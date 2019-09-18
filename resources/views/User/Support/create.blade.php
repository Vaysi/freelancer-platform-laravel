@extends('User.master')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-12 mb-3" id="emp_req">
                <div class="card custom">
                    <div class="card-title">
                        <span>ایجاد تیکت پشتیبانی</span>
                    </div>
                    <div class="card-body py-3">
                        <div class="col-11 mx-auto">
                            <form action="{{ route('support.store') }}" method="post" class="corner">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="title">عنوان</label>
                                            <input type="text" class="form-control" name="title" id="title">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="type">نوع</label>
                                            <select name="type" id="type" class="selectpicker w-auto">
                                                <option value="question">سوال</option>
                                                <option value="critics">انتقاد</option>
                                                <option value="suggestions">پیشنهاد</option>
                                                <option value="support">پشتیبانی</option>
                                                <option value="judgement">داوری</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row collapse show" id="coder">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="project">کد پروژه</label>
                                            <input type="text" class="form-control" name="project" id="project">
                                            <span class="form-text text-mute">
                                                جهت تسریع در رسیدگی لطفا کد پروژه مورد نظر خود را وارد نمایید
                                                <a href="#" data-toggle="collapse" data-target="#lister">(انتخاب از میان پروژه ها)</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row collapse" id="lister">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="project_id">لیست پروژه های شما</label>
                                            <select name="project_id" id="project_id" class="selectpicker w-auto">
                                                    <option value="" selected>انتخاب کنید</option>
                                                @foreach($projects as $project)
                                                    <option value="{{ $project->id }}">{{ limit($project->title,70) }}</option>
                                                @endforeach
                                            </select>
                                            <span class="form-text text-mute">
                                                جهت تسریع در رسیدگی لطفا پروژه مورد نظر خود را از لیست بالا انتخاب کنید
                                                <a href="#" data-toggle="collapse" data-target="#coder">( وارد کردن کد پروژه )</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="content">پیام</label>
                                            <textarea name="content" class="form-control" id="content" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-outline-danger w-100" type="submit">ارسال</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(function () {
            $('#coder').on('show.bs.collapse', function () {
                $('#lister').collapse('hide');
            });
            $('#lister').on('show.bs.collapse', function () {
                $('#coder').collapse('hide');
            });
        });
    </script>
@stop
