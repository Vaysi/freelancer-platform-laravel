
@extends('User.master')
@section('content')
    <div class="col-3 pl-1">
        <div class="card custom sticky-sidebar">
            <div class="card-title">
                <span><i class="fa fa-search align-middle"></i> فیلتر کردن نتایج</span>
            </div>
            <div class="card-body " >
                <form action="{{ route('employer.requests.filter') }}" method="post" class="corner">
                    @csrf
                    <div class="form-group">
                        <label for="title">عنوان پروژه</label>
                        <input type="text" class="form-control form-control-sm" id="title" placeholder="عنوان پروژه را وارد کنید">
                    </div>
                    <div class="form-group">
                        <label for="status">وضعیت پروژه</label>
                        <select name="status" id="status" class="selectpicker w-100">
                            <option value="all">همه درخواست ها</option>
                            <option value="">اماده دریافت پیشنهادات</option>
                            <option value="">انجام شده</option>
                            <option value="">در حال انجام</option>
                            <option value="">پیشنویس</option>
                            <option value="">در انتظار تایید</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn-info btn">نمایش بده</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-9 pr-1">
        <div class="row">
            <div class="col-12 mb-3" id="emp_req">
                <div class="card custom">
                    <div class="card-title">
                        <span> <i class="fa fa-list align-middle"></i> فهرست درخواست های ثبت شده از سوی شما | <span class="text-danger">{{ $count }} مورد</span></span>
                    </div>
                    <div class="card-body">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
