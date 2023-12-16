@extends('admin.layout.default')

@section('template_title')
    {{ $customer->customername }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Thông tin khách hàng') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('customer.index') }}"> {{ __('Trở lại') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Mã khách hàng:</strong>
                            {{ $customer->customerid }}
                        </div>
                        <div class="form-group">
                            <strong>Tên khách hàng:</strong>
                            {{ $customer->customername }}
                        </div>
                        <div class="form-group">
                            <strong>Địa chỉ:</strong>
                            {{ $customer->address }}
                        </div>
                        <div class="form-group">
                            <strong>Số điện thoại:</strong>
                            {{ $customer->phonenumber }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <span class="card-title">Các hoá đơn đã mua của khách hàng <strong>{{ $customer->customername }}</strong></span>
                </div>
            </div>


            <div class="card-body">
                <div class="list-group">
                    @foreach ($salesinvoices as $salesinvoice)
                        <a href="{{ route('sales-invoice.show', $salesinvoice->invoiceid) }}"
                            class="list-group-item list-group-item-action">Mã hoá đơn {{ $salesinvoice->invoiceid }}
                            <br />
                            (Tổng tiền: <strong>{{ $salesinvoice->totalamount }} VNĐ</strong>)</a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
