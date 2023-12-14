@extends('admin.layout.default')

@section('template_title')
    {{ $product->productname }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Thông tin sản phẩm') }}</span>
                        </div>
                        <div class="float-right">
                            <a href="{{ route('product.edit', $product->productid) }}" class="btn btn-outline-primary"><i
                                    class="fa-solid fa-pen"></i> Sửa thông tin</a>
                            <a class="btn btn-primary" href="{{ route('product.index') }}"> {{ __('Trở lại') }}</a>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">

                        <div class="form-group">
                            <img src="{{ $product->image }}" alt="{{ $product->productname }}" class="img-thumbnail rounded"
                                style="max-width: 300px">
                        </div>

                        <div class="form-group">
                            <strong>Mã sản phẩm:</strong> {{ $product->productid }}
                        </div>
                        <div class="form-group">
                            <strong>Tên sản phẩm:</strong> {{ $product->productname }}
                        </div>
                        <div class="form-group">
                            <strong>Kiểu:</strong> {{ $product->type }}
                        </div>
                        <div class="form-group">
                            <strong>Giá nhập:</strong> {{ $product->purchaseprice }} VNĐ
                        </div>
                        <div class="form-group">
                            <strong>Giá bán:</strong> {{ $product->sellingprice }} VNĐ
                        </div>
                        <div class="form-group">
                            <strong>Danh mục:</strong> {{ $product->category?->categoryname }}
                        </div>
                        <div class="form-group">
                            <strong>Kích thước:</strong> {{ $product->size?->sizename }} cm
                        </div>
                        <div class="form-group">
                            <strong>Loại men:</strong> {{ $product->glaze?->glazename }}
                        </div>
                        <div class="form-group">
                            <strong>Màu sắc:</strong> {{ $product->color?->colorname }}
                        </div>
                        <div class="form-group">
                            <strong>Nước sản xuất:</strong> {{ $product->country?->countryname }}
                        </div>
                        <div class="form-group">
                            <strong>Số lượng:</strong> {{ $product->quantity }}
                        </div>
                        <div class="form-group">
                            <strong>Trọng lượng:</strong> {{ $product->weight }}
                        </div>
                        <div class="form-group">
                            <strong>Bảo hành:</strong> {{ $product->warrantyperiod }}
                        </div>
                        <div class="form-group">
                            <strong>Ghi chú:</strong> {{ $product->note }}
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Danh sách ảnh đính kèm của
                                <strong>{{ $product->productname }}</strong> ({{ $images->count() }})</span>
                        </div>
                        <div class="float-right"><a href="{{ route('product.edit', $product->productid) }}#ImageAttach"
                                class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i> Sửa</a></div>
                    </div>


                    <div class="card-body">
                        <div class="row">
                            @foreach ($images as $image)
                                <div class="col-3">
                                    <img src="{{ $image->imagepath }}" alt="{{ $image->imageid }}"
                                        class="img-thumbnail rounded" style="max-width: 200px">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
