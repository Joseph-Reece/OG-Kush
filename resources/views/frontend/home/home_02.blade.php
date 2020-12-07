@php
    $img_home_banner = getImageUrl(setting('home_banner'));
    if (setting('home_banner')) {
        $home_banner = "style=background-image:url({$img_home_banner})";
    } else {
        $home_banner = "style=background-image:url(/assets/images/home-bsn-banner.jpg)";
    }
@endphp
<style>
/* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
       #map {
  height: 100%;
}
</style>
@extends('frontend.layouts.template_02')
@section('main')
    <main id="main" class="site-main home-main business-main">
        <div class="site-banner" {{$home_banner}}>
            <div class="container">
                <div class="site-banner__content">
                    <h1 class="site-banner__title">{{__('Business Listing')}}</h1>
                    <p><i>{{$city_count}}</i> {{__('cities')}}, <i>{{$category_count}}</i> {{__('categories')}}, <i>{{$place_count}}</i> {{__('places')}}.</p>
                    <form action="{{route('page_search_listing')}}" class="site-banner__search layout-02">
                        <div class="field-input">
                            <label for="input_search">Find</label>
                            <input class="site-banner__search__input open-suggestion" id="input_search" type="text" placeholder="Ex: fastfood, beer" autocomplete="off">
                            <input type="hidden" name="category[]" id="category_id">
                            <div class="search-suggestions category-suggestion">
                                <ul>
                                    <li><a href="#"><span>{{__('Loading...')}}</span></a></li>
                                </ul>
                            </div>
                        </div><!-- .site-banner__search__input -->
                        <div class="field-input">
                            <label for="location_search">{{__('Where')}}</label>
                            <input class="site-banner__search__input open-suggestion" id="location_search" type="text" placeholder="Your city" autocomplete="off">
                            <input type="hidden" id="city_id">
                            <div class="search-suggestions location-suggestion">
                                <ul>
                                    <li><a href="#"><span>{{__('Loading...')}}</span></a></li>
                                </ul>
                            </div>
                        </div><!-- .site-banner__search__input -->
                        <div class="field-submit">
                            <button><i class="las la-search la-24-black"></i></button>
                        </div>
                        {{-- <input type="hidden" name="action" value="homesearch"> --}}
                    </form><!-- .site-banner__search -->
                </div><!-- .site-banner__content -->
            </div>
        </div><!-- .site-banner -->

        {{-- <div class="business-category">
            <div class="container">
                <h2 class="title title-border-bottom align-center">{{__('Browse Businesses by Category')}}</h2>
                <div class="slick-sliders">
                    <div class="slick-slider business-cat-slider slider-pd30" data-item="6" data-arrows="true" data-itemScroll="6" data-dots="true" data-centerPadding="50" data-tabletitem="3" data-tabletscroll="3" data-smallpcitem="4" data-smallpcscroll="4" data-mobileitem="2" data-mobilescroll="2" data-mobilearrows="false">

                        @foreach($categories as $cat)
                            <div class="bsn-cat-item rosy-pink">
                                <a href="{{route('page_search_listing', ['category[]' => $cat->id])}}" style="background-color:{{$cat->color_code}};">
                                    <img src="{{getImageUrl($cat->icon_map_marker)}}" alt="{{$cat->name}}">
                                    <span class="title">{{$cat->name}}</span>
                                    <span class="place">{{$cat->place_count}} {{__('Places')}}</span>
                                </a>
                            </div>
                        @endforeach

                    </div>
                    <div class="place-slider__nav slick-nav">
                        <div class="place-slider__prev slick-nav__prev">
                            <i class="las la-angle-left"></i>
                        </div><!-- .place-slider__prev -->
                        <div class="place-slider__next slick-nav__next">
                            <i class="las la-angle-right"></i>
                        </div><!-- .place-slider__next -->
                    </div><!-- .place-slider__nav -->
                </div>
            </div>
        </div> --}}
        <!-- .business-category -->

        {{-- <div class="trending trending-business">
            <div class="container">
                <h2 class="title title-border-bottom align-center">{{__('Trending Business Places')}}</h2>
                <div class="slick-sliders">
                    <div class="slick-slider trending-slider slider-pd30" data-item="4" data-arrows="true" data-itemScroll="4" data-dots="true" data-centerPadding="30" data-tabletitem="2" data-tabletscroll="2" data-smallpcscroll="3" data-smallpcitem="3" data-mobileitem="1" data-mobilescroll="1" data-mobilearrows="false">

                        @foreach($trending_places as $place)
                            <div class="place-item layout-02">
                                <div class="place-inner">
                                    <div class="place-thumb">
                                        <a class="entry-thumb" href="{{route('place_detail', $place->slug)}}"><img src="{{getImageUrl($place->thumb)}}" alt="{{$place->name}}"></a>
                                        <a href="#" class="golo-add-to-wishlist btn-add-to-wishlist @if($place->wish_list_count) remove_wishlist active @else @guest open-login @else add_wishlist @endguest @endif" data-id="{{$place->id}}">
											<span class="icon-heart">
												<i class="la la-bookmark large"></i>
											</span>
                                        </a>
                                        <a class="entry-category rosy-pink" href="{{route('page_search_listing', ['category[]' => $place['categories'][0]['id']])}}" style="background-color:{{$place['categories'][0]['color_code']}};">
                                            <img src="{{getImageUrl($place['categories'][0]['icon_map_marker'])}}" alt="{{$place['categories'][0]['name']}}">
                                            <span>{{$place['categories'][0]['name']}}</span>
                                        </a>
                                    </div>
                                    <div class="entry-detail">
                                        <div class="entry-head">
                                            <div class="place-type list-item">
                                                @foreach($place['place_types'] as $type)
                                                    <span>{{$type->name}}</span>
                                                @endforeach
                                            </div>
                                            <div class="place-city">
                                                <a href="{{route('page_search_listing', ['city[]' => $place['city']['id']])}}">{{$place['city']['name']}}</a>
                                            </div>
                                        </div>
                                        <h3 class="place-title"><a href="{{route('place_detail', $place->slug)}}">{{$place->name}}</a></h3>
                                        <div class="entry-bottom">
                                            <div class="place-preview">
                                                <div class="place-rating">
                                                    @if($place->reviews_count)
                                                        {{number_format($place->avgReview, 1)}}
                                                        <i class="la la-star"></i>
                                                    @endif
                                                </div>
                                                <span class="count-reviews">({{$place->reviews_count}} {{__('reviews')}})</span>
                                            </div>
                                            <div class="place-price">
                                                <span>{{PRICE_RANGE[$place['price_range']]}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="place-slider__nav slick-nav">
                        <div class="place-slider__prev slick-nav__prev">
                            <i class="las la-angle-left"></i>
                        </div><!-- .place-slider__prev -->
                        <div class="place-slider__next slick-nav__next">
                            <i class="las la-angle-right"></i>
                        </div><!-- .place-slider__next -->
                    </div><!-- .place-slider__nav -->
                </div>
            </div>
        </div> --}}
        <!-- .trending -->
        {{-- <button id="button" class="btn">Click here</button>
        <div class="field-group">
            <input type="text" id="pac-input" placeholder="{{__('My Full Address')}}" value="" name="address" autocomplete="off" required/>
        </div>
        <div class="field-group field-maps">
            <div class="field-map">
                <input type="hidden" id="place_lat" name="lat" value="">
                <input type="hidden" id="place_lng" name="lng" value="">
                <div class="site-banner" id="map" style=" position: relative; overflow: hidden;"></div>
            </div>
        </div> --}}

        <!-- business-about -->
        <div class="business-about" style="background-image: url({{asset('assets/images/img_about_1.jpg')}});">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="business-about-info">
                            <h2>{{__('Who we are')}}</h2>
                            <p>{{__("Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident.")}}</p>
                            <a href="#" class="btn">{{__('Read more')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .business-about -->

        <div class="container-fluid bg-light py-2">
            <h6 class="text-uppercase text-center mb-2 " style="font-size: 3em">Pricing</h6>

            <div class="container-fluid">
                <nav class="nav nav-pills d-flex justify-content-center flex-column flex-sm-row" id="myTab" role="tablist">
                        <a class="flex-sm-fill text-sm-center nav-link active " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dispensaries</a>
                        <a class="flex-sm-fill text-sm-center nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Delivery Driver</a>
                        <a class="flex-sm-fill text-sm-center nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Doctor</a>
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

        {{-- <div class="testimonial">
            <div class="container">
                <h2 class="title title-border-bottom align-center">{{__('People Talking About Us')}}</h2>
                <div class="slick-sliders">
                    <div class="slick-slider testimonial-slider slider-pd30" data-item="2" data-arrows="true" data-itemScroll="2" data-dots="true" data-centerPadding="30" data-tabletitem="1" data-tabletscroll="1" data-mobileitem="1" data-mobilescroll="1" data-mobilearrows="false">
                        @foreach($testimonials as $item)
                            <div class="testimonial-item layout-02">
                                <div class="avatar">
                                    <img class="ava" src="{{getImageUrl($item->avatar)}}" alt="Avatar">
                                    <img src="{{asset('assets/images/quote-active.png')}}" alt="Quote" class="quote">
                                </div>
                                <div class="testimonial-info">
                                    <p>{{$item->content}}</p>
                                    <div class="testimonial-meta">
                                        <b>{{$item->name}}</b>
                                        <span>{{$item->job_title}}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="place-slider__nav slick-nav">
                        <div class="place-slider__prev slick-nav__prev">
                            <i class="las la-angle-left"></i>
                        </div><!-- .place-slider__prev -->
                        <div class="place-slider__next slick-nav__next">
                            <i class="las la-angle-right"></i>
                        </div><!-- .place-slider__next -->
                    </div><!-- .place-slider__nav -->
                </div>
            </div>
        </div> --}}
        <!-- .testimonial -->

        <div class="blogs">
            <div class="container">
                <h2 class="title title-border-bottom align-center">{{__('From Our Blog')}}</h2>
                <div class="news__content">
                    <div class="row">

                        @foreach($blog_posts as $post)
                            <div class="col-md-4">
                                <article class="post hover__box">
                                    <div class="post__thumb hover__box__thumb">
                                        <a title="{{$post->title}}" href="{{route('post_detail', [$post->slug, $post->id])}}"><img src="{{getImageUrl($post->thumb)}}" alt="{{$post->title}}"></a>
                                    </div>
                                    <div class="post__info">
                                        <ul class="post__category">
                                            @foreach($post['categories'] as $cat)
                                                <li><a title="{{$cat->name}}" href="{{route('post_list', $cat->slug)}}">{{$cat->name}}</a></li>
                                            @endforeach
                                        </ul>
                                        <h3 class="post__title"><a title="{{$post->title}}" href="{{route('post_detail', [$post->slug, $post->id])}}">{{$post->title}}</a></h3>
                                    </div>
                                </article>
                            </div>
                        @endforeach

                    </div>
                    <div class="align-center button-wrap"><a href="{{route('post_list_all')}}" class="btn btn-border">{{__('View more')}}</a></div>
                </div>
            </div>
        </div><!-- .blogs -->




        <div class="container-fluid py-2">

            <div class="row">

                <div class="col-md-6">
                    <div class="d-flex justify-content-center">

                        <p style="font-size: 2em">{{__('United States')}}</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                            <dl>
                                <dt class="py-1">Here Are All The States That Have Fully Legalized Marijuana</dt>

                                    <dd class="py-1">Washington</dd>
                                    <dd class="py-1">Oregon</dd>
                                    <dd class="py-1">California</dd>
                                    <dd class="py-1">Nevada</dd>
                                    <dd class="py-1">Colorado</dd>
                                    <dd class="py-1">South Dakota</dd>
                                    <dd class="py-1">Maine</dd>
                                    <dd class="py-1">Vermont</dd>
                                    <dd class="py-1">New Jersey</dd>
                                    <dd class="py-1">D.C.</dd>
                                    <dd class="py-1">Illinois</dd>
                                    <dd class="py-1">Michigan</dd>
                                    <dd class="py-1">Alaska</dd>
                                    <dd class="py-1">Massachusetts</dd>
                                    <dd class="py-1">Arizona</dd>
                                    <dd class="py-1">South Dakota</dd>
                                    <dd class="py-1">Montana</dd>

                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl>
                                <dt>Here Are All The States That Have Only Medical or Decriminalized Marijuana</dt>
                                    <dd class="py-1">Mississippi (Medical & Decriminalized)</dd>
                                    <dd class="py-1">Arkansas (Medical)</dd>
                                    <dd class="py-1">Connecticut (Medical & Decriminalized)</dd>
                                    <dd class="py-1">Delaware (Medical & Decriminalized)</dd>
                                    <dd class="py-1">Florida (Medical)</dd>
                                    <dd class="py-1">Hawaii (Medical & Decriminalized)</dd>
                                    <dd class="py-1">Maryland (Medical & Decriminalized)</dd>
                                    <dd class="py-1">Minnesota (Medical & Decriminalized)</dd>
                                    <dd class="py-1">Nebraska (Decriminalized)</dd>
                                    <dd class="py-1">New Hampshire (Medical & Decriminalized)</dd>
                                    <dd class="py-1">New Mexico (Medical & Decriminalized)</dd>
                                    <dd class="py-1">New York (Medical & Decriminalized)</dd>
                                    <dd class="py-1">North Carolina (Decriminalized)</dd>
                                    <dd class="py-1">North Dakota (Medical & Decriminalized)</dd>
                                    <dd class="py-1">Ohio (Medical & Decriminalized)</dd>
                                    <dd class="py-1">Oklahoma (Medical)</dd>
                                    <dd class="py-1">Pennsylvania (Medical)</dd>
                                    <dd class="py-1">Rhode Island (Medical & Decriminalized)</dd>
                                    <dd class="py-1">Utah (Medical)</dd>
                                    <dd class="py-1">Virginia (Decriminalized)</dd>
                                    <dd class="py-1">West Virginia (Medical)</dd>

                            </dl>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="">
                        <img src="{{asset('admin/images/Map_of_US_state_cannabis_laws.svg')}}" alt="" srcset="">

                    </div>
                    {{-- <div class="container py-2">
                        <p>blue: fully legalized</p>
                    </div> --}}
                </div>
            </div>
        </div>
    </main><!-- .site-main -->
@stop
@push('scripts')
<script src="{{asset('assets/js/map.js')}}"></script>


@endpush
