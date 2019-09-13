@extends('Admin.master')
@section('title','تنظیمات سایت')
@section('MainTitle','| تنظیمات سایت')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>تنظیمات سایت</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-project-tab" data-toggle="pill" href="#project" role="tab" aria-controls="project" aria-selected="true">تنظیمات پروژه و زیرمجموعه گیری</a>
                                <a class="nav-link" id="v-pills-payment-tab" data-toggle="pill" href="#payment" role="tab" aria-controls="payment" aria-selected="true">پنل پیامک و درگاه پرداخت</a>
                                <a class="nav-link" id="v-pills-general-tab" data-toggle="pill" href="#general" role="tab" aria-controls="general" aria-selected="true">کلی</a>
                                <a class="nav-link" id="v-pills-contact-tab" data-toggle="pill" href="#contact" role="tab" aria-controls="contact" aria-selected="true">تماس با ما</a>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="project" role="tabpanel" aria-labelledby="v-pills-project-tab">
                                    <form action="{{ route('settings.update') }}" method="post">
                                        @csrf
                                        <h5 class="mb-2">بخش قیمت پروژه ها</h5>
                                        <hr class="mb-2">
                                        <div class="form-group">
                                            <label for="normal">قیمت پروژه معمولی</label>
                                            <input type="number" min="0" step="500" placeholder="فقط عدد و به تومان وارد کنید" class="form-control" name="normal" id="normal" value="{{ old('normal') ?? option('normal') ?? ''  }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="private">قیمت پروژه خصوصی</label>
                                            <input type="number" min="1000" step="500" placeholder="فقط عدد و به تومان وارد کنید" class="form-control" name="private" id="private" value="{{ old('private') ?? option('private') ?? ''  }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="hidden">قیمت پروژه مخفی</label>
                                            <input type="number" min="1000" step="500" placeholder="فقط عدد و به تومان وارد کنید" class="form-control" name="hidden" id="hidden" value="{{ old('hidden') ?? option('hidden') ?? ''  }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="special">قیمت پروژه ویژه</label>
                                            <input type="number" min="1000" step="500" placeholder="فقط عدد و به تومان وارد کنید" class="form-control" name="special" id="special" value="{{ old('special') ?? option('special') ?? ''  }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="hire">قیمت پروژه استخدامی</label>
                                            <input type="number" min="1000" step="500" placeholder="فقط عدد و به تومان وارد کنید" class="form-control" name="hire" id="hire" value="{{ old('hire') ?? option('hire') ?? ''  }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="sticky">قیمت پروژه چسبنده</label>
                                            <input type="number" min="1000" step="500" placeholder="فقط عدد و به تومان وارد کنید" class="form-control" name="sticky" id="sticky" value="{{ old('sticky') ?? option('sticky') ?? ''  }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="urgent">قیمت پروژه فوری</label>
                                            <input type="number" min="1000" step="500" placeholder="فقط عدد و به تومان وارد کنید" class="form-control" name="urgent" id="urgent" value="{{ old('urgent') ?? option('urgent') ?? ''  }}">
                                        </div>
                                        <hr class="mt-2">
                                        <h5 class="mb-2">زیرمجموعه گیری</h5>
                                        <hr class="mb-2">
                                        <div class="form-group">
                                            <label for="first_fee">درصد سود از اولین پروژه کاربر معرفی شده</label>
                                            <input type="number" min="0" step="1" placeholder="فقط عدد و به درصد وارد کنید" class="form-control" name="first_fee" id="first_fee" value="{{ old('first_fee') ?? option('first_fee') ?? ''  }}">
                                            <span class="form-text text-mute small">این سود از سود شما از پروژه کسر میشود !</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="normal_fee">درصد سود از پروژه های بعدی کاربر معرفی شده</label>
                                            <input type="number" min="0" step="1" placeholder="فقط عدد و به درصد وارد کنید" class="form-control" name="normal_fee" id="normal_fee" value="{{ old('normal_fee') ?? option('normal_fee') ?? ''  }}">
                                            <span class="form-text text-mute small">این سود از سود شما از پروژه کسر میشود !</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="upgrade_fee">درصد سود از ارتقا پلن کاربر</label>
                                            <input type="number" min="0" step="1" placeholder="فقط عدد و به درصد وارد کنید" class="form-control" name="upgrade_fee" id="upgrade_fee" value="{{ old('upgrade_fee') ?? option('upgrade_fee') ?? ''  }}">
                                            <span class="form-text text-mute small">این سود از سود شما از پروژه کسر میشود !</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="fee_times">تعداد پروژه هایی که معرف میتواند از یک کاربر سود دریافت کند</label>
                                            <input type="number" min="0" step="1" placeholder="فقط عدد وارد کنید" class="form-control" name="fee_times" id="fee_times" value="{{ old('fee_times') ?? option('fee_times') ?? ''  }}">
                                        </div>
                                        <hr class="mt-2">
                                        <div class="form-group">
                                            <button class="btn btn-primary w-100" type="submit">ذخیره</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
                                    <form action="{{ route('settings.update') }}" method="post">
                                        @csrf
                                        <h5 class="mb-2">پنل پیامک</h5>
                                        <hr class="mb-2">
                                        <div class="form-group">
                                            <label for="sms_driver">درگاه پیامک</label>
                                            <select name="sms_driver" id="sms_driver" class="form-control">
                                                <option value="farazsms">فراز اسمس</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="sms_username">نام کاربری</label>
                                            <input type="text" class="ltr form-control" name="sms_username" id="sms_username" value="{{ old('sms_username') ?? option('sms_username') ?? ''  }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="sms_password">رمز عبور</label>
                                            <input type="text" class="ltr form-control" name="sms_password" id="sms_password" value="{{ old('sms_password') ?? option('sms_password') ?? ''  }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="sms_from">شماره ارسال کننده</label>
                                            <input type="text" class="ltr form-control" name="sms_from" id="sms_from" value="{{ old('sms_from') ?? option('sms_from') ?? ''  }}">
                                            <span class="form-text text-mute small">این شماره معمولا باید با +98 همراه باشد .</span>
                                        </div>
                                        <hr class="mt-5">
                                        <h5 class="mb-2">سرویس درگاه پرداخت</h5>
                                        <hr class="mt-3">
                                        <div class="form-group">
                                            <label for="payment_driver">درگاه پرداخت</label>
                                            <select name="payment_driver" id="payment_driver" class="form-control">
                                                <option value="zarinpal">زرین پال</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_merchant">مرچنت آی دی</label>
                                            <input type="text" class="ltr form-control" name="payment_merchant" id="payment_merchant" value="{{ old('payment_merchant') ?? option('payment_merchant') ?? ''  }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="min_payment">حداقل مبلغ پرداخت</label>
                                            <input type="number" class="ltr form-control" name="min_payment" id="min_payment" value="{{ old('min_payment') ?? option('min_payment') ?? ''  }}">
                                        </div>
                                        <hr class="mb-2">
                                        <div class="form-group">
                                            <button class="btn btn-primary w-100" type="submit">ذخیره</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="general" role="tabpanel" aria-labelledby="v-pills-general-tab">
                                    <form action="{{ route('settings.update') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="message_confirmation">تایید گفتگوی کاربران</label>
                                            <select name="message_confirmation" id="message_confirmation" class="form-control">
                                                <option value="1">بله</option>
                                                <option value="0" {{ option('message_confirmation') ? '' : 'selected' }}>خیر</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="raychat">کد رایچت</label>
                                            <textarea name="raychat" class="form-control ltr" id="raychat" rows="10">{{ old('raychat') ?? option('raychat') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="rules">قوانین سایت (صفحه قوانین)</label>
                                            <textarea name="rules" class="editor w-100" id="rules">{{ old('rules') ?? option('rules') }}</textarea>
                                        </div>
                                        <hr class="mb-2">
                                        <div class="form-group">
                                            <button class="btn btn-primary w-100" type="submit">ذخیره</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="v-pills-contact-tab">
                                    <form action="{{ route('settings.update') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="contact_text_1">متن شماره 1</label>
                                            <input type="text" class="form-control" name="contact_text_1" id="contact_text_1" value="{{ old('contact_text_1') ?? option('contact_text_1') ?? ''  }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_address">آدرس دفتر</label>
                                            <input type="text" class="form-control" name="contact_address" id="contact_address" value="{{ old('contact_address') ?? option('contact_address') ?? ''  }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_phone">تلفن</label>
                                            <textarea name="contact_phone" class="form-control" id="contact_phone" rows="5">{{ old('contact_phone') ?? option('contact_phone') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_email">ایمیل</label>
                                            <input type="text" class="ltr form-control" name="contact_email" id="contact_email" value="{{ old('contact_email') ?? option('contact_email') ?? ''  }}">
                                        </div>
                                        <hr class="mt-3">
                                        <h3 class="my-1">شبکه های اجتماعی</h3>
                                        <hr class="mb-3">
                                        <div class="form-group">
                                            <label for="contact_gplus">گوگل پلاس</label>
                                            <input type="text" class="ltr form-control" name="contact_gplus" id="contact_gplus" value="{{ old('contact_gplus') ?? option('contact_gplus') ?? ''  }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_linkedin">لینکدین</label>
                                            <input type="text" class="ltr form-control" name="contact_linkedin" id="contact_linkedin" value="{{ old('contact_linkedin') ?? option('contact_linkedin') ?? ''  }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_instagram">اینستاگرام</label>
                                            <input type="text" class="ltr form-control" name="contact_instagram" id="contact_instagram" value="{{ old('contact_instagram') ?? option('contact_instagram') ?? ''  }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_telegram">تلگرام</label>
                                            <input type="text" class="ltr form-control" name="contact_telegram" id="contact_telegram" value="{{ old('contact_telegram') ?? option('contact_telegram') ?? ''  }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_facebook">فیسبوک</label>
                                            <input type="text" class="ltr form-control" name="contact_facebook" id="contact_facebook" value="{{ old('contact_facebook') ?? option('contact_facebook') ?? ''  }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_twitter">توییتر</label>
                                            <input type="text" class="ltr form-control" name="contact_twitter" id="contact_twitter" value="{{ old('contact_twitter') ?? option('contact_twitter') ?? ''  }}">
                                        </div>
                                        <hr class="mt-3">
                                        <h3 class="my-1">نقشه</h3>
                                        <hr class="mb-3">
                                        <div class="form-group">
                                            <label for="contact_mapLat">عرض جغرافیایی (Latitude)</label>
                                            <input type="text" class="ltr form-control" name="contact_mapLat" id="contact_mapLat" value="{{ old('contact_mapLat') ?? option('contact_mapLat') ?? ''  }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_mapLong">طول جغرافیایی (Longitude)</label>
                                            <input type="text" class="ltr form-control" name="contact_mapLong" id="contact_mapLong" value="{{ old('contact_mapLong') ?? option('contact_mapLong') ?? ''  }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_mapText">متن روی نقشه</label>
                                            <input type="text" class="ltr form-control" name="contact_mapText" id="contact_mapText" value="{{ old('contact_mapText') ?? option('contact_mapText') ?? ''  }}">
                                        </div>
                                        <hr class="mt-3">
                                        <h3 class="my-1">فرم تماس</h3>
                                        <hr class="mb-3">
                                        <div class="form-group">
                                            <label for="contact_formEmail">ایمیل دریافت کننده فرم تماس</label>
                                            <input type="text" class="ltr form-control" name="contact_formEmail" id="contact_formEmail" value="{{ old('contact_formEmail') ?? option('contact_formEmail') ?? ''  }}">
                                        </div>
                                        <hr class="mb-2">
                                        <div class="form-group">
                                            <button class="btn btn-primary w-100" type="submit">ذخیره</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-left">
                    <nav class="d-inline-block">
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset("admin/plugins/ckeditor/ckeditor.js") }}"></script>
    <script src="{{ asset("admin/plugins/ckeditor/lang/fa.js") }}"></script>
    <script>
        $(function () {
            CKEDITOR.replace( document.querySelector('.editor') ,{
                language: 'fa',
            });
        });
    </script>
@endsection
