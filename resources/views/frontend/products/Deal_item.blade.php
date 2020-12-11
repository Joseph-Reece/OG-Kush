@foreach ($deal as $deal)
<div class="card mb-3 border-0" >
    <div class="row no-gutters">
      <div class="col-md-3 col-sm-6 my-2">
        @if(isset($deal->image))
            <img style="max-height: 15rem" src="{{getImageUrl($deal->image)}}" class="card-img" alt="{{$deal->name}}">
        @else
            <img src="https://via.placeholder.com/1280x500?text=B&C" alt="slider no image">
        @endif

      </div>
      <div class="col-md-9">
        <div class="card-body">
            <h5 class="card-title">{{$deal->name}}</h5>
            <h5 class="card-title text-Upper">{{$deal->place->name}}</h5>
            <h5 class="card-title text-Upper"></h5>
            <p class="card-text">{{$deal->description}}</p>
            <p class="card-text">{{$deal->details}}</p>

        </div>
        <div class="card-footer bg-white">
            <button
            type=""
            class="btn"
            id="EditDeal"
            data-id="{{$deal->id}}"
            data-name="{{$deal->name}}"
            data-image="{{$deal->image}}"
            data-description="{{$deal->description}}"
            data-details="{{$deal->details}}"
            >Edit</button>
            <form class="d-inline" action="{{route('deal.destroy', $deal->id)}}" method="POST">
                @method('DELETE')
                @csrf
               <button style="background-color: rgb(206, 54, 54); padding-bottom:0" class="btn"><i class="fa fa-trash"></i> Delete</button>
            </form>
        </div>
      </div>
    </div>
</div>
@endforeach



