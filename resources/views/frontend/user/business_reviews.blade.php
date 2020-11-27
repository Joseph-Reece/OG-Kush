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
                        <h1>{{__('Business Reviews')}}</h1>
                    </div><!-- .member-place-top -->
                    @include('frontend.common.box-alert')
                    

                    <div class="mf-right">
                        <form action="" class="site__search__form" method="GET">
                            <div class="site__search__field">
                                    <span class="site__search__icon">
                                        <i class="la la-search"></i>
                                    </span><!-- .site__search__icon -->
                                <input class="site__search__input" type="text" name="keyword" value="{{$filter}}" placeholder="{{__('Search')}}">
                            </div><!-- .search__input -->
                        </form><!-- .search__form -->
                    </div><!-- .mf-right -->

                    <div class="place__box place__box--reviews">
                        @if (count($reviews))
                            
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
                        @endif

                        

                    </div><!-- .place__box -->
                    <div class="pagination align-left">
                        {{-- {{$places->appends(["city_id" => $filter['city'], "category_id" => $filter['category'], "keyword" => $filter['keyword']])->render('frontend.common.pagination')}} --}}
                        {{-- {{$reviews->appends(["keyword" => $filter['keyword']])->render('frontend.common.pagination')}} --}}
                    </div><!-- .pagination -->

                </div><!-- .member-place-wrap -->
            </div>
        </div><!-- .site-content -->
    </main><!-- .site-main -->


@stop
@push('scripts')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endpush
