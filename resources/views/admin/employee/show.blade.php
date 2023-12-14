@extends('admin.layout.default')

@section('template_title')
    {{ $user->UserName }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Thông tin nhân viên') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('employee.index') }}"> {{ __('Trở lại') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Mã nhân viên:</strong>
                            {{ $user->employeeid }}
                        </div>
                        <div class="form-group">
                            <strong>Tên nhân viên:</strong>
                            {{ $user->employeename }}
                        </div>
                        <div class="form-group">
                            <strong>Giới tính:</strong>
                            {{ $user->gender }}
                        </div>
                        <div class="form-group">
                            <strong>Ngày sinh:</strong>
                            {{ $user->birthdate }}
                        </div>
                        <div class="form-group">
                            <strong>Số điện thoại:</strong>
                            {{ $user->phonenumber }}
                        </div>
                        <div class="form-group">
                            <strong>Địa chỉ:</strong>
                            {{ $user->address }}
                        </div>
                        <div class="form-group">
                            <strong>Username:</strong>
                            {{ $user->username }}
                        </div>
                        <div class="form-group">
                            <strong>Tên công việc:</strong>
                            {{ $user->job?->jobtitle }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
