<?php

namespace App\Http\Controllers\Mine;

use App\Commons\Response;
use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Language;
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

    // public function savebusiness(Request $request){



    //     // $this->validate($request, [
    //     //     'name' => 'required|string',
    //     //     'category' => 'string',
    //     //     'country_id' => 'required',
    //     //     'city_id' => 'required',
    //     //     'address' => 'required',
    //     //     'email' => 'required|email',
    //     //     'phone_number' => 'required',
    //     //     'website' => 'required|',
    //     //     'license_number' => 'required',
    //     //     'license_type' => 'required',
    //     //     'expiration' => 'required',
    //     // ]);

    //         // Put License details into array
    //     $license_details = array([
    //         'license_number' => $request->license_number,
    //         'license_type' =>$request->license_type,
    //         'expiration' =>$request->expiration
    //     ]);

    //     // Change $license_details to Json ******** to save as string **** to retrieve the output use $string_json = json_decode($license_details, true);
    //     $json_array = json_encode($license_details);

    //         // put json to $request array
    //     $request['license']= $json_array;
    //     $request['user_id'] = Auth::user()->id;
    //     $request['status'] = Place::STATUS_PENDING;

    //     //Get slug for business name
    //     $name = $request->name;
    //     $slug = \Illuminate\Support\Str::slug($name);

    //     $request['slug'] = $slug;

    //     $data = $request->except('_token');


    //     //dd($request->except('_token'));

    //     //hande saving data to table
    //     $business = new Place();
    //     $business->fill($data);
    //     // dd($business);

    //     $business->save();

    //     return redirect(route('user_my_place'))->with('success', 'Create place success. Waiting admin review and apporeve!');

    //     /*
    //     code to retrieve values
    //     $string_json = "[{"name":"1"},{"name2":"2"},{"name":"3"}]";
    //     $array_output = json_decode($string_json,true);
    //     */


    // }
}
