<div class="table-responsive">
    <table class="table table-striped responsive table-hover table-sm table-bordered " id="myTable">
        <thead>
        <tr>
            <th>ID</th>
            <th data-priority="1">Image</th>
            <th data-priority="2">Product Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @if (count($product)>0)
                @foreach ($product as $item)
                <tr>
                    <td>
                        {{$item->id}}
                    </td>
                    <td>
                        <img style='height: 80px; width: 100px; border: 1px solid #000;' src="{{getImageUrl($item->image)}}" class="card-img-top" alt="...">
                    </td>
                    <td>
                        {{$item->name}}
                    </td>
                    <td>
                        {{$item->productCategories->name}}
                    </td>
                    <td>
                        {{$item->price}}
                    </td>
                    <td>
                        <button
                        style="background-color: rgb(29, 151, 29); padding-bottom:0"
                            id="editProduct"
                            class="btn"
                            data-id="{{$item->id}}"
                            data-name="{{$item->name}}"
                            data-price="{{$item->price}}"
                            data-category="{{$item->productCategories->name}}"
                            ><i class="fa fa-edit"></i> Edit
                        </button>
                        <button
                        id="showProduct"
                        class="btn showProduct"

                        ><i class="fa fa-eye"></i> Show
                        </button>
                        <form class="d-inline" action="{{route('product.destroy', $item->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                           <button style="background-color: rgb(206, 54, 54); padding-bottom:0" class="btn"><i class="fa fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

