
@extends('User.master')
@section('content')
    <div class="col-3 pl-1">
        <div class="row">
            <div class="col-12 mb-3" id="addAccount">
                <div class="card custom">
                    <div class="card-title">
                        <span>مدیریت شماره حساب ها</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('money.store') }}" method="post" class="corner">
                            @csrf
                            <div class="form-group">
                                <label for="first_name">نام صاحب حساب :</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}" aria-describedby="first_name">
                            </div>
                            <div class="form-group">
                                <label for="last_name">نام خانوادگی صاحب حساب :</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}" aria-describedby="last_name">
                            </div>
                            <div class="form-group">
                                <label for="sheba">شماره شبا :</label>
                                <input type="text" class="form-control" name="sheba" id="sheba" value="{{ old('sheba') }}" aria-describedby="sheba">
                            </div>
                            <div class="form-group">
                                <label for="number">شماره حساب :</label>
                                <input type="text" class="form-control" name="number" id="number" value="{{ old('number') }}" aria-describedby="number">
                            </div>
                            <div class="form-group">
                                <label for="cart_number">شماره کارت :</label>
                                <input type="text" class="form-control" name="cart_number" id="cart_number" value="{{ old('cart_number') }}" aria-describedby="cart_number">
                            </div>
                            <div class="form-group">
                                <label for="bank">بانک :</label>
                                <select name="bank" id="bank" class="selectpicker w-100">
                                    <option value="ملت">ملت</option>
                                    <option value="ملی">ملی</option>
                                    <option value="پارسیان">پارسیان</option>
                                    <option value="پاسارگاد">پاسارگاد</option>
                                    <option value="ایران زمین">ایران زمین</option>
                                    <option value="آینده">آینده</option>
                                    <option value="شهر">شهر</option>
                                    <option value="قوامین">قوامین</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="w-100 btn-info btn">افزودن حساب</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 px-1">
        <div class="row">
            <div class="col-12 mb-3" id="myAccounts">
                <div class="card custom">
                    <div class="card-title">
                        <span>شماره حساب های ثبت شده</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table normal round">
                                <thead>
                                <tr>
                                    <th scope="col" width="10%">#</th>
                                    <th scope="col">صاحب حساب</th>
                                    <th scope="col">بانک</th>
                                    <th scope="col">اطلاعات حساب</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(user()->accounts()->latest()->get() as $account)
                                    <tr>
                                        <th scope="row"><small>{{ $loop->iteration }}</small></th>
                                        <td>
                                            <small>{{ $account->first_name . ' ' . $account->last_name }}</small>
                                        </td>
                                        <td>
                                            <small>{{ $account->bank }}</small>
                                        </td>
                                        <td>
                                            <span class="font-weight-bold"> شماره شبا :</span><small> {{ $account->sheba }} </small><br>
                                            <span class="font-weight-bold"> شماره حساب :</span><small> {{ $account->number }} </small><br>
                                            <span class="font-weight-bold"> شماره کارت :</span><small> {{ $account->cart_number }} </small><br>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 pr-1">
        <div class="row">
            <div class="col-12 mb-3" id="help">
                <div class="card custom">
                    <div class="card-title">
                        <span>نکته های مهم</span>
                    </div>
                    <div class="card-body">
                        <ul class="text-danger small pr-3">
                            <li>شماره حساب های وارد شده قابل حذف نیست.</li>
                            <li>شما می توانید به تعداد دلخواه شماره حساب داشته باشید.</li>
                            <li>اولین درخواست پرداخت نیازمند تاییده تلفنی است.</li>
                        </ul>
                        <a href="#" class="btn btn-info rounded-corner-2">پاسخ به پرسش های متداول</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
