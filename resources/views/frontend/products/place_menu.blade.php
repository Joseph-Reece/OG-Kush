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
                    <h1>{{__('Menu')}}</h1>
                </div><!-- .member-place-top -->


                @include('frontend.common.box-alert')

                <div class="container-fluid">
                    <ul class="nav nav-tabs border-bottom border-top  border-success" id="myTab" role="tablist">
                        <li class="nav-item mr-4" role="presentation">
                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                              Products
                              @if (count($product)>0)
                                <i class="badge badge-secondary">{{count($product)}}</i>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item mx-4" role="presentation">
                          <a class="nav-link " id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false">Deals
                            @if (count($deal)>0)
                            <i class="badge badge-secondary">{{count($deal)}}</i>
                            @endif
                          </a>
                        </li>

                    </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            {{-- Modal buttom --}}
                            <div class="my-2">
                                @if (count($product)>0)
                                    {{count($product)}} products
                                @endif
                                <button id="addProduct" class="btn product float-right">+ Add Product</button>
                            </div>
                            {{-- <div class="container-fluid  py-2 border rounded my-2 box-shadow" id="createForm" style="display: none; position: relative; overflow: hidden;">

                                <form id="myForm" action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                        <img style='height: 80px; width: 100px; border: 1px solid #000;' id="thumb_preview" src="{{asset('assets/images/cs-thumb.jpg')}}" alt=""/>
                                        </div>

                                        <div class="">
                                            <label for="thumb_image">Add Image</label>
                                            <input type="file" id="thumb_image" name="thumb" class="Upload-file" accept="image/*" placeholder="one">
                                        </div>
                                        <small class="text-muted">
                                            @error('thumb')
                                            <div class="alert alert-danger alert-dissmissible">{{ $message }}</div>
                                            @enderror

                                        </small>
                                    </div>

                                    <div class="row my-1">
                                        <div class="col-md-4">
                                                <label for="category">Product Category</label>
                                                <select name="category_id" class="custom-select" id="category" >
                                                    <option value="" selected disabled>Please Select a Category...</option>
                                                    @foreach ($category as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                <small class="text-muted">
                                                    @error('category_id')
                                                    <div class="alert alert-danger ">{{ $message }}</div>
                                                    @enderror
                                                </small>
                                        </div>

                                        <div class="col-md-4">
                                                <label for="name">Product Name</label>
                                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Product name" style="outline: 0; border: 0; border-bottom:1px solid black">
                                                <small class="text-muted">
                                                    @error('name')
                                                    <div class="alert alert-danger alert-dissmissible">{{ $message }}</div>
                                                    @enderror
                                                </small>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="price">Product Price</label>
                                            <input class="form-control" style="outline: 0; border: 0; border-bottom:1px solid black" type="number" name="price" id="price" placeholder="Enter Price">
                                            <small  class="text-muted">
                                                @error('price')
                                                <div class="alert alert-danger alert-dissmissible">{{ $message }}</div>
                                                @enderror
                                            </small>
                                        </div>
                                    </div>
                                    <input type="hidden" name="place_id" id="places-id" value="{{$place->id}}">
                                    <button type="submit" id="submit-MyForm" class="btn "><i class="fas fa-plus"></i> Add</button>
                                </form>
                            </div> --}}

                            {{--Menu list--}}
                            <div class="menu-items ">
                                @include('frontend.products.product_item')
                            </div>
                        </div>
                        <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">


                            {{-- Modal buttom --}}
                            <div class="my-2">
                                @if (count($deal)>0)
                                    {{count($deal)}} active Deals
                                @endif
                                <button id="addDeal" class="btn  float-right mb-1">Add Deal</button>
                            </div>
                            <div class="container-fluid  py-2 border rounded my-2 box-shadow" id="dealsForm" style="display: none; position: relative; overflow: hidden;">

                            </div>

                            @include('frontend.products.Deal_item')
                        </div>
                    </div>
                </div>



            </div><!-- .member-place-wrap -->
        </div>
    </div><!-- .site-content -->
</main><!-- .site-main -->
@include('frontend.products.modal_edit_product')
@include('frontend.products.modal_editDeal')

@stop
@push('scripts')
<script src="{{asset('assets/js/place_menu.js')}}"></script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable({

            "order": [0, "desc"]
        });
    } );
</script>
@endpush
