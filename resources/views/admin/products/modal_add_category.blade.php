<div class="modal fade" id="modal_add_product_category" tabindex="-1" role="dialog" aria-labelledby="modal_add_product_category" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>

            <form action="{{route('admin_product-category.store')}}" method="post" data-parsley-validate enctype="multipart/form-data">
                <input type="hidden" id="add_category_method" name="_method" value="POST">
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
                        <div class="col-md-12">

                            <div class="form-group">
                                <label for="name">Category name: *</label>
                                <input type="text" class="form-control" id="category_name" name="name" placeholder="Enter Category name" required>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" id="category_id" name="category_id" value="">
                    <button type="submit" class="btn btn-primary" id="submit_add_category">Add</button>
                    <button  class="btn btn-primary" id="submit_edit_category">Save</button>
                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>

        </div>
    </div>
</div>
