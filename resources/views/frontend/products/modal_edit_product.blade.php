<div class="modal fade" id="modal_edit_product" data-backdrop="static" data-keyboard='false' tabindex="-1" role="dialog" aria-labelledby="modal_edit_product" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="myForm" action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="add_product_method" name="_method" value="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-5">
                        <img style='height: 80px; width: 100px; border: 1px solid #000;' id="thumb_previeww" src="{{asset('assets/images/cs-thumb.jpg')}}" alt=""/>
                        </div>

                        <div class="col-md-4">
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
                                <label for="select_category">Product Category</label>
                                <select name="category_id" class="custom-select" id="select_category" required>
                                    <option selected  value="">Please Select a Category...</option>
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
                            <label for="select_subcategory">Product Sub-Category</label>
                            <select name="sub_category_id" class="custom-select" id="select_subcategory" required>
                                <option value="">Please Select a Sub Category...</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="product-weight">Product Weight</label>
                            <select name="weight" class="custom-select" id="product-weight" required>
                                <option selected  value="">Please product weight...</option>
                                @foreach(PRODUCT_WEIGHT as $key => $weight)
                                    <option value="{{$key}}">{{$weight}}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-4">
                                <label for="name">Product Name</label>
                                <input type="text" name="name" class="form-control" id="product-name" placeholder="Enter Product name" style="outline: 0; border: 0; border-bottom:1px solid black">
                                <small class="text-muted">
                                    @error('name')
                                    <div class="alert alert-danger alert-dissmissible">{{ $message }}</div>
                                    @enderror
                                </small>
                        </div>

                        <div class="col-md-4">
                            <label for="price">Product Price</label>
                            <input name="price" class="form-control" style="outline: 0; border: 0; border-bottom:1px solid black" type="number"  id="product-price" placeholder="Enter Price">
                            <small  class="text-muted">
                                @error('price')
                                <div class="alert alert-danger alert-dissmissible">{{ $message }}</div>
                                @enderror
                            </small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            <label for="product-description">Description</label>
                            <textarea type="text" class="form-control tinymce_editor" name="description" id="product-description"  rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="product-id" value="">
                        <input type="hidden" name="place_id" id="places-id" value="{{$place->id}}">
                        <button type="submit" id="add_product" class="btn"><i class="fas fa-plus"></i> Add </button>
                        <button class="btn btn-primary" id="edit_product"> Save </button>
                        <button class="btn btn-default " data-dismiss="modal"> Cancel </button>
                    </div>

                </form>
            </div>


        </div>
    </div>
</div>
