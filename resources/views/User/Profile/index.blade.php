@extends('User.master')
@section('content')
    <div class="col-9 pl-1">
        <div class="row">
            <div class="col-12 mb-3" id="emp_req">
                <div class="card custom">
                    <div class="card-title">
                        <span>ویرایش اطلاعات پایه</span>
                    </div>
                    <div class="card-body py-3">
                        <div class="col-11 mx-auto">
                            <form class="corner" action="{{ route('profile.update') }}" method="post">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">نام کامل</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ user()->name }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="email">ایمیل</label>
                                            <input type="email" class="form-control" disabled readonly id="email" value="{{ user()->email }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="password">کلمه عبور</label>
                                            <input type="password" class="form-control" name="password" id="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-outline-danger w-100">بروزرسانی</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-11 mx-auto mt-5 mb-3 text-center">
                            <button data-toggle="collapse" data-target="#phone" type="button" class="btn btn-outline-info btn-sm">شماره تلفن</button>
                        </div>
                        <div class="col-12 border rounded collapse py-3" id="phone">
                            <div class="form-group">
                                <div class="input-group mb-3" dir="ltr">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-primary" :disabled="busy == true" type="button" @click="sendCode">@{{ buttonCap }}</button>
                                    </div>
                                    <input type="text" class="form-control" dir="rtl" v-model="phone" :disabled="busy == true" :class="{'disabled': busy == true}"  placeholder="شماره موبایل خود را وارد کنید" aria-describedby="button-addon1">
                                </div>
                            </div>
                            <div class="form-group collapse" :class="{'show':nowVerify == true}">
                                <div class="input-group mb-3" dir="ltr">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-success" :disabled="busy == true" type="button" @click="verifyCode">بررسی کد</button>
                                    </div>
                                    <input type="text" class="form-control" dir="rtl" v-model="code" :disabled="busy == true" :class="{'disabled': busy == true}"  placeholder="کد دریافتی را وارد کنید" aria-describedby="button-addon1">
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
                <span> نکات قابل توجه</span>
            </div>
            <div class="card-body">
                <ul class="text-info px-3 small mb-0">
                    <li class="mb-2">رخدادهای سایت به وسیله ایمیل به اطلاع شما می رسد. پس لطفا یک ایمیل معتبر را وارد نمایید.</li>
                    <li>درج کامل و صحیح نام و نام خانوادگی برای انجام عملیات های بانکی ضروری است.</li>
                </ul>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        let app = new Vue({
            el:"#phone",
            data:{
                phone:'',
                sendCodeUrl : '{{ route('phone.verify') }}',
                verifyCodeUrl : '{{ route('phone.verify.final') }}',
                busy:false,
                nowVerify:false,
                code:'',
                waitForAnother:false,
                buttonCap:'ارسال کد',
            },
            methods:{
                sendCode(){
                    if(this.waitForAnother){
                        Swal.fire({"timer":5000,"text":"برای درخواست مجدد کد باید 60 ثانیه صبر کنید !","title":"خطا !","showConfirmButton":false,"type":"error"});
                    }else {
                        this.busy = true;
                        loading(true);
                        let app = this;
                        axios.post(this.sendCodeUrl,{
                            phone:app.phone
                        }).then((resp) => {
                            loading(false);
                            if(resp.data.status){
                                app.waitForAnother = true;
                                app.nowVerify = true;
                                app.busy=false;
                                // Countdown
                                let timeleft = 60;
                                let downloadTimer = setInterval(function(){
                                    timeleft--;
                                    app.buttonCap = ' ثانیه ' + timeleft;
                                    if(timeleft <= 0) {
                                        clearInterval(downloadTimer);
                                        app.waitForAnother = false;
                                        app.buttonCap = 'ارسال کد';
                                    }
                                },1000);
                            }else {
                                Swal.fire({"timer":5000,"text":resp.data.msg,"title":"خطا !","showConfirmButton":false,"type":"error"});
                            }
                        });
                    }
                },
                verifyCode(){
                    this.busy = true;
                    loading(true);
                    let app = this;
                    axios.post(this.verifyCodeUrl,{
                        code:app.code
                    }).then((resp) => {
                        loading(false);
                        if(resp.data.status){
                            Swal.fire({"timer":5000,"text":'شماره تلفن شما تایید شد !',"title":"تبریک !","showConfirmButton":false,"type":"success"});
                        }else {
                            Swal.fire({"timer":5000,"text":resp.data.msg,"title":"خطا !","showConfirmButton":false,"type":"error"});
                        }
                    });
                }
            }
        });
    </script>
@stop
