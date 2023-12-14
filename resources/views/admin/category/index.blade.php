@extends('admin.layout.default')

@section('template_title')
    Danh mục
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    @php
                        $routeName = 'category.index';
                    @endphp
                    <a href="{{ route('category.create') }}" class="btn btn-primary float-right" data-placement="left">
                        {{ __('Thêm danh mục mới') }}
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
                                            <th>Mã danh mục</th>
                                            <th>Tên danh mục</th>
                                            <th>Các danh mục con</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr class="even" onmouseover="readListScripts.showTableActions()"
                                                onmouseleave="readListScripts.hideTableActions()">
                                                <td>{{ $category->categoryid }}</td>
                                                <td>{{ $category->categoryname }}</td>
                                                <td>
                                                    @foreach ($category->childcategories as $childCategory)
                                                        <div>
                                                            <a
                                                                href="{{ route('category.show', $childCategory->categoryid) }}">{{ $childCategory->categoryname }}</a>
                                                        </div>
                                                    @endforeach
                                                </td>

                                                <td style="position: absolute; right: 0; display: none">
                                                    <div style="position: sticky;">
                                                        <form
                                                            action="{{ route('category.destroy', $category->categoryid) }}"
                                                            method="POST">
                                                            <a class="btn btn-sm btn-primary "
                                                                href="{{ route('category.show', $category->categoryid) }}"><i
                                                                    class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                            <a class="btn btn-sm btn-success"
                                                                href="{{ route('category.edit', $category->categoryid) }}"><i
                                                                    class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                                    class="fa fa-fw fa-trash"></i> {{ __('Delete') }}
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
                                {!! $categories->links() !!}
                            </div>
                        </div>
                        @if ($categories->count() > 0)
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                        Hiển thị {{ $i + 1 }} đến {{ $i + $categories->count() }} trong tổng
                                        số {{ $category->count() }} bản ghi
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
            let tableName = 'categoryy';
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
