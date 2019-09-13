@extends('Admin.master')
@section('title','جستجوی پروژه')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">جستجوی پروژه</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('projects.search.post') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="id">کد پروژه</label>
                        <input type="text" class="form-control" id="id" name="id">
                    </div>
                    <div class="form-group col-6">
                        <label for="title">نام پروژه</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group col-6">
                        <label for="price_range">محدوده قیمت</label>
                        <select class="form-control select2 w-100" id="price_range" name="price_range">
                            <option value="">هیچکدام</option>
                            <option value="1" {{ old('price_range') == 1 ? 'selected' : '' }}> خیلی کوچک » از 5,000 تومان تا 100,000 تومان </option>
                            <option value="2" {{ old('price_range') == 2 ? 'selected' : '' }}> کوچک » از 100,000 تومان تا 300,000 تومان </option>
                            <option value="3" {{ old('price_range') == 3 ? 'selected' : '' }}> متوسط » از 300,000 تومان تا 750,000 تومان </option>
                            <option value="4" {{ old('price_range') == 4 ? 'selected' : '' }}> نسبتا بزرگ » از 750,000 تومان تا 5,000,000 تومان </option>
                            <option value="5" {{ old('price_range') == 5 ? 'selected' : '' }}> بزرگ » از 5,000,000 تومان تا 15,000,000 تومان </option>
                            <option value="6" {{ old('price_range') == 6 ? 'selected' : '' }}> خیلی بزرگ » از 15,000,000 تومان تا 50,000,000 تومان </option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="features">ویژگی ها</label>
                        <select class="form-control select2 w-100" multiple id="features" name="features[]">
                            <option value="hidden">مخفی</option>
                            <option value="hire">استخدامی</option>
                            <option value="urgent">فوری</option>
                            <option value="sticky">چسبنده</option>
                            <option value="private">شخصی</option>
                            <option value="special">ویژه</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="publish_status">وضعیت انتشار</label>
                        <select class="form-control select2 w-100" id="publish_status" name="publish_status">
                            <option value="">مهم نیست</option>
                            <option value="pending">مخفی</option>
                            <option value="closed">پایان یافته</option>
                            <option value="canceled">لغو شده</option>
                            <option value="open">باز</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="status">وضعیت پروژه</label>
                        <select class="form-control select2 w-100" id="status" name="status">
                            <option value="">مهم نیست</option>
                            <option value="emp_trust">در انتظار گروگزاری کارفرما</option>
                            <option value="flc_trust">در انتظار گروگزاری مجری</option>
                            <option value="trust_done">در حال انجام</option>
                            <option value="flc_done">مجری تحویل داده</option>
                            <option value="open">باز</option>
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
