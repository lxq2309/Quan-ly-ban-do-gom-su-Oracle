@extends('admin.layout.default')

@section('template_title')
    {{ $productset->setname }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Thông tin bộ sản phẩm') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('productset.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <img src="{{ $productset->image }}" alt="{{ $productset->setname }}"
                                class="img-thumbnail rounded" style="max-width: 300px">
                        </div>

                        <div class="form-group">
                            <strong>Mã bộ sản phẩm:</strong>
                            {{ $productset->setid }}
                        </div>
                        <div class="form-group">
                            <strong>Tên bộ sản phẩm:</strong>
                            {{ $productset->setname }}
                        </div>
                        <div class="form-group">
                            <strong>Đường dẫn ảnh:</strong>
                            {{ $productset->image }}
                        </div>
                        <div class="form-group">
                            <strong>Số sản phẩm:</strong>
                            {{ $productsetdetails->count() }}
                        </div>
                        <div class="form-group">
                            <strong>Mô tả:</strong>
                            {{ $productset->note }}
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Các sản phẩm của bộ <strong>{{ $productset->setname }}</strong></span>
                        </div>
                    </div>


                    <div class="card-body">
                        <div class="list-group">
                            @foreach ($productsetdetails as $setdetail)
                                <a href="{{ route('product.show', $setdetail->productid) }}"
                                    class="list-group-item list-group-item-action">{{ $setdetail->product?->productname }}
                                    <br />
                                    (Số lượng: <strong>{{ $setdetail->quantity }}</strong>)</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
