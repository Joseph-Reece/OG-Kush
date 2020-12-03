@extends('frontend.layouts.template_02')
@section('main')
    <main id="main" class="site-main">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="height: 400px">
            <div class="carousel-inner">

                @if($places->total())
                @foreach($places as $place)

                <div class="carousel-item ">
                    <div class="place-item place-hover layout-02" data-maps="">
                        <div class="place-inner">
                            <div class="place-thumb">
                                <a class="entry-thumb" href="{{route('place_detail', $place->slug)}}"><img src="{{getImageUrl($place->thumb)}}" alt="" style="height: 400px"></a>
                                {{-- <a href="#" class="golo-add-to-wishlist btn-add-to-wishlist @if($place->wish_list_count) remove_wishlist active @else @guest open-login @else add_wishlist @endguest @endif" data-id="{{$place->id}}">
                                <span class="icon-heart">
                                    <i class="la la-bookmark large"></i>
                                </span>
                                </a>
                                <a class="entry-category rosy-pink" href="{{route('page_search_listing', ['category[]' => $place['categories'][0]['id']])}}" style="background-color:{{$place['categories'][0]['color_code']}};">
                                    <img src="{{getImageUrl($place['categories'][0]['icon_map_marker'])}}" alt="{{$place['categories'][0]['name']}}">
                                    <span>{{$place['categories'][0]['name']}}</span>
                                </a> --}}
                            </div>
                            <div class="carousel-caption d-none d-md-block">
                                {{-- <div class="entry-head"> --}}
                                    <div class="place-type list-item">
                                        @foreach($place['place_types'] as $type)
                                            <span>{{$type->name}}</span>
                                        @endforeach
                                    </div>
                                    <div class="place-city">
                                        <h5><a href="{{route('page_search_listing', ['city[]' => $place['city']['id']])}}">{{$place['city']['name']}}</a></h5>
                                    </div>
                                {{-- </div> --}}
                                <h3 class="place-title"><a href="{{route('place_detail', $place->slug)}}">{{$place->name}}</a></h3>
                                {{-- <div class="entry-bottom">
                                    <div class="place-preview">
                                        <div class="place-rating">
                                            @if($place->reviews_count)
                                                <span>{{number_format($place->avgReview, 1)}}</span>
                                                <i class="la la-star"></i>
                                            @endif
                                        </div>
                                        <span class="count-reviews">({{$place->reviews_count}} {{__('reviews')}})</span>
                                    </div>
                                    <div class="place-price">
                                        <span>{{PRICE_RANGE[$place['price_range']]}}</span>
                                    </div>
                                </div> --}}
                              </div>
                            {{--  --}}
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
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
            <div class="archive-city">
                <div class="col-left">
                    <div class="archive-filter">
                        <form action="#" class="filterForm" id="filterForm">
                            <div class="filter-head">
                                <h2>{{__('Filter')}}</h2>
                                <a href="#" class="clear-filter"><i class="fal fa-sync"></i>Clear all</a>
                               {{--<a href="#" class="close-filter"><i class="las la-times"></i></a>--}}
                            </div>
                            {{--Cities--}}
                            <div class="filter-box">
                                <h3>Sort By</h3>
                                <div class="filter-list">
                                    <div class="filter-group">
                                        <ul class="sort-by filter-control custom-scrollbar">
                                            <li><a href="#" data-sort="newest">{{__('Newest')}}</a></li>
                                            <li><a href="#" data-sort="rating">{{__('Average rating')}}</a></li>
                                            <li class="price-filter"><a href="#" data-sort="price_asc">{{__('Price: Low to high')}}</a></li>
                                            <li class="price-filter"><a href="#" data-sort="price_desc">{{__('Price: High to low')}}</a></li>
                                        </ul>
                                    </div>
                                    <a href="#" class="more open-more" data-close="Close" data-more="More">More</a>
                                </div>
                            </div>
                            {{--Cities--}}
                            <div class="filter-box">
                                <h3>price</h3>
                                <div class="filter-list">
                                    <div class="filter-group">
                                        <ul class="price filter-control custom-scrollbar">
                                            <li><a href="#" data-price="0">{{__('Free')}}</a></li>
                                            <li><a href="#" data-price="1">{{__('Low: $')}}</a></li>
                                            <li><a href="#" data-price="2">{{__('Medium: $$')}}</a></li>
                                            <li><a href="#" data-price="3">{{__('High: $$$')}}</a></li>
                                        </ul>
                                    </div>
                                    <a href="#" class="more open-more" data-close="Close" data-more="More">More</a>
                                </div>
                            </div>
                            {{--Cities--}}
                            <div class="filter-box">
                                <h3>Cities</h3>
                                <div class="filter-list">
                                    <div class="filter-group">
                                        @foreach($cities as $city)
                                            <div class="field-check">
                                                <label class="bc_filter" for="city_{{$city->id}}">
                                                    <input type="checkbox" id="city_{{$city->id}}" name="cities" value="{{$city->id}}" {{isChecked($city->id, $filter_city)}}>
                                                    {{$city->name}}
                                                    <span class="checkmark"><i class="la la-check"></i></span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a href="#" class="more open-more" data-close="Close" data-more="More">More</a>
                                </div>
                            </div>
                            {{--categories--}}
                            <div class="filter-box">
                                <h3> {{__('Categories')}}</h3>
                                <div class="filter-list">
                                    <div class="filter-group">
                                        @foreach($categories as $cat)
                                            <div class="field-check">
                                                <label class="bc_filter" for="cat_{{$cat->id}}">
                                                    <input type="checkbox" id="cat_{{$cat->id}}" name="categories" value="{{$cat->id}}" {{isChecked($cat->id, $filter_category)}}>
                                                    {{$cat->name}}
                                                    <span class="checkmark"><i class="la la-check"></i></span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a href="#" class="more open-more" data-close="Close" data-more="More">{{__('More')}}</a>
                                </div>
                            </div>
                            {{--placeType--}}
                            <div class="filter-box">
                                <h3>{{__('Place Type')}}</h3>
                                <div class="filter-list">
                                    <div class="filter-group">
                                        @foreach($place_types as $place_type)
                                            <div class="field-check">
                                                <label class="bc_filter" for="place_type_{{$place_type->id}}">
                                                    <input type="checkbox" id="place_type_{{$place_type->id}}" name="types" value="{{$place_type->id}}" {{isChecked($place_type->id, $filter_place_type)}}>
                                                    {{$place_type->name}}
                                                    <span class="checkmark"><i class="la la-check"></i></span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a href="#" class="more open-more" data-close="Close" data-more="More">{{__('More')}}</a>
                                </div>
                            </div>
                            {{--amenities--}}
                            <div class="filter-box">
                                <h3>{{__('Amenities')}}</h3>
                                <div class="filter-list">
                                    <div class="filter-group">
                                        @foreach($amenities as $item)
                                            <div class="field-check">
                                                <label class="bc_filter" for="amenities_{{$item->id}}">
                                                    <input type="checkbox" id="amenities_{{$item->id}}" name="amenities"
                                                    value="{{$item->id}}" {{isChecked($item->id, $filter_amenities)}}>
                                                    {{$item->name}}
                                                    <span class="checkmark"><i class="la la-check"></i></span>
                                                </label>
                                            </div>
                                        @endforeach

                                    </div>
                                    <a href="#" class="more open-more" data-close="Close" data-more="More">More</a>
                                </div>
                            </div>
                            <div class="form-button align-center">
                                <input type="hidden" name="keyword" value="{{$keyword}}">
                                <input type="hidden" name="action" value="livesearch">
							    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <a href="#" class="btn">{{__('Apply')}}</a>
                            </div>
                        </form>
                    </div><!-- .archive-fillter -->

                    <div class="main-primary">
                        <div class="filter-mobile">
                            <ul>
                                <li><a class="mb-filter mb-open" href="#filterForm">{{__('Filter')}}</a></li>
                            </ul>
                            <div class="mb-maps"><a class="mb-maps" href="#"><i class="las la-map-marked-alt"></i></a></div>
                        </div>
                        

                        {{-- <div class="area-places" id="list_places">

                            @if($places->total())
                                @foreach($places as $place)

                                    <div class="place-item place-hover layout-02" data-maps="">
                                        <div class="place-inner">
                                            <div class="place-thumb">
                                                <a class="entry-thumb" href="{{route('place_detail', $place->slug)}}"><img src="{{getImageUrl($place->thumb)}}" alt=""></a>
                                                <a href="#" class="golo-add-to-wishlist btn-add-to-wishlist @if($place->wish_list_count) remove_wishlist active @else @guest open-login @else add_wishlist @endguest @endif" data-id="{{$place->id}}">
                                                <span class="icon-heart">
                                                    <i class="la la-heart la-24"></i>
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
                                                                <span>{{number_format($place->avgReview, 1)}}</span>
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
                            @else
                                <div class="p-3">
                                    <p>{{__('Nothing found!')}}</p>
                                    <p>{{__("We're sorry but we do not have any listings matching your search, try to change you search settings")}}</p>
                                </div>
                            @endif
                        </div> --}}

						{{--@if (Route::currentRouteNamed('page_search_listing'))--}}
						<div class="main-search">

                            @include('frontend.common.business_item')
						</div>
						{{--@endif--}}

						<div class="results">
							<div id="overlay" style="display:none;" class="searchoverlay">
								<div class="spinner"></div>
								<br />
								Loading...
							</div>

						</div>

                        <div class="pagination">
                            {{$places->render('frontend.common.pagination')}}
                        </div>
                    </div><!-- .main-primary -->
                </div><!-- .col-left -->

                <div class="col-right">
                    <div class="filter-head">
                        <h2>{{__('Maps')}}</h2>
                        <a href="#" class="close-maps">{{__('Close')}}</a>
                    </div>
                    <div class="entry-map">
                        <div id="place-map-filter"></div>
                    </div>
                </div><!-- .col-right -->
        </div>
        <!-- .archive-city -->
    </main><!-- .site-main -->
@stop

@push('scripts')
    <script src="{{asset('assets/js/page_business_category.js')}}"></script>
    <script>

	//.............................Submiting the form.............................//
	function submitForm() {
	// console.log($("#brand").val());
		$(".searchoverlay").fadeIn();
		$.ajax({
			url:"{{route('page_search_listing')}}",
			method:"GET",
			data:{
				model:$('#carmodel').val(),
				min_price: $("#min_price").val(),
				max_price: $("#max_price").val(),
				brand: $("#brand").val(),
				fuel: $("#fuel").val(),
				condition: $("#selCondition").val() ,
				sort: $("#sort").val() ,
				transmission: $("#transmission").val(),
				action: "carsearch" ,
				"_token": $('#token').val(),
					},

			success:function(data)
			{


				// console.log(data);
				$('.main-search').hide();
				$('.results').empty();
				$('.results').append(data);
				$(".searchoverlay").fadeOut();

			},
				error:function(data)
			{
			console.log('nothing');
			}
		});

	}
    </script>

@endpush
