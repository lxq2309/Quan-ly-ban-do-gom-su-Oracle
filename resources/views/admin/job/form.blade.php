
@php
    $name = 'công việc';
@endphp

<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label("Tên $name") }}
            {{ Form::text('jobtitle', $job->jobtitle, ['class' => 'form-control' . ($errors->has('jobtitle') ? ' is-invalid' : '')]) }}
            {!! $errors->first('jobtitle', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Xác nhận') }}</button>
    </div>
</div>
