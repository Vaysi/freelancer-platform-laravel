<!DOCTYPE html>
<html lang="fa-IR" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="userID" content="{{ user()->id }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @hasSection('page')
            @yield('page')
        @else
            داشبورد کاربری
        @endif
    </title>
    <link rel="stylesheet" href="{{ asset('user/css/app.css') }}">
    @yield('css')
</head>
<body>
    @yield('body')
    <div class="position-absolute w-100 h-100 demo d-flex align-content-between position-absolute">
        <div class="content zindex-0 row">
            <div id="large-header" class="large-header">
                <canvas id="demo-canvas"></canvas>
            </div>
        </div>
    </div>
    <div id="container" class="container-fluid position-relative">
        @include('User.layouts.header')
        <div class="col-12 fHeight">
            <div class="row text-right row-eq-height fHeight">
                <div class="col-12 d-flex row-eq-height fHeight">
                    @include('User.layouts.sidebar')
                    <div id="content" class="bg-white content-wrapper">
                        <div class="row header mb-2 bg-white">
                            <div class="col-md-6 col-2 text-right pt-1 pt-md-0">
                                <button class="toggleMenu btn btn-darkBlue rounded-circle d-lg-none d-inline-block"><i class="fa fa-bars align-middle"></i></button>
                                <a href="{{ route('user.project.new') }}" class="btn blinker btn-custom btn-danger d-none d-md-inline-block">
                                    <i class="fa fa-plus align-middle"></i>
                                    سفارش پروژه
                                </a>
                                <a href="{{ route('employer.requests') }}" class="btn btn-outline-primary d-none d-md-inline-block rounded-corner-4 mr-2">
                                    <i class="fa fa-circle-o align-middle"></i>
                                    سفارشات قبلی
                                </a>
                            </div>
                            <div class="col-md-6 col-10 text-left">
                                <div class="d-inline-block" id="onlineChat">
                                    <button id="messages" class="btn btn-lg my-1 btn-primary btn-gradient-primary rounded-circle {{ user()->unreadMessage() ? 'animated tada infinite' : '' }} slow" data-toggle="collapse" data-target="#chatWrapper"><span class="count {{ user()->unreadMessage() ? '' : 'hide' }}">{{ user()->unreadMessage() ? user()->unreadMessage() : '' }}</span> <i class="fa fa-comments"></i></button>
                                </div>
                                <div class="d-inline-block dropdown" id="messageDropdown">
                                    <button id="notification" class="btn btn-sm my-1 btn-danger btn-danger-gradient rounded-half shadow-circle-red dropdown-toggle {{ user()->unreadMessages()->count() ? 'animated shake infinite' : '' }} slower" data-toggle="dropdown">{{ user()->unreadMessages()->count() ? user()->unreadMessages()->count() : '' }} <i class="fa fa-bell"></i></button>
                                    <div class="dropdown-menu animated fadeIn faster dropdown-menu-left messages">
                                        @forelse(user()->messages()->latest()->get() as $message)
                                            <a class="dropdown-item py-4 {{ $message->read ? 'read' : '' }}" href="{{ $message->link() }}">
                                            <span class="d-flex w-100 align-items-center justify-content-between mb-2">
                                                <span>
                                                    <span class="p-1 bg-{{ $message->type }} iconer text-white"><i class="fa fa-newspaper-o"></i></span>
                                                    <span class="p-1 text-white iconer text-white"><i class="fa fa-{{ $message->read ? 'envelope-open-o' : 'envelope-o' }}"></i></span>
                                                </span>
                                                <span class="bg-white rounded-half small p-1 text-dark-2">{{ jdate($message->created_at)->ago() }}</span>
                                            </span>
                                                <span class="small">
                                                {{ $message->text }}
                                            </span>
                                            </a>
                                            @if(!$loop->last)
                                                <div class="dropdown-divider bg-white border-white m-0"></div>
                                            @endif
                                        @empty

                                        @endforelse
                                    </div>
                                </div>
                                <div class="dropdown d-inline-block">
                                    <button id="profile" class="btn p-0 mr-2 dropdown-toggle" data-toggle="dropdown">
                                        <img src="{{ user()->avatar }}" class="img-thumbnail rounded-circle" id="profile_pic">
                                        <span class="text-gradient mr-1">{{ user()->name() }}</span>
                                        <span class="text-secondary mr-1"><i class="fa fa-chevron-down align-middle"></i></span>
                                    </button>
                                    <div class="dropdown-menu animate slideIn" aria-labelledby="dropdownMenu2">
                                        <a class="dropdown-item" href="{{ route('resume.edit') }}">
                                            <i class="fa fa-edit"></i>
                                            ویرایش رزومه
                                        </a>
                                        <a class="dropdown-item" href="{{ route('resume.me') }}">
                                            <i class="fa fa-picture-o"></i>
                                            نمایش رزومه
                                        </a>
                                        <a class="dropdown-item" href="{{ route('portfolio.index') }}">
                                            <i class="fa fa-briefcase"></i>
                                            نمونه کار
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('avatar') }}">
                                            <i class="fa fa-user-o"></i>
                                            تغیر آواتار
                                        </a>
                                        <a class="dropdown-item" href="{{ route('profile') }}">
                                            <i class="fa fa-info-circle"></i>
                                            ویرایش اطلاعات پایه
                                        </a>
                                        <a class="dropdown-item" href="{{ route('document.upload') }}">
                                            <i class="fa fa-file-o"></i>
                                            بارگزاری مدارک
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('password.change') }}">
                                            <i class="fa fa-key"></i>
                                            تغیر رمز عبور
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('notifications') }}">
                                            <i class="fa fa-bell-o"></i>
                                            تنظیم اطلاع رسانی
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('affiliate.invite') }}">
                                            <i class="fa fa-envelope-o"></i>
                                            دعوت از دوستان
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('logout') }}" method="post" id="logoutForm">
                                            @csrf
                                            <a class="dropdown-item" href="#" id="logout">
                                                <i class="fa fa-sign-out"></i>
                                                خروج
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($errors->count())
                            <div class="row mt-3">
                                <div class="col-12">
                                    <ul class="w-100 alert normal alert-danger px-4 font-size-auto">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <div class="row {{ $errors->count() ? 'mt-1' : 'mt-3' }} mb-1 @yield('classes')">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="loading" class="collapse">
        <div class="wrapper">
            <div class="dot-falling"></div>
        </div>
    </div>
    @include('User.layouts.chat')
    @include('sweetalert::alert')
    <script>
        let url = '{{ url('/') }}';
        let csrf = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/user.js') }}"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/499416/TweenLite.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/499416/EasePack.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/499416/demo.js"></script>
    @yield('js')
    @yield('footer')
    {!! option('raychat') ?? '' !!}
</body>
</html>
