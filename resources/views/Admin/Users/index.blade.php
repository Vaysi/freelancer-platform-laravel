@extends('Admin.master')
@section('title','کاربر ها')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">آخرین کاربر ها</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if(isset($page) && isset($request))
                <form action="{{ route('users.search.post') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="name">نام کاربر</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $request->name }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="email">ایمیل</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ $request->email }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="phone">موبایل</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $request->phone }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="banned">مسدود شده</label>
                                <select class="form-control select2 w-100" id="banned" name="banned">
                                    <option value="0" {{ $request->banned == '0' ? 'selected' : '' }}>خیر</option>
                                    <option value="1" {{ $request->banned == '1' ? 'selected' : '' }}>بله</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-12 text-left row">
                            <button type="submit" class="btn btn-info mb-3">جستجو</button>
                        </div>
                    </div>
                </form>
            @endif
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام کاربر</th>
                    <th>ایمیل</th>
                    <th>شماره موبایل</th>
                    <th>وضعیت</th>
                    <th>تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td data-toggle="tooltip" title="{{ $user->name() }}">{{ $user->name}}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{!! $user->banned ? '<span class="badge badge-danger">مسدود شده</span>' : '<span class="badge badge-success">فعال</span>' !!}</td>
                            <td>
                                <form action="{{ route('users.ban',['user'=>$user->id]) }}" method="post">
                                    @csrf
                                    {{ method_field('PATCH') }}
                                    <a href="{{ route('users.edit',['user'=>$user->id]) }}" class="btn btn-warning btn-sm">ویرایش</a>
                                    <a href="{{ route('resume.view',['user'=>$user->id]) }}" class="btn btn-info btn-sm">نمایش رزومه</a>
                                    @if($user->banned)
                                        <button class="btn btn-success btn-sm btn-ask" type="submit">فعال سازی</button>
                                    @else
                                        <button class="btn btn-danger btn-sm btn-ask" type="submit">بن کردن</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>عنوان</th>
                    <th>زیر مجموعه</th>
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
