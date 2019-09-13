
@extends('User.master')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-12 mb-3" id="emp_req">
                <div class="card custom">
                    <div class="card-title">
                        <span> <i class="fa fa-list align-middle"></i> فهرست درخواست های باز شما</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="alert alert-info rounded-corner-5">
                                <div class="row row-eq-height">
                                    <div class="col-2 icon display-4 text-center">
                                        <i class="fa fa-gift"></i>
                                    </div>
                                    <div class="col-10">
                                        <span class="bold h5">دعوت از مجری <a href="{{ $user->resumeLink() }}">{{ $user->name() }}</a></span>
                                        <p class="mb-0 mt-2 h6">لطفا پروژه مورد نظر را انتخاب نمایید</p>
                                    </div>
                                </div>
                            </div>
                            <table class="table normal">
                                <thead>
                                <tr>
                                    <th scope="col" width="13%">کد پروژه</th>
                                    <th scope="col" width="30%">عنوان پروژه</th>
                                    <th scope="col" width="25%">وضعیت پروژه</th>
                                    <th scope="col" width="17%">نوع پروژه</th>
                                    <th scope="col" width="15%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(user()->openProjects()->get() as $project)
                                    <tr>
                                        <th scope="row"><small>{{ $project->id }}</small></th>
                                        <td>
                                            <a href="{{ route('user.project.view',['project'=> $project->id]) }}" class="text-dark small">{{ limit($project->title,50) }}</a>
                                        </td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ !$project->is_paid ? '0' : project_status($project,false,true) }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <small>{{ $project->is_paid ? publish_status($project,false) : 'پروژه پیشنویس' }}</small>
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
                                            @if($project->isUserInvited($user))
                                                <button class="btn btn-danger round disabled">قبلا دعوت شده</button>
                                            @else
                                                <a href="{{ route('invite.user.project',['user'=>$user->id,'project'=>$project->id]) }}" class="btn btn-primary round">دعوت</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
