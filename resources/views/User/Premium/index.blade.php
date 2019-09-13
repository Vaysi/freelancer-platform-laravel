@extends('User.master')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-12 mb-3" id="faq">
                <div class="card custom">
                    <div class="card-title">
                        <span>ارتقا حساب کاربری</span>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-yellow rounded-corner-5">
                            <div class="row row-eq-height">
                                <div class="col-2 icon display-4 text-center silver">
                                    <img src="{{ user()->package()->icon }}" class="{{ user()->package()->is_default ? 'w-25' : 'w-50' }} d-block mx-auto">
                                </div>
                                <div class="col-10">
                                    <h6 class="bold">عضویت فعلی شما : {{ user()->package()->name }}</h6>
                                    @if(!user()->package()->is_default)
                                        <span class="d-block">تاریخ شروع عضویت: {{ jdate(user()->starts_at)->format('d F H:i:s') }}</span>
                                        <span class="d-block mt-2">تاریخ خاتمه عضویت: {{ jdate(user()->expires_at)->format('d F H:i:s') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="notify notify-info">
                            <div>&nbsp;</div>
                            <p>هزینه کارمزد پروژه در صورتی که در تمام مدت انجام پروژه (از لحظه پذیرش پیشنهاد تا پذیرش کار توسط خریدار) حساب مجری ویژه باشد با در نظر گرفتن تخفیف کاربران ويژه محاسبه می‌گردد. چنانچه در حین انجام کار وقفه ای در این عضویت رخ دهد اثر مجری ویژه از بین خواهد رفت.</p>
                        </div>
                        <div class="row my-3 row-eq-height" id="plans">
                            @foreach(\App\Package::all() as $package)
                                <div class="col-3 {{ $package->color }}">
                                    <div class="card custom h-100">
                                        <div class="card-header">
                                            <span>{{ $package->name }}</span>
                                        </div>
                                        <div class="card-body">
                                            <div class="text-center my-2">
                                                <span class="text-dark-2 font-weight-bold d-block">{{ $package->price < 500 ? 'رایگان' : money($package->price) }}</span>
                                                <span class="small text-danger font-weight-bold">{{ dayToMonth($package->length) }}</span>
                                            </div>
                                            <ul class="custom-ul {{ $package->min && $package->min > user()->doneJobs() ? '' : 'pb-4' }}">
                                                <li>{{ $package->features->desc1 }}</li>
                                                <li>{{ $package->features->desc2 }}</li>
                                                <li>کارمزد <span>{{ $package->features->fee }}</span> درصد</li>
                                                <li>انجام <span>{{ $package->features->max == '-1' ? 'نامحدود' : 'حداکثر ' .  $package->features->max }}</span> پروژه همزمان</li>
                                                <li>ثبت <span>{{ $package->features->portfolio == '-1' ? 'نامحدود' : $package->features->portfolio }}</span> نمونه کار در رزومه</li>
                                            </ul>
                                            @if($package->min && $package->min > user()->doneJobs())
                                            <div class="m-2 pb-4">
                                                <div class="w-100 bg-secondary-2 text-center p-2 small  rounded-all-corners-half">
                                                    <span class="text-dark-4">برای ارتقاء به این سطح باید حداقل <span>{{ $package->min }}</span> پروژه را با موفقیت به اتمام رسانده باشید</span>
                                                    <span class="d-block mt-2 text-secondary-2">
                                                    تعداد پروژه های شما : {{ user()->doneJobs() }}
                                                </span>
                                                </div>
                                            </div>
                                            @endif
                                            @if(!$package->is_default && (!boolval($package->min) && $package->min <= user()->doneJobs()))
                                                <div class="buy-btn">
                                                    <a href="{{ route('premium.update',['package'=>$package->id]) }}" class="btn blue-gradient w-75 text-center rounded-half btn-ask">{{ optional(user()->package())->id == $package->id ? 'تمدید' : 'ارتقاء' }}</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
