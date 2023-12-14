<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('Tên danh mục') }}
            {{ Form::text('categoryname', $category->categoryname, ['class' => 'form-control' . ($errors->has('categoryname') ? ' is-invalid' : '')]) }}
            {!! $errors->first('categoryname', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('Danh mục cha') }}
        <select name="parentid" class="form-control">
            <option value="">--- Không có --</option>
            @foreach($parentCategories as $parentCategory)
                <option value="{{ $parentCategory->categoryid }}"
                    {{ $parentCategory->categoryid == $category->parentid ? 'selected' : '' }}>
                    {{ $parentCategory->categoryname }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Xác nhận') }}</button>
    </div>
</div>
