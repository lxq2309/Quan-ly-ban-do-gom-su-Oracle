@extends('admin.layout.default')

@section('template_title')
    {{ $supplier->suppliername }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Thông tin nhà cung cấp') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('supplier.index') }}"> {{ __('Trở lại') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Mã nhà cung cấp:</strong>
                            {{ $supplier->supplierid }}
                        </div>
                        <div class="form-group">
                            <strong>Tên nhà cung cấp:</strong>
                            {{ $supplier->suppliername }}
                        </div>
                        <div class="form-group">
                            <strong>Địa chỉ:</strong>
                            {{ $supplier->address }}
                        </div>
                        <div class="form-group">
                            <strong>Số điện thoại:</strong>
                            {{ $supplier->phonenumber }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
