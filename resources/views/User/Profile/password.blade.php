@extends('User.master')
@section('content')
    <div class="col-9 pl-1">
        <div class="row">
            <div class="col-12 mb-3" id="emp_req">
                <div class="card custom">
                    <div class="card-title">
                        <span>تغیر کلمه عبور</span>
                    </div>
                    <div class="card-body py-3">
                        <div class="col-11 mx-auto">
                            <form action="{{ route('password.change.update') }}" method="post" class="corner">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="current_password">کلمه عبور فعلی</label>
                                            <input type="password" class="form-control" name="current_password" id="current_password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="password">کلمه عبور جدید</label>
                                            <input type="password" class="form-control" name="password" id="password">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="password_confirmation">تکرار کلمه عبور جدید</label>
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-outline-danger w-100" type="submit">بروزرسانی</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 pr-1">
        <div class="card custom sticky-sidebar">
            <div class="card-title">
                <span>هشدار مهم</span>
            </div>
            <div class="card-body">
                <div class="alert alert-yellow">
                    <p>کلمه عبور ساده همچون 123456 باعث می شود تا برخی از کاربرانی که سوء نیت دارند با هک کردن حساب شما به اهداف خود دست یابند.</p>
                    <p>یک کلمه عبور مطمئن می بایست ترکیبی از حروف، اعداد و سایر کاراکترهای نگارشی همچون کاما باشد و طول آن بیش از 8 حرف باشد.</p>
                </div>
            </div>
        </div>
    </div>
@stop
