<?php

namespace App\Http\Controllers\Frontend;


use App\Commons\Response;
use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\PaymentType;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Deal;
use App\Models\Place;
use App\Models\PlaceType;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Review;
use App\Models\Wishlist;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PlaceController extends Controller
{
    private $place;
    private $country;
    private $city;
    private $category;
    private $amenities;
    private $response;

    public function __construct(
        Place $place,
        Country $country,
        City $city,
        Category $category,
        Amenities $amenities,
        Response $response
        )
    {
        $this->place = $place;
        $this->country = $country;
        $this->city = $city;
        $this->category = $category;
        $this->amenities = $amenities;
        $this->response = $response;
    }

    public function detail($slug)
    {
        $place = $this->place->getBySlug($slug);
        if (!$place) abort(404);

        // dd($place->age_limit);
        $city = City::query()
            ->with('country')
            ->where('id', $place->city_id)
            ->first();

        $amenities = Amenities::query()
            ->whereIn('id', $place->amenities ? $place->amenities : [])
            ->get(['id', 'name', 'icon']);

        $payment = PaymentType::query()
            ->whereIn('id', $place->payment_type ? $place->payment_type : [])
            ->get(['id', 'name', 'icon']);

        $categories = Category::query()
            ->whereIn('id', $place->category ? $place->category : [])
            ->get(['id', 'name', 'slug', 'icon_map_marker']);

        $place_types = PlaceType::query()
            ->whereIn('id', $place->place_type ? $place->place_type : [])
            ->get(['id', 'name']);

        $payment_types = PaymentType::query()
            ->whereIn('id', $place->payment_type ? $place->payment_type : [])
            ->get(['id', 'name', 'icon']);

        $reviews = Review::query()
            ->with('user')
            ->where('place_id', $place->id)
            ->where('status', Review::STATUS_ACTIVE)
            ->get();
            // dd($reviews['user']);
        $review_score_avg = Review::query()
            ->where('place_id', $place->id)
            ->where('status', Review::STATUS_ACTIVE)
            ->avg('score');

        $similar_places = Place::query()
            ->with('place_types')
            ->with('avgReview')
            ->withCount('reviews')
            ->withCount('wishList')
            ->where('city_id', $city->id)
            ->where('id', '<>', $place->id);
        foreach ($place->category as $cat_id):
            $similar_places->where('category', 'like', "%{$cat_id}%");
        endforeach;
        $similar_places = $similar_places->limit(4)->get();
        $addons = $place->gallery;

        $product = Product::where('place_id', $place->id)->get();
        $product_categories = ProductCategory::all();

        $license_details = $place->license;

        $license = json_decode($license_details, true);

        // dd($payment_types);

        // return $categories;

        // SEO Meta
        $title = $place->seo_title ? $place->seo_title : $place->name;
        $description = $place->seo_description ? $place->seo_description : Str::limit($place->description, 165);
        SEOMeta($title, $description, getImageUrl($place->thumb));

        $template = setting('template', '01');

        return view("frontend.place.place_detail_{$template}", [
            'place' => $place,
            'product' => $product,
            'product_categories' => $product_categories,
            'city' => $city,
            'amenities' => $amenities,
            'payment' => $payment,
            'categories' => $categories,
            'place_types' => $place_types,
            'payment_types' => $payment_types,
            'reviews' => $reviews,
            'license' => $license,
            'review_score_avg' => $review_score_avg,
            'similar_places' => $similar_places,

        ]);
    }

    public function businessInfo()
    {
        $user = Auth::user()->id;
        //dd($user);

        $place = $this->place->getById($user);
        // dd($place->age_limit);

        $license_details = $place->license;

        $license = json_decode($license_details, true);

        // dd($license);

        $city = City::query()
            ->with('country')
            ->where('id', $place->city_id)
            ->first();

        $amenities = Amenities::query()
            // ->whereIn('id', $place->amenities ? $place->amenities : [])
            ->get(['id', 'name', 'icon']);

        $payment = PaymentType::query()
            // ->whereIn('id', $place->amenities ? $place->amenities : [])
            ->get(['id', 'name', 'icon']);

        $categories = Category::query()
            ->whereIn('id', $place->category ? $place->category : [])
            ->get(['id', 'name', 'slug', 'icon_map_marker']);

        $place_types = PlaceType::query()
            ->whereIn('id', $place->place_type ? $place->place_type : [])
            ->get(['id', 'name']);

        $reviews = Review::query()
            ->with('user')
            ->where('place_id', $place->id)
            ->where('status', Review::STATUS_ACTIVE)
            ->get();
        $review_score_avg = Review::query()
            ->where('place_id', $place->id)
            ->where('status', Review::STATUS_ACTIVE)
            ->avg('score');

        $similar_places = Place::query()
            ->with('place_types')
            ->with('avgReview')
            ->withCount('reviews')
            ->withCount('wishList')
            ->where('city_id', $city->id)
            ->where('id', '<>', $place->id);

        $followers = Wishlist::where('place_id', $place->id)->count();
        // dd($followers);
        foreach ($place->category as $cat_id):
            $similar_places->where('category', 'like', "%{$cat_id}%");
        endforeach;
        $similar_places = $similar_places->limit(4)->get();
        // dd($place->thumb);
        $addons = $place->gallery;
        // $cover_image= $addons[0];
        // dd($cover_image);


        // return $categories;

        // SEO Meta
        $title = $place->seo_title ? $place->seo_title : $place->name;
        $description = $place->seo_description ? $place->seo_description : Str::limit($place->description, 165);
        SEOMeta($title, $description, getImageUrl($place->thumb));

        // $template = setting('template', '01');

        // return view("frontend.place.place_detail_{$template}", [
        return view("frontend.user.user_business", [
            'place' => $place,
            'city' => $city,
            'license' => $license,
            'amenities' => $amenities,
            'payment' => $payment,
            'categories' => $categories,
            'place_types' => $place_types,
            'reviews' => $reviews,
            'followers' => $followers,
            'review_score_avg' => $review_score_avg,
            'similar_places' => $similar_places,
            // Mine
            // 'cover_image' => $cover_image
        ]);
    }

    public function pageReviews(Request $request){

        // $filter = [
        //     // 'city' => $request->city_id,
        //     // 'category' => $request->category_id,
        //     'keyword' => $request->keyword,
        // ];
        $filter_keyword = $request->keyword;
        // dd($filter_keyword);

        $user = Auth::user()->id;

        $place = $this->place->getById($user);

        $reviews = Review::query()
        ->with('user')
        ->where('place_id', $place->id)
        ->where('status', Review::STATUS_ACTIVE)
        ->get();

        $review_score_avg = Review::query()
        ->where('place_id', $place->id)
        ->where('status', Review::STATUS_ACTIVE)
        ->avg('score');
        // dd($reviews[1]->comment );
        foreach ($reviews as $key => $value) {
            # code...
            $review=$value;
        }


        // dd($reviews[0]->where('comment', 'like', '%'.$filter_keyword.'%'));

        // $reviews = $reviews->paginate();


        return view("frontend.user.business_reviews", [
            'place' => $place,
            'reviews' => $reviews,
            'review_score_avg' => $review_score_avg,
            'filter' => $filter_keyword
        ]);


    }

    public function pageNew()
    {
        SEOMeta(setting('app_name'), setting('home_description'));
        $country_id = '11';

        $countries = $this->country->getFullList();
        $categories = $this->category->getListAll(Category::TYPE_PLACE);
        $cities = $this->city->getListByCountry($country_id);

        $place_types = Category::query()
            ->with('place_type')
            ->get();

        $amenities = $this->amenities->getListAll();

        return view('frontend.New.business_signup', compact('countries','cities', 'categories', 'place_types', 'amenities'));;
    }
    public function pageAddNew(Request $request, $id = null)
    // public function pageAddNew(Request $request)
    {
        $place = Place::find($id);

        $license_details = $place->license;

        $license = json_decode($license_details, true);

        /////dd($license);

        if ($place) abort_if($place->user_id !== Auth::id(), 401);

        $country_id = $place ? $place->country_id : false;

        $countries = $this->country->getFullList();
        $cities = $this->city->getListByCountry($country_id);
        $categories = $this->category->getListAll(Category::TYPE_PLACE);
        // dd($this->country);

        $place_types = Category::query()
            ->with('place_type')
            ->get();

        $amenities = $this->amenities->getListAll();
        $payment= PaymentType::all();

        $app_name = setting('app_name', 'Golo.');
        SEOMeta("Add new place - {$app_name}");
        return view('frontend.place.place_edit', [
            'place' => $place,
            'countries' => $countries,
            'cities' => $cities,
            'payment' => $payment,
            'categories' => $categories,
            'place_types' => $place_types,
            'amenities' => $amenities,
            'license' => $license,
        ]);
    }

    public function create(Request $request)
    {
        $request['user_id'] = Auth::id();
        $request['status'] = Place::STATUS_PENDING;


        $name = $request->name;
        $request['name'] = $name;

        $slug = \Illuminate\Support\Str::slug($name);
        $request['slug'] = $slug;
        //dd($request->all());

        $rule_factory = RuleFactory::make([
            'user_id' => '',
            'country_id' => '',
            'city_id' => '',
            'category' => '',
            //'place_type' => '',
            'name' => '',
            'slug' => '',
            '%description%' => '',
            'price_range' => '',
            'age_limit' => '',
            //'amenities' => '',
            //'payment_type' => '',
            'address' => '',
            'lat' => '',
            'lng' => '',
            'email' => '',
            'phone_number' => '',
            'website' => '',
            'social' => '',
            'opening_hour' => '',
            'gallery' => '',
            'video' => '',
            //'link_bookingcom' => '',
            'status' => '',
            //'thumb' => 'mimes:jpeg,jpg,png,gif|max:10000'
        ]);
        $data = $this->validate($request, $rule_factory);
            // $data = $request->all();
        // dd($data);

        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb');
            $thumb_file = $this->uploadImage($thumb, '');
            $data['thumb'] = $thumb_file;
        }


        $model = new Place();
        $model->fill($data);

        if ($model->save()) {
            return redirect(route('user_my_place'))->with('success', 'Create place success. Waiting admin review and apporeve!');
        }

        return $request;
    }

    public function update(Request $request)
    {
        $request['slug'] = getSlug($request, 'name');

       $rule_factory = RuleFactory::make([
            'user_id' => '',
            'country_id' => '',
            'city_id' => '',
            'category' => '',
            'place_type' => '',
            '%name%' => '',
            'slug' => '',
            '%description%' => '',
            'price_range' => '',
            'age_limit' => '',
            'amenities' => '',
            'payment_type' => '',
            'address' => '',
            'lat' => '',
            'lng' => '',
            'email' => '',
            'phone_number' => '',
            'website' => '',
            'social' => '',
            'opening_hour' => '',
            'gallery' => '',
            'video' => '',
            'link_bookingcom' => '',
            'status' => '',
        'thumb' => 'mimes:jpeg,jpg,png,gif|max:10000'
        ]);
        $data = $this->validate($request, $rule_factory);

        $data = $request->all();
        // dd($data);

        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb');
            $thumb_file = $this->uploadImage($thumb, '');
            $data['thumb'] = $thumb_file;
        }
        // dd($thumb = $request->file('thumb'));

        $model = Place::find($request->place_id);
        $model->fill($data);

        if ($model->save()) {
            return redirect()->back()->with('success', 'Update place success!');
        }

        return $request;
    }

    public function getListMap(Request $request)
    {
        $city = City::find($request->city_id);

        $places = Place::query()
            ->with('categories')
            ->with('avgReview')
            ->withCount('reviews')
            ->where('city_id', $request->city_id)
            ->where('category', 'like', '%' . $request->category_id . '%')
            ->where('status', Place::STATUS_ACTIVE)
            ->get();

        $data = [
            'city' => $city,
            'places' => $places
        ];

        return $this->response->formatResponse(200, $data, 'success');
    }
    public function getListMapSearch(Request $request)
    {
        dd($request->name);
        $city = City::find($request->name);

        $places = Place::query()
            ->with('categories')
            ->with('avgReview')
            ->withCount('reviews')
            ->where('city_id', $request->city_id)
            ->where('category', 'like', '%' . $request->category_id . '%')
            ->where('status', Place::STATUS_ACTIVE)
            ->get();

        $data = [
            'city' => $city,
            'places' => $places
        ];

        return $this->response->formatResponse(200, $data, 'success');
    }

    public function getListFilter(Request $request)
    {
        $city_id = $request->city_id;
        $category_id = $request->category_id;

        $sort_by = $request->sort_by;
        $price_range = $request->price;
        $place_types = $request->place_types;
        $amenities = $request->amenities;

        $places = Place::query()
            ->with('place_types')
            ->withCount('reviews')
            ->with('avgReview')
            ->withCount('wishList')
            ->where('city_id', $city_id)
            ->where('category', 'like', "%$category_id%")
            ->where('status', Place::STATUS_ACTIVE);

        if ($price_range) {
            $places->where('price_range', $price_range);
        }
        if ($place_types) {
            foreach ($place_types as $place_type) {
                $places->where('place_type', 'like', "%$place_type%");
            }
        }
        if ($amenities) {
            foreach ($amenities as $item) {
                $places->where('amenities', 'like', "%$item%");
            }
        }

        if ($sort_by) {
            if ($sort_by === 'price_asc') $places->orderBy('price_range', 'asc');
            if ($sort_by === 'price_desc') $places->orderBy('price_range', 'desc');
        }

        $places = $places->get();

        $html = "";
        if (count($places)) :
            foreach ($places as $place) :
                $place_detail_url = route('place_detail', $place->slug);
                $place_price_range = PRICE_RANGE[$place->price_range];
                $place_thumb = getImageUrl($place->thumb);

                $html_place_type = "";
                foreach ($place['place_types'] as $type) :
                    $html_place_type .= "<a href='#' title='{$type->name}'> {$type->name}</a>";
                endforeach;

                if ($place->wish_list_count) {
                    $class_wishlist = "remove_wishlist active";
                } else {
                    Auth::user() ? $class_wishlist = "add_wishlist" : $class_wishlist = "open-login";
                }

                $html_review = "";
                if ($place->reviews_count) $html_review .= "{$place->avgReview} <i class='la la-star'></i>";

                $html .= "
                <div class='col-xl-3 col-lg-4 col-6'>
                    <div class='places-item hover__box'>
                        <div class='places-item__thumb hover__box__thumb'>
                            <a title='Barcelona' href='{$place_detail_url}'><img src='{$place_thumb}' alt='{$place->name}'></a>
                        </div>
                        <a href='#' class='place-item__addwishlist {$class_wishlist}' data-id='{$place->id}' title='Add Wishlist'>
                            <i class='la la-bookmark la-24'></i>
                        </a>
                        <div class='places-item__info'>
                            <div class='places-item__category'>
                                {$html_place_type}
                            </div>
                            <h3><a href='{$place_detail_url}' title='{$place->name}'>{$place->name}</a></h3>
                            <div class='places-item__meta'>
                                <div class='places-item__reviews'>
                                    <span class='places-item__number'>
                                        {$html_review}
                                        <span class='places-item__count'>({$place->reviews_count} reviews)</span>
                                    </span>
                                </div>
                                <div class='places-item__currency'>
                                    {$place_price_range}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            endforeach;
        else:
            $html .= "<div class='col-md-12 text-center'>No places</div>";
        endif;

        return $html;
    }

    public function showMenu(){

        $user= Auth::user()->id;
        $place = Place::where('user_id', $user)->first();
        $category = ProductCategory::all();
        $product = Product::where('place_id' , $place->id)->get();

        //  dd($product->name);



        $deal = Deal::where('place_id' , $place->id)->get();


        return view('frontend.products.place_menu', compact('category', 'product', 'place', 'deal'));
    }
}
