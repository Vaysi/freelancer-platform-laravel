@extends('Admin.master')
@section('title','مهارت ها')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">مهارت جدید</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('skills.update',['skill'=>$skill->id]) }}" method="post">
            @csrf
            {{ method_field('PATCH') }}
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="name">نام مهارت</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $skill->name }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="category_id">دسته بندی مرتبط</label>
                        <select class="form-control select2 w-100" id="category_id" name="category_id">
                            @if(\App\Category::whereParentId(0)->get())
                                <option value="0">&nbsp;</option>
                            @endif
                            @forelse(\App\Category::whereParentId(0)->get() as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $skill->category()->id ? 'selected' : '' }} {!! $category->icon ? 'data-icon="'. $category->icon . '"'  : '' !!}>{{ $category->name }}</option>
                            @empty
                                <option value="0">وجود ندارد !</option>
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-success">ویرایش</button>
                <a href="{{ route('skills.index') }}" class="btn btn-default float-left">بازگشت</a>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@stop
@section('script')
    <script src="{{ asset('admin/plugins/iconpicker/js/fontawesome-iconpicker.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/select2/i18n/fa.js') }}"></script>
    <script>
        function format(state) {
            let originalOption = state.element;
            return $("<span>" + state.text + "</span> " + "<i class='fa " + $(originalOption).data('icon') + "'></i>");
        }
        $(function () {
            $('.select2').select2({
                templateResult: format,
            });
            $('.icp-auto').iconpicker();
        });
    </script>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/iconpicker/css/fontawesome-iconpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
@stop
