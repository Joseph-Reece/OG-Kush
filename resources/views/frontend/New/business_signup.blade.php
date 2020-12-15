@extends('frontend.layouts.template')
@section('main')
<style>
.my-form{
	max-width: 660px;
}
</style>

<main id="main" class="site-main home-main business-main">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

          <div class="listing-main ">

              <div class="listing-nav ">
                  <div class="listing-menu nav-scroll">
                      <ul>
                          <li class="active">
                              <a href="#general" title="Genaral">
                                  <span class="icon"><i class="la la-cog"></i></span>
                                  <span>{{__('General')}}</span>
                              </a>
                          </li>

                          <li>
                              <a href="#location" title="Location">
                                  <span class="icon"><i class="la la-map-marker"></i></span>
                                  <span>{{__('Location')}}</span>
                              </a>
                          </li>
                          <li>
                              <a href="#contact" title="Contact info">
                                  <span class="icon"><i class="la la-phone"></i></span>
                                  <span>{{__('Contact info')}}</span>
                              </a>
                          </li>
                          <li>
                              <a href="#license" title="license info">
                                  <span class="icon"><i class="la la-phone"></i></span>
                                  <span>{{__('License info')}}</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </div><!-- .listing-nav -->
              <div class="listing-content">
                    {{-- <h2 class="title title-border-bottom align-center">{{__('Business SignUp')}}</h2> --}}
                    <form action="{{route('place_create')}}" method="POST" class="my-form" enctype="multipart/form-data">
                        @csrf
                        <div class="listing-box" id="general">
                            <h3>{{__('General')}}</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="business_name">Business Name <span class="text-danger"> *</span></label>
                                    <input type="text" name="name" id="business_name" placeholder="{{__('What is the name of place')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="business_type">Business Type <span class="text-danger"> *</span></label>
                                    <select class="" id="business_type" name="category[]" data-placeholder="{{__('Select Category')}}"  required>
                                        @foreach($categories as $cat)
                                            <option value="{{$cat['id']}}">{{$cat['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="field-group field-select">
                                <label for="price_range">{{__('Price Range')}}</label>
                                <select id="price_range" name="price_range">
                                    @foreach(PRICE_RANGE as $key => $price)
                                        <option value="{{$key}}">{{$price}}</option>
                                    @endforeach
                                </select>
                                <i class="la la-angle-down"></i>
                            </div>


                        </div>

                <div class="listing-box" id="location">
                    <h3>{{__('Location')}}</h3>
                    <div class="field-clone">
                        {{-- <label for="country">{{__('Country')}} <span class="text-danger"> *</span></label> --}}
                        <div class="field-inline field-3col">
                            <div class="field-group field-select">
                                <select name="country_id" class="custom-select" id="select_country" required>
                                    <option value="">{{__('Select country')}}</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country['id']}}">{{$country['name']}}</option>
                                    @endforeach
                                </select>
                                <i class="la la-angle-down"></i>
                            </div>
                            {{-- <label for="city_id">City <span class="text-danger"> *</span></label> --}}
                            <div class="field-group field-select">
                                <select name="city_id" class="custom-select" id="select_city" required>
                                    <option value="">{{__('Select city')}}</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city['id']}}" >{{$city['name']}}</option>
                                    @endforeach
                                </select>
                                <i class="la la-angle-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="field-group">
                        <input type="text" id="pac-input" placeholder="{{__('Full Address')}}" value="" name="address" autocomplete="off" />
                    </div>
                    <div class="field-group field-maps">
                        <div class="field-inline">
                            <label for="pac-input">{{__('Place Location at Google Map')}}</label>
                        </div>
                        <div class="field-map">
                            <input type="hidden" id="place_lat" name="lat" value="">
                            <input type="hidden" id="place_lng" name="lng" value="">
                            <div id="map"></div>
                        </div>
                    </div>
                </div><!-- .listing-box -->
                <div class="listing-box" id="contact">
                    <h3>Contact Info</h3>
                    <div class="field-group">
                        <label for="place_email">{{__('Email')}} <span class="text-danger"> *</span></label>
                        <input type="email" id="place_email" value="" placeholder="{{__('Your email address')}}" name="email">
                    </div>
                    <div class="field-group">
                        <label for="place_number">{{__('Phone number')}} <span class="text-danger"> *</span></label>
                        <input type="tel" id="place_number" value="" placeholder="{{__('Your phone number')}}" name="phone_number">
                    </div>
                    <div class="field-group">
                        <label for="place_website">{{__('Website')}}</label>
                        <input type="url" id="place_website" value="" placeholder="{{__('Your website url')}}" name="website">
                    </div>
                </div>
                {{-- license listing box --}}
                <div class="listing-box" id="license">
                    <h3>License</h3>
                    <div class="field-inline">
                        <div class="field-group field-input">
                            <label for="license">{{__('License Number')}} <span class="text-danger"> *</span></label>
                            <input type="text" id="license" value="" placeholder="" name="license_number">
                        </div>
                        <div class="field-group field-select">

                            <label for="licenseType">license type <span class="text-danger"> *</span></label>
                            <select name="license_type" class="custom-select" id="select_license" required>
                                <option class="" disabled selected value="">{{__('Select licence type')}}</option>
                                <option class="" value="Adult-Use Cultivation">{{__('Adult-Use Cultivation')}}</option>
                                <option class="" value="Adult-Use Mfg.">{{__('Adult-Use Mfg. ')}}</option>
                                <option class="" value="Adult-Use Nonstorefront">{{__('Adult-Use Nonstorefront')}}</option>
                                <option class="" value="Adult-Use Retail">{{__('Adult-Use Retail')}}</option>
                                <option class="" value="Distributor">{{__('Distributor')}}</option>
                                <option class="" value="Event">{{__('Event')}}</option>
                                <option class="" value="Medical Cultivation">{{__('Medical Cultivation')}}</option>
                                <option class="" value="Medical Mfg.">{{__('Medical Mfg.')}}</option>
                                <option class="" value="Medical Nonstorefront">{{__('Medical Nonstorefront')}}</option>
                                <option class="" value="Medical Retail">{{__('Medical Retail')}}</option>
                                <option class="" value="Microbusiness">{{__('Microbusiness')}}</option>
                                <option class="" value="Testing Lab">{{__('Testing Lab')}}</option>
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="field-group field-select">
                                <label for="age_limit">{{__('Age Limit')}}</label>
                                <select id="age_limit" name="age_limit">
                                    @foreach(AGE_LIMIT as $key => $age)
                                        <option value="{{$key}}">{{$age}}</option>
                                    @endforeach
                                </select>
                                <i class="la la-angle-down"></i>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="field-group">
                                <label for="license_expiration">{{__('Expiration')}} <span class="text-danger"> *</span></label>
                                <input type="date" id="license_expiration" value="" class="" placeholder="" name="expiration">
                            </div>

                        </div>
                    </div>

                </div>

                <div class="field-group field-submit">

                    @guest
                        <a href="#" class="btn btn-login open-login">{{__('Login to submit')}}</a>
                    @else

                            <input class="btn" type="submit" value="{{__('Submit')}}">

                    @endguest

                </div>
                </form>

              </div>
          </div>
</main>
@stop
@push('scripts')
    <script src="{{asset('assets/js/page_place_new.js')}}"></script>
@endpush
