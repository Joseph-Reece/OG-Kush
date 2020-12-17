@extends('frontend.layouts.template')
<style>
    .btn-active{
        background-color: blue;
        border-radius: 25px;
    }
</style>
@section('main')
    <main id="main" class="site-main">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="height: 400px">
            <div class="carousel-inner">

                @if($places->count())
                @foreach($places as $place)

                <div class="carousel-item ">
                    <div class="place-item place-hover layout-02" data-maps="">
                        <div class="place-inner">
                            <div class="place-thumb">
                                <a class="entry-thumb" href="{{route('place_detail', $place->slug)}}"><img src="{{getImageUrl($place->thumb)}}" alt="" style="height: 400px"></a>

                            </div>
                            <div class="carousel-caption d-none d-md-block">
                                    <div class="place-type list-item">
                                        @foreach($place['place_types'] as $type)
                                            <span>{{$type->name}}</span>
                                        @endforeach
                                    </div>
                                    <div class="place-city">
                                        <h5><a href="{{route('page_search_listing', ['city[]' => $place['city']['id']])}}">{{$place['city']['name']}}</a></h5>
                                    </div>
                                <h3 class="place-title"><a href="{{route('place_detail', $place->slug)}}">{{$place->name}}</a></h3>

                              </div>
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


        <div class="site-content">
            <div class="container">
                <div class="member-wrap">
                    <div class="search-wrap">
                         <div class="">

                        <div class="row my-2">
                            <div class="col-md-3">
                                <label for="category">Category filter</label>
                            <select name="category_id" id="category" class="custom-select cat_id" onchange="GL_FILTER.ajaxFilterMap()" >
                                    <option value="">Select a category</option>
                                    @foreach($category as $category)

                                    <option value="{{$category->id}}">{{$category['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="shop__meta">
                            <div class="site__search__form">
                                <div class="site__search__field">
                                    <span class="site__search__icon">
                                        <i class="la la-search"></i>
                                    </span><!-- .site__search__icon -->
                                    <input onkeyup="doMapSearch()" class="site__search__input" type="text" id="keyword" name="keyword"  placeholder="{{__('Search')}}">
                                    <input role="button" type="hidden" name="action" id="action" value="livesearch">
                            </div>
                            </div>

                            <div class="shop__order site__order golo-nav-filter">
                                <div class="golo-clear-filter">
                                    <i class="la la-times"></i>
                                    <span>{{__('Clear All')}}</span>
                                </div>
                                <div class="shop__filter site__filter">
                                    <a title="Filter" class="golo-filter-toggle" href="#">
                                        {{__('Filter')}}
                                        <i class="la la-angle-down"></i>
                                    </a>
                                </div><!-- .shop__filter -->
                            </div><!-- .shop__order -->
                        </div><!-- .shop__meta -->

                        <div class="golo-menu-filter">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="entry-filter">
                                        <h4>{{__('Sort By')}}</h4>
                                        <ul class="sort-by filter-control custom-scrollbar">
                                            <li><a href="#" data-sort="newest">{{__('Newest')}}</a></li>
                                            <li><a href="#" data-sort="rating">{{__('Average rating')}}</a></li>
                                            <li class="price-filter"><a href="#" data-sort="price_asc">{{__('Price: Low to high')}}</a></li>
                                            <li class="price-filter"><a href="#" data-sort="price_desc">{{__('Price: High to low')}}</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="entry-filter">
                                        <h4>{{__('Price Filter')}}</h4>
                                        <ul class="price filter-control custom-scrollbar">
                                            <li><a href="#" data-price="0">{{__('Free')}}</a></li>
                                            <li><a href="#" data-price="1">{{__('Low: $')}}</a></li>
                                            <li><a href="#" data-price="2">{{__('Medium: $$')}}</a></li>
                                            <li><a href="#" data-price="3">{{__('High: $$$')}}</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="entry-filter">
                                        <h4>{{__('Payment Types')}}</h4>
                                        <ul class="type filter-control custom-scrollbar">
                                            @foreach($payment_types as $type)
                                                <li>
                                                    <input type="checkbox" class="custom-checkbox input-control" id="type_{{$type->id}}" name="types" value="{{$type->id}}">
                                                    <label for="type_{{$type->id}}">{{$type->name}}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="entry-filter">
                                        <h4>{{__('Amenities')}}</h4>
                                        <ul class="amenities filter-control custom-scrollbar">
                                            @foreach($amenities as $item)
                                                <li>
                                                    <input type="checkbox" class="custom-checkbox input-control" id="amenities_{{$item->id}}" name="amenities" value="{{$item->id}}">
                                                    <label for="amenities_{{$item->id}}">{{$item->name}}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="category_id" id="category_id" value="">
                        </div>
                        </div>
                    </div>

                <!-- .search__form -->

                <div class="mw-box my-2">
                    <div class="mw-grid golo-grid grid-4 ">
                        <div
                        style=" height: 100vh;
                        position: sticky;
                        position: -webkit-sticky;
                        ;"
                        class="">
                            <div style="height: 100%;" id="place-map-filter"></div>
                        </div>
                    </div>
                    <div class="loads" style="display: none">
                        <div class="col-md-12 text-center">Loading...</div>
                    </div>
                </div><!-- .mw-box -->



                </div><!-- .member-wrap -->
            </div>
        </div><!-- .site-content -->
    </main><!-- .site-main -->
@stop
