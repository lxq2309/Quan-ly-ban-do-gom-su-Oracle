@extends('admin.layout.default')

@section('template_title')
    {{ "Hoá đơn $salesInvoice->invoiceid" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Thông tin') }} hoá đơn bán</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('sales-invoice.index') }}"> {{ __('Quay lại') }}</a>
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
                            {{ $salesInvoice->invoiceid }}
                        </div>
                        <div class="form-group">
                            <strong>Ngày bán</strong>
                            {{ $salesInvoice->saledate }}
                        </div>
                        <div class="form-group">
                            <strong>Người mua</strong>
                            {{ $salesInvoice->customer?->customername }}
                        </div>
                        <div class="form-group">
                            <strong>Tổng tiền:</strong>
                            {{ $salesInvoice->totalamount }} VNĐ
                        </div>
                        <div class="form-group">
                            <strong>Người tạo:</strong>
                            {{ $salesInvoice->employee?->employeename }}
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
                        @foreach($salesInvoiceDetails as $salesInvoiceDetail)
                            <div class="card card-info">
                                <div class="card-header">
                                    <div class="float-left">
                                        <span class="card-title">{{ $salesInvoiceDetail->product->productname }}</span>
                                    </div>
                                </div>

                                <div class="card-body">

                                    <div class="form-group">
                                        <strong>Số lượng:</strong>
                                        {{ $salesInvoiceDetail->quantity }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Giá bán:</strong>
                                        {{ $salesInvoiceDetail->price }} VNĐ
                                    </div>
                                    <div class="form-group">
                                        <strong>Thành tiền:</strong>
                                        {{ $salesInvoiceDetail->totalamount }} VNĐ
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
