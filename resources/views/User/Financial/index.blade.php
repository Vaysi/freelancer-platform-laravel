@extends('User.master')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-12 mb-3" id="financial_report">
                <div class="card custom">
                    <div class="card-title">
                        <span> گزارش مالی حساب شما</span>
                    </div>
                    <div class="card-body">
                        <div class="btn-gp text-center ">
                            <button class="btn btn-bright rounded-corner-3 btn-green py-3 px-4">
                                <span class="w-100 h-100 d-flex justify-content-start align-items-center ml-2">
                                    <span class="ml-1 counter">
                                        <small class="bg-white rounded-corner-3">{{ money(user()->balance,false) }}</small>
                                    </span>
                                    <small class="text-right mr-1"><span class="h5">تومان</span><br><small>موجودی شما</small></small>
                                </span>
                            </button>
                            <button class="btn btn-bright rounded-corner-3 btn-purple py-3 px-4 ml-2">
                                <span class="w-100 h-100 d-flex justify-content-start align-items-center">
                                    <span class="ml-1 counter">
                                        <span class="bg-white rounded-corner-3">{{ money(user()->payments()->whereType('release')->sum('price'),false) }}</span>
                                    </span>
                                    <small class="text-right mr-1"><span class="h5">تومان</span><br><small>درامد شما تا کنون</small></small>
                                </span>
                            </button>
                            <button class="btn btn-bright rounded-corner-3 btn-blue-2 py-3 px-4 ml-2">
                                <span class="w-100 h-100 d-flex justify-content-start align-items-center">
                                    <span class="ml-1 counter">
                                        <span class="bg-white rounded-corner-3">{{ money(user()->payments()->whereType('payment')->sum('price'),false) }}</span>
                                    </span>
                                    <small class="text-right mr-1"><span class="h5">تومان</span><br><small>واریزی شما به سایت</small></small>
                                </span>
                            </button>
                        </div>
                        <div class="my-3">
                            <ul class="nav nav-tabs" id="fin_tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="deposit-tab" data-toggle="tab" href="#deposit" role="tab" aria-controls="deposit" aria-selected="true">واریز به سایت</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="release-tab" data-toggle="tab" href="#release" role="tab" aria-controls="release" aria-selected="false">آزاد سازی</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pawn-tab" data-toggle="tab" href="#pawn" role="tab" aria-controls="pawn" aria-selected="false">گروگزاری ها</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="withdraw-tab" data-toggle="tab" href="#withdraw" role="tab" aria-controls="withdraw" aria-selected="false">برداشت از سایت</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="deposit" role="tabpanel" aria-labelledby="deposit-tab">
                                    <div class="table-responsive">
                                        <table class="table normal">
                                            <thead>
                                            <tr>
                                                <th scope="col" width="16%">شماره سند</th>
                                                <th scope="col" width="12%">زمان ثبت</th>
                                                <th scope="col" width="12%">بانک</th>
                                                <th scope="col" width="26%">توضیحات</th>
                                                <th scope="col" width="12%">شماره فیش</th>
                                                <th scope="col" width="12%">مبلغ</th>
                                                <th scope="col" width="10%">وضعیت</th>
                                            </tr>
                                            </thead>
                                            @php
                                                $payments = user()->payments()->latest()->whereType('payment')->paginate(25);
                                            @endphp
                                            <tbody>
                                                @foreach($payments as $payment)
                                                <tr>
                                                    <th scope="row"><small>{{ $payment->id }}</small></th>
                                                    <td>
                                                       <small>{{ jdate($payment->created_at)->format('d F H:i:s') }}</small>
                                                    </td>
                                                    <td>
                                                        <small>{{ $payment->bank ?? '-' }}</small>
                                                    </td>
                                                    <td>
                                                        <small>{{ $payment->message }}</small>
                                                    </td>
                                                    <td>
                                                        <small>{{ $payment->refId ?? 'پرداخت اعتباری' }}</small>
                                                    </td>
                                                    <td>
                                                        <small>{{ money($payment->price) }}</small>
                                                    </td>
                                                    <td class="text-center h5">
                                                        @if($payment->status)
                                                            <small class="text-success"><i class="fa fa-check-circle"></i></small>
                                                        @else
                                                            <small class="text-danger"><i class="fa fa-times-circle"></i></small>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <nav>
                                        {!! render($payments->render()) !!}
                                    </nav>
                                </div>
                                <div class="tab-pane fade" id="release" role="tabpanel" aria-labelledby="release-tab">
                                    <div class="table-responsive">
                                        <table class="table normal">
                                            <thead>
                                                <tr>
                                                    <th scope="col" width="16%">شماره پرداخت</th>
                                                    <th scope="col" width="20%">زمان ثبت</th>
                                                    <th scope="col" width="32%">پروژه</th>
                                                    <th scope="col" width="10%">درصد</th>
                                                    <th scope="col" width="12%">مبلغ</th>
                                                </tr>
                                                </thead>
                                                @php
                                                    $payments = user()->payments()->latest()->whereType('release')->paginate(25);
                                                @endphp
                                                <tbody>
                                                @foreach($payments as $payment)
                                                    <tr>
                                                        <th scope="row"><small>{{ $payment->id }}</small></th>
                                                        <td>
                                                            <small>{{ jdate($payment->created_at)->format('d F H:i:s') }}</small>
                                                        </td>
                                                        <td>
                                                            <small>{{ $payment->message }}</small>
                                                        </td>
                                                        <td>
                                                            <small>{{ $payment->percent }}</small>
                                                        </td>
                                                        <td>
                                                            <small>{{ money($payment->price) }}</small>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <nav>
                                        {!! render($payments->render()) !!}
                                    </nav>
                                </div>
                                <div class="tab-pane fade" id="pawn" role="tabpanel" aria-labelledby="pawn-tab">
                                    <div class="table-responsive">
                                        <table class="table normal">
                                            <thead>
                                            <tr>
                                                <th scope="col" width="16%">شماره پرداخت</th>
                                                <th scope="col" width="20%">زمان ثبت</th>
                                                <th scope="col" width="32%">پروژه</th>
                                                <th scope="col" width="10%">درصد</th>
                                                <th scope="col" width="12%">مبلغ</th>
                                            </tr>
                                            </thead>
                                            @php
                                                $payments = user()->payments()->latest()->whereType('deposit')->paginate(25);
                                            @endphp
                                            <tbody>
                                            @foreach($payments as $payment)
                                                <tr>
                                                    <th scope="row"><small>{{ $payment->id }}</small></th>
                                                    <td>
                                                        <small>{{ jdate($payment->created_at)->format('d F H:i:s') }}</small>
                                                    </td>
                                                    <td>
                                                        <small>{{ $payment->message }}</small>
                                                    </td>
                                                    <td>
                                                        <small>{{ $payment->percent }}</small>
                                                    </td>
                                                    <td>
                                                        <small>{{ money($payment->price) }}</small>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <nav>
                                        {!! render($payments->render()) !!}
                                    </nav>
                                </div>
                                <div class="tab-pane fade" id="withdraw" role="tabpanel" aria-labelledby="withdraw-tab">
                                    <div class="alert alert-info my-2">
                                        <span>با توجه به انجام واریز ها با حواله پایا، وجه چند ساعت بعد از واریز به حساب شما منتقل می گردد.</span>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table normal">
                                            <thead>
                                            <tr>
                                                <th scope="col">شماره سند</th>
                                                <th scope="col">زمان ثبت</th>
                                                <th scope="col">بانک</th>
                                                <th scope="col">شماره فیش</th>
                                                <th scope="col">تاریخ واریز</th>
                                                <th scope="col">مبلغ</th>
                                                <th scope="col">وضعیت</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $withdraws = user()->withdraws()->latest()->paginate(25);
                                            @endphp
                                            @foreach($withdraws as $withdraw)
                                                <tr>
                                                    <th scope="row"><small>{{ $withdraw->id }}</small></th>
                                                    <td>
                                                        <small>{{ jdate($withdraw->created_at)->format('d F H:i:s') }}</small>
                                                    </td>
                                                    <td>
                                                        <small>{{ $withdraw->bank }}</small>
                                                    </td>
                                                    <td>
                                                        <small>{{ $withdraw->refId ?? '-' }}</small>
                                                    </td>
                                                    <td>
                                                        <small>{{ $withdraw->deposited_at ? jdate($withdraw->deposited_at)->format('d F H:i:s') : '-' }}</small>
                                                    </td>
                                                    <td>
                                                        <small>{{ money($withdraw->price) }}</small>
                                                    </td>
                                                    <td class="text-center h5">
                                                        @if($withdraw->status == 'deposited')
                                                            <small class="text-success" data-toggle="tooltip" data-placement="top" title="با موفقیت واریز شد !"><i class="fa fa-check-circle"></i></small>
                                                        @elseif($withdraw->status == 'pending')
                                                            <small class="text-warning" data-toggle="tooltip" data-placement="top" title="در انتظار واریز و تایید !"><i class="fa fa-clock-o"></i></small>
                                                        @else
                                                            <small class="text-danger" data-toggle="tooltip" data-placement="top" title="رد شد !"><i class="fa fa-close"></i></small>
                                                            @if($withdraw->rejection_cause)
                                                                <br>
                                                                <button class="btn btn-sm btn-danger" data-toggle="popover" data-trigger="hover" data-placement="top" data-container="body" data-content="{{ $withdraw->rejection_cause }}">علت رد شدن</button>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <nav>
                                        {!! render($withdraws->render()) !!}
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(function () {
            $("[data-toggle]").popover();
        });
    </script>
@stop
