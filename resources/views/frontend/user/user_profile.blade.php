@extends('frontend.layouts.template')
@section('main')
    <main id="main" class="site-main">
        <div class="site-content">
            <div class="member-menu">
                <div class="container">
                    @include('frontend.user.user_menu')
                </div>
            </div>
            <div class="container">
                {{-- <div class="member-wrap">
                    <h1>{{__('Profile Setting')}}</h1>

                    @include('frontend.common.box-alert')

                    <form class="member-profile form-underline" action="{{route('user_profile_update')}}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <h3>{{__('Avatar')}}</h3>
                        <div class="member-avatar">
                            <img id="member_avatar" src="{{getUserAvatar(user()->avatar)}}" alt="Member Avatar">
                            <label for="upload_new">
                                <input id="upload_new" type="file" name="avatar" value="{{__('Upload new')}}" accept="image/*">
                                {{__('Upload new')}}
                            </label>
                        </div>
                        <h3>{{__('Basic Info')}}</h3>
                        <div class="field-input">
                            <label for="name">{{__('Full name')}}</label>
                            <input type="text" id="name" name="name" value="{{user()->name}}" placeholder="{{__('Enter your name')}}">
                        </div>
                        <div class="field-input">
                            <label for="email">{{__('Email')}}</label>
                            <input type="email" id="email" name="email" value="{{user()->email}}" disabled>
                        </div>
                        <div class="field-input">
                            <label for="phone">{{__('Phone')}}</label>
                            <input type="tel" id="phone" name="phone_number" value="{{user()->phone_number}}" placeholder="{{__('Enter phone number')}}">
                        </div>
                        <div class="field-input">
                            <label for="facebook">{{__('Facebook')}}</label>
                            <input type="text" id="facebook" name="facebook" value="{{user()->facebook}}" placeholder="{{__('Enter facebook')}}">
                        </div>
                        <div class="field-input">
                            <label for="instagram">{{__('Instagram')}}</label>
                            <input type="text" id="instagram" name="instagram" value="{{user()->instagram}}" placeholder="{{__('Enter instagram')}}">
                        </div>
                        <div class="field-submit">
                            <input type="submit" value="{{__('Update')}}">
                        </div>
                    </form><!-- .member-profile -->

                    <form class="member-password form-underline" action="{{route('user_password_update')}}" method="post">
                        @method('put')
                        @csrf
                        <h3>{{__('Change Password')}}</h3>
                        <div class="field-input">
                            <label for="old_password">{{__('Old password')}}</label>
                            <input type="password" name="old_password" placeholder="{{__('Enter old password')}}" id="old_password" required>
                        </div>
                        <div class="field-input">
                            <label for="new_password">{{__('New password')}}</label>
                            <input type="password" name="password" placeholder="{{__('Enter new password')}}" id="new_password" required>
                        </div>
                        <div class="field-input">
                            <label for="re_new">{{__('Re-new password')}}</label>
                            <input type="password" name="password_confirmation" placeholder="{{__('Enter new password')}}" id="re_new" required>
                        </div>
                        <div class="field-submit">
                            <input type="submit" value="{{__('Save')}}">
                        </div>
                    </form><!-- .member-password -->

                </div> --}}
                <div class="container-fluid">
                    <nav class="nav nav-pills d-flex justify-content-center flex-column flex-sm-row" id="myTab" role="tablist">
                            <a class="flex-sm-fill text-sm-center nav-link active " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile </a>
                            <a class="flex-sm-fill text-sm-center nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Store Info</a>
                            <a class="flex-sm-fill text-sm-center nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Menu</a>
                            <a class="flex-sm-fill text-sm-center nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Following</a>
                            <a class="flex-sm-fill text-sm-center nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Reviews</a>
                    </nav>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="member-wrap">
                                <h1>{{__('Profile Setting')}}</h1>

                                @include('frontend.common.box-alert')

                                <form class="member-profile form-underline" action="{{route('user_profile_update')}}" method="post" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <h3>{{__('Avatar')}}</h3>
                                    <div class="member-avatar">
                                        <img id="member_avatar" src="{{getUserAvatar(user()->avatar)}}" alt="Member Avatar">
                                        <label for="upload_new">
                                            <input id="upload_new" type="file" name="avatar" value="{{__('Upload new')}}" accept="image/*">
                                            {{__('Upload new')}}
                                        </label>
                                    </div>
                                    <h3>{{__('Basic Info')}}</h3>
                                    <div class="field-input">
                                        <label for="name">{{__('Full name')}}</label>
                                        <input type="text" id="name" name="name" value="{{user()->name}}" placeholder="{{__('Enter your name')}}">
                                    </div>
                                    <div class="field-input">
                                        <label for="email">{{__('Email')}}</label>
                                        <input type="email" id="email" name="email" value="{{user()->email}}" disabled>
                                    </div>
                                    <div class="field-input">
                                        <label for="phone">{{__('Phone')}}</label>
                                        <input type="tel" id="phone" name="phone_number" value="{{user()->phone_number}}" placeholder="{{__('Enter phone number')}}">
                                    </div>
                                    <div class="field-input">
                                        <label for="facebook">{{__('Facebook')}}</label>
                                        <input type="text" id="facebook" name="facebook" value="{{user()->facebook}}" placeholder="{{__('Enter facebook')}}">
                                    </div>
                                    <div class="field-input">
                                        <label for="instagram">{{__('Instagram')}}</label>
                                        <input type="text" id="instagram" name="instagram" value="{{user()->instagram}}" placeholder="{{__('Enter instagram')}}">
                                    </div>
                                    <div class="field-submit">
                                        <input type="submit" value="{{__('Update')}}">
                                    </div>
                                </form><!-- .member-profile -->

                                <form class="member-password form-underline" action="{{route('user_password_update')}}" method="post">
                                    @method('put')
                                    @csrf
                                    <h3>{{__('Change Password')}}</h3>
                                    <div class="field-input">
                                        <label for="old_password">{{__('Old password')}}</label>
                                        <input type="password" name="old_password" placeholder="{{__('Enter old password')}}" id="old_password" required>
                                    </div>
                                    <div class="field-input">
                                        <label for="new_password">{{__('New password')}}</label>
                                        <input type="password" name="password" placeholder="{{__('Enter new password')}}" id="new_password" required>
                                    </div>
                                    <div class="field-input">
                                        <label for="re_new">{{__('Re-new password')}}</label>
                                        <input type="password" name="password_confirmation" placeholder="{{__('Enter new password')}}" id="re_new" required>
                                    </div>
                                    <div class="field-submit">
                                        <input type="submit" value="{{__('Save')}}">
                                    </div>
                                </form><!-- .member-password -->

                            </div>
                            {{-- Dispensary Pricing Table --}}

                            {{-- <section class="pricing py-5" >
                                <div class="container">
                                    <div class="row">
                                    <!-- Free Tier -->
                                    <div class="col-lg-4">
                                        <div class="card mb-5 mb-lg-0">
                                        <div class="card-body">
                                            <h5 class="card-title text-muted text-uppercase text-center">Basic</h5>
                                            <h6 class="card-price text-center">$50<span class="period">/month</span></h6>
                                            <hr>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Map Marker </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Phone Number </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Store Hours </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Offer Up To 5 Products On Display </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Company Name & Address</li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Company Logo</li>
                                                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Featured Listing On Rotation (‘x’ amount on rotation guaranteed per day)</li>
                                                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Offer Up To 20 Products On Display Under Any Categories</li>
                                                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Allow Reviews To Be Displayed For Your Company In The Listing</li>
                                                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Delivery Service Description & ‘About Us’ Information</li>
                                                <li class="text-muted"  ><span class="fa-li"><i class="fas fa-times"></i></span>Offer Discounts & Deals</li>
                                                <li class="text-muted"  ><span class="fa-li"><i class="fas fa-times"></i></span>Import Videos</li>
                                                <li class="text-muted"  ><span class="fa-li"><i class="fas fa-times"></i></span>Premium Map Marker (Bigger and Different colored Map Marker) </li>
                                            </ul>
                                            <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a>

                                        </div>
                                        </div>
                                    </div>
                                    <!-- Plus Tier -->
                                    <div class="col-lg-4">
                                        <div class="card mb-5 mb-lg-0">
                                        <div class="card-body">
                                            <h5 class="card-title text-muted text-uppercase text-center">Plus</h5>
                                            <h6 class="card-price text-center">$125<span class="period">/month</span></h6>
                                            <hr>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Map Marker </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Phone Number </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Store Hours </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Offer Up To 5 Products On Display </li>
                                                <li class=""><span class="fa-li"><i class="fas fa-check"></i></span>Company Name & Address</li>
                                                <li class=""><span class="fa-li"><i class="fas fa-check"></i></span>Company Logo</li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Featured Listing On Rotation (‘x’ amount on rotation guaranteed per day)</li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Offer Up To 20 Products On Display Under Any Categories</li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Allow Reviews To Be Displayed For Your Company In The Listing</li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Delivery Service Description & ‘About Us’ Information</li>
                                                <li class="text-muted" ><span class="fa-li"><i class="fas fa-times"></i></span>Offer Discounts & Deals</li>
                                                <li class="text-muted" ><span class="fa-li"><i class="fas fa-times"></i></span>Import Videos</li>
                                                <li class="text-muted" ><span class="fa-li"><i class="fas fa-times"></i></span>Premium Map Marker (Bigger and Different colored Map Marker) </li>
                                            </ul>
                                            <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a>
                                        </div>
                                        </div>
                                    </div>
                                    <!-- Pro Tier -->
                                    <div class="col-lg-4">
                                        <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title text-muted text-uppercase text-center">Pro</h5>
                                            <h6 class="card-price text-center">$200<span class="period">/month</span></h6>
                                            <hr>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Map Marker </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Phone Number </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Store Hours </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Offer Up To 5 Products On Display </li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Company Name & Address</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Company Logo</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>High Priority On Featured Listings In Rotation (‘x’ amount guaranteed per day)</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Offer Unlimited Products On Display Under Any Categories</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Allow Reviews To Be Displayed For Your Company In The Listing</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Delivery Service Description & ‘About Us’ Information</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Offer Discounts & Deals</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Import Videos</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Premium Map Marker (Bigger and Different colored Map Marker) </li>
                                            </ul>
                                            <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </section> --}}
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                            {{--  Delivery Driver Pricing Table --}}

                            <section class="pricing py-5" >
                                <div class="container">
                                    <div class="row">
                                    <!-- Free Tier -->
                                    <div class="col-lg-4">
                                        <div class="card mb-5 mb-lg-0">
                                        <div class="card-body">
                                            <h5 class="card-title text-muted text-uppercase text-center">Basic</h5>
                                            <h6 class="card-price text-center">$50<span class="period">/month</span></h6>
                                            <hr>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Map Marker </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Phone Number </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Store Hours </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Offer Up To 5 Products On Display </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Company Name & Address</li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Company Logo</li>
                                                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Featured Listing On Rotation (‘x’ amount on rotation guaranteed per day)</li>
                                                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Offer Up To 20 Products On Display Under Any Categories</li>
                                                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Allow Reviews To Be Displayed For Your Company In The Listing</li>
                                                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Delivery Service Description & ‘About Us’ Information</li>
                                                <li class="text-muted"  ><span class="fa-li"><i class="fas fa-times"></i></span>Offer Discounts & Deals</li>
                                                <li class="text-muted"  ><span class="fa-li"><i class="fas fa-times"></i></span>Import Videos</li>
                                                <li class="text-muted"  ><span class="fa-li"><i class="fas fa-times"></i></span>Premium Map Marker (Bigger and Different colored Map Marker) </li>
                                            </ul>
                                            <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a>

                                        </div>
                                        </div>
                                    </div>
                                    <!-- Plus Tier -->
                                    <div class="col-lg-4">
                                        <div class="card mb-5 mb-lg-0">
                                        <div class="card-body">
                                            <h5 class="card-title text-muted text-uppercase text-center">Plus</h5>
                                            <h6 class="card-price text-center">$125<span class="period">/month</span></h6>
                                            <hr>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Map Marker </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Phone Number </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Store Hours </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Offer Up To 5 Products On Display </li>
                                                <li class=""><span class="fa-li"><i class="fas fa-check"></i></span>Company Name & Address</li>
                                                <li class=""><span class="fa-li"><i class="fas fa-check"></i></span>Company Logo</li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Featured Listing On Rotation (‘x’ amount on rotation guaranteed per day)</li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Offer Up To 20 Products On Display Under Any Categories</li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Allow Reviews To Be Displayed For Your Company In The Listing</li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Delivery Service Description & ‘About Us’ Information</li>
                                                <li class="text-muted" ><span class="fa-li"><i class="fas fa-times"></i></span>Offer Discounts & Deals</li>
                                                <li class="text-muted" ><span class="fa-li"><i class="fas fa-times"></i></span>Import Videos</li>
                                                <li class="text-muted" ><span class="fa-li"><i class="fas fa-times"></i></span>Premium Map Marker (Bigger and Different colored Map Marker) </li>
                                            </ul>
                                            <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a>
                                        </div>
                                        </div>
                                    </div>
                                    <!-- Pro Tier -->
                                    <div class="col-lg-4">
                                        <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title text-muted text-uppercase text-center">Pro</h5>
                                            <h6 class="card-price text-center">$200<span class="period">/month</span></h6>
                                            <hr>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Map Marker </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Phone Number </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Store Hours </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Offer Up To 5 Products On Display </li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Company Name & Address</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Company Logo</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>High Priority On Featured Listings In Rotation (‘x’ amount guaranteed per day)</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Offer Unlimited Products On Display Under Any Categories</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Allow Reviews To Be Displayed For Your Company In The Listing</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Delivery Service Description & ‘About Us’ Information</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Offer Discounts & Deals</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Import Videos</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Premium Map Marker (Bigger and Different colored Map Marker) </li>
                                            </ul>
                                            <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                            {{-- Doctor Pricing Table --}}

                            <section class="pricing py-5" >
                                <div class="container">
                                    <div class="row">
                                    <!-- Free Tier -->
                                    <div class="col-lg-4">
                                        <div class="card mb-5 mb-lg-0">
                                        <div class="card-body">
                                            <h5 class="card-title text-muted text-uppercase text-center">Free</h5>
                                            <h6 class="card-price text-center">$0<span class="period">/month</span></h6>
                                            <hr>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Map Marker </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Phone Number </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Store Hours </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Offer Up To 5 Products On Display </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Company Name & Address</li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Company Logo</li>
                                                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Featured Listing On Rotation (‘x’ amount on rotation guaranteed per day)</li>
                                                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Offer Up To 20 Products On Display Under Any Categories</li>
                                                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Allow Reviews To Be Displayed For Your Company In The Listing</li>
                                                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Doctor Service Description & ‘About Us’ Information</li>
                                                <li class="text-muted"  ><span class="fa-li"><i class="fas fa-times"></i></span>Offer Discounts & Deals</li>
                                                <li class="text-muted"  ><span class="fa-li"><i class="fas fa-times"></i></span>Import Photos & Videos</li>
                                                {{-- <li class="text-muted"  ><span class="fa-li"><i class="fas fa-times"></i></span>Premium Map Marker (Bigger and Different colored Map Marker) </li> --}}
                                            </ul>
                                            <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a>

                                        </div>
                                        </div>
                                    </div>
                                    <!-- Plus Tier -->
                                    {{-- <div class="col-lg-4">
                                        <div class="card mb-5 mb-lg-0">
                                        <div class="card-body">
                                            <h5 class="card-title text-muted text-uppercase text-center">Plus</h5>
                                            <h6 class="card-price text-center">$20<span class="period">/month</span></h6>
                                            <hr>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Map Marker </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Phone Number </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Store Hours </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Offer Up To 5 Products On Display </li>
                                                <li class=""><span class="fa-li"><i class="fas fa-check"></i></span>Company Name & Address</li>
                                                <li class=""><span class="fa-li"><i class="fas fa-check"></i></span>Company Logo</li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Featured Listing On Rotation (‘x’ amount on rotation guaranteed per day)</li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Offer Up To 20 Products On Display Under Any Categories</li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Allow Reviews To Be Displayed For Your Company In The Listing</li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Doctor Service Description & ‘About Us’ Information</li>
                                                <li class="text-muted" ><span class="fa-li"><i class="fas fa-times"></i></span>Offer Discounts & Deals</li>
                                                <li class="text-muted" ><span class="fa-li"><i class="fas fa-times"></i></span>Import Photos & Videos</li>
                                                <li class="text-muted" ><span class="fa-li"><i class="fas fa-times"></i></span>Premium Map Marker (Bigger and Different colored Map Marker) </li>
                                            </ul>
                                            <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a>
                                        </div>
                                        </div>
                                    </div> --}}
                                    <!-- Pro Tier -->
                                    <div class="col-lg-4">
                                        <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title text-muted text-uppercase text-center">Pro</h5>
                                            <h6 class="card-price text-center">$20<span class="period">/month</span></h6>
                                            <hr>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Map Marker </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Phone Number </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Store Hours </li>
                                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Offer Up To 5 Products On Display </li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Company Name & Address</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Company Logo</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>High Priority On Featured Listings In Rotation (‘x’ amount guaranteed per day)</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Offer Unlimited Products On Display Under Any Categories</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Allow Reviews To Be Displayed For Your Company In The Listing</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Doctors Service Description & ‘About Us’ Information</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Offer Discounts & Deals</li>
                                                <li ><span class="fa-li"><i class="fas fa-check"></i></span>Import Photos & Videos</li>
                                                {{-- <li ><span class="fa-li"><i class="fas fa-check"></i></span>Premium Map Marker (Bigger and Different colored Map Marker) </li> --}}
                                            </ul>
                                            <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <!-- .member-wrap -->
            </div>
        </div><!-- .site-content -->
    </main><!-- .site-main -->
@stop
