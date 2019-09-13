@extends('User.master')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-12 mb-3" id="faq">
                <div class="card custom">
                    <div class="card-title">
                        <span>{{ $title }}</span>
                    </div>
                    <div class="card-body">
                        <div class="my-2">
                            {!! $content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
