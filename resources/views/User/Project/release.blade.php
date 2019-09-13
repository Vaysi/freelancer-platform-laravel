@extends('User.master')
@section('content')
    <div class="col-9 pl-1">
        <div class="row">
            <div class="col-12 mb-3 projectList" id="newProject">
                <div class="card custom">
                    <div class="card-title">
                        <span>آزاد سازی وجه پروژه {{ $project->title }}</span>
                    </div>
                    <div class="card-body py-3">
                        <div class="alert alert-info rounded-corner-5">
                            <p class="m-0 h6">
                                <i class="fa fa-info-circle ml-2"></i>
                                <span>شما مقدار
                                    <span class="font-weight-bold">{{ $project->released }} درصد </span>
                                    رو آزاد سازی کردید و مقدار
                                    <span class="font-weight-bold">{{ $project->deposit }} درصد </span>
                                    گروگزاری کردید
                                    , حال میتوانید تا سقف
                                    <span class="font-weight-bold">{{ ($project->deposit - intval($project->released)) }} درصد </span>
                                    از پروژه را آزادسازی کنید .
                                </span>
                            </p>
                        </div>
                        <form action="{{ route('project.release.update',['project'=>$project->id]) }}" class="corner" method="post">
                            @csrf
                            {{ method_field('PATCH') }}
                            <div class="form-group">
                                <label for="release">مقدار آزادسازی</label>
                                <div class="input-group mb-1 w-50">
                                    <input type="number" name="release" class="form-control" min="1" max="{{ ($project->deposit - intval($project->released)) }}" value="{{ ($project->deposit - intval($project->released)) }}" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-info text-white" id="basic-addon2">درصد</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info w-50">آزاد سازی</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 pr-1">
        <div class="card custom sticky-sidebar">
            <div class="card-title text-center">
                <span>با همکاری بانک های زیر</span>
            </div>
            <div class="card-body">
                <div class="sticky-sidebar w-100 d-flex">
                    <div class="d-inline-block w-50 border-left">
                        <img src="https://parscoders.com/assets/admin/layout2/img/behpardakht_logo.jpg">
                    </div>
                    <div class="d-inline-block w-50 pr-1">
                        <img src="https://parscoders.com/assets/admin/layout2/img/saman_logo.jpg">
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
