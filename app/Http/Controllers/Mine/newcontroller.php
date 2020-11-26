<?php

namespace App\Http\Controllers\Mine;

use App\Commons\Response;
use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Place;
use App\Models\PlaceType;
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


        $place = Place::find($id);
        

        if ($place) abort_if($place->user_id !== Auth::id(), 401);

        $country_id = $place ? $place->country_id : false;

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
}
