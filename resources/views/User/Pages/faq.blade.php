@extends('User.master')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-12 mb-3" id="faq">
                <div class="card custom">
                    <div class="card-title">
                        <span>پاسخ بسیاری از پرسش های شما اینجاست</span>
                    </div>
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-3">
                                <div class="list-group" id="list-tab" role="tablist">
                                    <a class="list-group-item list-group-item-action active" id="list-employer-list" data-toggle="list" href="#list-employer" role="tab" aria-controls="employer">
                                        <span class="icon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <span class="title">
                                            پرسش های خریداران
                                            <span class="arrow float-left"><i class="fa fa-angle-double-left"></i></span>
                                        </span>
                                    </a>
                                    <a class="list-group-item list-group-item-action" id="list-freelancer-list" data-toggle="list" href="#list-freelancer" role="tab" aria-controls="freelancer">
                                        <span class="icon">
                                            <i class="fa fa-users"></i>
                                        </span>
                                        <span class="title">
                                            پرسش های مجریان
                                            <span class="arrow float-left"><i class="fa fa-angle-double-left"></i></span>
                                        </span>
                                    </a>
                                    <a class="list-group-item list-group-item-action" id="list-financial-list" data-toggle="list" href="#list-financial" role="tab" aria-controls="financial">
                                        <span class="icon">
                                            <i class="fa fa-money"></i>
                                        </span>
                                        <span class="title">
                                            موارد مالی
                                            <span class="arrow float-left"><i class="fa fa-angle-double-left"></i></span>
                                        </span>
                                    </a>
                                    <a class="list-group-item list-group-item-action" id="list-others-list" data-toggle="list" href="#list-others" role="tab" aria-controls="others">
                                        <span class="icon">
                                            <i class="fa fa-info"></i>
                                        </span>
                                        <span class="title">
                                            متفرقه
                                            <span class="arrow float-left"><i class="fa fa-angle-double-left"></i></span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="list-employer" role="tabpanel" aria-labelledby="list-employer-list">
                                        <div class="accordion" id="accordionExample">
                                            @foreach(\App\Question::whereType('faq')->whereLocation('employer')->get() as $faq)
                                                <div class="card mb-2 rounded-half">
                                                    <div class="card-header rounded-half d-flex justify-content-between align-items-center align-items-center" id="heading{{ $faq->id }}">
                                                        <h4 class="mb-0">
                                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $faq->id }}" aria-expanded="true" aria-controls="collapse{{ $faq->id }}">
                                                                {{ $faq->title }}
                                                            </button>
                                                        </h4>
                                                        <h5 class="text-dark-2 mb-0"><i class="fa fa-chevron-down"></i></h5>
                                                    </div>

                                                    <div id="collapse{{ $faq->id }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <p>{!! $faq->content !!}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="list-freelancer" role="tabpanel" aria-labelledby="list-freelancer-list">
                                        <div class="accordion" id="freelancer">
                                            @foreach(\App\Question::whereType('faq')->whereLocation('freelancer')->get() as $faq)
                                                <div class="card mb-2 rounded-half">
                                                    <div class="card-header rounded-half d-flex justify-content-between align-items-center align-items-center" id="heading{{ $faq->id }}">
                                                        <h4 class="mb-0">
                                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $faq->id }}" aria-expanded="true" aria-controls="collapse{{ $faq->id }}">
                                                                {{ $faq->title }}
                                                            </button>
                                                        </h4>
                                                        <h5 class="text-dark-2 mb-0"><i class="fa fa-chevron-down"></i></h5>
                                                    </div>

                                                    <div id="collapse{{ $faq->id }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <p>{!! $faq->content !!}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="list-financial" role="tabpanel" aria-labelledby="list-financial-list">
                                        <div class="accordion" id="financial">
                                            @foreach(\App\Question::whereType('faq')->whereLocation('financial')->get() as $faq)
                                                <div class="card mb-2 rounded-half">
                                                    <div class="card-header rounded-half d-flex justify-content-between align-items-center align-items-center" id="heading{{ $faq->id }}">
                                                        <h4 class="mb-0">
                                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $faq->id }}" aria-expanded="true" aria-controls="collapse{{ $faq->id }}">
                                                                {{ $faq->title }}
                                                            </button>
                                                        </h4>
                                                        <h5 class="text-dark-2 mb-0"><i class="fa fa-chevron-down"></i></h5>
                                                    </div>

                                                    <div id="collapse{{ $faq->id }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <p>{!! $faq->content !!}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="list-others" role="tabpanel" aria-labelledby="list-others-list">
                                        <div class="accordion" id="others">
                                            @foreach(\App\Question::whereType('faq')->whereLocation('other')->get() as $faq)
                                                <div class="card mb-2 rounded-half">
                                                    <div class="card-header rounded-half d-flex justify-content-between align-items-center align-items-center" id="heading{{ $faq->id }}">
                                                        <h4 class="mb-0">
                                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $faq->id }}" aria-expanded="true" aria-controls="collapse{{ $faq->id }}">
                                                                {{ $faq->title }}
                                                            </button>
                                                        </h4>
                                                        <h5 class="text-dark-2 mb-0"><i class="fa fa-chevron-down"></i></h5>
                                                    </div>

                                                    <div id="collapse{{ $faq->id }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <p>{!! $faq->content !!}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
