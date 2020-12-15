@extends('frontend.layouts.template')
<style>
    .grid-container {
        display: grid;
        grid-template-columns: auto auto auto auto;
        grid-gap: 10px;
        /* background-color: #2196F3; */
        padding: 10px;
    }

    .grid-container > div {
        text-align: center;
        /* padding: 20px 0; */
        /* font-size: 30px; */
    }

</style>
@section('main')

<main id="main" class="site-main home-main business-main">
    <div class="container">

        <div class="card-deck">
            <div class="card mb-3">
                <div class="row no-gutters">
                <div class="col-md-4">
                    <img style="height:384px; width:384px" src="{{getImageUrl($product->image)}}" class="card-img" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                    <p class="card-text"> {{$product->productCategories->name}}|{{getSubcategoryName($product->sub_category_id)}}</p>

                    <h5 class="card-title">{{$product->name}}</h5>

                   
                    <h3 class="font-weight-bolder my-2">
                        ${{$product->price}} @ {{PRODUCT_WEIGHT[$product->weight]}}
                    </h3>

                    <div class="my-3">

                        <a style="border-radius: 5px"  target="_blank" href="{{route('place_detail', $product->place->slug)}}" class="btn">View Retailer</a>
                    </div>

                        <div class="">

                        {!! $product->description !!}
                        </div>




                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h3>Related Products</h3>
        @if (count($related)>0)
        <div class="grid-container">
            @foreach ($related as $item)
            <div class="card" style="">
                <a href="{{route('place_detail', $item->slug)}}" class="">
                    <img src="{{getImageUrl($item->image)}}" style="max-height: 18rem" class="card-img-top" alt="...">
                </a>
                <div class="card-body">
                    <p class="card-text">{{$item->productCategories->name}} </p>
                    <a target="_blank" href="{{route('place_detail', $item->slug)}}" class="">
                        <p class="card-text">{{$item->name}} </p>
                    </a>
                    <p class="card-text">$ {{$item->price}} </p>

                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</main>

@stop

