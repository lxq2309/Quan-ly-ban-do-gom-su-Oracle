<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group required">
            {{ Form::label('Tên sản phẩm') }}
            {{ Form::text('productname', $product->productname, ['class' => 'form-control' . ($errors->has('productname') ? ' is-invalid' : '')]) }}
            {!! $errors->first('productname', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group required">
            {{ Form::label('Giá nhập (VNĐ)') }}
            {{ Form::number('purchaseprice', $product->purchaseprice, ['class' => 'form-control' . ($errors->has('purchaseprice') ? ' is-invalid' : '')]) }}
            {!! $errors->first('purchaseprice', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group required">
            {{ Form::label('Giá bán (VNĐ)') }}
            {{ Form::number('sellingprice', $product->sellingprice, ['class' => 'form-control' . ($errors->has('sellingprice') ? ' is-invalid' : '')]) }}
            {!! $errors->first('sellingprice', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Thời hạn bảo hành (tháng)') }}
            {{ Form::number('warrantyperiod', $product->warrantyperiod, ['class' => 'form-control' . ($errors->has('warrantyperiod') ? ' is-invalid' : '')]) }}
            {!! $errors->first('warrantyperiod', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group required">
            {{ Form::label('Trọng lượng (gram)') }}
            {{ Form::number('weight', $product->weight, ['class' => 'form-control' . ($errors->has('weight') ? ' is-invalid' : '')]) }}
            {!! $errors->first('weight', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Ảnh đại diện') }}
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab"
                       aria-controls="tab1" aria-selected="true">Nhập URL ảnh</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2"
                       aria-selected="false">Tải lên tệp</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabsContent">
                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                    <div class="form-group mt-4">
                        <input type="text" class="form-control" name="imageurl"
                               placeholder="https://example.com/image.jpg" value="{{ $product->image }}">
                    </div>
                </div>
                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                    <div class="form-group mt-4">
                        <input type="file" class="form-control-file" name="image" accept="image/*">
                    </div>
                </div>
            </div>
            {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group required">
            {{ Form::label('Loại sản phẩm') }}
            <select name="type" class="form-control">
                <option
                    value="0">-- Đồ gốm --
                </option>
                <option
                    value="1" {{ ($method == 'PATCH' && $product->type == 1) ? 'selected' : '' }}>-- Đồ sứ --
                </option>
                <option
                    value="2" {{ ($method == 'PATCH' && $product->type == 2) ? 'selected' : '' }}>-- Đồ gốm sứ --
                </option>
            </select>
        </div>
        <div class="form-group required">
            {{ Form::label('Số lượng') }}
            {{ Form::number('quantity', $product->quantity, ['class' => 'form-control' . ($errors->has('quantity') ? ' is-invalid' : '')]) }}
            {!! $errors->first('quantity', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Mô tả, ghi chú') }}
            {{ Form::textarea('note', $product->note, ['class' => 'form-control' . ($errors->has('note') ? ' is-invalid' : '')]) }}
            {!! $errors->first('note', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('Danh mục') }}
            <select name="categoryid" class="form-control">
                <option value="">-- Không thuộc danh mục nào --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->categoryid }}"
                        {{ $category->categoryid == $product->categoryid ? 'selected' : '' }}>
                        {{ $category->categoryname }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {{ Form::label('Kích thước') }}
            <select name="sizeid" class="form-control">
                <option value="">-- Chưa rõ --</option>
                @foreach($sizes as $size)
                    <option value="{{ $size->sizeid }}"
                        {{ $size->sizeid == $product->sizeid ? 'selected' : '' }}>
                        {{ $size->sizename }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {{ Form::label('Loại men') }}
            <select name="glazeid" class="form-control">
                <option value="">-- Chưa rõ --</option>
                @foreach($glazes as $glaze)
                    <option value="{{ $glaze->glazeid }}"
                        {{ $glaze->glazeid == $product->glazeid ? 'selected' : '' }}>
                        {{ $glaze->glazename }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {{ Form::label('Màu sắc') }}
            <select name="colorid" class="form-control">
                <option value="">-- Chưa rõ --</option>
                @foreach($colors as $color)
                    <option value="{{ $color->colorid }}"
                        {{ $color->colorid == $product->colorid ? 'selected' : '' }}>
                        {{ $color->colorname }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {{ Form::label('Nước sản xuất') }}
            <select name="countryid" class="form-control">
                <option value="">-- Chưa rõ --</option>
                @foreach($countries as $country)
                    <option value="{{ $country->countryid }}"
                        {{ $country->countryid == $product->countryid ? 'selected' : '' }}>
                        {{ $country->countryname }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group" id="ImageAttach">
            {{ Form::label('Danh Sách Hình Ảnh Đính Kèm') }}
            <div class="row">
                @foreach($images as $image)
                    <div class="col-3 position-relative image-items d-flex align-items-center justify-content-center">
                        <img src="{{ $image->imagepath }}" alt="{{ $image->note }}" class="img-thumbnail rounded"
                             style="max-width: 200px">
                        <div class="image-overlay">
                            <div id="btnDeleteImage" data-imgid="{{ $image->imageid }}" style="cursor: pointer;"><i
                                    class="fa fa-trash" aria-hidden="true"></i> Xoá
                            </div>
                        </div>
                        <input type="hidden" name="imagesids[]" value="{{ $image->imageid }}">
                    </div>

                @endforeach
            </div>

            <label>Thêm ảnh đính kèm mới</label>
            <ul class="nav nav-tabs" id="myTabs2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab1-2-tab" data-toggle="tab" href="#tab1-2" role="tab"
                       aria-controls="tab1-2" aria-selected="true">Nhập URL ảnh</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab2-2-tab" data-toggle="tab" href="#tab2-2" role="tab"
                       aria-controls="tab2-2"
                       aria-selected="false">Tải lên tệp</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabsContent2">
                <div class="tab-pane fade show active" id="tab1-2" role="tabpanel" aria-labelledby="tab1-2-tab">
                    <button type="button" class="btn btn-sm btn-outline-primary " id="add-image-url-input">Thêm url
                    </button>
                    <div class="form-group mt-4" id="image-url-upload-container">

                    </div>
                </div>
                <div class="tab-pane fade" id="tab2-2" role="tabpanel" aria-labelledby="tab2-2-tab">
                    <button type="button" class="btn btn-sm btn-outline-primary " id="add-image-input">Thêm tệp</button>
                    <div class="form-group mt-4" id="image-upload-container">

                    </div>
                </div>
            </div>
            {!! $errors->first('images', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Xác nhận') }}</button>
    </div>
</div>

@section('formProductScripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById('add-image-input').addEventListener('click', function () {
                var container = document.getElementById('image-upload-container');
                var input = document.createElement('input');
                input.type = 'file';
                input.name = 'images-file[]';
                input.accept = 'image/*';
                input.className = 'form-control-file mt-2';
                container.appendChild(input);
            });

            document.getElementById('add-image-url-input').addEventListener('click', function () {
                var container = document.getElementById('image-url-upload-container');
                var input = document.createElement('input');
                input.type = 'text';
                input.name = 'images-url[]';
                input.className = 'form-control';
                input.placeholder = 'https://example.com/image.jpg';
                container.appendChild(input);
            });
        });
    </script>
@endsection

<style>
    .image-overlay {
        display: none;
        background-color: rgba(0, 0, 0, 0.2);
        z-index: 2;
        width: 100%;
        height: 100%;
        position: absolute;
        color: #fff;
        justify-content: center;
        align-items: center;
    }
</style>

<script>
    let image_items = document.querySelectorAll(".image-items");
    image_items.forEach(function (item) {
        item.addEventListener('mouseenter', function () {
            item.querySelector('.image-overlay').style.display = 'flex';
        });

        item.addEventListener('mouseleave', function () {
            item.querySelector('.image-overlay').style.display = 'none';
        })

        item.querySelector("#btnDeleteImage").addEventListener('click', function () {
            let imgId = this.dataset.imgid;
            var result = confirm("Bạn có muốn xoá ảnh này không?");
            if (result) {
                alert(`Đã xoá ${imgId}`);
                item.remove();
            }
        })
    })
</script>
