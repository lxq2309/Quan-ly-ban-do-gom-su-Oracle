@extends('admin.layout.default')



@section('template_title')
    {{ "Sửa thông tin $job->jobname" }}
@endsection

@php
    $method = 'PATCH';
@endphp

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Sửa thông tin') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('job.index') }}"> {{ __('Trở lại') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('job.update', $job->jobid) }}" role="form"
                              enctype="multipart/form-data">
                            {{ method_field($method) }}
                            @csrf

                            @include('admin.job.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
