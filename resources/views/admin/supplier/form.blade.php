<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('Tên nhà cung cấp') }}
            {{ Form::text('suppliername', $supplier->suppliername, ['class' => 'form-control' . ($errors->has('suppliername') ? ' is-invalid' : '')]) }}
            {!! $errors->first('suppliername', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('Địa chỉ') }}
            {{ Form::text('address', $supplier->address, ['class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : '')]) }}
            {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('Số điện thoại') }}
            {{ Form::text('phonenumber', $supplier->phonenumber, ['class' => 'form-control' . ($errors->has('phonenumber') ? ' is-invalid' : '')]) }}
            {!! $errors->first('phonenumber', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Xác nhận') }}</button>
    </div>
</div>
