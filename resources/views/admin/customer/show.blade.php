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
    </section>
@endsection
