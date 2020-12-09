<div class="modal fade" id="modal_add_payment" tabindex="-1" role="dialog" aria-labelledby="modal_add_payment" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add payment type</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <form action="{{route('admin_payment_create')}}" method="post" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" id="add_payment_method" name="_method" value="POST">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label for="name">Payment Type  name: *</label>
                                <input type="text" class="form-control" id="payment_name" name="name" required>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><strong>Icon:</strong></p>
                                    <img id="preview_icon" src="https://via.placeholder.com/100x100?text=icon" alt="no image">
                                    <input type="file" class="form-control" id="payment_icon" name="icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" id="payment_id" name="payment_id" value="1">
                    <button type="submit" class="btn btn-primary" id="submit_add_payment">Add</button>
                    <button class="btn btn-primary" id="submit_edit_payment">Save</button>
                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>

        </div>
    </div>
</div>
