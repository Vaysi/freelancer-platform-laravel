@extends('Admin.master')
@section('title','پیوند ها')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">آخرین پیوند ها</h3>
            <a href="{{ route('links.create') }}" class="btn btn-info">ایجاد</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان</th>
                    <th>نوع</th>
                    <th>آدرس پیوند</th>
                    <th>تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($links as $link)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $link->title }}</td>
                        <td>{{ $link->type == 'public' ? 'عمومی' : 'اخبار' }}</td>
                        <td><a href="{{ url($link->link) }}">پیوند</a></td>
                        <td>
                            <form action="{{ route('links.destroy',['link'=>$link->id]) }}" method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <a href="{{ route('links.edit',['link'=>$link->id]) }}" class="btn btn-warning btn-sm">ویرایش</a>
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
                    <th>نوع</th>
                    <th>آدرس پیوند</th>
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
