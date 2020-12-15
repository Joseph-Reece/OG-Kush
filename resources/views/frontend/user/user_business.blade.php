@extends('frontend.layouts.template')
@section('main')
    <main id="main" class="site-main">
        <div class="site-content">
            <div class="member-menu">
                <div class="container">
                    @include('frontend.user.user_menu')
                </div>
            </div>
            <div class="container-fluid">
                <div class="member-place-wrap">
                    <div class="member-place-top flex-inline">
                        <h1>{{__('Business info')}}</h1>
                    </div><!-- .member-place-top -->
                    @include('frontend.common.box-alert')

                    <form action="{{route('place_create')}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="container-main">
                            <div class="listing-container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="listing-box" id="general">

                                            <div class="field-group">
                                                <div class="field-group field-input">
                                                    <label for="place_name">{{__('Business Name')}} ({{$language_default['code']}}) *</label>
                                                    <input type="text" id="place_name" name="{{$language_default['code']}}[name]" value="{{$place['name']}}" required placeholder="{{__('What the name of place')}}">
                                                </div>
                                                {{--  --}}
                                            </div>
                                            <label for="place_address">{{__('Business Address')}} *</label>

                                            <div class="field-group">
                                                <input type="text" id="pac-input" placeholder="{{__('Full Address')}}" value="{{$place['address']}}" name="address" autocomplete="off" required/>
                                            </div>

                                            <div class="show-map">
                                                <span>{{__('Show on Map')}}</span>
                                                <a href="#" class="icon-toggle"></a>
                                            </div><!-- .show-map -->


                                            </a>
                                            <div class="field-group field-maps">
                                                <div class="field-map">
                                                    <input type="hidden" id="place_lat" name="lat" value="{{$place['lat']}}">
                                                    <input type="hidden" id="place_lng" name="lng" value="{{$place['lng']}}">
                                                    <div class="Show_map" id="map" style="display: none; position: relative; overflow: hidden;"></div>
                                                </div>
                                            </div>
                                        </div><!-- .listing-box -->

                                        {{-- <div class="listing-box" id="location">

                                            <label for="place_address">{{__('Business Address')}} *</label>

                                            <div class="field-group">
                                                <input type="text" id="pac-input" placeholder="{{__('Full Address')}}" value="{{$place['address']}}" name="address" autocomplete="off" required/>
                                            </div>
                                            <button class="btn" id="show_map">Toggle Map</button>
                                            <div class="field-group field-maps">
                                                <div class="field-map">
                                                    <input type="hidden" id="place_lat" name="lat" value="{{$place['lat']}}">
                                                    <input type="hidden" id="place_lng" name="lng" value="{{$place['lng']}}">
                                                    <div class="Show_map" id="map" style="display: none; position: relative; overflow: hidden;"></div>
                                                </div>
                                            </div>
                                        </div><!-- .listing-box --> --}}

                                        <div class="listing-box" id="contact">
                                            <h3>Contact Info</h3>
                                            <div class="field-group">
                                                <label for="place_email">{{__('Email')}}</label>
                                                <input type="email" id="place_email" value="{{$place['email']}}" placeholder="{{__('Your email address')}}" name="email">
                                            </div>
                                            <div class="field-group">
                                                <label for="place_number">{{__('Phone number')}}</label>
                                                <input type="tel" id="place_number" value="{{$place['phone_number']}}" placeholder="{{__('Your phone number')}}" name="phone_number">
                                            </div>
                                            <div class="field-group">
                                                <label for="place_website">{{__('Website')}}</label>
                                                <input type="text" id="place_website" value="{{$place['website']}}" placeholder="{{__('Your website url')}}" name="website">
                                            </div>

                                        </div><!-- .listing-box -->

                                        <div class="listing-box" id="license">
                                            <h3>License</h3>
                                            <div class="field-inline">
                                                @if ($license)

                                                @foreach ($license as $key =>$item)


                                                <div class="field-group field-input">
                                                    <label for="license">{{__('License Number')}}</label>
                                                <input type="text" disabled id="license" value="{{$item['license_number']}}" placeholder="" name="license_number">
                                                </div>
                                                <div class="field-group field-input">
                                                    <label for="license_type">{{__('License Type')}}</label>
                                                    <input type="text" disabled id="license_type" value="{{$item['license_type']}}" placeholder="" name="license_type">
                                                </div>

                                            </div>
                                            <div class="field-group">
                                                <label for="license_expiration">{{__('Expiration')}} <span class="text-danger"> *</span></label>
                                                <input type="date" disabled id="license_expiration" value="{{$item['expiration']}}" class="col-md-4" placeholder="" name="expiration">
                                            </div>
                                            @endforeach
                                            @endif

                                        </div><!-- .listing-box -->

                                        <div class="listing-box" id="amenities" hidden>
                                            <h3>{{__('Amenities')}}</h3>
                                            <div class="field-group field-check">
                                                @foreach($amenities as $item)
                                                    <label for="amenities_{{$item['id']}}">
                                                        <input type="checkbox" name="amenities[]" id="amenities_{{$item['id']}}" value="{{$item['id']}}" {{isChecked($item['id'], $place['amenities'])}}>{{$item['name']}}
                                                        <span class="checkmark">
                                                            <i class="la la-check"></i>
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>
                                            <div class="row">
                                                <button class="btn float-right" id="hideAmenities">Hide</button>

                                            </div>
                                        </div><!-- .listing-box -->



                                        <div class="listing-box" id="open" hidden>
                                            <h3>{{__('Opening Hours')}}</h3>
                                            <div class="group-field" id="time-opening">
                                                @if($place['opening_hour'])
                                                    @foreach($place['opening_hour'] as $index => $opening_hour)
                                                        <div class="field-inline field-3col openinghour_item">
                                                            <div class="field-group field-input">
                                                                <input type="text" class="form-control valid" name="opening_hour[{{$index}}][title]" value="{{$opening_hour['title']}}">
                                                            </div>
                                                            <div class="field-group field-input">
                                                                <input type="text" class="form-control" name="opening_hour[{{$index}}][value]" value="{{$opening_hour['value']}}">
                                                            </div>
                                                            <a href="#" class="openinghour_item_remove pt-2">
                                                                <i class="la la-trash-alt"></i>
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    @foreach(DAYS as $key => $value)
                                                        <div class="place-fields-wrap">
                                                            <div class="place-fields place-time-opening row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control valid" name="opening_hour[{{$key}}][title]" value="{{$value}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="opening_hour[{{$key}}][value]" placeholder="{{$value == "Ex: Sunday" ? "Closed" : "Ex: 9:00 AM - 5:00 PM"}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="d-flex justify-content-around">
                                                <a href="#open" class="add-social btn" id="openinghour_addmore">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                                        <g fill="#2D2D2D" fill-rule="evenodd">
                                                            <path d="M7 0h2v16H7z"/>
                                                            <path d="M16 7v2H0V7z"/>
                                                        </g>
                                                    </svg>
                                                    <span>{{__('Add more')}}</span>
                                                </a>
                                                <button class="btn" id="hideHours">Hide</button>

                                            </div>
                                        </div><!-- .listing-box -->

                                    </div>
                                    {{-- End Left side --}}
                                    <div class="col-md-6">
                                       
                                        <div class="listing-box" id="description">
                                            <div class="field-group">
                                                <label for="description">{{__('Description')}} ({{$language_default['code']}}) <span class="text-danger"> *</span></label>
                                                <textarea class="form-control tinymce_editor" id="description" name="description" rows="5">{{$place['description']}}</textarea>
                                            </div>
                                        </div><!-- .listing-box -->

                                        <div class="listing-box" id="muted-buttons">
                                            <div class="row">
                                                <div class="col">
                                                    <button class="btn add-social" disabled="disabled">Delivery Radius</button>
                                                </div>
                                                <div class="col">
                                                <button class="btn add-social" disabled="disabled">Followers <span class="badge badge-secondary">{{$followers}}</span></button>
                                                </div>
                                            </div>
                                        </div><!-- .listing-box -->

                                        <div class="listing-box" id="social">
                                            <h3>{{__('Social Networks')}}</h3>
                                            <div class="field-group">
                                                <label for="place_socials">{{__('Social Networks')}}</label>

                                                <div class="social_list">
                                                    @if($place['social'])
                                                        @foreach($place['social'] as $key => $social)
                                                            <div class="field-inline field-3col social_item">
                                                                <div class="field-group field-select">
                                                                    <select name="social[{{$key}}][name]" id="place_socials">
                                                                        <option value="">{{__('Select network')}}</option>
                                                                        @foreach(SOCIAL_LIST as $k => $value)
                                                                            <option value="{{$k}}" {{isSelected($k, $social['name'])}}>{{$value['name']}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <i class="la la-angle-down"></i>
                                                                </div>
                                                                <div class="field-group field-input">
                                                                    <input type="text" name="social[{{$key}}][url]" value="{{$social['url']}}" placeholder="{{__('Enter URL include http or www')}}">
                                                                </div>
                                                                <a href="#" class="social_item_remove pt-2">
                                                                    <i class="la la-trash-alt"></i>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="field-inline field-3col social_item">
                                                            <div class="field-group field-select">
                                                                <select name="social[0][name]" id="place_socials">
                                                                    <option value="">{{__('Select network')}}</option>
                                                                    @foreach(SOCIAL_LIST as $value)
                                                                        <option value="{{$value['name']}}">{{$value['name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <i class="la la-angle-down"></i>
                                                            </div>
                                                            <div class="field-group field-input">
                                                                <input type="text" name="social[0][url]" placeholder="{{__('Enter URL include http or www')}}">
                                                            </div>
                                                            <a href="#" class="social_item_remove pt-2">
                                                                <i class="la la-trash-alt"></i>
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>

                                                <a href="#social" id="social_addmore" class="add-social btn">
                                                    <i class="la la-plus la-24"></i>
                                                    <span>{{__('Add more')}}</span>
                                                </a>
                                            </div>
                                        </div><!-- .listing-box -->

                                        <div class="listing-box" id="payments" hidden>
                                            <h3>{{__('Payment Types')}}</h3>
                                            <div class="field-group field-check">
                                                @if(count($payment)>0)

                                                @foreach($payment as $item)
                                                    <label for="payment_{{$item['id']}}">
                                                        <input type="checkbox" name="payment_type[]" id="payment_{{$item['id']}}" value="{{$item['id']}}" {{isChecked($item['id'], $place['payment_type'])}}>{{$item['name']}}
                                                        <span class="checkmark">
                                                            <i class="la la-check"></i>
                                                        </span>
                                                    </label>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="row">
                                                <button class="btn float-right" id="hidePayments">Hide</button>
                                            </div>
                                        </div><!-- .listing-box -->

                                        <div class="listing-box" id="media" hidden>
                                            <h3>Media</h3>
                                            <div class="field-group field-file">
                                                <label for="thumb_image">{{__('Thumb image')}}</label>
                                                <label for="thumb_image" class="preview">
                                                    @if($place && $place['thumb'])
                                                        <input type="file" id="thumb_image" name="thumb" class="upload-file">
                                                    @else
                                                        <input type="file" id="thumb_image" name="thumb" class="upload-file" required>
                                                    @endif
                                                    <img id="thumb_preview" src="{{$place && $place['thumb'] ? getImageUrl($place['thumb']) : ''}}" alt=""/>
                                                    <i class="la la-cloud-upload-alt"></i>
                                                </label>
                                                <div class="field-note">{{__('Maximum file size: 1 MB')}}.</div>
                                            </div>
                                            <div class="field-group field-file">
                                                <label for="gallery_img">{{__('Gallery Images')}}</label>
                                                <div id="gallery_preview">
                                                    @if($place && $place['gallery'])
                                                        @foreach($place['gallery'] as $gallery)
                                                            <div class="col-sm-2 media-thumb-wrap">
                                                                <figure class="media-thumb">
                                                                    <img src="{{getImageUrl($gallery)}}">
                                                                    <div class="media-item-actions">
                                                                        <a class="icon icon-delete" href="#">
                                                                            <i class="la la-trash-alt"></i>
                                                                        </a>
                                                                        <input type="hidden" name="gallery[]" value="{{$gallery}}">
                                                                        <span class="icon icon-loader"><i class="fa fa-spinner fa-spin"></i></span>
                                                                    </div>
                                                                </figure>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <label for="gallery" class="preview w-100">
                                                    <input type="file" id="gallery" class="upload-file">
                                                    <i class="la la-cloud-upload-alt"></i>
                                                </label>
                                                <div class="field-note">{{__('Maximum file size: 1 MB')}}.</div>
                                            </div>
                                            <div class="field-group">
                                                <label for="place_video">{{__('Video')}}</label>
                                                <input type="text" id="place_video" name="video" placeholder="{{__('Youtube, Vimeo video url')}}">
                                            </div>
                                            <div class="row">
                                                <button class="btn float-right" id="hideMedia">Hide</button>

                                            </div>
                                        </div><!-- .listing-box -->
                                    </div>
                                </div>
                                {{-- End Right side --}}

                            </div>{{--listing container--}}
                        </div>{{--container-main--}}



                        <div class="container pb-3" >
                            <div class="row justify-content-around d-flex m-2">
                                <button class="btn add-social" id="btn_add_hour" type="button">+ Add Hours</button>
                                <button class="btn add-social" id="btn_add_amenities" type="button">+ Add Amenities</button>
                                <button class="btn add-social" id="btn_add_payments" type="button">+ Add Payment Types</button>
                                <a href="{{route('business_menu')}}" class="btn btn-search">+ Add Deals</a>
                                <button class="btn add-social" id="btn_add_media" type="button">+ Add Media</button>

                            </div>
                        </div>
                        <div class="container pt-3 ">
                            <div class="row justify-content-around d-flex">
                                <a class="btn viewbtn" href="{{route('place_detail', $place->slug)}}" class="view" title="{{__('View store')}}"><i class="la la-eye"></i> {{__('View Store')}} </a>
                                <input type="hidden" name="place_id" value="{{$place['id']}}">
                                <button class="btn viewbtn" type="submit" value=""><i class="la la-save"></i> {{__('Save Changes')}} </button>
                            </div>
                        </div>
                    </form>
                </div><!-- .member-place-wrap -->
            </div>
        </div><!-- .site-content -->
    </main><!-- .site-main -->


@stop

@push('scripts')
<script src="{{asset('assets/js/page_place_new.js')}}"></script>
<script src="{{asset('assets/js/MyJs.js')}}"></script>

@endpush
