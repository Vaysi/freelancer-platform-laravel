@extends('layouts.auth')
@section('title','بازیابی رمز عبور')
@section('icon','lock')
@section('content')
    <form action="{{ route('password.email') }}" method="post">
        @csrf
        @if (session('status'))
            <div class="alert alert-success rounded-half" role="alert" style="border-top-right-radius: 2rem!important;">
                {{ session('status') }}
            </div>
        @endif
        <div class="input-group my-3">
            <div class="input-group-prepend">
                <span class="fa fa-envelope input-group-text"></span>
            </div>
            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="ایمیل خود را وارد کنید" name="email" required>
            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row">
            <div class="col-12 text-left">
                <button type="submit" class="btn btn-danger rounded-half shadow-danger w-100">ارسال لینک فعالسازی</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    <div class="d-flex justify-content-between align-items-center mt-5">
        <a href="{{ route('login') }}" class="btn btn-block btn-gradient-primary rounded-half w-25">
            ورود
        </a>
        <a href="{{ route('register') }}" class="btn btn-block btn-gradient-danger rounded-half w-25">ثبت نام</a>
    </div>
@stop
