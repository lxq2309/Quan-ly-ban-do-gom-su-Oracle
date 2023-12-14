@extends('admin.layout.default')

@section('template_title')
    {{ $category->categoryname }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Thông tin danh mục') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('category.index') }}"> {{ __('Trở về') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Mã thể loại:</strong>
                            {{ $category->categoryid }}
                        </div>
                        <div class="form-group">
                            <strong>Tên danh mục:</strong>
                            {{ $category->categoryname }}
                        </div>
                        @if ($category->parentid != null)
                            <div class="form-group">
                                <strong>Danh mục cha:</strong>
                                {{ $category->parentcategory->categoryname }}
                            </div>
                        @endif
                        <form action="{{ route('category.destroy', $category->categoryid) }}" method="POST">
                            <a class="btn btn-sm btn-success"
                                href="{{ route('category.edit', $category->categoryid) }}"><i
                                    class="fa fa-fw fa-edit"></i> {{ __('Sửa') }}</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i>
                                {{ __('Xoá') }}
                            </button>
                        </form>
                    </div>
                </div>

                @if ($category->childcategories->count() > 0)
                    <div class="card">
                        <div class="card-header">
                            <div class="float-left">
                                <span class="card-title">Các danh mục con thuộc
                                    <strong>{{ $category->categoryname }}</strong></span>
                            </div>
                        </div>


                        <div class="card-body">
                            <div class="list-group">
                                @foreach ($category->childcategories as $childCategory)
                                    <a href="{{ route('category.show', $childCategory->categoryid) }}"
                                        class="list-group-item list-group-item-action">{{ $childCategory->categoryname }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>
@endsection
