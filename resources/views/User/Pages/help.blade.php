@extends('User.master')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-12 mb-3" id="help">
                <div class="card custom">
                    <div class="card-title">
                        <span>راهنمای استفاده از سایت</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 mb-3 help_item">
                                <div class="w-100 bg-info-3 rounded-corner-2 py-2">
                                    <h5 class="text-dark-3 px-2">معرفی</h5>
                                    <ul>
                                        @foreach(\App\Question::whereType('help')->whereLocation('intro')->get() as $help)
                                        <li>
                                            <a href="{{ route('help.single',['id'=>$help->id]) }}">{{ $help->title }} </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-4 mb-3 help_item">
                                <div class="w-100 bg-info-3 rounded-corner-2 py-2">
                                    <h5 class="text-dark-3 px-2">مجری یا فریلنسر</h5>
                                    <ul>
                                        @foreach(\App\Question::whereType('help')->whereLocation('freelancer')->get() as $help)
                                            <li>
                                                <a href="{{ route('help.single',['id'=>$help->id]) }}">{{ $help->title }} </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-4 mb-3 help_item">
                                <div class="w-100 bg-info-3 rounded-corner-2 py-2">
                                    <h5 class="text-dark-3 px-2">خریدار یا کارفرما</h5>
                                    <ul>
                                        @foreach(\App\Question::whereType('help')->whereLocation('employer')->get() as $help)
                                            <li>
                                                <a href="{{ route('help.single',['id'=>$help->id]) }}">{{ $help->title }} </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-4 mb-3 help_item">
                                <div class="w-100 bg-info-3 rounded-corner-2 py-2">
                                    <h5 class="text-dark-3 px-2">اموری مالی</h5>
                                    <ul>
                                        @foreach(\App\Question::whereType('help')->whereLocation('financial')->get() as $help)
                                            <li>
                                                <a href="{{ route('help.single',['id'=>$help->id]) }}">{{ $help->title }} </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-4 mb-3 help_item">
                                <div class="w-100 bg-info-3 rounded-corner-2 py-2">
                                    <h5 class="text-dark-3 px-2">مسائل حقوقی</h5>
                                    <ul>
                                        @foreach(\App\Question::whereType('help')->whereLocation('law')->get() as $help)
                                            <li>
                                                <a href="{{ route('help.single',['id'=>$help->id]) }}">{{ $help->title }} </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-4 mb-3 help_item">
                                <div class="w-100 bg-info-3 rounded-corner-2 py-2">
                                    <h5 class="text-dark-3 px-2">سایر موارد</h5>
                                    <ul>
                                        @foreach(\App\Question::whereType('help')->whereLocation('other')->get() as $help)
                                            <li>
                                                <a href="{{ route('help.single',['id'=>$help->id]) }}">{{ $help->title }} </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
