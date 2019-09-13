@extends('User.master')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-12 mb-3" id="emp_req">
                <div class="card custom">
                    <div class="card-title">
                        <span>لطفا با دقت مطالعه فرمایید</span>
                    </div>
                    <div class="card-body">
                        {!! option('rules') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
