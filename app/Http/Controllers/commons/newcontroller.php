<?php

namespace App\Http\Controllers\commons;

use App\Commons\Response;
use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Deal;
use App\Models\Language;
use App\Models\Place;
use App\Models\PlaceType;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\Review;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class newcontroller extends Controller
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
    //
    public function Business_signup(Request $request, $id = null){
        SEOMeta(setting('app_name'), setting('home_description'));
        $country_id = '11';

        $countries = $this->country->getFullList();
        $categories = $this->category->getListAll(Category::TYPE_PLACE);
        $cities = $this->city->getListByCountry($country_id);

        $place_types = Category::query()
            ->with('place_type')
            ->get();

        $amenities = $this->amenities->getListAll();

        return view('frontend.New.business_signup', compact('countries','cities', 'categories', 'place_types', 'amenities'));

        // return view('frontend.New.place_addnew');
    }
    public function Business_package(){

        SEOMeta(setting('app_name'), setting('home_description'));

        return view('frontend.New.business_package');
    }

    public function searchProduct(Request $request){


        $keyword = $request->keyword;
        $place = $request->place;
        $category = $request->category;
        $sort = $request->sort;
        $searchResults = $this->fetchProductsBySearch($keyword, $place, $sort, $category);
        // $output = '';
        // $products = Product::where('place_id', $request->place);
        // dd($searchResults);
        $product = $searchResults->get();
        $warning = '';

            return View('frontend.place.place_product', compact('product','warning'));

    }


    public function fetchProductsBySearch($keyword='', $place, $sort='', $category='')
    {
        $query = Product::where('place_id', $place);

        if ($keyword != '') {
            $query->where('name', 'like',  "%{$keyword}%");
        }

        if ($category != '') {
            $query->where('category_id', $category);
        }

        if ($sort == 'desc') {
            $query->orderBy('id', 'DESC');
        }elseif($sort == 'price_asc'){
            $query->orderBy('price', 'ASC');
        }elseif($sort == 'price_desc'){
            $query->orderBy('price', 'DESC');
        }else{
            $query->orderBy('updated_at');
        }

        return $query;
    }

    // Search Reviews
    public function searchReview(Request $request){


        $keyword = $request->keyword;
        $place = $request->place;
        $searchResults = $this->fetchReviewsBySearch($keyword, $place);
        $reviews = $searchResults;
        $warning = '';

            return View('frontend.user.review', compact('reviews','warning'));

    }


    public function fetchReviewsBySearch($keyword='', $place)
    {

        $query = Review::query()
        ->with('user')
        ->where('place_id', $place)
        ->where('status', Review::STATUS_ACTIVE)
        ;


        if ($keyword != '') {
            $query->where('comment', 'like',  "%{$keyword}%");
        }


        return $query->get();
    }


    public function ProductDiscoveryPage(){

        $products= Product::all()->groupBy('category_id', true);

        $categories = ProductCategory::all();

        $subCategories = ProductSubCategory::all()->groupBy('product_category_id', true);




        //dd($subCategories);

        //dd($categories->products);

        return view('frontend.discover.index', [
            'subCategory'=>$subCategories,
            'categories'=>$categories,
        ]);
    }


}
