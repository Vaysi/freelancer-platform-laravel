@extends('User.master')
@section('content')
    <div class="col-12 pr-1">
        <div class="row">
            <div class="col-12 mb-3" id="emp_req">
                <div class="card custom">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <span> <i class="fa fa-list align-middle"></i> دعوت مجری ها به <b>{{ limit($project->title,30) }}</b> </span>
                        <a href="{{ route('user.project.view',$project->id) }}" class="btn btn-sm btn-primary round">بازگشت</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table normal">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" width="25%">نام کاربری</th>
                                        <th scope="col" width="15%">انجام داده</th>
                                        <th scope="col" width="25%">در حال انجام</th>
                                        <th scope="col" width="10%">رتبه</th>
                                        <th scope="col" width="10%">امتیاز</th>
                                        <th scope="col" width="15%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td scope="row">
                                                <a href="{{ $user->resumeLink() }}">
                                                    <img src="{{ $user->avatar }}" class="rounded-circle" style="max-width: 50px;">
                                                    <span class="text-dark">{{ $user->name() }}</span>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <span>{{ $user->doneJobs() }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span>{{ $user->currentJobs() }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span>{{ $user->score }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="ml-2">{{ $user->points }}</span>
                                            </td>
                                            <td>
                                                <span class="text-warning ml-2"><i class="fa fa-trophy"></i></span>
                                                <a href="{{ route('invite.user.project',['user'=>$user->id,'project'=>$project->id]) }}" class="btn btn-info btn-sm">دعوت</a>
                                            </td>
                                        </tr>
                                    @empty

                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <nav>
                            {!! render($render) !!}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
