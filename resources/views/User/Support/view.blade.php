@extends('User.master')
@section('page',$ticket->title)
@section('content')
    <div class="col-8 pl-1">
        <div class="row">
            <div class="col-12 mb-3" id="tickets">
                <div class="card custom">
                    <div class="card-title">
                        <span>
                            {!! ticket_type($ticket,false,true) !!}
                            {{ $ticket->title }}
                        </span>
                    </div>
                    <hr class="my-0 mb-2">
                    <div class="card-body mt-3" id="messages">
                        <div class="item {{ $ticket->isFromMe() }} mb-5" id="msg1">
                            <div class="avatar">
                                <img src="{{ $ticket->user->avatar }}" class="rounded-circle img-thumbnail img-fluid">
                            </div>
                            <div class="content {{ $ticket->isFromMe() }}">
                                <div class="wrapper px-4 py-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ $ticket->user->resumeLink() }}">{{ $ticket->user->name() }}</a>
                                        <span class="small text-secondary" data-toggle="tooltip" data-placement="top" title="{{ jdate($ticket->created_at)->format('Y/m/d H:i:s') }}">{{ jdate($ticket->created_at)->ago() }}</span>
                                    </div>
                                    <div class="pt-4 pb-2">
                                        {!! justBr($ticket->content)  !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($ticket->conversations()->count())
                            @foreach($ticket->conversations() as $conversation)
                                <div class="item {{ $conversation->isFromMe() }} mb-5" id="msg{{ $conversation->id }}">
                                    <div class="avatar">
                                        <img src="{{ $conversation->user->avatar }}" class="rounded-circle img-thumbnail img-fluid">
                                    </div>
                                    <div class="content {{ $conversation->isFromMe() }}">
                                        <div class="wrapper px-4 py-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="{{ $conversation->user->resumeLink() }}">{{ $conversation->user->name() }}</a>
                                                <span class="small text-secondary" data-toggle="tooltip" data-placement="top" title="{{ jdate($conversation->created_at)->format('Y/m/d H:i:s') }}">{{ jdate($conversation->created_at)->ago() }}</span>
                                            </div>
                                            <div class="pt-4 pb-2">
                                                {!! justBr($conversation->message)  !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <h6>دریافت کنندگان :</h6>
                        <div class="row mb-2">
                            @if(optional($ticket->target)->id && user()->id != optional($ticket->target)->id)
                                <div class="col-12">
                                    <input type="checkbox" name="receiver" value="target" class="toggle color-primary has-animation" checked> {{ $ticket->target->nicky }}
                                </div>
                            @endif
                            @if(optional($ticket->user)->id && user()->id != optional($ticket->user)->id)
                                <div class="col-12">
                                    <input type="checkbox" name="receiver" value="user" class="toggle color-primary has-animation" checked> {{ $ticket->user->nicky }}
                                </div>
                            @endif
                            @if(!user()->admin)
                                <div class="col-12">
                                    <input type="checkbox" class="toggle color-primary has-animation disabled" disabled checked> {{ optional($ticket->judge)->nicky ?? 'پشتیبان پارسکدرز' }}
                                </div>
                            @endif
                        </div>
                        <form action="{{ route('support.send',$ticket->id) }}" class="corner mt-2" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="message" class="form-label">پیام</label>
                                <textarea type="text" name="message" class="form-control" id="message" rows="5">{{ old('message') }}</textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-outline-info w-100">ارسال پیام</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4 pr-1">
        <div class="sticky-sidebar">
            <div class="card custom" id="quick">
                <div class="card-title d-flex justify-content-between align-items-center">
                    <span>
                        {!! ticket_type($ticket,false,true) !!}
                        سایر اطلاعات
                    </span>
                </div>
                <div class="card-body px-2 pt-3">
                    <div class="item d-flex justify-content-between border-bottom small pb-2 mb-2">
                        <span>
                            <span class="icon text-danger small"><i class="fa fa-chevron-left"></i></span>
                            <span>آغاز درخواست : </span>
                        </span>
                        <span>{{ jdate($ticket->created_at)->format('d F Y - H:i:s') }}</span>
                    </div>
                    <div class="item d-flex justify-content-between border-bottom small pb-2 mb-2">
                        <span>
                            <span class="icon text-danger small"><i class="fa fa-chevron-left"></i></span>
                            <span>نوع درخواست</span>
                        </span>
                        <span>{{ ticket_type($ticket,false) }}</span>
                    </div>
                    @if(optional(optional($ticket->project)->finalOffer())->deadline)
                        <div class="item d-flex justify-content-between border-bottom small pb-2 mb-2">
                        <span>
                            <span class="icon text-danger small"><i class="fa fa-chevron-left"></i></span>
                            <span>مهلت اولیه</span>
                        </span>
                            <span>{{ optional(optional($ticket->project)->finalOffer())->deadline }} روز </span>
                        </div>
                    @endif
                    @if(optional($ticket->project)->id)
                        @php
                            $done = $ticket->project->conversations()->where('done',1)->first();
                            $date = optional($done)->id ? jdate($done->created_at)->format('d F Y - H:i:s') : '';
                        @endphp
                        <div class="item d-flex justify-content-between border-bottom small pb-2 mb-2">
                        <span>
                            <span class="icon text-danger small"><i class="fa fa-chevron-left"></i></span>
                            <span>زمان تحویل کار</span>
                        </span>
                            <span>{{ $date }} </span>
                        </div>
                    @endif
                    <div class="item d-flex justify-content-between border-bottom small pb-2 mb-2">
                        <span>
                            <span class="icon text-danger small"><i class="fa fa-chevron-left"></i></span>
                            <span>وضعیت</span>
                        </span>
                        <span class="bg-secondary-3 px-2 rounded-half">{{ ticket_status($ticket,false) }}</span>
                    </div>
                    @if(optional($ticket->project)->id)
                    <div class="progress mt-3 rounded-half">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ project_status($ticket->project,false,true) }}%" aria-valuenow="{{ project_status($ticket->project,false,true) }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="text-center text-dark-3 my-2 ">{{ project_status($ticket->project,false) }}</div>
                    @endif
                    <h6 class="mt-3">حاضران :</h6>
                    <ul>
                        <li><a href="{{ route('resume.view',$ticket->user->id) }}">{{ $ticket->user->nicky }}</a></li>
                        @if(optional($ticket->target)->id)
                        <li><a href="{{ route('resume.view',$ticket->target->id) }}">{{ $ticket->target->nicky }}</a></li>
                        @endif
                        @if(optional($ticket->judge)->id)
                            <li>{{ $ticket->judge->nicky }}</li>
                        @endif
                    </ul>
                    @if(user()->admin)
                        @if(!boolval($ticket->target_id) && $ticket->type == 'judgement')
                            <a href="{{ route('support.action',[$ticket->id,'invite']) }}" class="btn btn-outline-primary round mt-2 w-100">دعوت طرف دعوی به تیکت</a>
                        @endif
                        @if($ticket->status != 'closed')
                            <a href="{{ route('support.action',[$ticket->id,'close']) }}" class="btn btn-outline-danger round mt-2 w-100">بستن تیکت</a>
                        @endif
                    @endif
                    <a href="{{ route('faq') }}" class="btn btn-info round mt-2 w-100">پرسش های متداول</a>
                </div>
            </div>
        </div>
    </div>
@stop
