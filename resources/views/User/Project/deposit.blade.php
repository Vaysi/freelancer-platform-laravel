
@extends('User.master')
@section('content')
    <div class="col-9 pl-1">
        <div class="row">
            <div class="col-12 mb-3 projectList" id="newProject">
                <div class="card custom">
                    <div class="card-title">
                        <span>گروگزاری در پروژه {{ $project->title }}</span>
                    </div>
                    <div class="card-body py-3">
                        <div class="alert alert-info rounded-corner-5">
                            <p class="m-0 h6">
                                <i class="fa fa-info-circle ml-2"></i>
                                <span>شما مقدار
                                    <span class="font-weight-bold">{{ $project->deposit }} درصد </span>
                                    رو گرو گزاری کردید , حال میتوانید تا سقف
                                    <span class="font-weight-bold">{{ (100 - intval($project->deposit)) }} درصد </span>
                                    از پروژه را گرو گزاری کنید .
                                </span>
                            </p>
                        </div>
                        <form action="{{ route('user.project.deposits.update',['project'=>$project->id]) }}" class="corner" method="post">
                            @csrf
                            {{ method_field('PATCH') }}
                            <div class="form-group">
                                <label for="price">مقدار گروگزاری</label>
                                <div class="input-group mb-1 w-50">
                                    <input type="number" name="deposit" class="form-control" min="1" max="{{ (100 - intval($project->deposit)) }}" value="{{ (100 - intval($project->deposit)) }}" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-info text-white" id="basic-addon2">درصد</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info w-50">گروگزاری</button>
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
