<?php

namespace App\Http\Controllers\Auth;

use App\Commons\APICode;
use App\Commons\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use App\Models\Amenities;
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

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $user;
    protected $response;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, Response $response)
    {
        $this->middleware('guest');
        $this->user = $user;
        $this->response = $response;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // Registration form with the referal link
    public function showRegistrationForm(Request $request)
    {
        if ($request->has('ref')) {
            session(['referrer' => $request->query('ref')]);
        }

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


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $referrer = User::whereUsername(session()->pull('referrer'))->first();

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'referrer_id' => $referrer ? $referrer->id : null,

            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $validator = $this->user->validateRegister($request);

        if ($validator->code == APICode::SUCCESS) {
            $user = $this->user->create($request);
            $this->guard()->login($user);
        }

        return $this->response->formatResponse($validator->code, null, $validator->message);
    }

    // what happens after you register with a referal link
    protected function registered(Request $request, $user)
    {
        if ($user->referrer !== null) {
            // Notification::send($user->referrer, new ReferrerBonus($user));
        }

        return redirect($this->redirectPath());
    }
}
