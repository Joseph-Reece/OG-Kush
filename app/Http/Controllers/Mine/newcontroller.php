<?php

namespace App\Http\Controllers\Mine;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class newcontroller extends Controller
{
    //
    public function Business_signup(){
        SEOMeta(setting('app_name'), setting('home_description'));

        return view('frontend.New.business_signup');
    }
    public function Business_package(){

        SEOMeta(setting('app_name'), setting('home_description'));

        return view('frontend.New.business_package');
    }
}
