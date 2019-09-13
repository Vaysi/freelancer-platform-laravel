@extends('User.master')
@section('content')
    <div class="col-9 pl-1">
        <div class="row">
            <div class="col-12 mb-3 projectList" id="newProject">
                <div class="card custom">
                    <div class="card-title">
                        <span>پروژه های در حال انجام یا به پایان رسیده</span>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-end align-items-center">
                            <nav>
                                <ul class="pagination justify-content-end h6 small pr-0 mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1"><i class="fa fa-angle-double-right"></i></a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"><i class="fa fa-angle-double-left"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div id="list" class="mt-5">
                            @forelse($projects as $project)
                            <div class="item mb-4 {{ project_tags($project) }}">
                                <div class="wrapper p-3">
                                    <div class="title hasBadge">
                                        <span class="MainTitle">
                                            <span class="icon">
                                                <i class="fa fa-file-code-o ml-2"></i>
                                            </span>
                                            @if($project->private)
                                                <span>
                                                    پروژه خصوصی
                                                </span>
                                            @else
                                                <a href="{{ $project->link() }}">
                                                    {{ limit($project->title,80) }}
                                                </a>
                                            @endif
                                        </span>
                                        @if(!empty(project_tags($project)))
                                        <span class="badge-wrapper h5">
                                            <span class="badge rounded-half">{{ project_tags($project,true) }}</span>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="description mt-3 text-justify small">
                                        <div class="text-center mt-1 mb-3 w-75 mx-auto bg-secondary-2 shadow-sm p-2 rounded-all-corners-half">
                                            <div class="progress rounded-half shadow-sm mb-1">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ project_status($project,false,true) }}%" aria-valuenow="{{ project_status($project,false,true) }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="font-weight-bold">{{ project_status($project,false) }}</span>
                                        </div>
                                        <p>
                                            @if($project->private)
                                                فقط افراد دعوت شده قادر به مشاهده پروژه هستند
                                            @else
                                                {{ limit($project->content,500) }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="footer d-flex justify-content-between align-items-center">
                                        <span class="title">
                                            <span class="icon">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                            <span>{{ jdate($project->created_at)->ago() }}</span> با <span>{{ $project->offers()->count() }}</span> پیشنهاد رسیده
                                        </span>
                                        <div class="tags small">
                                            @foreach($project->skills()->take(3)->get() as $skill)
                                            <a href="{{ $skill->link() }}" class="btn btn-warning btn-sm rounded-half">{{ $skill->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <div class="alert alert-warning text-center">
                                    هیچ پروژه ای وجود ندارد !
                                </div>
                            @endforelse
                        </div>
                        <nav>
                            <ul class="pagination justify-content-center h6 small pr-0 mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1"><i class="fa fa-angle-double-right"></i></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fa fa-angle-double-left"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 pr-1">
        <div class="card custom sticky-sidebar">
            <div class="card-title text-center">
                <span>اعلان های مهم</span>
            </div>
            <div class="card-body " >
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
@stop
