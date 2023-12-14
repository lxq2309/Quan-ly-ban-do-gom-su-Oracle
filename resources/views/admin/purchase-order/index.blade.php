@extends('admin.layout.default')

@section('template_title')
    Hoá đơn nhập
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
                            $routeName = 'purchase-order.index';
                        @endphp

                    </div>
                    <a href="{{ route('purchase-order.create') }}" class="btn btn-primary float-right"
                       data-placement="left">
                        {{ __('Thêm hoá đơn nhập') }}
                    </a>
                    <div class="dataTables_filter" style="padding: 0; padding-top: 0.75rem">
                        <form id="searchForm" action="{{ route($routeName) }}" method="GET">
                            <div class="dataTables_filter" style="padding: 0; padding-top: 0.75rem">
                                <input type="search" id="searchInput" class="form-control form-control-sm"
                                       placeholder="Tìm kiếm theo mã hoá đơn..." name="search">
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
                                        <th>Mã hoá đơn</th>
                                        <th>Ngày nhập</th>
                                        <th>Nhà cung cấp</th>
                                        <th>Tổng tiền</th>
                                        <th>Người tạo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($purchaseOrders as $purchaseOrder)
                                        <tr class="even" onmouseover="readListScripts.showTableActions()"
                                            onmouseleave="readListScripts.hideTableActions()">
                                            <td>{{ $purchaseOrder->orderid }}</td>
                                            <td>{{ $purchaseOrder->orderdate }}</td>
                                            <td>{{ $purchaseOrder->supplier?->suppliername  }}</td>
                                            <td>{{ $purchaseOrder->totalamount }} VNĐ</td>
                                            <td>{{ $purchaseOrder->employee?->employeename }}</td>

                                            <td style="position: absolute; right: 0; display: none">
                                                <div style="position: sticky;">
                                                    <form
                                                        action="{{ route('purchase-order.destroy',$purchaseOrder->orderid) }}"
                                                        method="POST">
                                                        <a class="btn btn-sm btn-primary "
                                                           href="{{ route('purchase-order.show',$purchaseOrder->orderid) }}"><i
                                                                class="fa fa-fw fa-eye"></i> {{ __('Xem chi tiết') }}</a>
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
                                {!! $purchaseOrders->links() !!}
                            </div>
                        </div>
                        @if($purchaseOrders->count() > 0)
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                        Hiển thị {{ $i + 1 }} đến {{ $i + $purchaseOrders->count() }} trong tổng
                                        số {{ $purchaseOrder->count() }} bản ghi
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
