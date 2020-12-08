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
<div class="container">

    <div class="card-deck">
        <div class="card mb-3">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img style="height:384px; width:384px" src="{{getImageUrl($product->image)}}" class="card-img" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <p class="card-text"> {{$product->productCategories->name}}</p>

                  <h5 class="card-title">{{$product->name}}</h5>

                  <div class="bg-light p-3">
                      <p class="card-text"> Available at {{$product->place->name}}</p>
                  </div>
                  <h3 class="font-weight-bolder">
                      ${{$product->price}}
                  </h3>

                  <a target="_blank" href="{{route('place_detail', $product->place->slug)}}" class="btn">View Retailer</a>

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
@stop

