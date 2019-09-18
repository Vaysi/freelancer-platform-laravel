@extends('User.master')
@section('content')
    <div class="col-9 pl-1">
        <div class="row">
            <div class="col-12 mb-3" id="emp_req">
                <div class="card custom">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <span> آیا از ثبت درخواست داوری اطمینان دارید؟ </span>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info rounded-corner-5">
                            <div class="row row-eq-height">
                                <div class="col-2 icon display-4 text-center">
                                    <i class="fa fa-balance-scale"></i>
                                </div>
                                <div class="col-10">
                                    <span class="bold">قوانین پروژستان</span>
                                    <p> پروژستان به عنوان واسطه میان خریدار و مجری فعالیت می‌نماید و در بهترین حالت همواره سعی در تسهیل کردن انجام معاملات و ایجاد رضایتمندی دوطرفه میان هر دو طرف را دارد، بنابرین خریدار و مجری توافق می‌کنند که درصورت پیشامدن هرگونه اختلاف، مرجع اولیه‌ی حل اختلاف تیم داوری پروژستان باشد. داوری طی ساعات و روزهای کاری انجام می پذیرد. در مواردی که تیم داوری پروژستان به دلایلی شامل و نه محدود به پیچیدگی های فنی و غیر فنی، احتمال عدم توانایی در حفظ حقوق طرفین را بدهد می تواند از انجام داوری خوداری نموده و طرفین را به مراجع قضایی قانونی و رسمی هدایت کند تا ایشان نسبت به حل اختلاف اقدام کند. </p>
                                    <br>
                                    <p><b>تبصره:</b> کاربران پروژستان می پذیرند که در صورت بروز هرگونه اختلاف با پروژستان، مرجع صالح رسیدگی کننده به اختلافات، مراجع ذی صلاح واقع در شهر شیراز بوده و کاربران حق پیگیری در مراجع قضایی دیگر را از خود سلب می نمایند. آدرس استقرار دفتر اصلی پروژستان مطابق با اطلاعات مندرج در نماد اعتماد الکترونیکی است. </p>
                                </div>
                            </div>
                        </div>
                        <h6>به چه دلیل قصد ایجاد درخواست داوری دارید؟</h6>
                        <div class="accordion mt-4" id="accordionExample">
                            <div class="card mb-2 rounded-half">
                                <div class="card-header rounded-half d-flex justify-content-between align-items-center align-items-center" id="headingOne">
                                    <h4 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            کارفرما وجه گروگذاری شده را آزاد نمی کند
                                        </button>
                                    </h4>
                                    <h5 class="text-dark-2 mb-0"><i class="fa fa-chevron-down"></i></h5>
                                </div>

                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <h6>آیا 72 ساعت سپری شده؟</h6>
                                        <p class="small"> خریدار موظف است پس از اعلام پایان کار توسط مجری نسبت به تایید یا اعمال نظر برای تغییرات حداکثر در مدت 72 ساعت اقدام نماید، بدیهی است در صورت عدم پاسخ گویی خریدار در این مدت با درخواست مجری پارسکدرز حق دارد کار مجری را پذیرفته شده در نظر گیرد و رأسا وجه گروگذاری شده را آزاد نماید. </p>
                                        <div class="alert alert-warning rounded-corner-5">هشدار: آیا می دانید درخواست داوری در رزومه شما ثبت می شود؟ توصیه می کنیم فقط در صورت لزوم درخواست دهید. </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2  rounded-half">
                                <div class="card-header rounded-half d-flex justify-content-between align-items-center" id="headingTwo">
                                    <h4 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            نمی توانم وجه را برای مجری آزاد کنم
                                        </button>
                                    </h4>
                                    <h5 class="text-dark-2 mb-0"><i class="fa fa-chevron-down"></i></h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        راهنمای تصویری پذیرش کار را در صفحه <a href="{{ route('help') }}"> راهنما </a>  مطالعه کنید
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2  rounded-half">
                                <div class="card-header rounded-half d-flex justify-content-between align-items-center" id="headingThree">
                                    <h4 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            می خواهم ضمانت تخصص حذف شود
                                        </button>
                                    </h4>
                                    <h5 class="text-dark-2 mb-0"><i class="fa fa-chevron-down"></i></h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>کافی است یک درخواست پشتیبانی ( نه داوری) برای ما ارسال کنید تا ترتیب کار داده شود. لینک صفحه درخواست پشتیبانی</p>
                                        <a href="{{ route('support.create') }}">کلیک کنید</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2  rounded-half">
                                <div class="card-header rounded-half d-flex justify-content-between align-items-center" id="headingFour">
                                    <h4 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            چرا وجه درخواستی من به حسابم واریز نشده؟
                                        </button>
                                    </h4>
                                    <h5 class="text-dark-2 mb-0"><i class="fa fa-chevron-down"></i></h5>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p> درخواست های واریز وجه تا 48 ساعت پس از ثبت درخواست شما و در طی روزهای کاری انجام خواهد شد. </p>
                                        <div class="alert alert-warning rounded-corner-5">هشدار: آیا می دانید درخواست داوری در رزومه شما ثبت می شود؟ توصیه می کنیم فقط در صورت لزوم درخواست دهید. </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2  rounded-half">
                                <div class="card-header rounded-half d-flex justify-content-between align-items-center" id="headingFive">
                                    <h4 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                            می خواهم پروژه به صورت توافقی لغو شود
                                        </button>
                                    </h4>
                                    <h5 class="text-dark-2 mb-0"><i class="fa fa-chevron-down"></i></h5>
                                </div>
                                <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p> برای لغو توافقی نیازی به داوری نیست. کافی است در همان صفحه گفتگوی پروژه برای طرف مقابل یک پیام ارسال کنید و از ایشان بخواهید که توافق خود را به صورت مکتوب در همان بخش قید کند. سپس از صفحه
                                            <a href="{{ route('support.create') }}">درخواست پشتیبانی</a> برای ما یک پیام ارسال کنید </p>
                                        <p> در صورتی که طرف مقابل پاسخی نداد آن وقت یک درخواست داوری دهید. </p>
                                        <div class="alert alert-warning rounded-corner-5">هشدار: آیا می دانید درخواست داوری در رزومه شما ثبت می شود؟ توصیه می کنیم فقط در صورت لزوم درخواست دهید. </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2  rounded-half">
                                <div class="card-header rounded-half d-flex justify-content-between align-items-center" id="headingSix">
                                    <h4 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                            هیچ کدام از موارد بالا، می خواهم درخواست داوری دهم
                                        </button>
                                    </h4>
                                    <h5 class="text-dark-2 mb-0"><i class="fa fa-chevron-down"></i></h5>
                                </div>
                                <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <form action="{{ route('support.store') }}" class="corner" method="post">
                                            @csrf
                                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                                            <input type="hidden" name="type" value="judgement">
                                            <input type="hidden" name="page" value="judgement">
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
                                                        <label for="content">پیام</label>
                                                        <textarea name="content" class="form-control" id="content" rows="10"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-12">
                                                    <input type="checkbox" name="private" value="1" class="toggle color-primary has-animation"> خصوصی باشد
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button class="btn btn-outline-danger w-100" type="submit">ارسال</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="alert alert-warning rounded-corner-5 small my-2">
                                            <ul>
                                                <li> در صورت انتخاب گزینه خصوصی، طرف مقابل به داوری دعوت نخواهد شد، اما در صورت لزوم توسط داور به داوری دعوت خواهد شد. </li>
                                                <li> آیا می دانید درخواست داوری در رزومه شما ثبت می شود و آمار آن توسط دیگران دیده می شود؟ توصیه می کنیم فقط در صورت لزوم درخواست دهید. برای ثبت
                                                    <a href="{{ route('support.create') }}">درخواست پشتیبانی</a> به جای داوری کلیک کنید. </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 pr-1">
        <div class="card custom sticky-sidebar">
            <div class="card-title">
                <span>  نکته های مهم  </span>
            </div>
            <div class="card-body text-center">
                <ul class="text-right px-2 small">
                    <li class="text-danger mb-2"> داوری پروژه ها به دلیل بررسی دقیق موارد زمانبر است. بنابراین با صبوری خود از همان بخش داوری پیگیر باشید.</li>
                    <li class="text-danger mb-2"> رعایت ادب و اخلاق یک اصل اساسی و ضروری است. در صورت مشاهده خلاف آن با شخص خاطی برخورد جدی خواهد شد. </li>
                    <li class="mb-2">از ایجاد درخواست های داوری تکراری اکیداً پرهیز کنید.</li>
                    <li class="mb-2"> درخواست های واریز وجه تا 48 ساعت پس از ثبت درخواست شما و در طی روزهای کاری انجام خواهد شد.</li>
                    <li> بسیاری از سئوالات شما در بخش پرسش های متداول پاسخ داده شده است</li>
                </ul>
                <hr>
                <a href="{{ route('faq') }}" class="btn btn-info round mt-2">پرسش های متداول</a>
            </div>
        </div>
    </div>
@stop
