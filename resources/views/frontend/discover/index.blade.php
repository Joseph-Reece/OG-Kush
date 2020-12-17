
@extends('frontend.layouts.template_02')
@section('main')

<main id="main" class="site-main home-main business-main">
    <div class="blogs">
        <div class="container">
        @foreach ($categories as $item)
            <div class="row">
                <div class="col-md-4">
                    <div class="place-item layout-02">
                        <div class="place-inner">
                            <div class="place-thumb">
                                <a class="entry-thumb" href="#"><img src="{{getImageUrl($item->image)}}" alt="{{$item->name}}"></a>
                                {{-- <a class="entry-thumb" href="{{route('product.show', $item->slug)}}"><img src="{{getImageUrl($item->image)}}" alt="{{$item->name}}"></a> --}}

                            </div>
                            <div class="entry-detail">

                                <h3 class="place-title"><a href="#">{{$item->name}}</a></h3>
                                {{-- <h3 class="place-title"><a href="{{route('product.show', $item->slug)}}">{{$item->name}}</a></h3> --}}
                                <div class="entry-bottom">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        @endforeach
        </div>

    </div>



    {{-- Sub Categories --}}
    @foreach ($subCategory as $key => $subCategory)

    <div class="container" style="margin-top: 30px">
        <h2 class="title align-left">{{getCategoryName($key)}}</h2>

        {{-- @foreach ($product as $item) --}}

        <div class="slick-sliders">
            <div class="slick-slider trending-slider slider-pd30" data-item="4" data-arrows="true" data-itemScroll="4" data-dots="true" data-centerPadding="30" data-tabletitem="2" data-tabletscroll="2" data-smallpcscroll="3" data-smallpcitem="3" data-mobileitem="1" data-mobilescroll="1" data-mobilearrows="false">

                @foreach($subCategory as $item)
                    <div class="place-item layout-02">
                        <div class="place-inner">
                            <div class="place-thumb">
                                <a class="entry-thumb" href="#"><img src="{{getImageUrl($item->image)}}" alt="{{$item->name}}"></a>
                                {{-- <a class="entry-thumb" href="{{route('product.show', $item->slug)}}"><img src="{{getImageUrl($item->image)}}" alt="{{$item->name}}"></a> --}}

                            </div>
                            <div class="entry-detail">

                                <h3 class="place-title"><a href="#">{{$item->name}}</a></h3>
                                {{-- <h3 class="place-title"><a href="{{route('product.show', $item->slug)}}">{{$item->name}}</a></h3> --}}
                                <div class="entry-bottom">

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
        {{-- @endforeach --}}
    </div>
    @endforeach
</main>
@stop
