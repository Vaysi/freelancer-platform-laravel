@extends('User.master')
@section('content')
    <div class="col-3 pl-1">
        <div class="card custom sticky-sidebar">
            <div class="card-title">
                <span><i class="fa fa-search align-middle"></i> فیلتر کردن نتایج</span>
            </div>
            <div class="card-body " >
                <form action="{{ route('freelancer.requests.filter') }}" method="post" class="corner">
                    @csrf
                    <div class="form-group">
                        <label for="status">وضعیت پروژه</label>
                        <select name="status" id="status" class="selectpicker w-100">
                            <option value="">همه پیشنهاد ها</option>
                            <option value="accepted" {{ isset($request) && ($request->status == 'accepted') ? 'selected' : '' }}>پذیرفته شده ( انجام شده )</option>
                            <option value="working" {{ isset($request) && ($request->status == 'working') ? 'selected' : '' }}>پذیرفته شده ( در حال انجام )</option>
                            <option value="open" {{ isset($request) && ($request->status == 'open') ? 'selected' : '' }}>در جریان</option>
                            <option value="rejected" {{ isset($request) && ($request->status == 'rejected') ? 'selected' : '' }}>پذیرفته نشده</option>
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
                        <span> <i class="fa fa-list align-middle"></i> فهرست درخواست های ثبت شده از سوی شما | <span class="text-danger">{{ $offers->count() }} مورد</span></span>
                    </div>
                    <div class="card-body">
                        @if($offers->count())
                        <div class="table-responsive">
                            <table class="table normal">
                                <thead>
                                <tr>
                                    <th scope="col">کد پروژه</th>
                                    <th scope="col">عنوان پروژه</th>
                                    <th scope="col">پیشنهاد</th>
                                    <th scope="col">وضعیت پروژه</th>
                                    <th scope="col">زمان تحویل</th>
                                    <th scope="col">پیشنهاد شما پذیرش شد ؟</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($offers as $offer)
                                        <tr>
                                            <th scope="row"><small>{{ $offer->project->id }}</small></th>
                                            <td>
                                                <a href="{{ route('user.project.view',$offer->project->id) }}" class="text-dark small">{{ limit($offer->project->title,30) }}</a>

                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-info round">{{ money($offer->price) }}</button>
                                            </td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-info" role="progressbar" style="width: {{ !$offer->project->is_paid ? '0' : project_status($offer->project,false,true) }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <small>{{ $offer->project->is_paid ? project_status($offer->project,false) : 'پروژه پیشنویس' }}</small>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-primary">{{ $offer->deadline }} روز </span>
                                            </td>
                                            <td class="text-center">
                                                @if($offer->id == $offer->project->offer_id)
                                                    <span class="text-success"><i class="fa fa-check"></i></span>
                                                @else
                                                    <span class="text-danger"><i class="fa fa-close"></i></span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <div class="alert alert-danger rounded-corner-2-half">شما هیچ پیشنهادی در وبسایت ارسال نکردید !</div>
                        @endif
                        <nav>
                            {!! render($offers->render()) !!}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
