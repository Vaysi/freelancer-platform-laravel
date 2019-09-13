@extends('User.master')
@section('content')
    <div class="col-9 pl-1">
        <div class="row">
            <div class="col-12 mb-3" id="emp_req">
                <div class="card custom">
                    <div class="card-title">
                        <span>کسب درامد با معرفی</span>
                    </div>
                    <div class="card-body py-3">
                        <h6 class="text-dark-2 font-weight-bold">چقدر درآمد خواهم داشت و این درآمد بابت انجام چه کاری است؟</h6>
                        <ul class="custom-ul small">
                            <li>به ازاء هر خریداری که شما به سایت پارس کدرز ارجا دهید ما درصدی از سود حاصل را به صورت زیر به شما پرداخت می کنیم
                                <ul type="circle">
                                    <li><span>{{ intval(option('first_fee')) }}%</span> از سود اولین پروژه ای که کاربر به عنوان خریدار در سایت پارس کدرز قرار دهد (<span>{{ intval(option('first_fee')) / 10 }}%</span> درصد از کل مبلغ پروژه)</li>
                                    <li><span>{{ intval(option('normal_fee')) }}%</span> از سود پروژه های بعدی که کاربر به عنوان خریدار در سایت پارس کدرز قرار دهد (<span>{{ intval(option('normal_fee')) / 10 }}%</span> درصد از کل مبلغ پروژه)</li>
                                    <li><span>{{ intval(option('upgrade_fee')) }}%</span> از هزینه ای که کاربر به عنوان مجری جهت ویژه نمودن حساب خود پرداخت می کند</li>
                                </ul>
                            </li>
                            <li>
                                برای جلوگیری از فریب سود پس اتمام کار و تایید آن از طرف خریدار محاسبه و پرداخت می گردد.
                            </li>
                            <li>
                                سود معرف حداکثر به مدت یک سال و برای <span>{{ intval(option('fee_times')) }}</span> پروژه هر یک که زود تر فرا رسد پرداخت می گردد.
                            </li>
                        </ul>
                        <h6 class="text-dark-2 font-weight-bold mt-3">نمایش بنر به صورت گرافیکی</h6>
                        <p class="small">شما می توانید یکی از بنرهای زیر را در سایت خود قرار دهید. کافیست بر روی یکی از عنواین زیر کلیک کرده تا کد مناسب نمایش داده شود.</p>
                        <div class="alert alert-yellow rounded-corner-2">
                            در صورتیکه از کدهای قدیمی برای ارجاع کاربران استفاده می کنید، حتما آن را با کد جدید جایگزین کنید.
                        </div>
                        <div class="accordion mt-4 row" id="accordionExample">
                            <div class="col-6">
                                <div class="card mb-2 rounded-half">
                                    <div class="card-header rounded-half d-flex justify-content-between align-items-center align-items-center" id="headingOne">
                                        <h4 class="mb-0">
                                            <button class="btn small btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                بنر با عرض 120 در ارتفاع 240
                                            </button>
                                        </h4>
                                        <h5 class="text-dark-2 mb-0"><i class="fa fa-chevron-down"></i></h5>
                                    </div>

                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body d-flex justify-content-between">
                                            <img src="https://parscoders.com/banner/120x240.gif">
                                            <textarea class="form-control"><a href="https://parscoders.com/?ref=21898"><img src="https://parscoders.com/banner/120x240.gif" alt="پارسکدرز اولین بازار کار آنلاین ایران" title="پارسکدرز اولین بازار کار آنلاین ایران"></a></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card rounded-half">
                                    <div class="card-header rounded-half d-flex justify-content-between align-items-center" id="headingTwo">
                                        <h4 class="mb-0">
                                            <button class="btn small btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                بنر با عرض 120 در ارتفاع 240
                                            </button>
                                        </h4>
                                        <h5 class="text-dark-2 mb-0"><i class="fa fa-chevron-down"></i></h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                        <div class="card-body d-flex justify-content-between">
                                            <img src="https://parscoders.com/banner/120x240.gif">
                                            <textarea class="form-control"><a href="https://parscoders.com/?ref=21898"><img src="https://parscoders.com/banner/120x240.gif" alt="پارسکدرز اولین بازار کار آنلاین ایران" title="پارسکدرز اولین بازار کار آنلاین ایران"></a></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-dark-2 font-weight-bold mt-3">نمایش لینک به صورت ساده</h6>
                        <p class="small">می توانید با استفاده از لینک زیر و درج آن در جای مناسب بازدید کنندگان سایت خود را به سمت پارسکدرز هدایت کنید.</p>
                        <div class="bg-secondary-2 rounded py-3 px-2 text-left" dir="ltr">
                            {{ user()->refLink() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 pr-1">
        <div class="card custom sticky-sidebar">
            <div class="card-title">
                <span> کاربران ثبت نام شده از طریق شما </span>
            </div>
            <div class="card-body text-center" >
                <div style="height: 70px;" class="d-flex justify-content-center align-items-center font-weight-bold text-info">
                    <span>{{ user()->references()->count() }}  نفر</span>
                </div>
                <a href="{{ route('affiliate.report') }}" class="btn btn-info round mt-2">آمار عملکرد</a>
            </div>
        </div>
    </div>
@stop
