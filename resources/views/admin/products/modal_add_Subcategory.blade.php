<div class="modal fade" id="modal_add_product_subcategory" tabindex="-1" role="dialog" aria-labelledby="modal_add_product_subcategory" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Sub Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>

            <form action="{{route('admin_subcategory.store')}}" method="post" data-parsley-validate enctype="multipart/form-data" class="was-validated">
                <input type="hidden" id="add_subcategory_method" name="_method" value="POST">
                @csrf

                <div class="modal-body">
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

                    <div class="row">

                        <div class="col-md-6">
                            <label for="sub-category_id">Select Category : *</label>

                            <select class="custom-select" name="product_category_id" id="sub-category_id"  required>
                                <option selected disabled value="">Select A Category</option>
                                @foreach ($category as $item)

                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="subcategory_name">Sub-Category name: *</label>
                                <input type="text" class="form-control" id="subcategory_name" name="name" placeholder="Enter Sub Category name" required>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" id="subcategory_id" name="id" value="">
                    <button type="submit" class="btn btn-primary" id="submit_add_subcategory">Add</button>
                    <button class="btn btn-primary" id="submit_edit_subcategory">Save</button>
                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>

        </div>
    </div>
</div>
