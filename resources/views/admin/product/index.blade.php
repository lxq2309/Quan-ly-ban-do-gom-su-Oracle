@extends('admin.layout.default')

@section('template_title')
    Sản phẩm
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="dt-buttons btn-group flex-wrap">
                        <div class="ml-1"></div>
                        <div class="dropdown">
                            @php
                                $order = request('order');
                                $oldest = 'cũ nhất';
                                $newest = 'mới nhất';
                                $orderText = $order == 'desc' ? $oldest : $newest;
                            @endphp
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="filterData"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sắp xếp theo: {{ $orderText }}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="filterData">
                                @php
                                    $status = request('status');
                                    $statusParam = empty($status) || $status == 1 ? '' : "&status=$status";
                                @endphp
                                <a class="dropdown-item {{ $orderText == $newest ? 'my-selected' : '' }}"
                                    href="?order=asc{{ $statusParam }}">Mới nhất</a>
                                <a class="dropdown-item {{ $orderText == $oldest ? 'my-selected' : '' }}"
                                    href="?order=desc{{ $statusParam }}">Cũ nhất</a>
                            </div>
                        </div>
                        @php
                            $routeName = 'product.index';
                        @endphp

                    </div>
                    <a href="{{ route('product.create') }}" class="btn btn-primary float-right" data-placement="left">
                        {{ __('Thêm sản phẩm mới') }}
                    </a>
                    <div class="dataTables_filter" style="padding: 0; padding-top: 0.75rem">
                        <form id="searchForm" action="{{ route($routeName) }}" method="GET">
                            <div class="dataTables_filter" style="padding: 0; padding-top: 0.75rem">
                                <input type="search" id="searchInput" class="form-control form-control-sm"
                                    placeholder="Tìm kiếm theo tên sản phẩm" name="search">
                            </div>
                        </form>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table data-bs-spy="scroll"
                                    class="table table-bordered table-striped dataTable dtr-inline table-hover table-responsive"
                                    aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th>Mã sản phẩm</th>
                                            <th>Ảnh</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Kiểu</th>
                                            <th>Giá nhập</th>
                                            <th>Giá bán</th>
                                            <th>Danh mục</th>
                                            <th>Kích thước</th>
                                            <th>Loại men</th>
                                            <th>Màu sắc</th>
                                            <th>Nước sản xuất</th>
                                            <th>Số lượng</th>
                                            <th>Trọng lượng</th>
                                            <th>Bảo hành</th>
                                            <th>Số lượng ảnh đính kèm</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr class="even" onmouseover="readListScripts.showTableActions()"
                                                onmouseleave="readListScripts.hideTableActions()">
                                                <td>{{ $product->productid }}</td>
                                                <td><img src="{{ $product->image }}" alt="{{ $product->productname }}"
                                                        class="img-thumbnail rounded check-image" style="max-width: 100px">
                                                </td>
                                                <td>{{ $product->productname }}</td>
                                                <td>{{ $product->type }}</td>
                                                <td>{{ $product->purchaseprice }} VNĐ</td>
                                                <td>{{ $product->sellingprice }} VNĐ</td>
                                                <td>{{ $product->category?->categoryname }}</td>
                                                <td>{{ $product->size?->sizename }} cm</td>
                                                <td>{{ $product->glaze?->glazename }}</td>
                                                <td>{{ $product->color?->colorname }}</td>
                                                <td>{{ $product->country?->countryname }}</td>
                                                <td>{{ $product->quantity }}</td>
                                                <td>{{ $product->weight }}</td>
                                                <td>{{ $product->warrantyperiod }}</td>
                                                <td>{{ $product->productimages->count() }}</td>

                                                <td style="position: absolute; right: 0; display: none">
                                                    <div style="position: sticky;">
                                                        <form action="{{ route('product.destroy', $product->productid) }}"
                                                            method="POST">
                                                            <a class="btn btn-sm btn-primary "
                                                                href="{{ route('product.show', $product->productid) }}"><i
                                                                    class="fa fa-fw fa-eye"></i> {{ __('Xem chi tiết') }}</a>
                                                            <a class="btn btn-sm btn-success"
                                                                href="{{ route('product.edit', $product->productid) }}"><i
                                                                    class="fa fa-fw fa-edit"></i> {{ __('Sửa') }}</a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                                    class="fa fa-fw fa-trash"></i> {{ __('Xoá') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-7">
                                {!! $products->links() !!}
                            </div>
                        </div>
                        @if ($products->count() > 0)
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                        Hiển thị {{ $i + 1 }} đến {{ $i + $products->count() }} trong tổng
                                        số {{ $product->count() }} bản ghi
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
