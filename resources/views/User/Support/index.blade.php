@extends('User.master')
@section('content')
    <div class="col-9 pl-1">
        <div class="row">
            <div class="col-12 mb-3" id="emp_req">
                <div class="card custom">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <span>درخواست های پشتیبانی </span>
                        <a href="{{ route('support.create') }}" class="btn btn-danger rounded-corner-3">تیکت جدید</a>
                    </div>
                    <div class="card-body">
                        @if($tickets->count())
                            <div class="table-responsive">
                                <table class="table normal">
                                    <thead>
                                    <tr class="text-center">
                                        <th scope="col" width="5%">#</th>
                                        <th class="text-right" scope="col" width="40%">عنوان</th>
                                        <th scope="col" width="20%"> نوع درخواست</th>
                                        <th scope="col" width="20%">زمان درخواست</th>
                                        <th scope="col" width="5%">وضعیت</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tickets as $ticket)
                                        <tr>
                                            <th scope="row">
                                                {{ $loop->iteration }}
                                            </th>
                                            <td class="small">
                                                <a href="{{ $ticket->link() }}" class="text-info small">
                                                    {{ $ticket->title }}
                                                </a>
                                            </td>
                                            <td class="text-center small">
                                                {!! ticket_type($ticket) !!}
                                            </td>
                                            <td class="text-center small">
                                                <span>{{ jdate($ticket->created_at)->format('d F Y - h:i:s') }}</span>
                                            </td>
                                            <td class="small text-center">
                                                {!! ticket_status($ticket) !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-warning rounded-corner-2-half">شما هیچ تیکت پشتیبانی در وبسایت ندارید !</div>
                        @endif
                        <nav>
                            {!! render($tickets->render()) !!}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 pr-1">
        <div class="card custom sticky-sidebar">
            <div class="card-title">
                <span> تعداد درخواست ها </span>
            </div>
            <div class="card-body text-center" >
                <div style="height: 70px;" class="d-flex justify-content-center align-items-center font-weight-bold text-info">
                    <span>{{ $tickets->count() }} درخواست</span>
                </div>
                <a href="{{ route('faq') }}" class="btn btn-info round mt-2">پرسش های متداول</a>
            </div>
        </div>
    </div>
@stop
