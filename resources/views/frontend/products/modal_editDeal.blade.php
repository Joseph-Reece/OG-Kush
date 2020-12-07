<div class="modal fade" id="modal_add_deal" tabindex="-1" role="dialog" aria-labelledby="modal_add_deal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="mdl-title" class="modal-title">Add Deal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <form action="{{route('deal.store')}}" method="post" data-parsley-validate enctype="multipart/form-data">
                <input type="hidden" id="add_deal_method" name="_method" value="POST">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                        <img style='height: 80px; width: 100px; border: 1px solid #000;' id="deal_preview" src="{{asset('assets/images/cs-thumb.jpg')}}" alt=""/>
                        </div>

                        <div class="">
                            <label for="thumb_image">Add Image</label>
                            <input type="file" id="deal_image" name="image" class="Upload-file" accept="image/*" placeholder="one">
                        </div>
                        <small class="text-muted">
                            @error('thumb')
                            <div class="alert alert-danger alert-dissmissible">{{ $message }}</div>
                            @enderror

                        </small>
                    </div>
                    <div class="row my-1">
                        <div class="col-md-4">
                            <label for="title">Title</label>
                            <input type="text" name="name" id="title" class="form-control" placeholder="Enter Deal's Title" style="outline: 0; border: 0; border-bottom:1px solid black">
                            <small class="text-muted">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </small>
                        </div>

                        <div class="col-md-4">
                            <label for="details">Discount details</label>
                            <select name="details" class="custom-select" id="details" >
                                <option value="" selected disabled>Please Select a Category...</option>
                                <option value="Storefront" >Storefront</option>
                                <option value="Medical" >Medical</option>
                            </select>
                            <small  class="text-muted">
                                @error('details')
                                <div class="alert alert-danger alert-dissmissible">{{ $message }}</div>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="description">Description</label>
                        {{-- <input type="text" name="description" class="form-control" id="description" placeholder="Enter Product name" style="outline: 0; border: 0; border-bottom:1px solid black"> --}}
                        <textarea name="description" id="description" cols="30" rows="10"></textarea>
                        <small class="text-muted">
                            Brief description about the Deal
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </small>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" id="deal_id" name="deal_id" value="">
                    <input type="hidden" id="place_id" name="place_id" value="{{$place->id}}">
                    <button type="submit" class="btn btn-primary" id="submit_add_deal">Add</button>
                    <button class="btn btn-primary" id="submit_edit_deal">Save</button>
                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>

        </div>
    </div>
</div>
