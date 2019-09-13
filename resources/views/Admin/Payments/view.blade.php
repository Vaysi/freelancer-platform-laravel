@extends('Admin.master')
@section('title','جزئیات درخواست')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">جزئیات درخواست</h3>
            <a href="{{ route('withdraws.index') }}" class="btn btn-default">بازگشت</a>
        </div>
        <form action="{{ route('withdraws.pay',['withdraw'=>$withdraw->id]) }}" method="post">
        <!-- /.card-header -->
            <div class="card-body">
                @csrf
                {{ method_field('PATCH') }}
                <div class="form-row">
                    <div class="form-group col-6">
                        <label>مبلغ واریز</label>
                        <input type="text" class="form-control-plaintext" readonly value="{{ money($withdraw->price) }}">
                    </div>
                    <div class="form-group col-6">
                        <label>شماره پیگیری</label>
                        <input type="text" class="form-control" name="refId" {{ $withdraw->status == 'pending' ? '' : 'readonly' }} value="{{ $withdraw->refId ?? '' }}">
                    </div>
                    <div class="form-group col-6">
                        <label>وضعیت</label>
                        <div>
                            {!! $withdraw->status == 'pending' ? '<span class="font-weight-bold text-warning">در انتظار پرداخت<span>' : ($withdraw->status == 'deposited' ? '<span class="font-weight-bold text-success">واریز شده</span>' : '<span class="font-weight-bold text-danger">لغو شده</span>') !!}
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label>علت لغو درخواست</label>
                        <input type="text" class="form-control" name="rejection_cause" value="{{ $withdraw->rejection_cause ?? '' }}">
                    </div>
                    <div class="form-group col-6">
                        <label>آیا اولین درخواست واریز این کاربر میباشد ؟</label>
                        <div>
                            @if($withdraw->user->withdraws()->where('status','deposited')->count())
                                <span class="text-secondary font-weight-bold">خیر</span>
                            @else
                                <span class="text-danger font-weight-bold">بله</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label>نام و نام خانوادگی صاحب حساب</label>
                        <div>
                            {{ $withdraw->account->first_name . ' ' . $withdraw->account->last_name }}
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label>شماره شبا</label>
                        <div>
                            {{ $withdraw->account->sheba }}
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label>شماره کارت</label>
                        <div>
                            {{ $withdraw->account->cart_number }}
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label>شماره حساب</label>
                        <div>
                            {{ $withdraw->account->number }}
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label>بانک</label>
                        <div>
                            {{ $withdraw->account->bank }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer d-flex justify-content-between">
                @if($withdraw->status == 'pending')
                    <button class="btn btn-success" name="pay" type="submit">اعلان واریز</button>
                @endif
                @if($withdraw->status != 'deposited')
                <button class="btn btn-danger" name="cancel" type="submit">لغو درخواست</button>
                @endif
            </div>
        </form>
    </div>
    <!-- /.card -->
@stop
@section('script')
    <script>
        $(function () {
            $("#datatable").DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Persian.json"
                },
                "info" : false,
            });
        });
    </script>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap4.css') }}">
@stop
