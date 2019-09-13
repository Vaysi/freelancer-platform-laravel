@extends('layouts.auth')
@section('title','ورود به سایت')
@section('icon','user-o')
@section('content')
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="input-group mb-3">
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
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="fa fa-lock input-group-text"></span>
                </div>
                <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="رمز عبور خود را وارد کنید" name="password" required>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-6 pt-2">
                    <label class="pointer">
                        <input type="checkbox" name="remember" class="checkbox color-primary has-animation"> مرا به <span class="text-danger">یاد</span> داشته باش
                    </label>
                </div>
                <!-- /.col -->
                <div class="col-6 text-left">
                    <button type="submit" class="btn btn-danger rounded-half shadow-danger">ورود به سایت</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <div class="social-auth-links text-center mb-3">
            <br>
            <a href="{{ route('autoLogin',['driver'=>'linkedin']) }}" class="btn btn-block btn-gradient-primary rounded-half">
                 ورود با اکانت لینکدین
            </a>
            <a href="{{ route('autoLogin',['driver'=>'google']) }}" class="btn btn-block btn-gradient-danger rounded-half">
                 ورود با اکانت گوگل
            </a>
        </div>
        <!-- /.social-auth-links -->
        <div class="d-flex justify-content-between align-items-center mt-1">
            <a href="{{ route('password.request') }}" class="text-dark">
                <i class="fa fa-info-circle align-middle"></i> رمز عبورم را فراموش کرده ام
            </a>
            <a href="{{ route('register') }}" class="text-dark">ثبت نام</a>
        </div>
@stop
