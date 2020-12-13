@extends('admin.layouts.template')

@section('main')
<div class="x_content">
    <div class="page-title">
        <div class="title_left">
            <h3>Product Categories</h3>
        </div>
        <div class="title_right">
            <div class="pull-right">
                <button class="btn btn-primary" id="btn_add_product_category" type="button">+ Add category</button>

            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <table class="table table-striped table-bordered golo-datatable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if (count($categories)>0)
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td><img class="place_list_thumb" src="{{getImageUrl($category->thumb)}}" alt="category thumb"></td>
                                        <td>{{$category->name}}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-xs category_edit"
                                                data-id="{{$category->id}}"
                                                data-name="{{$category->name}}"
                                                data-thumb="{{$category->thumb}}"
                                            >Edit</button>
                                            <form class="d-inline" action="{{route('admin_product-category.destroy',$category->id)}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" class="btn btn-danger btn-xs category_delete">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


</div>

@include('admin.products.modal_add_category')
{{-- @include('admin.products.modal_edit_category') --}}
@stop
@push('scripts')
    <script src="{{asset('admin/js/product_category.js')}}"></script>
@endpush
