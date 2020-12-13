@extends('admin.layouts.template')

@section('main')

    <div class="page-title">
        <div class="title_left">
            <h3>Product Sub-Categories</h3>
        </div>
        <div class="title_right">
            <div class="pull-right">
                <button class="btn btn-primary" id="btn_add_subcategory" type="button">+ Add Sub-Category</button>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                {{-- <div class="x_title">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>Select Category:</label>
                            <form>
                                <select class="form-control" id="select_category_id" name="category_id" onchange="this.form.submit()">
                                    <option value="">--- Select category ---</option>
                                    @foreach($categories as $cat)
                                        @if($category_id)
                                            <option value="{{$cat->id}}" {{isSelected($cat->id, $category_id)}}>{{$cat->name}}</option>
                                        @else
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div> --}}

                <div class="x_content">

                    <table class="table table-striped table-bordered golo-datatable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Sub-Category name</th>
                            <th>Category name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($subcategories as $subcategory)
                            <tr>
                                <td>{{$subcategory->id}}</td>
                                <td><img class="place_list_thumb" src="{{getImageUrl($subcategory->thumb)}}" alt="subcategory thumb"></td>
                                <td>{{$subcategory->name}}</td>
                                <td>{{$subcategory['category']['name']}}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-xs subcategory_edit"
                                            data-id="{{$subcategory->id}}"
                                            data-catid="{{$subcategory->product_category_id}}"
                                            data-catname="{{$subcategory['category']['name']}}"
                                            data-name="{{$subcategory->name}}"
                                            data-thumb="{{$subcategory->thumb}}"
                                    >Edit
                                    </button>
                                    <form class="d-inline" action="{{route('admin_subcategory.delete',$subcategory->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-xs subcategory_delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>


                </div>

            </div>
        </div>
    </div>

    @include('admin.products.modal_add_Subcategory')
@stop

@push('scripts')
<script src="{{asset('admin/js/product_category.js')}}"></script>
@endpush
