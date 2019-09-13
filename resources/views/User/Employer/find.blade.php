@extends('User.master')
@section('content')
    <div class="col-3 pl-1">
        <div class="card custom sticky-sidebar">
            <div class="card-title">
                <span><i class="fa fa-search align-middle"></i> فیلتر کردن نتایج</span>
            </div>
            <div class="card-body">
                <form action="{{ route('employer.find.filter') }}" method="post" class="corner">
                    @csrf
                    <div class="form-group">
                        <label for="name">نام مستعار</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="نام مجری را جستجو کنید">
                    </div>
                    <div class="form-group">
                        <label for="skills">مهارت ها</label>
                        <select name="skills[]" id="skills" class="selectpicker mb-2" data-live-search="true" multiple title="مهارت لازم را انتخاب کنید" data-max-options="8">
                            @foreach(\App\Category::latest()->get() as $category)
                                @continue($category->skills()->count() < 1)
                                <optgroup label="{{ $category->name }}">
                                    @foreach($category->skills()->get() as $skill)
                                        <option value="{{ $skill->id }}" {{ in_array($skill->id,old('skills') ?? []) ? 'selected' : '' }}>{{ trim($skill->name) }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
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
                        <span> <i class="fa fa-list align-middle"></i> فهرست مجریان </span>
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
                                                <a href="{{ route('invite.user',['user'=>$user->id]) }}" class="btn btn-info btn-sm">دعوت</a>
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
