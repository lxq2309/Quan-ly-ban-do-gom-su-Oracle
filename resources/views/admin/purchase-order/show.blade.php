@extends('admin.layout.default')

@section('template_title')
    {{ "Hoá đơn $purchaseOrder->orderid" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Thông tin') }} hoá đơn nhập</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('purchase-order.index') }}"> {{ __('Quay lại') }}</a>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Mã hoá đơn:</strong>
                            {{ $purchaseOrder->orderid }}
                        </div>
                        <div class="form-group">
                            <strong>Ngày nhập</strong>
                            {{ $purchaseOrder->orderdate }}
                        </div>
                        <div class="form-group">
                            <strong>Nhà cung cấp</strong>
                            {{ $purchaseOrder->supplier?->suppliername }}
                        </div>
                        <div class="form-group">
                            <strong>Tổng tiền:</strong>
                            {{ $purchaseOrder->totalamount }} VNĐ
                        </div>
                        <div class="form-group">
                            <strong>Người tạo:</strong>
                            {{ $purchaseOrder->employee?->employeename }}
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Chi tiết hoá đơn</span>
                        </div>
                    </div>


                    <div class="card-body">
                        @foreach($purchaseOrderDetails as $purchaseOrderDetail)
                            <div class="card card-info">
                                <div class="card-header">
                                    <div class="float-left">
                                        <span class="card-title">{{ $purchaseOrderDetail->product->productname }}</span>
                                    </div>
                                </div>

                                <div class="card-body">

                                    <div class="form-group">
                                        <strong>Số lượng:</strong>
                                        {{ $purchaseOrderDetail->quantity }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Giá bán:</strong>
                                        {{ $purchaseOrderDetail->price }} VNĐ
                                    </div>
                                    <div class="form-group">
                                        <strong>Thành tiền:</strong>
                                        {{ $purchaseOrderDetail->totalamount }} VNĐ
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
