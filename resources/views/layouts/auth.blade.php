<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="h-100 d-flex justify-content-center align-items-center" id="authContainer">
        <div class="col-lg-5 col-xl-4 col-md-8 col-sm-10 col-12 mx-auto my-3 my-md-0" id="authBox">
            <span class="h3 title text-center d-block mb-3">
                <span class="icon"><i class="fa fa-@yield('icon') align-middle"></i></span>
                <span class="caption">@yield('title')</span>
            </span>
            <div class="card custom text-right">
                @yield('content')
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
