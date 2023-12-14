
@php
    $name = 'nước sản xuất';
@endphp

<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label("Tên $name") }}
            {{ Form::text('countryname', $country->countryname, ['class' => 'form-control' . ($errors->has('countryname') ? ' is-invalid' : '')]) }}
            {!! $errors->first('countryname', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Xác nhận') }}</button>
    </div>
</div>
