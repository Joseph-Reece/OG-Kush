<div class="top-area top-area-filter">
    <span class="result-count"><span class="count">{{$places->count()}}</span> {{__('results')}}</span>
{{-- <a href="#" class="clear">Clear filter</a>  --}}
    <div class="select-box">
    </div><!-- .select-box -->
    <div class="show-map">
        <span>{{__('Maps')}}</span>
        <a href="#" class="icon-toggle"></a>
    </div><!-- .show-map -->
</div>

<div class="area-places" id="list_places">
    @if(($places->count())>0)
        @foreach($places as $place)
        {{-- @include('frontend.common.place_item') --}}
            <div class="place-item place-hover layout-02" data-maps="">
                <div class="place-inner">
                    <div class="place-thumb">
                        <a class="entry-thumb" href="{{route('place_detail', $place->slug)}}"><img src="{{getImageUrl($place->thumb)}}" alt=""></a>
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
</div>
