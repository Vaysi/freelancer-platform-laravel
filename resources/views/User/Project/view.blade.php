@extends('User.master')
@section('page',$project->title)
@section('content')
    <div class="col-8 pl-1">
        <div class="row">
            <div class="col-12 mb-3" id="projectDetails">
                <div class="card custom">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <span>{{ limit($project->title) }}</span>
                        <span class="bg-transparent small">
                            <span class="text-danger">
                                دسته بندی :
                            </span>
                            @foreach($project->skills()->take(4)->get() as $skill)
                                <a href="{{ $skill->link() }}" class="text-dark">{{ $skill->name }}</a>
                                @if(!$loop->last)
                                    /
                                @endif
                            @endforeach
                        </span>
                    </div>
                    <hr class="my-0 mb-2">
                    <div class="card-body">
                        <div class="d-flex">
                            <a href="{{ route('resume.view',['user'=>$project->user->id]) }}">
                                <img src="{{ $project->user->avatar }}" class="avatarSpec img-thumbnail">
                            </a>
                            <div class="mr-2 pt-2">
                                <a href="{{ route('resume.view',['user'=>$project->user->id]) }}" class="text-dark-3 d-block">
                                    <span class="font-weight-bold">{{ $project->user->name() }}</span>
                                </a>
                                <span class="d-block">امتیاز : {{ $project->user->points }}</span>
                                <span class="d-block">پروژه های موفق : <span>{{ $project->user()->first()->successfulProjects() }}</span> از <span>{{ $project->user()->first()->allProjects() }}</span></span>
                            </div>
                        </div>
                        <div class="projectContent text-justify py-2">
                            <p style="text-align:right;">{!! $project->content !!}</p>
                        </div>
                        @if($project->files()->count())
                            <div class="alert alert-yellow rounded-corner-5">
                                <div class="row row-eq-height">
                                    <div class="col-2 icon display-4 text-center">
                                        <i class="fa fa-exclamation"></i>
                                    </div>
                                    <div class="col-10">
                                        <span class="bold h6">فایل ضمیمه</span>
                                        <p>این پروژه شامل <span>{{ $project->files()->count() }}</span>	فایل مهم می باشد، لطفا قبل از ارسال پیشنهاد حتما نسبت به بررسی این فایل اقدام فرمایید.</p>
                                        @foreach($project->files()->get() as $file)
                                            <div class="mb-1">
                                                <a href="{{ $file->link() }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="{{ humanSize($file->size,true) }}"><i class="fa fa-download"></i> <span class="ltr">{{ $file->id }}.{{ $file->type }}</span></a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        <hr class="mb-2 mt-2">
                        <div class="d-flex text-secondary justify-content-between small">
                            <span>زمان تایید: {{ $project->confirmed_at ? jdate($project->confirmed_at)->format('Y/m/d H:i:s') : '-' }}</span>
                            <span>زمان خاتمه مناقصه: {{ $project->expires_at ? jdate($project->expires_at)->format('Y/m/d H:i:s') : '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12">
                <div class="card custom">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <span>پیشنهاد ها</span>
                        <span class="bg-transparent text-danger">
                            تا کنکون <span>{{ $project->offers()->count() }}</span> پیشنهاد ارسال شده
                        </span>
                    </div>
                    <div class="card-body pt-4">
                        @if(!$project->isEmployer() && $project->status == 'open')
                            <div class="mb-4 text-center">
                                <a href="{{ route('conversations.fte',['project'=>$project->id]) }}" class="btn btn-gradient-primary rounded-half blinker"><i class="fa fa-send"></i> ارسال پیشنهاد / پیام</a>
                            </div>
                        @endif
                        @forelse($project->offers()->get() as $offer)
                        <div class="offer mb-3 rounded-half d-flex p-2 align-items-center position-relative">
                            @if($project->isFinalOffer($offer))
                                <div class="marker-overlay">
                                    <span class="top-right marker">پذیرفته شده</span>
                                </div>
                            @endif
                            <div class="avatar pointer" data-toggle="redirect" data-url="{{ route('resume.view',['user'=>$offer->user->id]) }}">
                                <img src="{{ $offer->user->avatar }}" class="rounded-circle">
                            </div>
                            <span class="bg-secondary-3 rounded-half px-2 mx-2 pointer" data-toggle="redirect" data-url="{{ route('resume.view',['user'=>$offer->user->id]) }}">{{ $offer->user->name() }}</span>
                            <div class="mx-2 info small">
                                <span class="d-block">امتیاز {{ $offer->user->points }}</span>
                                <span class="d-block">پروژه موفق : {{ $offer->user()->first()->successfulProjects() }}</span>
                                <span class="d-block">رتبه: {{ $offer->user->score }}</span>
                                <span class="d-block">{{ jdate($offer->created_at)->ago() }}</span>
                            </div>
                            @if($project->isEmployer() || $offer->user->isMe())
                            <div class="mx-2" style="width: 40%;">
                                <p class="m-0">{{ limit($offer->content) }}</p>
                                <br>
                                <span class="font-weight-bold m-0 bg-secondary-3 rounded-half px-2">{{ money($offer->price) }} <small>در <span>{{ $offer->deadline }} روز</span></small></span>
                                <a href="{{ $project->isEmployer() ? route('conversations.etf',['project'=>$project->id,'user'=>$offer->user->id]) : route('conversations.fte',['project'=>$project->id]) }}" class="btn btn-sm btn-danger round mr-1"><i class="fa fa-list"></i> گفتگو </a>
                            </div>
                            @endif
                            <div class="plan text-center mr-auto ml-2">
                                <img width="75" src="{{ $offer->user()->first()->package()->icon }}">
                                <span class="text-{{ $offer->user()->first()->package()->colorSecond }} font-weight-bold d-block">{{ $offer->user()->first()->package()->name }}</span>
                            </div>
                        </div>
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12">
                <div class="card custom">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <span>پیام های بدون پیشنهاد</span>
                        <span class="bg-transparent text-danger">
                            تا کنکون <span>{{ $project->userSentMessages()->count() }}</span> پیام بدون پیشنهاد ارسال شده
                        </span>
                    </div>
                    <div class="card-body pt-4">
                        @forelse($project->userSentMessages() as $user)
                            <div class="offer mb-3 rounded-half d-flex p-2 align-items-center">
                                <div class="avatar">
                                    <img src="{{ $user->avatar }}" class="rounded-circle">
                                </div>
                                <span class="bg-secondary-3 rounded-half px-2 mx-2">{{ $user->name() }}</span>
                                <div class="mx-2 info small">
                                    <span class="d-block">امتیاز {{ $user->points }}</span>
                                    <span class="d-block">پروژه موفق : {{ $user->successfulProjects() }}</span>
                                    <span class="d-block">رتبه: {{ $user->score }}</span>
                                </div>
                                @if($project->isEmployer() || $user->isMe())
                                    <div class="mx-2" style="width: 40%;">
                                        <a href="{{ $project->isEmployer() ? route('conversations.etf',['project'=>$project->id,'user'=>$user->id]) : route('conversations.fte',['project'=>$project->id]) }}" class="btn btn-sm btn-danger round mr-1"><i class="fa fa-list"></i> گفتگو </a>
                                    </div>
                                @endif
                                <div class="plan text-center mr-auto ml-2">
                                    <img width="75" src="{{ asset('images/plan/gold.png') }}">
                                    <span class="text-warning font-weight-bold d-block">فریلنسر طلایی</span>
                                </div>
                            </div>
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('User.Project.sidebar')
@stop
@section('js')
    <script>
        $(function () {
            let isEmpty = $("#buttons .card-body").text().trim().length;
            if(isEmpty < 2){
                $("#buttons").hide();
            }
        });
    </script>
@stop
