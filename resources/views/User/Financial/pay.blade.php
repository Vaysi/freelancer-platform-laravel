
@extends('User.master')
@section('content')
    <div class="col-9 pl-1">
        <div class="row">
            <div class="col-12 mb-3 projectList" id="newProject">
                <div class="card custom">
                    <div class="card-title">
                        <span>مبلغ قابل پرداخت</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('money.pay.online') }}" class="corner" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="price">مبلغ  </label>
                                <div class="input-group mb-1 w-50">
                                    <input type="number" class="form-control" name="amount" min="0" value="{{ is_null($amount) ? '0' : $amount }}" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-info text-white" id="basic-addon2">تومان</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <select name="account" id="account" class="selectpicker w-50 input-group-btn">
                                    <option value="zarinpal">زرین پال</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info w-50">پرداخت</button>
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
                <span>با همکاری بانک های زیر</span>
            </div>
            <div class="card-body">
                <div class="sticky-sidebar w-100 d-flex">
                    <div class="d-inline-block w-50 border-left">
                        <img src="https://parscoders.com/assets/admin/layout2/img/behpardakht_logo.jpg">
                    </div>
                    <div class="d-inline-block w-50 pr-1">
                        <img src="https://parscoders.com/assets/admin/layout2/img/saman_logo.jpg">
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
