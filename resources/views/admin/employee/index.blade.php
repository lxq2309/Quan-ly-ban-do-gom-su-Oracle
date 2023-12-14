@extends('admin.layout.default')

@section('template_title')
    Nhân viên
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="dt-buttons btn-group flex-wrap">
                        @php
                            $routeName = 'employee.index';
                        @endphp

                    </div>
                    <a href="{{ route('employee.create') }}" class="btn btn-primary float-right"
                       data-placement="left">
                        {{ __('Thêm nhân viên mới') }}
                    </a>
                    <div class="dataTables_filter" style="padding: 0; padding-top: 0.75rem">
                        <form id="searchForm" action="{{ route($routeName) }}" method="GET">
                            <div class="dataTables_filter" style="padding: 0; padding-top: 0.75rem">
                                <input type="search" id="searchInput" class="form-control form-control-sm"
                                       placeholder="Tìm kiếm theo số điện thoại" name="search">
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
                                <table id="example1"
                                       class="table table-bordered table-striped dataTable dtr-inline table-hover"
                                       aria-describedby="example1_info">
                                    <thead>
                                    <tr>
                                        <th>Mã nhân viên</th>
                                        <th>Tên nhân viên</th>
                                        <th>Giới tính</th>
                                        <th>Ngày sinh</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Username</th>
                                        <th>Tên công việc</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $user)
                                        <tr class="even" onmouseover="readListScripts.showTableActions()"
                                            onmouseleave="readListScripts.hideTableActions()">
                                            <td>{{ $user->employeeid }}</td>
                                            <td>{{ $user->employeename }}</td>
                                            <td>{{ $user->gender }}</td>
                                            <td>{{ $user->birthdate }}</td>
                                            <td>{{ $user->phonenumber }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->job->jobtitle }}</td>


                                            <td style="position: absolute; right: 0; display: none">
                                                <div style="position: sticky;">
                                                    <form action="{{ route('employee.destroy',$user->employeeid) }}"
                                                          method="POST">
                                                        <a class="btn btn-sm btn-primary "
                                                           href="{{ route('employee.show',$user->employeeid) }}"><i
                                                                class="fa fa-fw fa-eye"></i> {{ __('Xem chi tiết') }}
                                                        </a>
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
                                {!! $users->links() !!}
                            </div>
                        </div>
                        @if($users->count() > 0)
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                    Hiển thị {{ $i + 1 }} đến {{ $i + $users->count() }} trong tổng
                                    số {{ $user->count() }} bản ghi
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
