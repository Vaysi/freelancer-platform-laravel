@extends('User.master')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-12 mb-3" id="resume">
                <div class="card custom">
                    <div class="card-title">
                        <span>مشاهده پروفایل {{ $user->name() }}</span>
                    </div>
                    <div class="card-body pt-3">
                        <div class="row row-eq-height">
                            <div class="col-3">
                                <div id="info" class="text-center pt-4">
                                    <img {!! $user->id == auth()->id() ? 'data-toggle="redirect" data-url="' . route('avatar') . '"' : '' !!} src="{{ $user->avatar }}" id="avatar" class="img-thumbnail rounded-circle w-50 {{ $user->id == auth()->id() ? 'pointer' : '' }}">
                                    <span class="my-3 text-dark-2 d-block">{{ $user->name() }}</span>
                                    <span class="d-block text-shadow-danger mb-3 small">رتبه : {{ $user->score }}</span>
                                    @if($user->id != auth()->id())
                                        <a href="{{ route('invite.user',['user'=>$user->id]) }}" class="btn btn-sm bg-secondary-3 rounded-half">دعوت از مجری جهت همکاری</a>
                                    @endif
                                    <div id="plan" class="my-2 {{ $user->id == auth()->id() ? 'pointer' : '' }}" {!!  $user->id == auth()->id() ? 'data-toggle="tooltip" data-title="میخوای عضویت رو ارتقا بدی ؟"' : '' !!}>
                                        <div {!!  $user->id == auth()->id() ? 'data-toggle="redirect"' : '' !!}  data-url="{{ route('premium') }}">
                                            <img src="{{ $user->package()->icon }}" class="w-25 p-2">
                                            <span class="text-warning d-block">{{ $user->package()->name }}</span>
                                        </div>
                                    </div>
                                    <div class="scores mt-3">
                                        <button class="btn btn-sm bg-secondary-3 rounded-half active mx-2">امتیاز مجری : {{ $user->points }} از {{ $user->jobs()->where('freelancer_score','!=',0)->count() }} رای</button>
                                        <button class="btn btn-sm bg-secondary-3 rounded-half mx-2 mt-2">امتیاز خام مجری : {{ $user->raw_points }}</button>
                                        <button class="btn btn-sm bg-secondary-3 rounded-half mx-2 mt-2">آخرین ورود : {{ is_null($user->last_login) ? jdate($user->updated_at)->ago() : jdate($user->last_login)->ago() }}</button>
                                        <button class="btn btn-sm bg-secondary-3 rounded-half mx-2 mt-2">تاریخ عضویت : {{ jdate($user->created_at)->ago() }}</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-9">
                                <div id="profileContent">
                                    <div class="tab-container">
                                        <ul class="nav nav-tabs justify-content-center" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="resumes-tab" data-toggle="tab" href="#resumes" role="tab" aria-controls="resumes" aria-selected="true">رزومه</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="freelancer-tab" data-toggle="tab" href="#freelancer" role="tab" aria-controls="freelancer" aria-selected="true">فعالیت به عنوان مجری</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="employer-tab" data-toggle="tab" href="#employer" role="tab" aria-controls="employer" aria-selected="false">فعالیت به عنوان خریدار</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="portfolio-tab" data-toggle="tab" href="#portfolio" role="tab" aria-controls="portfolio" aria-selected="false">نمونه کار</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content py-3 px-4" id="myTabContent">
                                        <div class="tab-pane fade show active" id="resumes" role="tabpanel" aria-labelledby="resumes-tab">
                                            {!! !empty(strip_tags($user->info)) ? scriptStripper($user->info) : 'این کاربر رزومه خود را کامل نکرده است !' !!}
                                            <hr>
                                            <div class="skills">
                                                <span class="text-dark-3 title-caption">مهارت ها</span>
                                                <ul class="nav justify-content-center">
                                                    @foreach($user->skills()->get() as $skill)
                                                        <li class="nav-item">
                                                            <button class="nav-link btn-danger btn btn-sm rounded-half" type="button">{{ $skill->name }}</button>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="freelancer" role="tabpanel" aria-labelledby="freelancer-tab">
                                            <div class="btn-groups">
                                                <button class="btn btn-finished rounded-corner-3 ml-1">
                                                    <span class="h4 count">{{ $user->doneJobs() }} مورد </span>
                                                    <span class="subtitle">پروژه های انجام شده</span>
                                                </button>
                                                <button class="btn btn-judgement rounded-corner-6 ml-1">
                                                    <span class="h4 count">0 مورد </span>
                                                    <span class="subtitle">درخواست های داوری</span>
                                                </button>
                                                <button class="btn btn-pending rounded-corner-4">
                                                    <span class="h4 count">{{ $user->currentJobs() }} مورد </span>
                                                    <span class="subtitle">پروژه های در حال انجام</span>
                                                </button>
                                            </div>
                                            <div class="text-center mt-2">
                                                <span class="title mx-auto">پروژه های فریلنسر</span>
                                                <hr class="mt-1">
                                            </div>
                                            <div class="projects row">
                                                @foreach($user->jobs()->latest()->get() as $job)
                                                <div class="project col-12 border-bottom">
                                                   <div class="row">
                                                       <div class="avatar text-center col-2 pl-1 pt-3">
                                                           <a href="{{ route('resume.me',['user'=>$job->user_id]) }}">
                                                               <img src="{{ $job->user->avatar }}" width="90" class="rounded-circle">
                                                               <span class="d-block mt-2 text-dark-3 small">{{ $job->user->nicky }}</span>
                                                           </a>
                                                       </div>
                                                       <div class="col-10 pr-1 pt-2">
                                                           <div class="d-flex justify-content-between mb-2">
                                                               <a href="{{ route('user.project.view',['project'=>$job->id]) }}" class="text-danger font-weight-bold">{{ $job->title }}</a>
                                                               <div>
                                                                   @if($job->employer_point)
                                                                       <button class="btn btn-sm bg-secondary-3 info rounded-half ml-1">امتیاز {{ $job->freelancer_point }}</button>
                                                                   @endif
                                                                   <button class="btn btn-sm bg-secondary-3 rounded-half ml-1">{{ money($job->finalOffer()->price) }}</button>
                                                               </div>
                                                           </div>
                                                           @if($job->employer_comment && $job->freelancer_comment)
                                                               <p class="text-dark-2 small">{{ $job->employer_comment }}</p>
                                                           @else
                                                               <p class="text-dark-2 small">نظری ثبت نشده !</p>
                                                           @endif
                                                           <div class="d-flex justify-content-between mb-2 skills">
                                                               <span>
                                                                   {{ jdate($job->starts_at)->format('d F Y') }}
                                                               </span>
                                                               <ul class="nav">
                                                                   @foreach($job->skills()->get() as $skill)
                                                                       <li class="nav-item">
                                                                           <a class="nav-link btn-danger btn btn-sm rounded-half" href="#">{{ $skill->name }}</a>
                                                                       </li>
                                                                   @endforeach
                                                               </ul>
                                                           </div>
                                                       </div>
                                                   </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="employer" role="tabpanel" aria-labelledby="employer-tab">
                                            <div class="btn-groups">
                                                <button class="btn btn-finished rounded-corner-3 ml-1">
                                                    <span class="h4 count">{{ $user->doneProjects() }} مورد </span>
                                                    <span class="subtitle">پروژه های انجام شده</span>
                                                </button>
                                                <button class="btn btn-accepted rounded-corner-6 ml-1">
                                                    <span class="h4 count">{{ $user->withOffers() }} مورد </span>
                                                    <span class="subtitle">پروژه با پذیرش پیشنهاد</span>
                                                </button>
                                                <button class="btn btn-judgement rounded-corner-6 ml-1">
                                                    <span class="h4 count">0 مورد </span>
                                                    <span class="subtitle">درخواست های داوری</span>
                                                </button>
                                                <button class="btn btn-pending rounded-corner-4">
                                                    <span class="h4 count">{{ $user->confirmedProjects() }} مورد </span>
                                                    <span class="subtitle">پروژه های تایید شده</span>
                                                </button>
                                            </div>
                                            <div class="text-center mt-2">
                                                <span class="title mx-auto">پروژه های کارفرما</span>
                                                <hr class="mt-1">
                                            </div>
                                            <div class="projects row">
                                                @foreach($user->allProjectsCanShow()->latest()->get() as $job)
                                                    <div class="project col-12 border-bottom">
                                                        <div class="row">
                                                            <div class="avatar text-center col-2 pl-1 pt-3">
                                                                <a href="{{ route('resume.me',['user'=>$job->freelancer_id]) }}">
                                                                    <img src="{{ optional($job->freelancer)->avatar ?? $job->user->avatar }}" width="90" class="rounded-circle">
                                                                    <span class="d-block mt-2 text-dark-3 small">{{ optional($job->freelancer)->nicky ?? $job->user->nicky }}</span>
                                                                </a>
                                                            </div>
                                                            <div class="col-10 pr-1 pt-2">
                                                                <div class="d-flex justify-content-between mb-2">
                                                                    <a href="{{ route('user.project.view',['project'=>$job->id]) }}" class="text-danger font-weight-bold">{{ $job->title }}</a>
                                                                    <div>
                                                                        @if($job->freelancer_point)
                                                                            <button class="btn btn-sm bg-secondary-3 info rounded-half ml-1">امتیاز {{ $job->freelancer_point }}</button>
                                                                        @endif
                                                                        <button class="btn btn-sm bg-secondary-3 rounded-half ml-1">{{ money($job->finalOffer()->price) }}</button>
                                                                    </div>
                                                                </div>
                                                                @if($job->freelancer_comment && $job->employer_comment)
                                                                    <p class="text-dark-2 small">{{ $job->freelancer_comment }}</p>
                                                                @else
                                                                    <p class="text-dark-2 small">نظری ثبت نشده !</p>
                                                                @endif
                                                                <div class="d-flex justify-content-between mb-2 skills">
                                                               <span>
                                                                   {{ jdate($job->starts_at)->format('d F Y') }}
                                                               </span>
                                                                    <ul class="nav">
                                                                        @foreach($job->skills()->get() as $skill)
                                                                            <li class="nav-item">
                                                                                <a class="nav-link btn-danger btn btn-sm rounded-half" href="#">{{ $skill->name }}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="portfolio" role="tabpanel" aria-labelledby="employer-tab">
                                            <div class="row row-eq-height" id="portfolio_list">
                                                @foreach($user->portfolios()->where('status','success')->latest()->get() as $portfolio)
                                                    <div class="col-md-4 col-sm-6 col-12 port_item mb-2">
                                                        <a href="{{ route('portfolio.show',['portfolio'=>$portfolio->id]) }}" class="d-block h-100 w-100 position-relative">
                                                            <img src="{{ asset($portfolio->images[0]) }}" class="rounded-half border">
                                                            <div class="overlay d-flex justify-content-center align-items-center flex-column w-100 h-100 text-center position-absolute">
                                                                <span class="h5 text-white">{{ limit($portfolio->title,20) }}</span>
                                                                <span class="text-white-50 h6 mt-1">جزئیات بیشتر</span>
                                                            </div>
                                                        </a>
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
    </div>
@stop
