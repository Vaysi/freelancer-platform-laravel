@extends('Admin.master')
@section('title','پکیج ها')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">آخرین پکیج ها</h3>
            <a href="{{ route('packages.create') }}" class="btn btn-info">ایجاد</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان</th>
                    <th>قیمت</th>
                    <th>مدت</th>
                    <th>تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($packages as $package)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td data-toggle="tooltip" title="{{ $package->name }}">{{ limit($package->name,20) }}</td>
                            <td>{{ money($package->price) }}</td>
                            <td><span class="badge badge-primary">{{ $package->length }} روز </span></td>
                            <td>
                                <form action="{{ route('packages.destroy',['package'=>$package->id]) }}" method="post">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <a href="{{ route('packages.edit',['package'=>$package->id]) }}" class="btn btn-warning btn-sm">ویرایش</a>
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
                    <th>قیمت</th>
                    <th>مدت</th>
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
