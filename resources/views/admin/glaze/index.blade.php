@extends('admin.layout.default')

@section('template_title')
    Loại men
@endsection

@php
    $name = 'loại men';
@endphp

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">

                    @php
                        $routeName = 'glaze.index';
                    @endphp


                    <a href="{{ route('glaze.create') }}" class="btn btn-primary float-right" data-placement="left">
                        {{ __('Thêm loại men mới') }}
                    </a>
                    <div class="dataTables_filter" style="padding: 0; padding-top: 0.75rem">
                        <form id="searchForm" action="{{ route($routeName) }}" method="GET">
                            <div class="dataTables_filter" style="padding: 0; padding-top: 0.75rem">
                                <input type="search" id="searchInput" class="form-control form-control-sm"
                                    placeholder="Tìm kiếm theo tên <?php echo $name ?>" name="search">
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
                                            <th>Mã <?php echo $name ?></th>
                                            <th>Tên <?php echo $name ?></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($glazes as $glaze)
                                            <tr class="even" onmouseover="readListScripts.showTableActions()"
                                                onmouseleave="readListScripts.hideTableActions()">
                                                <td>{{ $glaze->glazeid }}</td>
                                                <td>{{ $glaze->glazename }}</td>


                                                <td style="position: absolute; right: 0; display: none">
                                                    <div style="position: sticky;">
                                                        <form
                                                            action="{{ route('glaze.destroy', $glaze->glazeid) }}"
                                                            method="POST">
                                                            <a class="btn btn-sm btn-primary "
                                                                href="{{ route('glaze.show', $glaze->glazeid) }}"><i
                                                                    class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                            <a class="btn btn-sm btn-success"
                                                                href="{{ route('glaze.edit', $glaze->glazeid) }}"><i
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
                                {!! $glazes->links() !!}
                            </div>
                        </div>
                        @if ($glazes->count() > 0)
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                        Hiển thị {{ $i + 1 }} đến {{ $i + $glazes->count() }} trong tổng
                                        số {{ $glaze->count() }} bản ghi
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
