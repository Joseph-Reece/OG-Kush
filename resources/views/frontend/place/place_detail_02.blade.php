@extends('frontend.layouts.template_02')
@section('main')
<style>
    small {
display: block;
line-height: 1.428571429;
color: #999;
}
</style>
<main id="main" class="site-main home-main business-main">
    <div class="container" style="max-width: 73.125rem">
        <div class="card mb-3 border-0" >
            <div class="row no-gutters">
              <div class="col-md-3 col-sm-6">
                @if(isset($place->thumb))
                    <img style="max-width: 13rem" src="{{getImageUrl($place->thumb)}}" class="card-img" alt="{{$place->name}}">
                @else
                    <img src="https://via.placeholder.com/1280x500?text=B&C" alt="slider no image">
                @endif

              </div>
              <div class="col-md-9">
                <div class="card-body">
                    <h5 class="card-title">{{$place->name}}</h5>

                    <div class="place__reviews reviews">
                            <span class="place__reviews__number reviews__number">
                                {{$review_score_avg}}
                                @php
                                    $i=0;
                                @endphp
                                    @for ($i = 0; $i < $review_score_avg; $i++)

                                    <i class="la la-star"></i>
                                    @endfor
                            </span>
                        <span class="place__places-item__count reviews_count">({{count($reviews)}} reviews)</span>
                    </div>

                    <small><cite title="{{$place->address}}"><i class="fas fa-address">{{$place->address}}
                    </i></cite></small>
                    @if(isset($place_types))
                        <div class="place__category">
                            @foreach($place_types as $type)
                                <a title="{{$type->name}}" href="{{route('page_search_listing', ['amenities[]' => $type->id])}}">{{$type->name}}</a>
                            @endforeach
                        </div>
                    @endif

                    @if($place->phone_number)
                        <a class=" btn mb-1" href="tel:{{$place->phone_number}}" rel="nofollow"><i class="fas fa-phone"></i> {{$place->phone_number}}</a>
                    @endif

                    <a class="btn" href="https://maps.google.com/?q={{$place->address}}" title="Direction" target="_blank" rel="nofollow"><i class="la la-map-marker"></i> ({{__('Get Directions')}})</a>

                </div>
              </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        <ul class="nav nav-tabs border-bottom border-top  border-success" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Menu</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false">Details</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Deals</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="media-tab" data-toggle="tab" href="#media" role="tab" aria-controls="media" aria-selected="false">Media</a>
            </li>
        </ul>
          <div class="tab-content" id="myTabContent">
              {{-- Menu --}}
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                <div class="filters">

                </div>
                @if (count($place->products)>0)
                <div class="row">
                    <div class="col-md-3">
                        <label for="sort">Sort By</label>
                        <select name="sort" id="sort" class="custom-select" onchange="submitForm()">
                            <option value="desc">Most Recent</option>
                            <option value="asc">Oldest</option>
                            <option value="price_desc">Price: High to Low</option>
                            <option value="price_asc">Price: Low to High</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="category">Category filter</label>
                        <select name="category" id="category" class="custom-select" onchange="submitForm()">
                            <option value="">Select a category</option>
                            @foreach($product_categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="col-md-3">
                        <select name="" id="" class="custom-select">
                            <option value="">option</option>
                            <option value="">option</option>
                            <option value="">option</option>
                        </select>
                    </div>
                    <div class="col-md-3">

                        <select name="" id="" class="custom-select">
                            <option value="">option</option>
                            <option value="">option</option>
                            <option value="">option</option>
                            <option value="">option</option>
                        </select>
                    </div> --}}


                </div>


                <div class="container my-3">
                    <form action="{{route('search.product')}}" method="GET" enctype="multipart/form-data">
                        <div class="input-group">
                        <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Search {{count($place->products)}} products">
                        <div class="input-group-append">
                            <button class="btn" id="submitform" type="submit"><i class="fas fa-search"></i> submit</button>

                        </div>
                    </div>
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <input type="hidden" name="place"  id="place" value="{{ $place->id }}">
                    </form>
                </div>
                <div class="main-search">
                    {{-- <h4 class="text-muted">{{count($place->products)}} results found</h4> --}}
                    @include('frontend.place.place_product')
                </div>
                <div class="results">
                    <div id="overlay" style="display:none;" class="searchoverlay">
                        <div class="spinner"></div>
                        <br />
                        Loading...
                    </div>
                </div>



                @else
                    This business has no products yet
                @endif
            </div>
            {{-- Details --}}
            <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                <div class="row">

                    <div class="col-md-6">
                        <div class="place-04">
                            <div class="place">

                                <div class="place__box place__box-overview">
                                    <h3>{{__('Overview')}}</h3>
                                    <div class="place__desc text-justify">
                                        {{$place->description}}
                                    </div><!-- .place__desc -->
                                    <a href="#" class="show-more" title="{{__('Show more')}}">{{__('Show more')}}</a>
                                </div>
                                @if(isset($amenities))
                                    <div class="place__box place__box-hightlight">
                                        <h3>{{__('Amenities')}}</h3>
                                        <div class="hightlight-grid">
                                            @foreach($amenities as $key => $item)
                                                @if($key < 4)
                                                    <div class="place__amenities">
                                                        <img src="{{getImageUrl($item->icon)}}" alt="{{$item->name}}">
                                                        <span>{{$item->name}}</span>
                                                    </div>
                                                @endif
                                            @endforeach
                                            @if(count($amenities) > 4)
                                                <a class="open-popup" href="#show-amenities"><span class="hightlight-count">+({{count($amenities) - 4}})</span></a>
                                            @endif
                                            <div class="popup-wrap" id="show-amenities">
                                                <div class="popup-bg popupbg-close"></div>
                                                <div class="popup-middle">
                                                    <a title="Close" href="#" class="popup-close">
                                                        <i class="la la-times la-24"></i>
                                                    </a><!-- .popup-close -->
                                                    <h3>{{__('Amenities')}}</h3>
                                                    <div class="popup-content">
                                                        <div class="hightlight-flex">
                                                            @foreach($amenities as $key => $item)
                                                                <div class="place__amenities">
                                                                    <img src="{{getImageUrl($item->icon)}}" alt="{{$item->name}}">
                                                                    <span>{{$item->name}}</span>
                                                                </div>
                                                            @endforeach
                                                        </div><!-- .hightlight-flex -->
                                                    </div><!-- .popup-content -->
                                                </div><!-- .popup-middle -->
                                            </div><!-- .popup-wrap -->
                                        </div>
                                    </div>
                                @endif
                            </div><!-- .place__box -->

                            <h3>{{__('State license')}}</h3>
                            @if ($license)
                                @foreach ($license as $key =>$item)
                                <p class="pt-2">
                                    {{$item['license_type']}}: {{$item['license_number']}}
                                </p>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 border rounded border-secondary">
                        <div class="place__box place__box-map">
                            <h3 class="place__title--additional">
                                {{__('Location & Maps')}}
                            </h3>
                            <div class="maps">
                                <div id="golo-place-map"></div>
                                <input type="hidden" id="place_lat" value="{{$place->lat}}">
                                <input type="hidden" id="place_lng" value="{{$place->lng}}">
                                <input type="hidden" id="place_icon_marker" value="{{asset('assets/images/icon-mapker.svg')}}">
                            </div>
                            <div class="address">
                                <i class="la la-map-marker"></i>
                                {{$place->address}}
                                <a href="https://maps.google.com/?q={{$place->address}}" title="Direction" target="_blank" rel="nofollow">({{__('Get Directions')}})</a>
                            </div>
                        </div>
                        <div class="place__box">
                            <h3>{{__('Contact Info')}}</h3>
                            <ul class="place__contact">
                                @if($place->phone_number)
                                    <li>
                                        <i class="la la-phone"></i>
                                        <a href="tel:{{$place->phone_number}}" rel="nofollow">{{$place->phone_number}}</a>
                                    </li>
                                @endif
                                @if($place->website)
                                    <li>
                                        <i class="la la-globe"></i>
                                        <a href="//{{$place->website}}" target="_blank" rel="nofollow">{{$place->website}}</a>
                                    </li>
                                @endif
                                @if($place->email)
                                    <li>
                                        <i class="la la-envelope"></i>
                                        <a href="mailto:{{$place->email}}" rel="nofollow">{{$place->email}}</a>
                                    </li>
                                @endif
                                @foreach($place->social as $social)
                                    @if($social['name'] && $social['url'])
                                        <li>
                                            <i class="{{SOCIAL_LIST[$social['name']]['icon']}}"></i>
                                            <a href="{{SOCIAL_LIST[$social['name']]['base_url'] . $social['url']}}" title="{{$social['url']}}" rel="nofollow" target="_blank">{{$social['url']}}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div><!-- .place__box -->
                        @php
                                $have_opening_hour = false;
                                if ($place->opening_hour):
                                    foreach ($place->opening_hour as $opening):
                                        if ($opening['title'] && $opening['value']):
                                        $have_opening_hour = true;
                                        endif;
                                    endforeach;
                                endif;

                            @endphp
                            @if($have_opening_hour)
                                <div class="place__box place__box-open">
                                    <h3 class="place__title--additional"><i class="fas fa-clock"></i>
                                        {{__('Opening Hours')}}
                                    </h3>
                                    <table class="open-table">
                                        <tbody>
                                        @foreach($place->opening_hour as $opening)
                                            @if($opening['title'] && $opening['value'])
                                                <tr class="p-2">
                                                    <td class="day">{{$opening['title']}}</td>
                                                    <td class="time">{{$opening['value']}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div><!-- .place__box -->
                            @endif

                    </div>
                </div>
            </div>
            {{-- Deals --}}
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                @if (count($place->deals)>0)
                <h4 class="text-muted">{{count($place->deals)}} results found</h4>
                @foreach ($place->deals as $item)
                <div class="row justify-content-between">
                      <div class="card-deck">
                        <div class="card mb-3" style="width: 73.125rem">
                            <div class="row no-gutters">
                              <div class="col-md-2">
                                <img style="height: 8rem" src="{{getImageUrl($item->image)}}" class="card-img" alt="...">
                              </div>
                              <div class="col-md-10">
                                <div class="card-body">
                                    {{-- <div class="row"> --}}
                                     <h5 class="card-title">{{$item->name}}</h5>
                                        {{-- <p class="pull-right"> {{$item->description}}</p> --}}
                                    {{-- </div> --}}

                                  <p class="card-text"> {{$item->place->name}}</p>

                                  <h4>Applies to:</h4>
                                  <p class="card-text"> {{$item->details}}</p>

                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                    {{-- <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{$item->name}}</h3>
                        </div>
                        <div class="col-md-2">
                            <img style="max-height: 8rem" src="{{getImageUrl($item->image)}}" class="card-img" alt="...">
                          </div>
                        <div class="card-body">
                            <p class="card-text">{{$item->description}}</p>
                            <p class="card-text">{{$item->place->name}}</p>
                            <p class="card-text">{{$item->details}}</p>
                        </div>
                    </div> --}}
                </div>
                @endforeach
                @else

                @endif

            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                <div class="place__box place__box--reviews">
                    <h3 class="place__title--reviews">
                        {{__('Review')}} ({{count($reviews)}})
                        @if(isset($reviews))
                            <span class="place__reviews__number"> {{$review_score_avg}}
                                <i class="la la-star"></i>
                            </span>
                        @endif
                    </h3>

                    <ul class="place__comments">
                        @foreach($reviews as $review)
                            <li>
                                <div class="place__author">
                                    <div class="place__author__avatar">
                                        {{-- <a title="Nitithorn" href="#0"><img src="{{getUserAvatar($review->user->avatar)}}" alt=""></a> --}}
                                        <a title="Nitithorn" href="#0"><img src="{{getUserAvatar($review['user']['avatar'])}}" alt=""></a>
                                    </div>
                                    <div class="place__author__info">
                                        <h4>
                                            <a title="Nitithorn" href="#">{{$review['user']['name']}}</a>
                                            <div class="place__author__star">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                                    <path fill="#DDD" fill-rule="evenodd" d="M6.12.455l1.487 3.519 3.807.327a.3.3 0 0 1 .17.525L8.699 7.328l.865 3.721a.3.3 0 0 1-.447.325L5.845 9.4l-3.272 1.973a.3.3 0 0 1-.447-.325l.866-3.721L.104 4.826a.3.3 0 0 1 .17-.526l3.807-.327L5.568.455a.3.3 0 0 1 .553 0z"/>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                                    <path fill="#DDD" fill-rule="evenodd" d="M6.12.455l1.487 3.519 3.807.327a.3.3 0 0 1 .17.525L8.699 7.328l.865 3.721a.3.3 0 0 1-.447.325L5.845 9.4l-3.272 1.973a.3.3 0 0 1-.447-.325l.866-3.721L.104 4.826a.3.3 0 0 1 .17-.526l3.807-.327L5.568.455a.3.3 0 0 1 .553 0z"/>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                                    <path fill="#DDD" fill-rule="evenodd" d="M6.12.455l1.487 3.519 3.807.327a.3.3 0 0 1 .17.525L8.699 7.328l.865 3.721a.3.3 0 0 1-.447.325L5.845 9.4l-3.272 1.973a.3.3 0 0 1-.447-.325l.866-3.721L.104 4.826a.3.3 0 0 1 .17-.526l3.807-.327L5.568.455a.3.3 0 0 1 .553 0z"/>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                                    <path fill="#DDD" fill-rule="evenodd" d="M6.12.455l1.487 3.519 3.807.327a.3.3 0 0 1 .17.525L8.699 7.328l.865 3.721a.3.3 0 0 1-.447.325L5.845 9.4l-3.272 1.973a.3.3 0 0 1-.447-.325l.866-3.721L.104 4.826a.3.3 0 0 1 .17-.526l3.807-.327L5.568.455a.3.3 0 0 1 .553 0z"/>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                                    <path fill="#DDD" fill-rule="evenodd" d="M6.12.455l1.487 3.519 3.807.327a.3.3 0 0 1 .17.525L8.699 7.328l.865 3.721a.3.3 0 0 1-.447.325L5.845 9.4l-3.272 1.973a.3.3 0 0 1-.447-.325l.866-3.721L.104 4.826a.3.3 0 0 1 .17-.526l3.807-.327L5.568.455a.3.3 0 0 1 .553 0z"/>
                                                </svg>
                                                @php
                                                    $width = $review->score * 20;
                                                    $review_width = "style='width:{$width}%'";
                                                @endphp
                                                <span {!! $review_width !!}>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                                        <path fill="#23D3D3" fill-rule="evenodd" d="M6.12.455l1.487 3.519 3.807.327a.3.3 0 0 1 .17.525L8.699 7.328l.865 3.721a.3.3 0 0 1-.447.325L5.845 9.4l-3.272 1.973a.3.3 0 0 1-.447-.325l.866-3.721L.104 4.826a.3.3 0 0 1 .17-.526l3.807-.327L5.568.455a.3.3 0 0 1 .553 0z"/>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                                        <path fill="#23D3D3" fill-rule="evenodd" d="M6.12.455l1.487 3.519 3.807.327a.3.3 0 0 1 .17.525L8.699 7.328l.865 3.721a.3.3 0 0 1-.447.325L5.845 9.4l-3.272 1.973a.3.3 0 0 1-.447-.325l.866-3.721L.104 4.826a.3.3 0 0 1 .17-.526l3.807-.327L5.568.455a.3.3 0 0 1 .553 0z"/>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                                        <path fill="#23D3D3" fill-rule="evenodd" d="M6.12.455l1.487 3.519 3.807.327a.3.3 0 0 1 .17.525L8.699 7.328l.865 3.721a.3.3 0 0 1-.447.325L5.845 9.4l-3.272 1.973a.3.3 0 0 1-.447-.325l.866-3.721L.104 4.826a.3.3 0 0 1 .17-.526l3.807-.327L5.568.455a.3.3 0 0 1 .553 0z"/>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                                        <path fill="#23D3D3" fill-rule="evenodd" d="M6.12.455l1.487 3.519 3.807.327a.3.3 0 0 1 .17.525L8.699 7.328l.865 3.721a.3.3 0 0 1-.447.325L5.845 9.4l-3.272 1.973a.3.3 0 0 1-.447-.325l.866-3.721L.104 4.826a.3.3 0 0 1 .17-.526l3.807-.327L5.568.455a.3.3 0 0 1 .553 0z"/>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                                        <path fill="#23D3D3" fill-rule="evenodd" d="M6.12.455l1.487 3.519 3.807.327a.3.3 0 0 1 .17.525L8.699 7.328l.865 3.721a.3.3 0 0 1-.447.325L5.845 9.4l-3.272 1.973a.3.3 0 0 1-.447-.325l.866-3.721L.104 4.826a.3.3 0 0 1 .17-.526l3.807-.327L5.568.455a.3.3 0 0 1 .553 0z"/>
                                                    </svg>
                                                </span>
                                            </div>
                                        </h4>
                                        <time>{{formatDate($review->created_at, 'd/m/Y')}}</time>
                                    </div>
                                </div>
                                <div class="place__comments__content">
                                    <p>{{$review->comment}}</p>
                                </div>
                            </li>
                        @endforeach

                    </ul>

                    @guest
                        <div class="login-for-review account logged-out">
                            <a href="#" class="btn-login open-login">{{__('Login')}}</a>
                            <span>{{__('to review')}}</span>
                        </div>
                    @else
                        <div class="review-form">
                            <h3>{{__('Write a review')}}</h3>
                            <form id="submit_review">
                                @csrf
                                <div class="rate">
                                    <span>{{__('Rate This Place')}}</span>
                                    <div class="stars">
                                        <a href="#" class="star-item" data-value="1" title="star-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                                <path fill="#DDD" fill-rule="evenodd" d="M6.12.455l1.487 3.519 3.807.327a.3.3 0 0 1 .17.525L8.699 7.328l.865 3.721a.3.3 0 0 1-.447.325L5.845 9.4l-3.272 1.973a.3.3 0 0 1-.447-.325l.866-3.721L.104 4.826a.3.3 0 0 1 .17-.526l3.807-.327L5.568.455a.3.3 0 0 1 .553 0z"/>
                                            </svg>
                                        </a>
                                        <a href="#" class="star-item" data-value="2" title="star-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                                <path fill="#DDD" fill-rule="evenodd" d="M6.12.455l1.487 3.519 3.807.327a.3.3 0 0 1 .17.525L8.699 7.328l.865 3.721a.3.3 0 0 1-.447.325L5.845 9.4l-3.272 1.973a.3.3 0 0 1-.447-.325l.866-3.721L.104 4.826a.3.3 0 0 1 .17-.526l3.807-.327L5.568.455a.3.3 0 0 1 .553 0z"/>
                                            </svg>
                                        </a>
                                        <a href="#" class="star-item" data-value="3" title="star-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                                <path fill="#DDD" fill-rule="evenodd" d="M6.12.455l1.487 3.519 3.807.327a.3.3 0 0 1 .17.525L8.699 7.328l.865 3.721a.3.3 0 0 1-.447.325L5.845 9.4l-3.272 1.973a.3.3 0 0 1-.447-.325l.866-3.721L.104 4.826a.3.3 0 0 1 .17-.526l3.807-.327L5.568.455a.3.3 0 0 1 .553 0z"/>
                                            </svg>
                                        </a>
                                        <a href="#" class="star-item" data-value="4" title="star-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                                <path fill="#DDD" fill-rule="evenodd" d="M6.12.455l1.487 3.519 3.807.327a.3.3 0 0 1 .17.525L8.699 7.328l.865 3.721a.3.3 0 0 1-.447.325L5.845 9.4l-3.272 1.973a.3.3 0 0 1-.447-.325l.866-3.721L.104 4.826a.3.3 0 0 1 .17-.526l3.807-.327L5.568.455a.3.3 0 0 1 .553 0z"/>
                                            </svg>
                                        </a>
                                        <a href="#" class="star-item" data-value="5" title="star-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                                <path fill="#DDD" fill-rule="evenodd" d="M6.12.455l1.487 3.519 3.807.327a.3.3 0 0 1 .17.525L8.699 7.328l.865 3.721a.3.3 0 0 1-.447.325L5.845 9.4l-3.272 1.973a.3.3 0 0 1-.447-.325l.866-3.721L.104 4.826a.3.3 0 0 1 .17-.526l3.807-.327L5.568.455a.3.3 0 0 1 .553 0z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="field-textarea">
                                    <img class="author-avatar" src="{{getUserAvatar(user()->avatar)}}" alt="">
                                    <textarea name="comment" placeholder="Write a review"></textarea>
                                </div>
                                <div class="field-submit">
                                    <small class="form-text text-danger" id="review_error">error!</small>
                                    <input type="hidden" name="score" value="">
                                    <input type="hidden" name="place_id" value="{{$place->id}}">
                                    <button type="submit" class="btn" id="btn_submit_review">{{__('Submit')}}</button>
                                </div>
                            </form>
                        </div>
                    @endguest

                </div><!-- .place__box -->
            </div>
            <div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
                <div class="site-main place-04">
                    <div class="place">

                        <div class="slick-sliders">
                            <div class="slick-slider photoswipe" data-item="1" data-arrows="false" data-itemScroll="1" data-dots="false" data-infinite="false" data-centerMode="false" data-centerPadding="0">
                                @if(isset($place->gallery))
                                    @foreach($place->gallery as $gallery)
                                        <div class="place-slider__item photoswipe-item"><a href="{{getImageUrl($gallery)}}" data-height="900" data-width="1200" data-caption="{{$gallery}}"><img src="{{getImageUrl($gallery)}}" alt="{{$gallery}}"></a></div>
                                    @endforeach
                                @else
                                    <div class="place-slider__item"><a href="#"><img src="https://via.placeholder.com/1280x500?text=GOLO" alt="slider no image"></a></div>
                                @endif
                            </div>
                            <div class="place-share">
                                <a title="Save" href="#" class="add-wishlist @if($place->wish_list_count) remove_wishlist active @else @guest open-login @else add_wishlist @endguest @endif" data-id="{{$place->id}}">
                                    <i class="la la-bookmark la-24"></i>
                                </a>
                                <a title="Share" href="#" class="share">
                                    <i class="la la-share-square la-24"></i>
                                </a>
                                <div class="social-share">
                                    <div class="list-social-icon">
                                        <a class="facebook" href="#" onclick="window.open('https://www.facebook.com/sharer.php?u=' + window.location.href,'popUpWindow','height=550,width=600,left=200,top=100,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes');">
                                            <i class="la la-facebook"></i>
                                        </a>
                                        <a class="twitter" href="#" onclick="window.open('https://twitter.com/share?url=' + window.location.href,'popUpWindow','height=500,width=550,left=200,top=100,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes');">
                                            <i class="la la-twitter"></i>
                                        </a>
                                        <a class="linkedin" href="#" onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url=' + window.location.href,'popUpWindow','height=550,width=600,left=200,top=100,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes');">
                                            <i class="la la-linkedin"></i>
                                        </a>
                                        <a class="pinterest" href="#" onclick="window.open('https://pinterest.com/pin/create/button/?url=' + window.location.href,'popUpWindow','height=500,width=550,left=200,top=100,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes');">
                                            <i class="la la-pinterest"></i>
                                        </a>
                                    </div>
                                </div>
                            </div><!-- .place-share -->
                            <div class="place-gallery">
                                <a class="show-gallery" title="Gallery" href="#">
                                    <i class="la la-images la-24"></i>
                                    {{__('Gallery')}}
                                </a>
                                @if($place->video)
                                    <a title="Video" href="{{$place->video}}" data-lity class="lity-btn">
                                        <i class="la la-youtube la-24"></i>
                                        {{__('Video')}}
                                    </a>
                                @endif
                            </div><!-- .place-item__photo -->
                            <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                                <!-- Background of PhotoSwipe.
                                       It's a separate element as animating opacity is faster than rgba(). -->
                                <div class="pswp__bg"></div>
                                <!-- Slides wrapper with overflow:hidden. -->
                                <div class="pswp__scroll-wrap">
                                    <!-- Container that holds slides.
                                          PhotoSwipe keeps only 3 of them in the DOM to save memory.
                                          Don't modify these 3 pswp__item elements, data is added later on. -->
                                    <div class="pswp__container">
                                        <div class="pswp__item"></div>
                                        <div class="pswp__item"></div>
                                        <div class="pswp__item"></div>
                                    </div>
                                    <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                                    <div class="pswp__ui pswp__ui--hidden">
                                        <div class="pswp__top-bar">
                                            <!--  Controls are self-explanatory. Order can be changed. -->
                                            <div class="pswp__counter"></div>
                                            <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                                            <button class="pswp__button pswp__button--share" title="Share"></button>
                                            <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                                            <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                                            <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                                            <!-- element will get class pswp__preloader--active when preloader is running -->
                                            <div class="pswp__preloader">
                                                <div class="pswp__preloader__icn">
                                                    <div class="pswp__preloader__cut">
                                                        <div class="pswp__preloader__donut"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                            <div class="pswp__share-tooltip"></div>
                                        </div>
                                        <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                                        </button>
                                        <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                                        </button>
                                        <div class="pswp__caption">
                                            <div class="pswp__caption__center"></div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .pswp -->
                        </div><!-- .place-slider -->
                    </div>
                </div>
            </div>
          </div>
    </div>

</main>
@stop

@push('scripts')
    <script src="{{asset('assets/js/page_place_detail.js')}}"></script>
    <script>
       $('#keyword').on('keyup', function(){
            submitForm();
        });

        function check($this){
            // e.preventDefault();
            console.log($this);
        //  let mine = $(this).val();
        //  console.log(mine);
        }

	//.............................Submiting the form.............................//
	function submitForm() {
        $('.main-search').fadeOut(500);
		$(".searchoverlay").fadeIn();
		$.ajax({
			url:"{{route('search.product')}}",
			method:"GET",
			data:{
                "keyword":$('#keyword').val(),
                "sort":$('#sort').val(),
                "category":$('#category').val(),
                "place":$('#place').val(),
				"_token": $('#token').val(),
					},

			success:function(data)
			{
				console.log('successful search');
				$('.main-search').hide();
				$('.results').empty();
				$('.results').append(data);
				$(".searchoverlay").fadeOut(500);

			},
				error:function(data)
			{
			console.log('nothing');
			}
		});

	}


    </script>
@endpush
