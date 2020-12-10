<?php

namespace Kubis\AgeGate\Controllers;

use Validator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

use App\Commons\Response;
use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\PaymentType;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Place;
use App\Models\PlaceType;
use App\Models\Post;
use App\Models\Testimonial;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;

use Kubis\AgeGate\Exceptions\AgeGateFormTypeNotSet;

class MainController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function get(Request $request)
    {
        // SEO Meta
        SEOMeta(setting('app_name'), setting('home_description'));

        $popular_cities = City::query()
            ->with('country')
            ->withCount(['places' => function ($query) {
                $query->where('status', Place::STATUS_ACTIVE);
            }])
            ->where('status', Country::STATUS_ACTIVE)
            ->limit(12)
            ->get();

        $blog_posts = Post::query()
            ->with(['categories' => function ($query) {
                $query->where('status', Category::STATUS_ACTIVE)
                    ->select('id', 'name', 'slug');
            }])
            ->where('type', Post::TYPE_BLOG)
            ->where('status', Post::STATUS_ACTIVE)
            ->limit(3)
            ->orderBy('created_at', 'desc')
            ->get(['id', 'category', 'slug', 'thumb']);


        $categories = Category::query()
            ->where('categories.status', Category::STATUS_ACTIVE)
            ->where('categories.type', Category::TYPE_PLACE)
            ->join('places', 'places.category', 'like', DB::raw("CONCAT('%', categories.id, '%')"))
            ->select('categories.id as id', 'categories.name as name', 'categories.priority as priority', 'categories.slug as slug', 'categories.color_code as color_code', 'categories.icon_map_marker as icon_map_marker', DB::raw("count(places.category) as place_count"))
            ->groupBy('categories.id')
            ->orderBy('categories.priority')
            ->limit(10)
            ->get();;


        $trending_places = Place::query()
            ->with('categories')
            ->with('city')
            ->with('place_types')
            ->withCount('reviews')
            ->with('avgReview')
            ->withCount('wishList')
            ->where('status', Place::STATUS_ACTIVE)
            ->limit(10)
            ->get();

        $testimonials = Testimonial::query()
            ->where('status', Testimonial::STATUS_ACTIVE)
            ->get();

        //        return $trending_places;

        $template = setting('template', '01');



        return view("frontend.home.home_{$template}", [
            'popular_cities' => $popular_cities,
            'blog_posts' => $blog_posts,
            'categories' => $categories,
            'trending_places' => $trending_places,
            'testimonials' => $testimonials
        ]);
    }


    // {
    //     $viewType = config('agegate.form_type', 'year');
    //     return View::first([
    //         'vendor.kubis.agegate.' . $viewType,
    //         'agegate::' . $viewType
    //     ]);
    // }

    public function post(Request $request){
        // redirect him back or to homepage
        $returnUrl = $request->has('return') ? rawurldecode($request->input('return')) : url('/');

        // validation based on configuration type
        switch(config('agegate.form_type')) {
            case 'dob':
                $validator = Validator::make($request->input(), [
                    'day' => 'required|numeric|min:1|max:31',
                    'month' => 'required|numeric|min:1|max:12',
                    'year' => 'required|digits:4',
                ]);
            break;

            case 'year':
                $validator = Validator::make($request->input(), [
                    'year' => 'required|digits:4',
                ]);
            break;

            default:
                throw new AgeGateFormTypeNotSet("AgeGate configuration form_type not set");
        }

        if ($validator->fails()) {
            return redirect(route('age-gate.redirect') . "?return=" . urlencode($returnUrl))
                ->withErrors($validator)
                ->withInput();
        }

        // do some additional datetime checks
        $then = new Carbon();
        $then->year = $request->input('year');
        if(config('agegate.form_type') == 'dob'){
            $then->day = $request->input('day');
            $then->month = $request->input('month');
        }

        if($then->diffInYears(new Carbon()) < (int)config('agegate.legal_age', 18)){
            return redirect(route('age-gate.redirect') . "?return=" . urlencode($returnUrl))
                ->withErrors([
                    'too_young' => true
                ])
                ->withInput();
        }

        if($then->diffInYears(new Carbon()) >= (int)config('agegate.maximum_age', 120)) {
            return redirect(route('age-gate.redirect') . "?return=" . urlencode($returnUrl))
                ->withErrors([
                    'too_old' => true
                ])
                ->withInput();
        }

        // check if remember me checkbox is checked
        if($request->has('remember') && (int)$request->input('remember') == 1) {
            $cookieTime = (int)config('agegate.cookie_time_extended') * 60 * 24;
        } else {
            $cookieTime = config('agegate.cookie_time') * 60 * 24;
        }


        return redirect($returnUrl)->cookie(config('agegate.cookie_name'), 'legal-age', $cookieTime);
    }
}
