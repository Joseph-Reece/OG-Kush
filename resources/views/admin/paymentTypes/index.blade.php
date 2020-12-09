@extends('admin.layouts.template')

@section('main')
    <div class="page-title">
        <div class="title_left">
            <h3>Payment Types</h3>
        </div>
        <div class="title_right">
            <div class="pull-right">
                <button class="btn btn-primary" id="btn_add_payment" type="button">+ Add Payment Type</button>
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
                            <th width="3%">ID</th>
                            <th width="5%">Icon</th>
                            <th>Payment Type Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payType as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td><img class="payment_icon" src="{{getImageUrl($item->icon)}}" alt="Payment Types icon"></td>
                                <td>{{$item->name}}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-xs payment_edit"
                                            data-id="{{$item->id}}"
                                            data-name="{{$item->name}}"
                                            data-icon="{{$item->icon}}"
                                    >Edit
                                    </button>
                                    <form class="d-inline" action="{{route('admin_payment_delete',$item->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-xs payment_delete">Delete</button>
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

    @include('admin.paymentTypes.modal_addPayment')
@stop

@push('scripts')
    <script src="{{asset('admin/js/page_paymentTypes.js')}}"></script>
@endpush
