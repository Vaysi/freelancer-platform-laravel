
@extends('User.master')
@section('content')
    <div class="col-9 pl-1">
        <div class="row">
            <div class="col-12 mb-3 projectList" id="newProject">
                <div class="card custom">
                    <div class="card-title">
                        <span>روش پرداخت</span>
                    </div>
                    <div class="card-body">
                        <div class="bg-secondary-2 rounded-corner-2 text-center mb-3 pt-3 pr-3 pl-3">
                            <h6 class="text-dark-2">پرداخت آنلاین از طریق کارت های بانکی عضو شتاب</h6>
                            <p class="text-secondary-2">در این روش حساب شما بلافاصله شارژ می شود و شما می توانید از وجه استفاده کنید.</p>
                            <a href="{{ route('money.pay') }}" class="btn btn-info-2 rounded-half">مشخص کردن مبلغ و درگاه پرداخت <i class="fa fa-angle-double-left"></i></a>
                            <div class="bg-info-2 w-75 mt-3 mx-auto" style="height: 4px;"></div>
                        </div>
                        <div class="bg-secondary-2 rounded-corner-2 text-center mb-3 pt-3 pr-3 pl-3">
                            <h6 class="text-dark-2">پرداخت از طریق واریز دستی وجه به حساب</h6>
                            <p class="text-secondary-2">پرداخت دستی نیازمند تایید مدیر است و ممکن است ساعاتی بعد تایید شود.</p>
                            <a href="#" class="btn btn-purple-2 rounded-half">ثبت اطلاعات واریزی</a> <a href="#" class="btn btn-secondary-2 rounded-half">مشاهده اطلاعات واریزی</a>
                            <div class="bg-purple-2 w-75 mt-3 mx-auto" style="height: 4px;"></div>
                        </div>
                        <div class="bg-secondary-2 rounded-corner-2 text-center mb-3 pt-3 pr-3 pl-3">
                            <h6 class="text-dark-2">پرداخت ارزی برای کاربران خارج از کشور ایران</h6>
                            <p class="text-secondary-2">برای پرداخت ارزی و غیر ریالی از طریق ارسال یک تیکت پشتیبانی با ما در ارتباط باشید تا مراحل کار به شما اعلام شود.</p>
                            <a href="#" class="btn btn-success-2 rounded-half">ارسال تیکت پشتیبانی</a>
                            <div class="bg-success-2 w-75 mt-3 mx-auto" style="height: 4px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 pr-1">
        <div class="card custom sticky-sidebar">
            <div class="card-title text-center">
                <span>با همکاری بانک های زیر</span>
            </div>
            <div class="card-body">
                <div class="sticky-sidebar w-100">
                    <div class="btn-gp text-center">
                        <button class="btn btn-bright rounded-corner-2 p-3 btn-green no_arrow w-100">
                            <span class="counter" style="width: fit-content">
                                <small class="bg-white rounded-corner-2 mx-auto px-3" style="width: fit-content">6,000,000</small>
                            </span>
                            <span class="d-block">تومان موجودی</span>
                            <small class="d-block"><small>مشاهده گزارش مالی</small></small>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
