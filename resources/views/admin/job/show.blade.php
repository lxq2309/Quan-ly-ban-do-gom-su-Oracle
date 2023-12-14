@extends('admin.layout.default')

@section('template_title')
    {{ $job->jobname }}
@endsection

@php
    $name = 'công việc';
@endphp

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Thông tin {{ $name }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('job.index') }}"> {{ __('Trở về') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Mã <?php echo $name ?>:</strong>
                            {{ $job->jobid }}
                        </div>
                        <div class="form-group">
                            <strong>Tên <?php echo $name ?>:</strong>
                            {{ $job->jobname }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
