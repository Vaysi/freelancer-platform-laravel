@extends('User.master')
@section('content')
    <div class="col-9 pl-1">
        <div class="row">
            <div class="col-12 mb-3" id="emp_req">
                <div class="card custom">
                    <form action="{{ route('document.upload.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-title">
                            <span>آپلود مدارک</span>
                        </div>
                        <div class="card-body py-3">
                            <p class="small">هدف از ارسال مدارک تایید هویت کاربر است. وقتی که هویت یک کارفرما یا فریلنسر تایید شده باشد، اعتماد طرف مقابل بیش از پیش جلب خواهد شد و این امر به افزایش کیفیت تعاملات منجر خواهد شد. تایید هویت به معنای تایید مهارت های فنی کاربر نیست و صرفاً به تایید اطلاعات تماس و مشخصات فردی و هویتی شخص توجه می شود.</p>
                            <div class="my-4 p-3 border rounded-corner-2-half shadow-sm">
                                <span class="text-success">کارت ملی</span>
                                <span class="text-secondary-2 small d-block">تصویر رنگی و واضح از کارت ملی</span>
                                <label class="btn btn-danger rounded-corner-2-half pointer mt-3">
                                    ضمیمه فایل
                                    <input type="file" class="hide" name="file">
                                </label>
                            </div>
                            @if(user()->documents()->count())
                                <div class="row my-2">
                                    @foreach(user()->documents()->get() as $document)
                                        <div class="col-md-4 col-sm-6 col-12 mb-2 position-relative" data-toggle="tooltip" data-placement="top" title="{{ $document->message }}">
                                            <img src="{{ $document->url}}" class="img-fluid img-thumbnail">
                                            <div class="position-absolute d-inline-block" style="top:5px;left: 25px;">
                                                @if($document->status == 'success')
                                                    <span class="badge badge-success">تایید شده</span>
                                                @elseif($document->status == 'pending')
                                                    <span class="badge badge-warning">در انتظار تایید</span>
                                                @else
                                                    <span class="badge badge-warning">رد شده !</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="my-1">
                                <button class="btn btn-info w-100 text-center round"> ارسال مدارک جهت بازبینی</button>
                            </div>
                        </div>
                    </form>
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
                <ul class="text-info px-3 small mb-3">
                    <li class="mb-2">مدارک ارسالی باید رنگی باشد.</li>
                    <li>مدارک ارسالی باید بدون هرگونه ویرایش و مخدوشی باشد</li>
                </ul>
                <a href="{{ route('faq') }}" class="btn btn-info round w-100">پرسش های متداول</a>
            </div>
        </div>
    </div>
@stop
