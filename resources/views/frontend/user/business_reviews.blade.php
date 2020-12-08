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
                        <form action="" class="site__search__form">
                            <div class="site__search__field">
                                <span class="site__search__icon">
                                    <i class="la la-search"></i>
                                </span><!-- .site__search__icon -->
                                <input onkeyup="submitForm()" class="site__search__input" type="text" id="keyword" name="keyword" value="{{$filter}}" placeholder="{{__('Search')}}">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <input type="hidden" name="place"  id="place" value="{{ $place->id }}">
                            </div><!-- .search__input -->
                        </form><!-- .search__form -->
                    </div><!-- .mf-right -->
                    @if (count($reviews))
                    <div class="main-search">
                        <div class="place__box place__box--reviews">
                            <h3 class="place__title--reviews">
                                {{__('Review')}} ({{count($reviews)}})
                                @if(isset($reviews))
                                    <span class="place__reviews__number"> {{$review_score_avg}}
                                        <i class="la la-star"></i>
                                    </span>
                                @endif
                            </h3>


                            @include('frontend.user.review')
                        </div><!-- .place__box -->
                    </div>
                    <div class="results">
                        <div id="overlay" style="display:none;" class="searchoverlay">
                            <div class="spinner"></div>
                            <br />
                            Loading...
                        </div>
                    </div>
                    @endif

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


 //.............................Submiting the form.............................//
 function submitForm() {
     console.log($('#keyword').val());
     $('.main-search').fadeOut(500);
     $(".searchoverlay").fadeIn();
     $.ajax({
         url:"{{route('search.review')}}",
         method:"GET",
         data:{
             "keyword":$('#keyword').val(),
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
