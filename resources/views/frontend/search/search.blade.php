@extends('frontend.layouts.template')
@section('main')
    <main id="main" class="site-main">
        <div class="page-title page-title--small align-left">
            <div class="container">
                <div class="page-title__content">
                    <h1 class="page-title__name">{{__('Search results')}}</h1>
                </div>
            </div>
        </div>

        <div class="site-content">
            <div class="container">
                <div class="search-wrap">

                    <h2>{{count($places)}} {{__('results for')}} "{{$keyword}}"</h2>
                    {{-- <div class="shop__meta">
                        <h2 class="title title--result">
                            {{count($places)}} {{__('results for')}} "{{$keyword}}"

                        </h2>
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
                                    <h4>{{__('Types')}}</h4>
                                    <ul class="type filter-control custom-scrollbar">
                                        @foreach($place['place_types'] as $type)
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

                        <input type="hidden" name="city_id" value="{{$city->id}}">
                        <input type="hidden" name="category_id" value="{{$places_by_category['category']['id']}}">
                    </div> --}}
                    <div class="mw-box">
                        <div class="mw-grid golo-grid grid-4 ">
                            @foreach($places as $place)
                                <div class="grid-item">
                                    @include('frontend.common.place_item')
                                </div>
                            @endforeach
                        </div>
                    </div><!-- .mw-box -->

                    <div class="pagination">
                        {{$places->appends(['keyword' => $keyword])->render('frontend.common.pagination')}}
                    </div><!-- .pagination -->

                </div><!-- .member-wrap -->
            </div>
        </div><!-- .site-content -->
    </main><!-- .site-main -->
@stop
