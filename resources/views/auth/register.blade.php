@extends('layouts.auth')
@section('title','ثبت نام')
@section('icon','user-plus')
@section('content')
    <form action="{{ route('register') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="fa fa-user input-group-text"></span>
            </div>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"  placeholder="نام و نام خانوادگی" value="{{ old('name') }}" autofocus required>
            @error('name')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="fa fa-envelope input-group-text"></span>
            </div>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="ایمیل" required>
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
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="رمز عبور">
            @error('password')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="fa fa-lock input-group-text"></span>
            </div>
            <input type="password" class="form-control" placeholder="تکرار رمز عبور" name="password_confirmation" required>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="checkbox pt-2 icheck @error('terms') is-invalid @enderror">
                    <label>
                        <input type="checkbox" name="terms" class="checkbox color-primary has-animation"> با <a href="#">شرایط</a> موافق هستم
                    </label>
                </div>
                @error('terms')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
            <!-- /.col -->
            <div class="col-6 text-left">
                <button type="submit" class="btn btn-danger rounded-half shadow-danger">ثبت نام در سایت</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    <div class="social-auth-links text-center mb-3">
        <br>
        <a href="{{ route('autoLogin',['driver'=>'linkedin']) }}" class="btn btn-block btn-gradient-primary rounded-half">
            ثبت نام با اکانت لینکدین
        </a>
        <a href="{{ route('autoLogin',['driver'=>'google']) }}" class="btn btn-block btn-gradient-danger rounded-half">
            ثبت نام با اکانت گوگل
        </a>
    </div>

    <a href="{{ route('login') }}" class="text-center text-dark">من قبلا ثبت نام کرده ام</a>
@endsection
