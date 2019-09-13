@extends('Admin.master')
@section('title','جستجوی کاربر')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">جستجوی کاربر</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('users.search.post') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="name">نام کاربر</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group col-6">
                        <label for="email">ایمیل</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group col-6">
                        <label for="phone">موبایل</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="form-group col-6">
                        <label for="banned">مسدود شده</label>
                        <select class="form-control select2 w-100" id="banned" name="banned">
                            <option value="0">خیر</option>
                            <option value="1">بله</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info">جستجو</button>
                <a href="{{ route('users.index') }}" class="btn btn-default float-left">بازگشت</a>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@stop
@section('script')
    <script src="{{ asset('admin/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/select2/i18n/fa.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2();
        });
    </script>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
@stop
