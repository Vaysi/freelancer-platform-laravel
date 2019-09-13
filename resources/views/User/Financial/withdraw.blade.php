
@extends('User.master')
@section('content')
    <div class="col-9 pl-1">
        <div class="row">
            <div class="col-12 mb-3 projectList" id="newProject">
                <div class="card custom">
                    <div class="card-title">
                        <span>درخواست واریز</span>
                    </div>
                    <div class="card-body">
                        <h5 class="text-dark-2 font-weight-bold mt-3">برداشت وجه از حساب کاربری</h5>
                        <p class="text-secondary">جهت ثبت درخواست واریز وجه به حساب بانکی شما بر روی دکمه زیر کلیک کنید. توجه نمایید که واریز ها از طریق حواله
                            <a href="#" class="text-info">پایا</a> و حداکثر تا 48 ساعت پس (روزهای کاری) از ثبت درخواست انجام خواهد شد.</p>
                        <form action="{{ route('money.withdraw.store') }}" class="corner" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="price">مبلغ درخواستی <span class="text-danger font-weight-bold">تومان</span> :</label>
                                <div class="input-group mb-1 w-50">
                                    <input type="number" name="price" id="price" value="{{ user()->balance }}" class="form-control" min="5000" max="{{ user()->balance }}"  aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-info text-white" id="basic-addon2">تومان</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <select name="account_id" id="account_id" class="selectpicker w-50 input-group-btn">
                                    @foreach(user()->accounts()->get() as $account)
                                        <option value="{{ $account->id }}">{{ $account->first_name . ' ' . $account->last_name }} ({{ $account->cart_number }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info w-50">ثبت درخواست</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 pr-1">
        <div class="card custom sticky-sidebar">
            <div class="card-title text-center">
                <span>موجودی حساب شما</span>
            </div>
            <div class="card-body">
                <div class="sticky-sidebar w-100">
                    <div class="btn-gp text-center">
                        <button class="btn btn-bright rounded-corner-2 p-3 btn-green no_arrow w-100" data-toggle="redirect" data-url="{{ route('money.index') }}">
                            <span class="counter" style="width: fit-content">
                                <small class="bg-white rounded-corner-2 mx-auto px-3" style="width: fit-content">{{ money(user()->balance,false) }}</small>
                            </span>
                            <span class="d-block">تومان موجودی</span>
                            <small class="d-block"><small>مشاهده گزارش مالی</small></small>
                        </button>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('money.edit') }}" class="btn btn-info rounded-corner-2 w-100">ویرایش شماره حساب ها</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
