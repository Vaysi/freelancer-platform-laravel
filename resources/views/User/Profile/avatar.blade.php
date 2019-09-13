@extends('User.master')
@section('content')
    <div class="col-9 pl-1">
        <div class="row">
            <div class="col-12 mb-3" id="emp_req">
                <div class="card custom">
                    <div class="card-title">
                        <span>تغیر آواتار</span>
                    </div>
                    <div class="card-body py-3">
                        <div class="alert alert-yellow rounded-corner-5">
                            <div class="row row-eq-height">
                                <div class="col-2 icon display-4 text-center">
                                    <i class="fa fa-exclamation"></i>
                                </div>
                                <div class="col-10">
                                    <span class="bold h6">ما بر اساس تجربه خود پیشنهاد می کنیم:</span>
                                    <p>عکس پروفایل شما باید نشان دهنده شخصیت حرفه‌ای شما و جلب کننده اعتماد بیننده باشد. آیا شما حاضرید پیاده‌سازی ایده تجاریتان را به یک پیشی ملوس یا یک درخت بسپارید؟</p>
                                    <p>در یک کلام عکس واقعی زمینه ساز ایجاد اعتماد می شود. خریدارانی که قصد سفارش پروژه های میلیونی دارند نیاز دارند تا مجریان را بهتر و بیشتر بشناسند.</p>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('avatar.update') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="my-4 text-center">
                                <div class="w-25 mx-auto">
                                    <img src="{{ user()->avatar }}" class="img-thumbnail">
                                </div>
                                <label class="btn btn-info w-25 mt-2 pointer">
                                    انتخاب عکس
                                    <input type="file" name="avatar" id="avatar" class="hide">
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 pr-1">
        <div class="card custom sticky-sidebar">
            <div class="card-title">
                <span> نکات قابل توجه</span>
            </div>
            <div class="card-body">
                <ul class="text-info px-3 small mb-0">
                    <li class="mb-2">حداقل سایز عکس می بایست 256 پیکسل در 256 پیکسل باشد.</li>
                    <li>فرمت های قابل قبول : JPG, PNG, GIF</li>
                </ul>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(function () {
            $("#avatar").change(function () {
                $(this).parents('form').submit();
            });
        });
    </script>
@endsection
