<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('UserName') }}
            {{ Form::text('username', $user->username, ['class' => 'form-control' . ($errors->has('username') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('username', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Họ và tên') }}
            {{ Form::text('employeename', $user->employeename, ['class' => 'form-control' . ($errors->has('employeename') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('employeename', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Số điện thoại') }}
            {{ Form::text('phonenumber', $user->phonenumber, ['class' => 'form-control' . ($errors->has('phonenumber') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('phonenumber', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Ngày sinh') }}
            {{ Form::date('birthdate', $user->birthdate, ['class' => 'form-control' . ($errors->has('birthdate') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('birthdate', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Địa chỉ') }}
            {{ Form::text('address', $user->address, ['class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Giới tính') }}
            <select name="gender" class="form-control">
                <option value="">Chưa xác định</option>
                <option value="0">Nam</option>
                <option value="1">Nữ</option>
            </select>
        </div>
        <div class="form-group">
            {{ Form::label('Vị trí công việc') }}
            <select name="jobid" class="form-control">
                <option value="">-- Chưa có --</option>
                @foreach($jobs as $job)
                    <option value="{{ $job->jobid }}"
                        {{ $job->jobid == $user->jobid ? 'selected' : '' }}>
                        {{ $job->jobtitle }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
