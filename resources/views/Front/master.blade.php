<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>پروژستان</title>
    <link rel="stylesheet" href="{{ asset('front/css/app.css') }}">
</head>
<body>
    <div class="container-fluid">
        <header class="row" id="header">
            <div class="container">
                <div class="row row-eq-height pt-2">
                    <div id="menu" class="col-12">
                        <div class="row">
                            <div class="col-5 d-flex justify-content-start align-items-center">
                                <ul class="nav p-2" id="mainMenu">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">صفحه اصلی</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">خدمات</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">درباره ما</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">راهنمای سامانه</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-2">
                                <div id="logo">
                                    <img src="{{ asset('images/logo-dark.png') }}" alt="">
                                    <img src="{{ asset('images/logo-dark.png') }}" class="reflect">
                                </div>
                            </div>
                            <div class="col-5 d-flex justify-content-end align-items-center">
                                <div class="py-2 pr-2 d-inline-block" id="login">
                                    <span class="h6 pl-1"><i class="fa fa-user-circle text-secondary-2 align-middle pt-1"></i></span>
                                    <a href="#" class="text-gray">ورود به حساب کاربری</a>
                                    <span class="px-1">/</span>
                                    <a href="#" class="text-red">ثبت نام</a>
                                </div>
                                <div class="mr-2 py-2 pr-4 d-inline-block" id="support">
                                    <a href="#" class="text-aqua py-0 d-flex align-items-center mt-1">
                                        <span class="h4 m-0"><i class="fa fa-phone"></i></span>
                                        <span class="text-secondary-3 mr-1 font-weight-bold supper">مشاوره <sup>رایگان</sup></span>
                                        <span class="mr-n4 ltr font-weight-bold h5 m-0"><span class="text-secondary-3">021</span><span class="text-aqua-2">1258912</span></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="row" id="mainSlider">
            <img src="{{ asset('images/slide1.jpg') }}" class="img-fluid">
        </div>
        <div class="row text-right" id="content">
            <div class="bg-white w-100 pb-5">
                <div id="section1">
                    <div class="container h-100">
                        <div class="h-100 d-flex justify-content-center align-items-center itemsContainer">
                            <div class="w-20 d-flex justify-content-center align-items-center p-2">
                                <img src="{{ asset('images/section1_item1.png') }}" class="undraggable">
                            </div>
                            <div class="w-25 px-3 py-4 text-left">
                                <a href="#" class="h-100 w-100 d-block">
                                    <span class="text-pink h3 d-block pl-5 mb-1 mt-2">952</span>
                                    <span class="text-dark-2 d-block h5">پروژه های <span class="font-weight-bold">ثبت شده</span></span>
                                    <span class="text-secondary-4 h6 small d-block">مشاهده پروژه ها <i class="fa fa-angle-double-left mr-1"></i></span>
                                </a>
                            </div>
                            <div class="w-25 px-3 py-4 text-left">
                                <a href="#" class="h-100 w-100 d-block">
                                    <span class="text-pink h3 d-block pl-5 mb-1 mt-2">1013</span>
                                    <span class="text-dark-2 d-block h5">متخصصان <span class="font-weight-bold">حرفه ای</span></span>
                                    <span class="text-secondary-4 h6 small d-block">مشاهده فریلنسر ها <i class="fa fa-angle-double-left mr-1"></i></span>
                                </a>
                            </div>
                            <div class="w-25 px-3 py-4 text-left">
                                <a href="#" class="h-100 w-100 d-block">
                                    <span class="text-pink h3 d-block pl-4 mb-1 mt-2">3210</span>
                                    <span class="text-dark-2 d-block h5">پروژه های <span class="font-weight-bold">موفق</span></span>
                                    <span class="text-secondary-4 h6 small d-block">مشاهده پروژه ها <i class="fa fa-angle-double-left mr-1"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div id="section2">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-3 py-5 text-center position-relative splitter">
                                    <span class="icon d-block h1 text-aqua-4 rotate-16"><i class="fa fa-file-text"></i></span>
                                    <span class="d-block text-dark-2 font-weight-bold h5">آخرین <span class="text-aqua-3">پروژه های</span> موجود</span>
                                    <a href="#" class="btn btn-special white btn-sm mt-2">
                                        <span class="text">مشاهده بیشتر</span>
                                        <i class="fa fa-angle-double-left mr-2"></i>
                                    </a>
                                </div>
                                <div class="col-9">
                                   <ul class="nav blue-list pr-2">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">لورم ایپسوم متن ساختگی با تولید سادگی </a>
                                        </li>
                                       <li class="nav-item">
                                           <a href="#" class="nav-link">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون </a>
                                       </li>
                                       <li class="nav-item">
                                           <a href="#" class="nav-link">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان  </a>
                                       </li>
                                       <li class="nav-item">
                                           <a href="#" class="nav-link">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a>
                                       </li>
                                       <li class="nav-item">
                                           <a href="#" class="nav-link">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</a>
                                       </li>
                                       <li class="nav-item">
                                           <a href="#" class="nav-link">لورم ایپسوم متن ساختگی با تولید سادگی </a>
                                       </li>
                                   </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="section3" class="mt-4 rounded-all-corners-half px-5">
                        <div class="col-12 py-3">
                            <div class="row">
                                <div class="col-12 title text-left d-flex justify-content-end align-items-center row-eq-height">
                                    <span class="text">
                                        <span class="h6 d-block text-dark-2 m-0">نمونه کارهای فریلنسر ها</span>
                                        <span class="h6 small d-block text-secondary-3 m-0">Freelancer Portfolio</span>
                                    </span>
                                    <span class="icon bg-white rounded p-2 h-100 text-danger mr-2 d-flex justify-content-center align-items-center">
                                        <i class="fa fa-heart px-1"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="row mt-3" id="items">
                                <div class="col-3 item mt-2 px-1">
                                    <div class="rounded-all-corners bg-white p-2 text-center w-100">
                                        <img src="{{ asset('images/portfolios/1.png') }}" class="img-fluid rounded-all-corners">
                                        <div class="avatar mt-n4 mb-1">
                                            <img src="{{ asset('images/avatar.jpg') }}" class="w-25 rounded-circle img-thumbnail">
                                        </div>
                                        <a href="#" class="text-dark-2 pt-1">
                                            <span class="text">HOSSEINMAZHARI</span>
                                            <i class="fa fa-chevron-right mr-1"></i>
                                        </a>
                                        <span class="text-danger d-block">9,457 <i class="fa fa-heart"></i></span>
                                    </div>
                                </div>
                                <div class="col-3 item mt-2 px-1">
                                    <div class="rounded-all-corners bg-white p-2 text-center w-100">
                                        <img src="{{ asset('images/portfolios/1.png') }}" class="img-fluid rounded-all-corners">
                                        <div class="avatar mt-n4 mb-1">
                                            <img src="{{ asset('images/avatar.jpg') }}" class="w-25 rounded-circle img-thumbnail">
                                        </div>
                                        <a href="#" class="text-dark-2 pt-1">
                                            <span class="text">HOSSEINMAZHARI</span>
                                            <i class="fa fa-chevron-right mr-1"></i>
                                        </a>
                                        <span class="text-danger d-block">9,457 <i class="fa fa-heart"></i></span>
                                    </div>
                                </div>
                                <div class="col-3 item mt-2 px-1">
                                    <div class="rounded-all-corners bg-white p-2 text-center w-100">
                                        <img src="{{ asset('images/portfolios/1.png') }}" class="img-fluid rounded-all-corners">
                                        <div class="avatar mt-n4 mb-1">
                                            <img src="{{ asset('images/avatar.jpg') }}" class="w-25 rounded-circle img-thumbnail">
                                        </div>
                                        <a href="#" class="text-dark-2 pt-1">
                                            <span class="text">HOSSEINMAZHARI</span>
                                            <i class="fa fa-chevron-right mr-1"></i>
                                        </a>
                                        <span class="text-danger d-block">9,457 <i class="fa fa-heart"></i></span>
                                    </div>
                                </div>
                                <div class="col-3 item mt-2 px-1">
                                    <div class="rounded-all-corners bg-white p-2 text-center w-100">
                                        <img src="{{ asset('images/portfolios/1.png') }}" class="img-fluid rounded-all-corners">
                                        <div class="avatar mt-n4 mb-1">
                                            <img src="{{ asset('images/avatar.jpg') }}" class="w-25 rounded-circle img-thumbnail">
                                        </div>
                                        <a href="#" class="text-dark-2 pt-1">
                                            <span class="text">HOSSEINMAZHARI</span>
                                            <i class="fa fa-chevron-right mr-1"></i>
                                        </a>
                                        <span class="text-danger d-block">9,457 <i class="fa fa-heart"></i></span>
                                    </div>
                                </div>
                                <div class="col-3 item mt-2 px-1">
                                    <div class="rounded-all-corners bg-white p-2 text-center w-100">
                                        <img src="{{ asset('images/portfolios/1.png') }}" class="img-fluid rounded-all-corners">
                                        <div class="avatar mt-n4 mb-1">
                                            <img src="{{ asset('images/avatar.jpg') }}" class="w-25 rounded-circle img-thumbnail">
                                        </div>
                                        <a href="#" class="text-dark-2 pt-1">
                                            <span class="text">HOSSEINMAZHARI</span>
                                            <i class="fa fa-chevron-right mr-1"></i>
                                        </a>
                                        <span class="text-danger d-block">9,457 <i class="fa fa-heart"></i></span>
                                    </div>
                                </div>
                                <div class="col-3 item mt-2 px-1">
                                    <div class="rounded-all-corners bg-white p-2 text-center w-100">
                                        <img src="{{ asset('images/portfolios/1.png') }}" class="img-fluid rounded-all-corners">
                                        <div class="avatar mt-n4 mb-1">
                                            <img src="{{ asset('images/avatar.jpg') }}" class="w-25 rounded-circle img-thumbnail">
                                        </div>
                                        <a href="#" class="text-dark-2 pt-1">
                                            <span class="text">HOSSEINMAZHARI</span>
                                            <i class="fa fa-chevron-right mr-1"></i>
                                        </a>
                                        <span class="text-danger d-block">9,457 <i class="fa fa-heart"></i></span>
                                    </div>
                                </div>
                                <div class="col-3 item mt-2 px-1">
                                    <div class="rounded-all-corners bg-white p-2 text-center w-100">
                                        <img src="{{ asset('images/portfolios/1.png') }}" class="img-fluid rounded-all-corners">
                                        <div class="avatar mt-n4 mb-1">
                                            <img src="{{ asset('images/avatar.jpg') }}" class="w-25 rounded-circle img-thumbnail">
                                        </div>
                                        <a href="#" class="text-dark-2 pt-1">
                                            <span class="text">HOSSEINMAZHARI</span>
                                            <i class="fa fa-chevron-right mr-1"></i>
                                        </a>
                                        <span class="text-danger d-block">9,457 <i class="fa fa-heart"></i></span>
                                    </div>
                                </div>
                                <div class="col-3 item mt-2 px-1">
                                    <div class="rounded-all-corners bg-white p-2 text-center w-100">
                                        <img src="{{ asset('images/portfolios/1.png') }}" class="img-fluid rounded-all-corners">
                                        <div class="avatar mt-n4 mb-1">
                                            <img src="{{ asset('images/avatar.jpg') }}" class="w-25 rounded-circle img-thumbnail">
                                        </div>
                                        <a href="#" class="text-dark-2 pt-1">
                                            <span class="text">HOSSEINMAZHARI</span>
                                            <i class="fa fa-chevron-right mr-1"></i>
                                        </a>
                                        <span class="text-danger d-block">9,457 <i class="fa fa-heart"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-left mt-3 mb-n4">
                                <a href="#" class="btn btn-special white mb-n2">
                                    همه نمونه کار ها
                                    <i class="fa fa-angle-double-left mr-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="section4" class="my-3">
                    <img src="{{ asset('images/section4.png') }}" class="img-fluid undraggable">
                </div>
                <div class="container">
                    <div id="section5" class="mt-4 rounded-all-corners-half px-5">
                        <div class="col-12 py-3">
                            <div class="row">
                                <div class="col-12 title text-left d-flex justify-content-end align-items-center row-eq-height">
                                    <span class="text">
                                        <span class="h6 d-block text-dark-2 m-0">برترین فریلنسر ها</span>
                                        <span class="h6 small d-block text-secondary-3 m-0">Top Freelancers</span>
                                    </span>
                                    <span class="icon bg-white rounded p-2  h-100 text-pink mr-2 d-flex justify-content-center align-items-center">
                                        <i class="fa fa-star px-1"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div id="topFreelancers">
                                        <div class="item text-center">
                                            <a href="#">
                                                <img src="{{ asset('images/avatar.jpg') }}" class="rounded-circle w-75 mx-auto">
                                                <span class="name d-block mt-3 mb-1 font-weight-bold">Mr.Designer</span>
                                                <span class="d-block bio small text-dark-2 ltr">I'm Designer For 7 years...</span>
                                                <span class="stars d-block text-warning ltr">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <span class="text-secondary-2">
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                    <span class="text-secondary-2">
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                </span>
                                                <button class="btn rounded-half btn-sm"><i class="fa fa-eye align-middle"></i></button>
                                            </a>
                                        </div>
                                        <div class="item text-center">
                                            <a href="">
                                                <img src="{{ asset('images/avatar.jpg') }}" class="rounded-circle w-75 mx-auto">
                                                <span class="name d-block mt-3 mb-1 font-weight-bold">Mr.Designer</span>
                                                <span class="d-block bio small text-dark-2 ltr">I'm Designer For 7 years...</span>
                                                <span class="stars d-block text-warning ltr">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <span class="text-secondary-2">
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                    <span class="text-secondary-2">
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                </span>
                                                <button class="btn rounded-half btn-sm"><i class="fa fa-eye align-middle"></i></button>
                                            </a>
                                        </div>
                                        <div class="item text-center">
                                            <a href="">
                                                <img src="{{ asset('images/avatar.jpg') }}" class="rounded-circle w-75 mx-auto">
                                                <span class="name d-block mt-3 mb-1 font-weight-bold">Mr.Designer</span>
                                                <span class="d-block bio small text-dark-2 ltr">I'm Designer For 7 years...</span>
                                                <span class="stars d-block text-warning ltr">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <span class="text-secondary-2">
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                    <span class="text-secondary-2">
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                </span>
                                                <button class="btn rounded-half btn-sm"><i class="fa fa-eye align-middle"></i></button>
                                            </a>
                                        </div>
                                        <div class="item text-center">
                                            <a href="">
                                                <img src="{{ asset('images/avatar.jpg') }}" class="rounded-circle w-75 mx-auto">
                                                <span class="name d-block mt-3 mb-1 font-weight-bold">Mr.Designer</span>
                                                <span class="d-block bio small text-dark-2 ltr">I'm Designer For 7 years...</span>
                                                <span class="stars d-block text-warning ltr">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <span class="text-secondary-2">
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                    <span class="text-secondary-2">
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                </span>
                                                <button class="btn rounded-half btn-sm"><i class="fa fa-eye align-middle"></i></button>
                                            </a>
                                        </div>
                                        <div class="item text-center">
                                            <a href="">
                                                <img src="{{ asset('images/avatar.jpg') }}" class="rounded-circle w-75 mx-auto">
                                                <span class="name d-block mt-3 mb-1 font-weight-bold">Mr.Designer</span>
                                                <span class="d-block bio small text-dark-2 ltr">I'm Designer For 7 years...</span>
                                                <span class="stars d-block text-warning ltr">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <span class="text-secondary-2">
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                    <span class="text-secondary-2">
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                </span>
                                                <button class="btn rounded-half btn-sm"><i class="fa fa-eye align-middle"></i></button>
                                            </a>
                                        </div>
                                        <div class="item text-center">
                                            <a href="">
                                                <img src="{{ asset('images/avatar.jpg') }}" class="rounded-circle w-75 mx-auto">
                                                <span class="name d-block mt-3 mb-1 font-weight-bold">Mr.Designer</span>
                                                <span class="d-block bio small text-dark-2 ltr">I'm Designer For 7 years...</span>
                                                <span class="stars d-block text-warning ltr">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <span class="text-secondary-2">
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                    <span class="text-secondary-2">
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                </span>
                                                <button class="btn rounded-half btn-sm"><i class="fa fa-eye align-middle"></i></button>
                                            </a>
                                        </div>
                                        <div class="item text-center">
                                            <a href="">
                                                <img src="{{ asset('images/avatar.jpg') }}" class="rounded-circle w-75 mx-auto">
                                                <span class="name d-block mt-3 mb-1 font-weight-bold">Mr.Designer</span>
                                                <span class="d-block bio small text-dark-2 ltr">I'm Designer For 7 years...</span>
                                                <span class="stars d-block text-warning ltr">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <span class="text-secondary-2">
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                    <span class="text-secondary-2">
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                </span>
                                                <button class="btn rounded-half btn-sm"><i class="fa fa-eye align-middle"></i></button>
                                            </a>
                                        </div>
                                        <div class="item text-center">
                                            <a href="">
                                                <img src="{{ asset('images/avatar.jpg') }}" class="rounded-circle w-75 mx-auto">
                                                <span class="name d-block mt-3 mb-1 font-weight-bold">Mr.Designer</span>
                                                <span class="d-block bio small text-dark-2 ltr">I'm Designer For 7 years...</span>
                                                <span class="stars d-block text-warning ltr">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <span class="text-secondary-2">
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                    <span class="text-secondary-2">
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                </span>
                                                <button class="btn rounded-half btn-sm"><i class="fa fa-eye align-middle"></i></button>
                                            </a>
                                        </div>
                                        <div class="item text-center">
                                            <a href="">
                                                <img src="{{ asset('images/avatar.jpg') }}" class="rounded-circle w-75 mx-auto">
                                                <span class="name d-block mt-3 mb-1 font-weight-bold">Mr.Designer</span>
                                                <span class="d-block bio small text-dark-2 ltr">I'm Designer For 7 years...</span>
                                                <span class="stars d-block text-warning ltr">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <span class="text-secondary-2">
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                    <span class="text-secondary-2">
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                </span>
                                                <button class="btn rounded-half btn-sm"><i class="fa fa-eye align-middle"></i></button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="section6" class="mt-4 rounded-all-corners-half px-4 pb-3">
                        <div class="title text-left d-flex justify-content-center align-items-center">
                            <span class="text">
                                <span class="h6 d-block m-0">نظرات کاربران پروژستان</span>
                                <span class="h6 small d-block m-0">User Comments</span>
                            </span>
                            <span class="icon rounded p-2  h-100 mr-2 d-flex justify-content-center align-items-center">
                                <img src="{{ asset('images/comments.png') }}" alt="نظرات کاربران" class="img-fluid">
                            </span>
                        </div>
                        <div class="col-12">
                            <div id="comments" class="mt-2">
                                <div class="item p-1">
                                    <div class="comment bg-white rounded-all-corners p-4">
                                        <div class="user py-1 px-2 d-flex justify-content-start align-items-center rounded-all-corners">
                                            <div class="avatar w-30">
                                                <img src="{{ asset('images/avatar.jpg') }}" class="img-fluid rounded-circle">
                                            </div>
                                            <div class="mr-2 w-70">
                                                <span class="d-block font-weight-bold text-dark-2 h6">فاطمه علی نژاد</span>
                                                <span class="d-block h6 small mb-0">مدیر عامل شرکت لیمو</span>
                                            </div>
                                        </div>
                                        <div class="body small mt-2">
                                            <p class="text-justify mb-0">
                                                پـروژستان سـیایت بسیار مـفید در رابـطه بـا
                                                حل مشکلات و پروژه های دانشجویی هستش
                                                و در سریعترین زمان ممکن توسط متخصصان
                                                پروژه دانشجویی خودم را حل کردم و ممنونم
                                                از مـدیران که ایـن وب سـایت را ایجاد کـردن
                                                بـا تـشکر
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item p-1">
                                    <div class="comment bg-white rounded-all-corners p-4">
                                        <div class="user py-1 px-2 d-flex justify-content-start align-items-center rounded-all-corners">
                                            <div class="avatar w-30">
                                                <img src="{{ asset('images/avatar.jpg') }}" class="img-fluid rounded-circle">
                                            </div>
                                            <div class="mr-2 w-70">
                                                <span class="d-block font-weight-bold text-dark-2 h6">فاطمه علی نژاد</span>
                                                <span class="d-block h6 small mb-0">مدیر عامل شرکت لیمو</span>
                                            </div>
                                        </div>
                                        <div class="body small mt-2">
                                            <p class="text-justify mb-0">
                                                پـروژستان سـیایت بسیار مـفید در رابـطه بـا
                                                حل مشکلات و پروژه های دانشجویی هستش
                                                و در سریعترین زمان ممکن توسط متخصصان
                                                پروژه دانشجویی خودم را حل کردم و ممنونم
                                                از مـدیران که ایـن وب سـایت را ایجاد کـردن
                                                بـا تـشکر
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item p-1">
                                    <div class="comment bg-white rounded-all-corners p-4">
                                        <div class="user py-1 px-2 d-flex justify-content-start align-items-center rounded-all-corners">
                                            <div class="avatar w-30">
                                                <img src="{{ asset('images/avatar.jpg') }}" class="img-fluid rounded-circle">
                                            </div>
                                            <div class="mr-2 w-70">
                                                <span class="d-block font-weight-bold text-dark-2 h6">فاطمه علی نژاد</span>
                                                <span class="d-block h6 small mb-0">مدیر عامل شرکت لیمو</span>
                                            </div>
                                        </div>
                                        <div class="body small mt-2">
                                            <p class="text-justify mb-0">
                                                پـروژستان سـیایت بسیار مـفید در رابـطه بـا
                                                حل مشکلات و پروژه های دانشجویی هستش
                                                و در سریعترین زمان ممکن توسط متخصصان
                                                پروژه دانشجویی خودم را حل کردم و ممنونم
                                                از مـدیران که ایـن وب سـایت را ایجاد کـردن
                                                بـا تـشکر
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item p-1">
                                    <div class="comment bg-white rounded-all-corners p-4">
                                        <div class="user py-1 px-2 d-flex justify-content-start align-items-center rounded-all-corners">
                                            <div class="avatar w-30">
                                                <img src="{{ asset('images/avatar.jpg') }}" class="img-fluid rounded-circle">
                                            </div>
                                            <div class="mr-2 w-70">
                                                <span class="d-block font-weight-bold text-dark-2 h6">فاطمه علی نژاد</span>
                                                <span class="d-block h6 small mb-0">مدیر عامل شرکت لیمو</span>
                                            </div>
                                        </div>
                                        <div class="body small mt-2">
                                            <p class="text-justify mb-0">
                                                پـروژستان سـیایت بسیار مـفید در رابـطه بـا
                                                حل مشکلات و پروژه های دانشجویی هستش
                                                و در سریعترین زمان ممکن توسط متخصصان
                                                پروژه دانشجویی خودم را حل کردم و ممنونم
                                                از مـدیران که ایـن وب سـایت را ایجاد کـردن
                                                بـا تـشکر
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item p-1">
                                    <div class="comment bg-white rounded-all-corners p-4">
                                        <div class="user py-1 px-2 d-flex justify-content-start align-items-center rounded-all-corners">
                                            <div class="avatar w-30">
                                                <img src="{{ asset('images/avatar.jpg') }}" class="img-fluid rounded-circle">
                                            </div>
                                            <div class="mr-2 w-70">
                                                <span class="d-block font-weight-bold text-dark-2 h6">فاطمه علی نژاد</span>
                                                <span class="d-block h6 small mb-0">مدیر عامل شرکت لیمو</span>
                                            </div>
                                        </div>
                                        <div class="body small mt-2">
                                            <p class="text-justify mb-0">
                                                پـروژستان سـیایت بسیار مـفید در رابـطه بـا
                                                حل مشکلات و پروژه های دانشجویی هستش
                                                و در سریعترین زمان ممکن توسط متخصصان
                                                پروژه دانشجویی خودم را حل کردم و ممنونم
                                                از مـدیران که ایـن وب سـایت را ایجاد کـردن
                                                بـا تـشکر
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item p-1">
                                    <div class="comment bg-white rounded-all-corners p-4">
                                        <div class="user py-1 px-2 d-flex justify-content-start align-items-center rounded-all-corners">
                                            <div class="avatar w-30">
                                                <img src="{{ asset('images/avatar.jpg') }}" class="img-fluid rounded-circle">
                                            </div>
                                            <div class="mr-2 w-70">
                                                <span class="d-block font-weight-bold text-dark-2 h6">فاطمه علی نژاد</span>
                                                <span class="d-block h6 small mb-0">مدیر عامل شرکت لیمو</span>
                                            </div>
                                        </div>
                                        <div class="body small mt-2">
                                            <p class="text-justify mb-0">
                                                پـروژستان سـیایت بسیار مـفید در رابـطه بـا
                                                حل مشکلات و پروژه های دانشجویی هستش
                                                و در سریعترین زمان ممکن توسط متخصصان
                                                پروژه دانشجویی خودم را حل کردم و ممنونم
                                                از مـدیران که ایـن وب سـایت را ایجاد کـردن
                                                بـا تـشکر
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item p-1">
                                    <div class="comment bg-white rounded-all-corners p-4">
                                        <div class="user py-1 px-2 d-flex justify-content-start align-items-center rounded-all-corners">
                                            <div class="avatar w-30">
                                                <img src="{{ asset('images/avatar.jpg') }}" class="img-fluid rounded-circle">
                                            </div>
                                            <div class="mr-2 w-70">
                                                <span class="d-block font-weight-bold text-dark-2 h6">فاطمه علی نژاد</span>
                                                <span class="d-block h6 small mb-0">مدیر عامل شرکت لیمو</span>
                                            </div>
                                        </div>
                                        <div class="body small mt-2">
                                            <p class="text-justify mb-0">
                                                پـروژستان سـیایت بسیار مـفید در رابـطه بـا
                                                حل مشکلات و پروژه های دانشجویی هستش
                                                و در سریعترین زمان ممکن توسط متخصصان
                                                پروژه دانشجویی خودم را حل کردم و ممنونم
                                                از مـدیران که ایـن وب سـایت را ایجاد کـردن
                                                بـا تـشکر
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item p-1">
                                    <div class="comment bg-white rounded-all-corners p-4">
                                        <div class="user py-1 px-2 d-flex justify-content-start align-items-center rounded-all-corners">
                                            <div class="avatar w-30">
                                                <img src="{{ asset('images/avatar.jpg') }}" class="img-fluid rounded-circle">
                                            </div>
                                            <div class="mr-2 w-70">
                                                <span class="d-block font-weight-bold text-dark-2 h6">فاطمه علی نژاد</span>
                                                <span class="d-block h6 small mb-0">مدیر عامل شرکت لیمو</span>
                                            </div>
                                        </div>
                                        <div class="body small mt-2">
                                            <p class="text-justify mb-0">
                                                پـروژستان سـیایت بسیار مـفید در رابـطه بـا
                                                حل مشکلات و پروژه های دانشجویی هستش
                                                و در سریعترین زمان ممکن توسط متخصصان
                                                پروژه دانشجویی خودم را حل کردم و ممنونم
                                                از مـدیران که ایـن وب سـایت را ایجاد کـردن
                                                بـا تـشکر
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="section7" class="mt-4">
                        <div class="col-12 px-0">
                            <div class="row">
                                <div class="col-4 pl-1">
                                    <img src="{{ asset('images/ads.jpg') }}" class="img-fluid rounded-all-corners" alt="تبلیغات شما">
                                </div>
                                <div class="col-4 px-1">
                                    <img src="{{ asset('images/ads.jpg') }}" class="img-fluid rounded-all-corners" alt="تبلیغات شما">
                                </div>
                                <div class="col-4 pr-1">
                                    <img src="{{ asset('images/ads.jpg') }}" class="img-fluid rounded-all-corners" alt="تبلیغات شما">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="section8" class="mt-4">
                        <div class="title text-center">
                            <span class="h5 d-block mb-1">مشتـریان پارسـکدرز چـه شرکت هایـی میباشـند ؟</span>
                            <span class="h6 small d-block ltr pr-5 mr-5">Which Companies Are The Customers Of Projestan ?</span>
                        </div>
                        <div id="customers" class="mt-3">
                            <div class="item">
                                <img src="{{ asset('images/supporters/1.png') }}" class="img-fluid mx-auto">
                            </div>
                            <div class="item">
                                <img src="{{ asset('images/supporters/2.png') }}" class="img-fluid mx-auto">
                            </div>
                            <div class="item">
                                <img src="{{ asset('images/supporters/3.png') }}" class="img-fluid mx-auto">
                            </div>
                            <div class="item">
                                <img src="{{ asset('images/supporters/4.png') }}" class="img-fluid mx-auto">
                            </div>
                            <div class="item">
                                <img src="{{ asset('images/supporters/1.png') }}" class="img-fluid mx-auto">
                            </div>
                            <div class="item">
                                <img src="{{ asset('images/supporters/2.png') }}" class="img-fluid mx-auto">
                            </div>
                            <div class="item">
                                <img src="{{ asset('images/supporters/3.png') }}" class="img-fluid mx-auto">
                            </div>
                            <div class="item">
                                <img src="{{ asset('images/supporters/4.png') }}" class="img-fluid mx-auto">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="section9" class="py-4 mt-4">
                    <div class="container">
                        <div class="bg-white rounded-all-corners wrapping p-3">
                            <div class="row">
                                <div class="col-4 d-flex justify-content-start align-items-center righter">
                                    <img src="{{ asset('images/chat.png') }}">
                                    <span class="h4 mb-0 mr-2">
                                        <span class="text-aqua-5">پیشنهاد</span>
                                        <span class="text-dark-2">ویژه</span>
                                    </span>
                                </div>
                                <div class="col-8 lefter d-flex align-items-center">
                                    <div>
                                        <span class="d-block text-dark-2">
                                        با عضویت در <span class="text-pink">پیشنهاد های ویژه</span> از پروژه های مهم یا بزرگ مرتبط با مهارت خود با <span class="text-pink">خبر</span> شوید.
                                        </span>
                                        <form class="form-inline mt-2">
                                            <div class="form-group mb-2">
                                                <input type="text" class="form-control" id="email" name="email" placeholder="آدرس ایمیل (نام کاربری)">
                                            </div>
                                            <div class="form-group mx-sm-3 mb-2">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="رمز عبور">
                                            </div>
                                            <button type="submit" class="btn btn-aqua mb-2 px-4">دریافت</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div id="section10" class="mt-4">
                        <div class="title text-left pr-5 mr-5">
                            <span class="h5 d-block mb-1 ml-3">اکثر متخصصین پروژستان در چه رشته هایی هستند...؟!</span>
                            <span class="h6 small d-block ltr">What Are most Projestan Specialists in ?</span>
                        </div>
                        <div>
                            <img src="{{ asset('images/section10.jpg') }}" class="img-fluid undraggable" alt="اکثر متخصصین پروژستان در چه رشته هایی هستند">
                        </div>
                    </div>
                    <div class="sec-separator">&nbsp;</div>
                    <div id="section11" class="mt-4">
                        <div class="title">
                            <span>ویژگی های ممتاز پروژستان</span>
                        </div>
                        <div class="my-3 row text-dark-3">
                            <div class="col-3 text-center">
                                <span class="icon display-4">
                                    <i class="fa fa-shield"></i>
                                </span>
                                <span class="mt-1 d-block">ضمانت مبلغ پروژه</span>
                            </div>
                            <div class="col-3 text-center">
                                <span class="icon display-4">
                                    <i class="fa fa-id-badge"></i>
                                </span>
                                <span class="mt-1 d-block">انتخاب برترین متخصصان</span>
                            </div>
                            <div class="col-3 text-center">
                                <span class="icon display-4">
                                    <i class="fa fa-clock-o"></i>
                                </span>
                                <span class="mt-1 d-block">انجام در کوتاه ترین زمان</span>
                            </div>
                            <div class="col-3 text-center">
                                <span class="icon display-4">
                                    <i class="fa fa-ticket"></i>
                                </span>
                                <span class="mt-1 d-block">ضمانت مبلغ پروژه</span>
                            </div>
                        </div>
                        <ul class="nav menu p-4">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <span class="text">مشاوره رایگان</span>
                                    <span class="icon">
                                        <i class="fa fa-support"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <span class="text">روش کار</span>
                                    <span class="icon">
                                        <i class="fa fa-list"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <span class="text">سوالات متداول</span>
                                    <span class="icon">
                                        <i class="fa fa-question-circle-o"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <span class="text">چرا پروژستان ؟</span>
                                    <span class="icon">
                                        <i class="fa fa-info-circle"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="sec-separator">&nbsp;</div>
                    <footer id="footer">
                        <div class="row">
                            <div class="col-4" id="links">
                                <div class="title">
                                    <span class="text-aqua-5 h5">لینک های مفید</span>
                                </div>
                                <ul class="nav flex-column p-0 mt-3 small">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            ورود به پنل کاربری
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            ثبت نام
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            راهنمای سایت
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            خرید اشتراک
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            وبلاگ
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-4" id="followUs">
                                <div class="title text-center">
                                    <span class="text-aqua-5 h5">ما را در شبکه های اجتماعی دنبال کنید</span>
                                </div>
                                <ul class="menu nav p-0 justify-content-center">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-pinterest-p"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                </ul>
                                <div class="mt-3 p-3 bg-secondary-2 rounded">
                                    <div class="title text-center text-aqua-5">
                                        <span>گواهینامه پروژستان</span>
                                    </div>
                                    <div class="d-flex justify-content-around mt-2">
                                        <img src="{{ asset('images/logo/1.png') }}">
                                        <img src="{{ asset('images/logo/2.png') }}">
                                        <img src="{{ asset('images/logo/3.png') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4" id="contactUs">
                                <div class="title">
                                    <span class="text-aqua-5 h5">ارتباط با ما</span>
                                </div>
                                <div class="content text-secondary-3">
                                    <span class="d-block mt-2">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                    <span class="content ltr d-block">
                                        0919-8600047 / 0919-8600047
                                    </span>
                                    <span class="d-block mt-2">
                                        <i class="fa fa-envelope-o"></i>
                                    </span>
                                    <span class="content d-block">
                                        ایمیل : info@projestan.com
                                    </span>
                                    <span class="d-block mt-2">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                    <span class="content d-block w-75">
                                        خیابان بهشتی ـ خیابان قائم مقام فراهانی ـ
کوچه دهم پلاک 11 ـ واحد 14
                                    </span>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/front.js') }}"></script>
</body>
</html>
