@extends('User.master')
@section('content')
    <div class="col-12">
        <div class="row row-eq-height">
            <div class="col-md-6 col-12 pl-md-1" id="summary">
                <div class="card custom h-100">
                    <div class="card-title">
                        <span>حساب شما در یک نگاه</span>
                    </div>
                    <div class="card-body mt-2">
                        <div class="btn-gp w-100">
                            <button class="btn btn-bright rounded-corner-3 btn-blue py-3" data-toggle="redirect" data-url="{{ route('user.projects.related') }}">
                                <span class="w-100 h-100 d-flex justify-content-start align-items-center">
                                    <span class="ml-1 counter">
                                        <span class="bg-white rounded-corner-3 text-primary p-1">{{ user()->unreadProjects() }}</span>
                                    </span>
                                    <small class="text-right">پروژه جدید <br> مشاهده پروژه ها</small>
                                </span>
                            </button>
                            <button class="btn btn-bright rounded-corner-4 btn-pink py-3" data-toggle="redirect" data-url="{{ route('money.index') }}">
                                <span class="w-100 h-100 d-flex justify-content-start align-items-center">
                                    <small class="ml-1 counter">
                                        <small class="bg-white rounded-corner-3 text-danger p-1">{{ money(user()->balance,false) }}</small>
                                    </small>
                                    <small class="text-right">تومان موجودی<br> مشاهده گزارش</small>
                                </span>
                            </button>
                        </div>
                        <div class="row mt-2" id="info">
                            <div class="{{--col-sm-6 --}}col-12 px-md-3">
                                <div class="w-100 d-flex justify-content-between align-items-center h6">
                                    <span class="title">وضعیت پروفایل شما</span>
                                    <span>{{ profile(true) }}%</span>
                                </div>
                                <div class="progress my-2" dir="ltr">
                                    <div class="progress-bar bg-{{ profile(false,true) }}" role="progressbar" style="width: {{ profile(true) }}%"
                                         aria-valuenow="{{ profile(true) }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                @foreach(profile() as $item)
                                    <span class="d-flex justify-content-between align-items-center mb-1">
                                        <span><span class="small"><i class="fa fa-chevron-left align-middle"></i></span> {{ $item['text'] }}</span>
                                        @if(isset($item['link']))
                                            <small><a href="{{ $item['link'] }}" class="text-danger"> اصلاح</a></small>
                                        @endif
                                    </span>
                                @endforeach

                            </div>
                            {{--<div class="col-sm-6 col-12 pr-md-1">
                                <div class="w-100 d-flex justify-content-between align-items-center">
                                    <span class="title">آخرین ورود های شما</span>
                                    <span>وضعیت</span>
                                </div>
                                <div class="list">
                                    @forelse(auth()->user()->loginHistory()->take(3)->get() as $login)
                                        <span class="title w-100 d-flex justify-content-between mt-1" data-toggle="tooltip" data-placement="top" title="آیپی : {{ $login->ip }}">
                                            <span><b>{{ jdate($login->created_at)->format('d F H:i:s') }}</b></span>
                                            <span class="text-{{ $login->status ? 'primary' : 'danger' }}">{{ $login->status ? 'موفق' : 'ناموفق' }}</span>
                                        </span>
                                    @empty
                                        <span class="text-center text-info d-block mt-2 font-weight-bold">
                                            تاریخچه ورود شما در وبسایت ثبت نشده !
                                        </span>
                                    @endforelse
                                </div>
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 pr-md-1 mt-md-0 mt-3" id="news">
                <div class="card custom h-100">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <span>آخرین پروژه ها</span>
                        <div class="nav toggle h6">
                            <a href="#" class="nav-link button mr-1 active" data-target="#specials">پروژه های فوری و ویژه و چسبنده</a>
                            <a href="#" class="nav-link button mr-1" data-target="#related">پروژه های مرتبط با تخصص شما</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="nav flex-column list hide active" id="specials">
                            @foreach($specials as $project)
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ $project->link() }}" class="d-flex justify-content-between align-items-center">
                                        <span class="text"><i class="fa fa-file-code-o ml-1"></i> {{ limit($project->title,40) }}</span>
                                        <span class="date">{{ jdate($project->created_at)->ago() }}</span>
                                    </a>
                                    @if(!empty(project_tags($project)))
                                        <span class="badge-wrapper h5">
                                         <span class="badge rounded-half text-white w-100 text-center {{ project_tags($project) }}">{{ project_tags($project,true) }}</span>
                                    </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="nav flex-column list hide" id="related">
                            @forelse($related as $project)
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ $project->link() }}" class="d-flex justify-content-between align-items-center">
                                        <span class="text"><i class="fa fa-file-code-o ml-1"></i> {{ limit($project->title,40) }}</span>
                                        <span class="date">{{ jdate($project->created_at)->ago() }}</span>
                                    </a>
                                    @if(!empty(project_tags($project)))
                                    <span class="badge-wrapper h5">
                                         <span class="badge rounded-half text-white w-100 text-center {{ project_tags($project) }}">{{ project_tags($project,true) }}</span>
                                    </span>
                                    @endif
                                </div>
                            @empty
                                <div class="alert alert-danger text-center">هیچ پروژه ای مطابق با مهارت شما پیدا نشد !</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-eq-height mt-3">
            <div class="col-md-10 d-md-12 pl-1" id="conversations">
                <div class="card custom h-100">
                    <div class="card-title">
                        <ul class="nav nav-tabs justify-content-center p-0" id="fin_tab" role="tablist">
                            <li class="nav-item ml-3">
                                <a class="nav-link active" id="lastConversations-tab" data-toggle="tab" href="#lastConversations" role="tab" aria-controls="lastConversations" aria-selected="true">
                                    آخرین گفتگو ها
                                    <span class="small rounded-half bg-danger px-2 py-1 text-white mx-1">{{ user()->unreadConversations() }} پیام مشاهده نشده </span>
                                </a>
                            </li>
                            <li class="nav-item  mx-3">
                                <a class="nav-link" id="myprojects-tab" data-toggle="tab" href="#myprojects" role="tab" aria-controls="myprojects" aria-selected="false">
                                    سفارشات شما
                                    <span class="badge badge-success align-middle">{{ user()->projects()->whereIn('status',['open' , 'emp_trust','flc_trust','trust_done','flc_done'])->where('expires_at','>',now())->count() }} فعال </span>
                                </a>
                            </li>
                            <li class="nav-item  mr-3">
                                <a class="nav-link" id="jobs-tab" data-toggle="tab" href="#jobs" role="tab" aria-controls="jobs" aria-selected="false">
                                    اجرا های شما
                                    <span class="badge badge-warning align-middle">{{ user()->currentJobs() }} فعال</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="lastConversations" role="tabpanel" aria-labelledby="conversations-tab">
                                @forelse(user()->lastConversations()->where('status','confirmed')->take(25) as $conversation)
                                    @php
                                        $project = $conversation->project()->first();
                                        $lastConversation = $project->conversations()->latest()->first();
                                        $target_user = $lastConversation->user->isMe() ? $lastConversation->to : $lastConversation->user;

                                    @endphp
                                    <div class="item d-flex align-items-center rounded-corner-3 p-2 mb-2 {{ in_array($conversation->project_id,user()->unreadConversationsIds2()) && isset(user()->unreadConversationsIds()[$conversation->project_id]) && $target_user->id == user()->unreadConversationsIds()[$conversation->project_id] ? 'border border-danger' : '' }}">
                                        <div class="avatar">
                                            <img src="{{ $lastConversation->user->avatar }}" class="rounded-circle img-thumbnail">
                                        </div>
                                        <div class="name mr-2 text-center">
                                            <a href="{{ $lastConversation->user->resumeLink() }}" class="d-block">
                                                <small class="text-secondary">
                                                    <i class="fa fa-user"></i>
                                                </small>
                                                <span class="text-danger">
                                        {{ $lastConversation->user->isMe() ? 'خودم' : $lastConversation->user->name()  }}
                                    </span>
                                            </a>
                                            @if($lastConversation->user->isMe())
                                                <span class="d-block">
                                        @if($project->isEmployer())
                                                        به
                                                        <a class="text-danger" href="{{ $project->freelancer->resumeLink() }}">{{ $project->freelancer->name() }}</a>
                                                    @else
                                                        در
                                                        <a class="text-danger" href="{{ $project->conversationLink() }}">{{ $project->title }}</a>
                                                    @endif
                                    </span>
                                            @endif
                                            <small class="text-secondary">{{ jdate($lastConversation->created_at)->ago() }}</small>
                                        </div>
                                        <div class="vertical-separator mx-2">&nbsp;</div>
                                        <div class="msg">
                                            <p class="text-secondary m-0 small">
                                                {{ limit($lastConversation->message,150) }}
                                            </p>
                                            <div class="mt-2">
                                                <span>پروژه مربوطه :  <a class="text-danger" href="{{ $lastConversation->project->link() }}">{{ limit($lastConversation->project->title) }}</a></span>
                                            </div>
                                        </div>
                                        <div class="links">
                                            @if($project->offer())
                                                <span class="d-block btn bg-info text-white rounded-half btn-sm">پیشنهاد قیمت</span>
                                            @endif
                                            <a href="{{ $project->conversationLink($target_user) }}" class="d-block btn btn-danger rounded-corner-3 btn-sm">مشاهده گفتگو</a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="alert alert-danger">شما هیچ گفتگویی ندارید !</div>
                                @endforelse
                            </div>
                            <div class="tab-pane fade" id="myprojects" role="tabpanel" aria-labelledby="myprojects-tab">
                                @php
                                    $projects = user()->projects()->orderByRaw("FIELD(status , 'open' , 'emp_trust','flc_trust','trust_done','flc_done') DESC")->paginate(25);
                                @endphp
                                @if($projects->count())
                                    <div class="table-responsive">
                                        <table class="table normal">
                                            <thead>
                                            <tr>
                                                <th scope="col" width="13%">کد پروژه</th>
                                                <th scope="col" width="40%">عنوان پروژه</th>
                                                <th scope="col" width="30%">وضعیت پروژه</th>
                                                <th scope="col" width="17%">نوع پروژه</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($projects as $project)
                                                <tr>
                                                    <th scope="row"><small>{{ $project->id }}</small></th>
                                                    <td>
                                                        <a href="{{ route('user.project.view',['project'=> $project->id]) }}" class="text-dark small">{{ limit($project->title,70) }}</a>
                                                        @if(!in_array($project->publish_status,['closed','canceled']) && in_array($project->status,['open']))
                                                            <span class="d-block small">
                                                    <a href="{{ route('user.project.edit',['project'=>$project->id]) }}" class="text-danger">ویرایش</a>
                                                </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: {{ !$project->is_paid ? '0' : project_status($project,false,true) }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <small>{{ $project->is_paid ? project_status($project,false) : 'پروژه پیشنویس' }}</small>
                                                    </td>
                                                    <td>
                                                        @php
                                                            $normal = true;
                                                        @endphp
                                                        @if($project->private)
                                                            <span class="badge project-c private rounded-half">خصوصی</span>
                                                            @php
                                                                $normal = false;
                                                            @endphp
                                                        @endif
                                                        @if($project->sticky)
                                                            <span class="badge project-c sticky rounded-half">چسبنده</span>
                                                            @php
                                                                $normal = false;
                                                            @endphp
                                                        @endif
                                                        @if($project->hidden)
                                                            <span class="badge badge-secondary rounded-half">مخفی</span>
                                                            @php
                                                                $normal = false;
                                                            @endphp
                                                        @endif
                                                        @if($project->special)
                                                            <span class="badge project-c special rounded-half">ویژه</span>
                                                            @php
                                                                $normal = false;
                                                            @endphp
                                                        @endif
                                                        @if($project->hire)
                                                            <span class="badge project-c hire rounded-half">استخدامی</span>
                                                            @php
                                                                $normal = false;
                                                            @endphp
                                                        @endif
                                                        @if($project->urgent)
                                                            <span class="badge project-c urgent rounded-half">فوری</span>
                                                            @php
                                                                $normal = false;
                                                            @endphp
                                                        @endif
                                                        @if($normal)
                                                            <span class="badge project-c normal rounded-half">معمولی</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <nav>
                                        {!! render($projects->render()) !!}
                                    </nav>
                                @else
                                    <div class="alert alert-danger text-center">
                                        شما هیچ پروژه ای در وبسایت ثبت نکرده اید !
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="jobs" role="tabpanel" aria-labelledby="jobs-tab">
                                @php
                                    $projects = user()->jobs()->orderByRaw("FIELD(status , 'open' , 'emp_trust','flc_trust','trust_done','flc_done') DESC")->paginate(25);
                                @endphp
                                @if($projects->count())
                                    <div class="table-responsive">
                                        <table class="table normal">
                                            <thead>
                                            <tr>
                                                <th scope="col" width="5%">کد پروژه</th>
                                                <th scope="col" width="20%">عنوان پروژه</th>
                                                <th scope="col" width="20%">وضعیت پروژه</th>
                                                <th scope="col" width="17%">نوع پروژه</th>
                                                <th scope="col" width="10%">قیمت پروژه</th>
                                                <th scope="col" width="14%">مقدار آزادسازی</th>
                                                <th scope="col" width="14%">مقدار گروگزاری</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($projects as $project)
                                                <tr>
                                                    <th scope="row"><small>{{ $project->id }}</small></th>
                                                    <td>
                                                        <a href="{{ route('user.project.view',['project'=> $project->id]) }}" class="text-dark small">{{ limit($project->title,70) }}</a>
                                                        @if(!in_array($project->publish_status,['closed','canceled']) && in_array($project->status,['open']))
                                                            <span class="d-block small">
                                                                <a href="{{ route('user.project.edit',['project'=>$project->id]) }}" class="text-danger">ویرایش</a>
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: {{ !$project->is_paid ? '0' : project_status($project,false,true) }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <small>{{ $project->is_paid ? project_status($project,false) : 'پروژه پیشنویس' }}</small>
                                                    </td>
                                                    <td>
                                                        @php
                                                            $normal = true;
                                                        @endphp
                                                        @if($project->private)
                                                            <span class="badge project-c private rounded-half">خصوصی</span>
                                                            @php
                                                                $normal = false;
                                                            @endphp
                                                        @endif
                                                        @if($project->sticky)
                                                            <span class="badge project-c sticky rounded-half">چسبنده</span>
                                                            @php
                                                                $normal = false;
                                                            @endphp
                                                        @endif
                                                        @if($project->hidden)
                                                            <span class="badge badge-secondary rounded-half">مخفی</span>
                                                            @php
                                                                $normal = false;
                                                            @endphp
                                                        @endif
                                                        @if($project->special)
                                                            <span class="badge project-c special rounded-half">ویژه</span>
                                                            @php
                                                                $normal = false;
                                                            @endphp
                                                        @endif
                                                        @if($project->hire)
                                                            <span class="badge project-c hire rounded-half">استخدامی</span>
                                                            @php
                                                                $normal = false;
                                                            @endphp
                                                        @endif
                                                        @if($project->urgent)
                                                            <span class="badge project-c urgent rounded-half">فوری</span>
                                                            @php
                                                                $normal = false;
                                                            @endphp
                                                        @endif
                                                        @if($normal)
                                                            <span class="badge project-c normal rounded-half">معمولی</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ money($project->finalOffer()->price ) }}
                                                    </td>
                                                    <td>
                                                        {{ $project->released }} درصد
                                                    </td>
                                                    <td>
                                                        {{ $project->deposit }} درصد
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <nav>
                                        {!! render($projects->render()) !!}
                                    </nav>
                                @else
                                    <div class="alert alert-danger text-center">
                                        شما هیچ اجرایی در پروژه های وبسایت ندارید !
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2 d-none d-md-block pr-1">
                <div class="card custom h-100">
                    <div class="card-title text-center">
                        <span>اعلان های مهم</span>
                    </div>
                    <div class="card-body ">
                        <div class="sticky-sidebar w-100 text-center">
                            <div class="ad-item mb-2">
                                <a href="#">
                                    <img src="{{ asset('images/166_122.png') }}">
                                </a>
                            </div>
                            <div class="ad-item mb-2">
                                <a href="#">
                                    <img src="{{ asset('images/166_122.png') }}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
