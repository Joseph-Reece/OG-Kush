<?php

namespace App\Http\Controllers\Frontend;


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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }


    public function index()
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

    public function pageFaqs()
    {
        return view('frontend.page.faqs');
    }

    public function pageContact()
    {
        return view('frontend.page.contact');
    }

    public function pageLanding($page_number)
    {
        return view("frontend.page.landing_{$page_number}");
    }

    public function sendContact(Request $request)
    {
        Mail::send('frontend.mail.contact_form', [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'note' => $request->note
        ], function ($message) use ($request) {
            $message->to(setting('email_system'), "{$request->first_name}")->subject('Contact from ' . $request->first_name);
        });

        return back()->with('success', 'Contact has been send!');
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->keyword;
        $category_id = $request->category_id;
        $city_id = $request->city_id;

        $places = Place::query()
            ->with(['city' => function ($query) {
                return $query->select('id', 'name', 'slug');
            }])
            ->whereTranslationLike('name', "%{$keyword}%")
            ->orWhere('address', 'like', "%{$keyword}%")
            ->where('status', Place::STATUS_ACTIVE);

        if ($category_id) {
            $places->where('category', 'like', "%{$category_id}%");
        }

        if ($city_id) {
            $places->where('city_id', $city_id);
        }

        $places = $places->get(['id', 'city_id', 'name', 'slug', 'address']);

        $html = '<ul class="custom-scrollbar">';
        foreach ($places as $place) :
            if (isset($place['city'])) :
                $place_url = route('place_detail', $place->slug);
                $city_url = route('city_detail', $place['city']['slug']);
                $html .= "
                <li>
                    <a href=\"{$place_url}\">{$place->name}</a>
                    <a href=\"{$city_url}\"><i class=\"la la-city\"></i>{$place['city']['name']}</a>
                </li>
                ";
            endif;
        endforeach;
        $html .= '</ul>';

        $html_notfound = "<div class=\"golo-ajax-result\">No place found</div>";

        count($places) ?: $html = $html_notfound;

        return response($html, 200);
    }

    public function searchListing(Request $request)
    {
        $keyword = $request->keyword;

        $places = Place::query()
            ->with(['city' => function ($query) {
                return $query->select('id', 'name', 'slug');
            }])
            ->whereTranslationLike('name', "%{$keyword}%")
            ->orWhere('address', 'like', "%{$keyword}%")
            ->where('status', Place::STATUS_ACTIVE);

        $places = $places->get(['id', 'city_id', 'name', 'slug', 'address']);

        $html = '<ul class="listing_items">';
        foreach ($places as $place) :
            if (isset($place['city'])) :
                $place_url = route('place_detail', $place->slug);
                $html .= "
                <li>
                    <a href=\"{$place_url}\">{$place->name}</a>
                </li>
                ";
            endif;
        endforeach;
        $html .= '</ul>';

        $html_notfound = "<ul><li><a href='#'><span>No listing found!</span></a></li></ul>";

        count($places) ?: $html = $html_notfound;

        return response($html, 200);
    }


    public function fetchListingBySearch($keyword = '', $filter_category='')
    {

        $places = Place::query()
            ->with(['city' => function ($query) {
                return $query->select('id', 'name', 'slug');
            }])
            ->with('categories')
            ->with('place_types')
            ->withCount('reviews')
            ->with('avgReview')
            ->withCount('wishList')
            // ->where('name', 'like',  "%{$keyword}%")
            // ->where('address', 'like', "%{$keyword}%")
            // ->orWhere('slug', 'like',  "%{$keyword}%")
            ->where('status', Place::STATUS_ACTIVE)
            ;
            // dd($places->where('category', '["11"]')->get());

            if($keyword !=''){
                $places->where('name', 'like',  "%{$keyword}%")
                        ->orWhere('slug', 'like',  "%{$keyword}%")
                        ;
            }

            // dd($places->get());

            if ($filter_category !='') {

                $places->where('category', 'like', "%$filter_category%");

            }

        return $places;
    }

    public function changeLanguage($locale)
    {
        Session::put('language_code', $locale);
        $language = Session::get('language_code');

        return redirect()->back();
    }

    public function fetchListingsBySearch($keyword = '')
    {
        $places = Place::query()
            ->with(['city' => function ($query) {
                return $query->select('id', 'name', 'slug');
            }])
            ->with('categories')
            ->with('place_types')
            ->withCount('reviews')
            ->with('avgReview')
            ->withCount('wishList')
            ->where('name', 'like',  "%{$keyword}%")
            ->where('address', 'like', "%{$keyword}%")
            ->orWhere('slug', 'like',  "%{$keyword}%")
            ->where('status', Place::STATUS_ACTIVE);




        return $places;
    }

    //Our New
    public function pageSearchListing(Request $request)
    {
        $keyword = $request->keyword;
        $filter_category = $request->category;
        $filter_amenities = $request->amenities;
        $filter_place_type = $request->place_type;
        $filter_city = $request->city;
        $sort_by = $request->sort_by;
        $action = $request->action;
        $ajax = $request->ajax;
        $price = $request->price;
        $searchResults = $this->ourfetchListingsBySearch($keyword, $filter_category, $filter_amenities, $filter_place_type, $filter_city, $sort_by, $action, $ajax, $price);

        $warning = '';
        $query = Place::query()
            ->with(['city' => function ($query) {
                return $query->select('id', 'name', 'slug');
            }])
            ->with('categories')
            ->with('place_types')
            ->withCount('reviews')
            ->with('avgReview')
            ->withCount('wishList');
        if ($ajax == '1') {
            $places = $query->get();

            $city = null;
            if (isset($filter_city)) {
                $city = City::query()
                    ->whereIn('id', $filter_city)
                    ->first();
            }

            $data = [
                'city' => $city,
                'places' => $places
            ];

            return $this->response->formatResponse(200, $data, 'success');
        }

        $categories = Category::query()
            ->where('type', Category::TYPE_PLACE)
            ->get();

        $place_types = PlaceType::query()
            ->get();

        $amenities = Amenities::query()
            ->get();

        $cities = City::query()
            ->get();

        $payment_types = PaymentType::all();


        if (!$searchResults->isEmpty()) {

            if ($action == 'livesearch') {
                //dd('has entered');

                $warning = 'Livesearch';

                return View('frontend.common.business_item', [
                    'places' => $searchResults,
                    'warning' => $warning,
                ]);
            } else {
                $warning = 'Success';
                //dd($warning);

                return view("frontend.search.search_02", [
                    'keyword' => $keyword,
                    'places' => $searchResults,
                    'categories' => $categories,
                    'place_types' => $place_types,
                    'amenities' => $amenities,
                    'payment_types' => $payment_types,
                    'cities' => $cities,
                    'sort_by' => $sort_by,
                    'warning' => $warning,
                    'filter_category' => $filter_category,
                    'filter_amenities' => $filter_amenities,
                    'filter_place_type' => $filter_place_type,
                    'filter_city' => $request->city,
                ]);
            }
        } else {
            if ($action == 'livesearch') {
                //dd('has entered');

                $warning = 'Livesearch';

                return View('frontend.common.business_item', [
                    'places' => $searchResults,
                    'warning' => $warning,
                ]);
            } else {
                $warning = 'Success';
                //dd($warning);

                return view("frontend.search.search_02", [
                    'keyword' => $keyword,
                    'places' => $searchResults,
                    'categories' => $categories,
                    'place_types' => $place_types,
                    'amenities' => $amenities,
                    'cities' => $cities,
                    'sort_by' => $sort_by,
                    'warning' => $warning,
                    'filter_category' => $filter_category,
                    'filter_amenities' => $filter_amenities,
                    'filter_place_type' => $filter_place_type,
                    'filter_city' => $request->city,
                ]);

                // dd('should output page with all data');





            }
        }
    }





    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $filter_category = $request->category_id;
        $filter_amenities = $request->amenities;
        $filter_place_type = $request->place_type;
        $filter_city = $request->city;
        $sort_by = $request->sort_by;
        $action = $request->action;
        $paymentTypes = $request->paymentTypes;
        $price = $request->price;
        $output='';
        // dd($request->paymentTypes);

        $searchresults = $this->ourfetchListingsBySearch($keyword, $filter_category, $filter_amenities, $sort_by, $price,$paymentTypes);

        $places = $searchresults;

        // dd($places);
        $payment_types= PaymentType::all();

        $categories = Category::query()
            ->where('type', Category::TYPE_PLACE)
            ->get();

        $amenities = Amenities::query()
            ->get();

        if ($action === 'livesearch') {

            if (count($places)>0) {
                return view('frontend.common.place_item', compact('places'));
            } else {
                return view('frontend.common.place_empty_item');
            }

        } else {
            return view('frontend.search.search', [
                'places' => $places,
                'amenities' => $amenities,
                'category' => $categories,
                'payment_types' => $payment_types,
            ]);
        }
    }



public function ourfetchListingsBySearch($keyword = '', $filter_category, $filter_amenities,   $sort_by = '',  $price = '',$paymentTypes)
    {

        $query = Place::query()
            ->with(['city' => function ($query) {
                return $query->select('id', 'name', 'slug');
            }])
            ->with('categories')
            // ->with('payment_types')
            ->withCount('reviews')
            ->with('avgReview')
            ->withCount('wishList');

        $query->where('status', Place::STATUS_ACTIVE);

        //$place = Place::all()->first();

        //dd($query->avgReview);

        if ($keyword != '') {
            $query->where('name', 'like',  "%{$keyword}%")
                ->orWhere('slug', 'like',  "%{$keyword}%");
        }
        if ($filter_category != '') {
                    $query->where('category', 'like', "%$filter_category%");
        }

        if ($filter_amenities) {
            foreach ($filter_amenities as $item) {
                $query->where('amenities', 'like', "%$item%");
            }
        }

        if ($paymentTypes) {
            foreach ($paymentTypes as $item) {
                $query->where('payment_type', 'like', "%$item%");
            }
        }


        if ($sort_by == 'newest') {
            $query->orderBy('updated_at', 'desc');
        } elseif ($sort_by == 'price_asc') {
            $query->orderBy('price_range', 'asc');
        } elseif ($sort_by == 'price_desc') {
            $query->orderBy('price_range', 'desc');
        } elseif ($sort_by == 'rating') {
            $query->orderBy('vehicles.updated_at');
        }


        if ($price) {
            $query->where('price_range', $price);
        }




        return $query->get();
    }
}
