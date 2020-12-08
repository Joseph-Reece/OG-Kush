<h4 class="text-muted">{{count($product)}} results found</h4>
@foreach ($product as $item)
<div class="card-deck">
    <div class="card mb-3 border-0" >
        <div class="row no-gutters">
          <div class="col-md-2">
                <a href="{{route('product.show', $item->slug)}}">
                    <img style="max-height: 8rem" src="{{getImageUrl($item->image)}}" class="card-img" alt="...">
                </a>
          </div>
          <div class="col-md-10">
            <div class="card-body">
                <div class="row">
                    <p class="card-text">{{$item->productCategories->name}}</p>
                    <p class="pull-right"> {{$item->price}}</p>
                </div>
                <a href="{{route('product.show', $item->slug)}}">
                    <h5 class="card-title">{{$item->name}}</h5>
                </a>
                <p class="card-text">{{$item->productCategories->name}}</p>
              <p class="card-text"> {{$item->price}}</p>
            </div>
          </div>
        </div>
      </div>
</div>

@endforeach
{{-- @foreach ($place->products as $item)
{{$item->name}}
{{$item->price}}
@endforeach --}}


