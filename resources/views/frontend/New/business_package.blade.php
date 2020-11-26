@extends('frontend.layouts.template_02')
@section('main')
<style>
    .bnt{
        color: white;
        background-color: #6c757d;
        border-color: #666e76;
    }
</style>

<main id="main" class="site-main home-main business-main">
    <div id="doctor" hidden>

        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="height: 400px">
            <div class="carousel-inner">
              <div class="carousel-item ">
                <img src="{{URL::asset('/assets/images/home-banner-apps.jpg')}}" class="d-block w-100" alt="..." style="height: 400px" >
              </div>
              <div class="carousel-item active">
                <img src="{{URL::asset('/assets/images/home-banner.jpg')}}" class="d-block w-100" alt="..." style="height: 400px">
              </div>
              <div class="carousel-item">
                <img src="{{URL::asset('/assets/images/home-banner.jpg')}}" class="d-block w-100" alt="..." style="height: 400px">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div id="dispensary" >

        <div id="carouselExampleControls2" class="carousel slide" data-ride="carousel" style="height: 400px">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{URL::asset('/assets/images/home-banner-apps.jpg')}}" class="d-block w-100" alt="..." style="height: 400px" >
              </div>
              <div class="carousel-item">
                <img src="{{URL::asset('/assets/images/home-banner.jpg')}}" class="d-block w-100" alt="..." style="height: 400px">
              </div>
              <div class="carousel-item">
                <img src="{{URL::asset('/assets/images/home-banner.jpg')}}" class="d-block w-100" alt="..." style="height: 400px">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls2" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls2" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="container-fluid bg-light py-2">
        <h6 class="text-uppercase text-center mb-2 " style="font-size: 3em">Pricing</h6>

        <div class="container-fluid">
            <nav class="nav nav-pills d-flex justify-content-center flex-column flex-sm-row" id="myTab" role="tablist">
                <a class="flex-sm-fill text-sm-center nav-link active " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dispensaries</a>

                <a class="flex-sm-fill text-sm-center nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Delivery Driver</a>

                <a class="flex-sm-fill text-sm-center nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Doctor</a>

                <a class="flex-sm-fill text-sm-center nav-link" id="brand-tab" data-toggle="tab" href="#brand" role="tab" aria-controls="brabd" aria-selected="false">Brand</a>

            </nav>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    {{-- Dispensary Pricing Table --}}

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
                                    <a href="#" class="btn btn-block btn-primary text-uppercase">Get Started</a>

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
                                    <a href="#" class="btn btn-block btn-primary text-uppercase">Get Started</a>
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
                                    <a href="#" class="btn btn-block btn-primary text-uppercase">Get Started</a>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </section>
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
                                    <a href="#" class="btn btn-block btn-primary text-uppercase">Get Started</a>

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
                                    <a href="#" class="btn btn-block btn-primary text-uppercase">Get Started</a>
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
                                    <a href="#" class="btn btn-block btn-primary text-uppercase">Get Started</a>
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
                                    <a href="#" class="btn btn-block btn-primary text-uppercase">Get Started</a>

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
                                    <a href="#" class="btn btn-block btn-primary text-uppercase">Get Started</a>
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
                                    <a href="#" class="btn btn-block btn-primary text-uppercase">Get Started</a>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="tab-pane fade" id="brand" role="tabpanel" aria-labelledby="brand-tab">

                    {{-- Brand Pricing Table --}}

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
                                    <a href="#" class="btn btn-block btn-primary text-uppercase">Get Started</a>

                                </div>
                                </div>
                            </div>
                            <!-- Plus Tier -->
                            <div class="col-lg-4">
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
                                    <a href="#" class="btn btn-block btn-primary text-uppercase">Get Started</a>
                                </div>
                                </div>
                            </div>
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
                                    <a href="#" class="btn btn-block btn-primary text-uppercase">Get Started</a>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

    </div>
</main>
@stop
