<div class="modal fade" id="modal_edit_category" tabindex="-1" role="dialog" aria-labelledby="modal_add_category" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>

            <form action="{{route('admin_product-category.update', $category->id)}}" method="post" data-parsley-validate enctype="multipart/form-data">
                {{-- <input type="hidden" id="add_category_method" name="_method" value="PUT"> --}}
                @method('PUT')
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label for="name">Category name: *</label>
                                <input type="text" class="form-control" id="cat_name" name="name" placeholder="Enter Category name" required>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" id="category_id" name="category_id" value="">
                    <button type="submit" class="btn btn-primary" id="add_category">Add</button>
                    <button class="btn btn-primary" id="edit_category">Save</button>
                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>

        </div>
    </div>
</div>
