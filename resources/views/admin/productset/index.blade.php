@extends('admin.layout.default')

@section('template_title')
    Bộ sản phẩm
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
                                    $statusParam = (empty($status) || $status == 1) ? '' : "&status=$status";
                                @endphp
                                <a class="dropdown-item {{ $orderText == $newest ? 'my-selected' : '' }}"
                                   href="?order=asc{{ $statusParam }}">Mới nhất</a>
                                <a class="dropdown-item {{ $orderText == $oldest ? 'my-selected' : '' }}"
                                   href="?order=desc{{ $statusParam }}">Cũ nhất</a>
                            </div>
                        </div>
                        @php
                            $routeName = 'productset.index';
                        @endphp

                    </div>
                    <a href="{{ route('productset.create') }}" class="btn btn-primary float-right"
                       data-placement="left">
                        {{ __('Thêm bộ sản phẩm mới') }}
                    </a>
                    <div class="dataTables_filter" style="padding: 0; padding-top: 0.75rem">
                        <form id="searchForm" action="{{ route($routeName) }}" method="GET">
                            <div class="dataTables_filter" style="padding: 0; padding-top: 0.75rem">
                                <input type="search" id="searchInput" class="form-control form-control-sm"
                                       placeholder="Tìm kiếm theo tên bộ sản phẩm" name="search">
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
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table data-bs-spy="scroll"
                                       class="table table-bordered table-striped dataTable dtr-inline table-hover"
                                       aria-describedby="example1_info">
                                    <thead>
                                    <tr>
                                        <th>Mã bộ sản phẩm</th>
                                        <th>Tên bộ sản phẩm</th>
                                        <th>Ảnh</th>
                                        <th>Ghi chú</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($productsets as $productset)
                                        <tr class="even" onmouseover="readListScripts.showTableActions()"
                                            onmouseleave="readListScripts.hideTableActions()">
                                            <td>{{ $productset->setid }}</td>
                                            <td>{{ $productset->setname }}</td>
                                            <td><img src="{{ $productset->image }}" alt="{{ $productset->setname }}"
                                                     class="img-thumbnail rounded check-image" style="max-width: 100px">
                                            </td>
                                            <td>{{ $productset->note }}</td>

                                            <td style="position: absolute; right: 0; display: none">
                                                <div style="position: sticky;">
                                                    <form action="{{ route('productset.destroy',$productset->setid) }}"
                                                          method="POST">
                                                        <a class="btn btn-sm btn-primary "
                                                           href="{{ route('productset.show',$productset->setid) }}"><i
                                                                class="fa fa-fw fa-eye"></i> {{ __('Xem chi tiết') }}
                                                        </a>
                                                        <a class="btn btn-sm btn-success"
                                                           href="{{ route('productset.edit',$productset->setid) }}"><i
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
                                {!! $productsets->links() !!}
                            </div>
                        </div>
                        @if($productsets->count() > 0)
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                        Hiển thị {{ $i + 1 }} đến {{ $i + $productsets->count() }} trong tổng
                                        số {{ $productset->count() }} bản ghi
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

@section('exportToExcelScripts')
    <script>
        function exportToExcel() {
            let tableName = 'productset';
            let apiUrl = `/api/${tableName}/all`;
            alert('Đang xuất thành file ' + tableName + '.xlsx');
            // Lấy dữ liệu từ API
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    // Chuyển đổi dữ liệu thành định dạng Excel
                    const workbook = XLSX.utils.book_new();
                    const worksheet = XLSX.utils.json_to_sheet(data);
                    XLSX.utils.book_append_sheet(workbook, worksheet, tableName);

                    // Xuất Excel
                    XLSX.writeFile(workbook, tableName + '.xlsx');
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }
    </script>
@endsection
