@extends('Admin.master')
@section('title','دسته بندی ها')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">آخرین دسته بندی ها</h3>
            <a href="{{ route('categories.create') }}" class="btn btn-info">ایجاد</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان</th>
                    <th>آیکون</th>
                    <th>زیر مجموعه</th>
                    <th>تاریخ ایجاد</th>
                    <th>تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td data-toggle="tooltip" title="{{ $category->name }}">{{ limit($category->name,20) }}</td>
                            <td><i class="fa {{ $category->icon }}"></i></td>
                            <td>{{ optional($category->parent())->name ?? '-' }}</td>
                            <td data-toggle="tooltip" title="{{ jdate($category->created_at)->format('H:i:s Y/m/d') }}">{{ jdate($category->created_at)->ago() }}</td>
                            <td>
                                <form action="{{ route('categories.destroy',['category'=>$category->id]) }}" method="post">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <a href="{{ route('categories.edit',['category'=>$category->id]) }}" class="btn btn-warning btn-sm">ویرایش</a>
                                    <button class="btn btn-danger btn-sm btn-ask" type="submit">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>عنوان</th>
                    <th>آیکون</th>
                    <th>زیر مجموعه</th>
                    <th>تاریخ ایجاد</th>
                    <th>تنظیمات</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@stop
@section('script')
    <script>
        $(function () {
            $("#datatable").DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Persian.json"
                },
                "info" : false,
            });
        });
    </script>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap4.css') }}">
@stop
