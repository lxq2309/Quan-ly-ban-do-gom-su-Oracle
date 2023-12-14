
@php
    $name = 'công việc';
@endphp

<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label("Tên $name") }}
            {{ Form::text('jobname', $job->jobname, ['class' => 'form-control' . ($errors->has('jobname') ? ' is-invalid' : '')]) }}
            {!! $errors->first('jobname', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Xác nhận') }}</button>
    </div>
</div>
