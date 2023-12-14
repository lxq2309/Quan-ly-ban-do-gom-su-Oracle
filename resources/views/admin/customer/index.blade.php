@extends('admin.layout.default')

@section('template_title')
    Khách hàng
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('customer.create') }}" class="btn btn-primary float-right"
                       data-placement="left">
                        {{ __('Thêm mới khách hàng') }}
                    </a>
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
                                        <th>Mã khách hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($customers as $customer)
                                        <tr class="even" onmouseover="readListScripts.showTableActions()"
                                            onmouseleave="readListScripts.hideTableActions()">
                                            <td>{{ $customer->customerid }}</td>
                                            <td>{{ $customer->customername }}</td>
                                            <td>{{ $customer->address }}</td>
                                            <td>{{ $customer->phonenumber }}</td>

                                            <td style="position: absolute; right: 0; display: none">
                                                <div style="position: sticky;">
                                                    <form action="{{ route('customer.destroy',$customer->customerid) }}"
                                                          method="POST">
                                                        <a class="btn btn-sm btn-primary "
                                                           href="{{ route('customer.show',$customer->customerid) }}"><i
                                                                class="fa fa-fw fa-eye"></i> {{ __('Xem chi tiết') }}</a>
                                                        <a class="btn btn-sm btn-success"
                                                           href="{{ route('customer.edit',$customer->customerid) }}"><i
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
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-7">
                                {!! $customers->links() !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                    Hiển thị {{ $i + 1 }} đến {{ $i + $customers->count() }} trong tổng
                                    số {{ $customer->count() }} bản ghi
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
