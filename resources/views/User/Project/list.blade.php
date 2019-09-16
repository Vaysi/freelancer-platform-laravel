@extends('User.master')
@section('content')
    <div class="col-12">
        <div class="accordion my-3" id="accordionExample">
            <div class="card mb-2 rounded-half" style="overflow: unset;">
                <div class="card-header rounded-half" id="headingOne">
                    <button class="btn btn-link d-flex justify-content-between align-items-center align-items-center h4 mb-0 w-100" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <span><i class="fa fa-search"></i> جستجو </span>
                    <span class="text-dark-2 mb-0"><i class="fa fa-chevron-down"></i></span>
                    </button>
                </div>
                @php
                    $req = isset($request) ? $request : optional(null);
                @endphp
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <form action="{{ route('user.projects.search') }}" class="corner" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-3">
                                    <label for="title">نام پروژه</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $req->title ?? old('title') ?? '' }}">
                                </div>
                                <div class="form-group col-3">
                                    <label for="price_range">محدوده قیمت</label>
                                    <select class="selectpicker w-auto" id="price_range" name="price_range" title="محدوده مورد نظر را انتخاب کنید">
                                        <option value="">هیچکدام</option>
                                        <option class="" value="1" {{ old('price_range') == 1 ? 'selected' : '' }}> خیلی کوچک » از 5,000 تومان تا 100,000 تومان </option>
                                        <option value="2" {{ $req->price_range ?? old('price_range') == 2 ? 'selected' : '' }}> کوچک » از 100,000 تومان تا 300,000 تومان </option>
                                        <option value="3" {{ $req->price_range ?? old('price_range') == 3 ? 'selected' : '' }}> متوسط » از 300,000 تومان تا 750,000 تومان </option>
                                        <option value="4" {{ $req->price_range ?? old('price_range') == 4 ? 'selected' : '' }}> نسبتا بزرگ » از 750,000 تومان تا 5,000,000 تومان </option>
                                        <option value="5" {{ $req->price_range ?? old('price_range') == 5 ? 'selected' : '' }}> بزرگ » از 5,000,000 تومان تا 15,000,000 تومان </option>
                                        <option value="6" {{ $req->price_range ?? old('price_range') == 6 ? 'selected' : '' }}> خیلی بزرگ » از 15,000,000 تومان تا 50,000,000 تومان </option>
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="features">ویژگی ها</label>
                                    <select class="selectpicker w-auto" multiple id="features" name="features[]" title="انتخاب کنید">
                                        <option value="hire" class="hire-color" {{ in_array('hire',$req->features ?? []) || in_array('hire',old('features') ?? []) ? 'selected' : '' }}>استخدامی</option>
                                        <option value="urgent" class="urgent-color" {{ in_array('urgent',$req->features ?? []) || in_array('urgent',old('features') ?? []) ? 'selected' : '' }}>فوری</option>
                                        <option value="sticky" class="sticky-color" {{ in_array('sticky',$req->features ?? []) || in_array('sticky',old('features') ?? []) ? 'selected' : '' }}>چسبنده</option>
                                        <option value="private" class="private-color" {{ in_array('private',$req->features ?? []) || in_array('private',old('features') ?? []) ? 'selected' : '' }}>شخصی</option>
                                        <option value="special" class="special-color" {{ in_array('special',$req->features ?? []) || in_array('special',old('features') ?? []) ? 'selected' : '' }}>ویژه</option>
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="skills">مهارت ها</label>
                                    <select name="skill" id="skills" class="selectpicker" data-live-search="true" title="انتخاب کنید">
                                        @foreach(\App\Category::latest()->get() as $category)
                                            @continue($category->skills()->count() < 1)
                                            <optgroup label="{{ $category->name }}">
                                                @foreach($category->skills()->get() as $skill)
                                                    <option value="{{ $skill->id }}" {{ $req->skill == $skill->id ? 'selected' : '' }}>{{ trim($skill->name) }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-outline-danger float-left">جستجو</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-10 pl-1">
        <div class="row">
            <div class="col-12 mb-3 projectList" id="newProject">
                <div class="card custom">
                    <div class="card-title">
                        <span>{{ $page }}</span>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <nav>
                                {!! render($projects->render(),"justify-content-end h6 small pr-0 mb-0") !!}
                            </nav>
                            <select name="order" id="orderBy" class="selectpicker w-25">
                                <option value="">جدیدترین ها</option>
                                <option value="">بیش ترین بودجه</option>
                                <option value="">کمترین بودجه</option>
                                <option value="">بیشترین پیشنهاد</option>
                                <option value="">کمترین پیشنهاد</option>
                            </select>
                        </div>
                        <div id="list" class="mt-5">
                            @foreach($projects as $project)
                                @php
                                    $created = \Carbon\Carbon::parse($project->created_at);
                                    $diff = $created->diffInDays(now());
                                @endphp
                                @continue($project->sticky && $diff > 2)
                                @continue(!$project->sticky)
                                <div class="item mb-4 sticky">
                                    <div class="wrapper p-3">
                                        <div class="title hasBadge">
                                        <span class="MainTitle">
                                            <span class="icon">
                                                <i class="fa fa-file-code-o ml-2"></i>
                                            </span>
                                            <a href="{{ $project->link() }}">
                                                {{ limit($project->title,80) }}
                                            </a>
                                        </span>
                                        @if(!empty(project_tags($project)))
                                        <span class="badge-wrapper h5">
                                             <span class="badge rounded-half">{{ project_tags($project,true) }}</span>
                                        </span>
                                        @endif
                                        </div>
                                        <div class="description mt-3 text-justify small">
                                            <p>
                                                {{ limit($project->content,500) }}
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
                            @endforeach
                            @forelse($projects as $project)
                            @php
                                $created = \Carbon\Carbon::parse($project->created_at);
                                $diff = $created->diffInDays(now());
                            @endphp
                            @continue($project->sticky && $diff <= 2)
                            <div class="item mb-4 {{ project_tags($project,false,false) }}">
                                <div class="wrapper p-3">
                                    <div class="title hasBadge">
                                        <span class="MainTitle {{ empty(project_tags($project)) ? 'w-100' : '' }}">
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
                                    هیچ پروژه ای برای شما وجود ندارد !
                                </div>
                            @endforelse
                        </div>
                        <nav>
                            {!! render($projects->render()) !!}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-2 pr-1">
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
