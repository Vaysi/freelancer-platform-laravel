@extends('Admin.master')
@section('title','پیوند ها')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">پیوند جدید</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('links.store') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="title">عنوان پیوند</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="link">آدرس پیوند</label>
                        <input type="url" class="form-control" id="link" name="link" value="{{ old('link') }}">
                    </div>
                    <div class="form-group col-12">
                        <label for="type">مکان نمایش</label>
                        <select class="form-control select2 w-100" id="type" name="type">
                            <option value="news" {{ old('type') == 'public' ? 'selected' : '' }}>اخبار</option>
                            <option value="public" {{ old('type') == 'news' ? 'selected' : '' }}>اعلان عمومی</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-success">ایجاد</button>
                <a href="{{ route('links.index') }}" class="btn btn-default float-left">بازگشت</a>
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
