@extends('Admin.master')
@section('title','پروژه ها')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">ویرایش پروژه</h3>
            <a href="{{ route('user.project.view',['project'=>$project->id]) }}" class="btn btn-info btn-sm">مشاهده پروژه</a>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('projects.update',['project'=>$project->id]) }}" method="post">
            @csrf
            {{ method_field('PATCH') }}
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="title">نام پروژه</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $project->title }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="price_range">محدوده قیمت</label>
                        <select class="form-control select2 w-100" id="price_range" name="price_range">
                            <option value="1" {{ $project->price_range == 1 ? 'selected' : '' }}> خیلی کوچک » از 5,000 تومان تا 100,000 تومان </option>
                            <option value="2" {{ $project->price_range  == 2 ? 'selected' : '' }}> کوچک » از 100,000 تومان تا 300,000 تومان </option>
                            <option value="3" {{ $project->price_range  == 3 ? 'selected' : '' }}> متوسط » از 300,000 تومان تا 750,000 تومان </option>
                            <option value="4" {{ $project->price_range  == 4 ? 'selected' : '' }}> نسبتا بزرگ » از 750,000 تومان تا 5,000,000 تومان </option>
                            <option value="5" {{ $project->price_range  == 5 ? 'selected' : '' }}> بزرگ » از 5,000,000 تومان تا 15,000,000 تومان </option>
                            <option value="6" {{ $project->price_range  == 6 ? 'selected' : '' }}> خیلی بزرگ » از 15,000,000 تومان تا 50,000,000 تومان </option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="expires_at">تاریخ انقضا : </label>
                        <input type="text" class="form-control datepicker" id="expires_at" name="expires_at" value="{{ $project->expires_at }}">
                        <span class="text-small form-text small">تاریخ انقضا  : <b>{{ jdate($project->expires_at)->format('Y/m/d') }}</b></span>
                    </div>
                    <div class="form-group col-6">
                        <label for="deadline">زمان (روز)</label>
                        <input type="text" class="form-control" id="deadline" name="deadline" value="{{ $project->deadline }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="min_guarantee">حداقل ضمانت تخصص</label>
                        <input type="number" class="form-control" id="min_guarantee" name="min_guarantee" value="{{ $project->min_guarantee }}">
                        <span class="text-small form-text small">طبق استاندارد و سیاست سایت بهتر است بیش از 25 درصد نباشد !</span>
                    </div>
                    <div class="form-group col-6">
                        <label for="status">وضعیت پروژه</label>
                        <select name="status" id="status" class="select2">
                            <option value="">تغیری نکند</option>
                            <option value="emp_trust" {{ $project->status  == "emp_trust" ? 'selected' : '' }}>در انتظار گروگزاری کارفرما</option>
                            <option value="flc_trust" {{ $project->status  == "flc_trust" ? 'selected' : '' }}>در انتظار گروگزاری مجری</option>
                            <option value="trust_done" {{ $project->status  == "trust_done" ? 'selected' : '' }}>در حال انجام</option>
                            <option value="flc_done" {{ $project->status  == "flc_done" ? 'selected' : '' }}>مجری تحویل داده</option>
                            <option value="closed" {{ $project->status  == "closed" ? 'selected' : '' }}>پایان یافته</option>
                            <option value="open" {{ $project->status  == "open" ? 'selected' : '' }}>باز</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="publish_status">وضعیت انتشار پروژه</label>
                        <select name="publish_status" id="publish_status" class="select2">
                            <option value="">تغیری نکند</option>
                            <option value="pending" {{ $project->publish_status  == "pending" ? 'selected' : '' }}>مخفی</option>
                            <option value="closed" {{ $project->publish_status  == "closed" ? 'selected' : '' }}>پایان یافته</option>
                            <option value="canceled" {{ $project->publish_status  == "canceled" ? 'selected' : '' }}>لغو شده</option>
                            <option value="open" {{ $project->publish_status  == "open" ? 'selected' : '' }}>باز</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="features">ویژگی ها</label>
                        <select class="form-control select2 w-100" multiple id="features" name="features[]">
                            <option value="hidden" {{ $project->hidden ? 'selected' : '' }}>مخفی</option>
                            <option value="hire" {{ $project->hire ? 'selected' : '' }}>استخدامی</option>
                            <option value="urgent" {{ $project->urgent ? 'selected' : '' }}>فوری</option>
                            <option value="sticky" {{ $project->sticky ? 'selected' : '' }}>چسبنده</option>
                            <option value="private" {{ $project->private ? 'selected' : '' }}>شخصی</option>
                            <option value="special" {{ $project->special ? 'selected' : '' }}>ویژه</option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="content">متن درخواست</label>
                        <textarea name="content" id="content" class="form-control" rows="10">{{ $project->content }}</textarea>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-success">ویرایش</button>
                <a href="{{ route('projects.index') }}" class="btn btn-default float-left">بازگشت</a>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">آخرین پیشنهاد ها</h3>
        </div>
        <div class="card-body">
            <table class="datatable table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام کاربر</th>
                    <th>مبلغ</th>
                    <th>زمان تحویل (روز)</th>
                    <th>توضیحات</th>
                    <th>پیش پرداخت (درصد)</th>
                    <th>ضمانت تخصص (درصد)</th>
                    <th>تاریخ ایجاد</th>
                    <th>تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($project->offers()->latest()->get() as $offer)
                    <tr class="{{ optional($project->finalOffer())->id == $offer->id ? 'bg-success' :'' }}">
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('users.edit',['user' => $offer->user->id]) }}">{{ $offer->user->name() }}</a></td>
                        <td>{{ money($offer->price) }}</td>
                        <td>{{ $offer->deadline }}</td>
                        <td><button class="btn btn-primary btn-sm" data-html="true" data-trigger="hover"  data-container="body" data-toggle="popover" data-placement="top" data-content="{!! $offer->content !!}">توضیحات پیشنهاد</button></td>
                        <td>{{ $offer->prepayment }}</td>
                        <td>{{ $offer->warranty }}</td>
                        <td data-toggle="tooltip" title="{{ jdate($project->created_at)->format('H:i:s Y/m/d') }}">{{ jdate($project->created_at)->ago() }}</td>
                        <td class="d-flex">
                            @if($project->status == 'open')
                                <form action="{{ route('project.offer.assign',['offer'=>$offer->id]) }}" method="post">
                                    @csrf
                                    {{ method_field('PATCH') }}
                                    <button class="btn btn-success btn-sm btn-ask" type="submit">پذیرش پیشنهاد</button>
                                </form>
                            @endif
                            @if(optional($project->finalOffer())->id != $offer->id)
                                <form action="{{ route('project.offer.delete',['offer'=>$offer->id]) }}" method="post">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger btn-sm btn-ask" type="submit">حذف</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>نام کاربر</th>
                    <th>مبلغ</th>
                    <th>زمان تحویل (روز)</th>
                    <th>توضیحات</th>
                    <th>پیش پرداخت (درصد)</th>
                    <th>ضمانت تخصص (درصد)</th>
                    <th>تاریخ ایجاد</th>
                    <th>تنظیمات</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">پیام های مشکوک به اطلاعات تماس</h3>
        </div>
        <div class="card-body">
            <table class="datatable table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>از</th>
                    <th>به</th>
                    <th>پیام</th>
                    <th>تاریخ ارسال</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $pattern = "/(\+98|0)?9\d{9}/";
                    $epattern = "/[\w\d\.\ ]+[\@]+[\w\d\-]+[\.]+[a-z]+/";
                    $conversations = $project->conversations()->latest()->get();
                @endphp
                @foreach($conversations as $msg)
                    @if(preg_match($pattern,$msg->message) || preg_match($epattern,$msg->message))
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-center"><a href="{{ route('users.edit',['user_id'=>$msg->user_id]) }}">{{ $msg->user->nicky }}</a>
                            @if($msg->user->id == $project->user_id || $msg->user_id == optional($project)->freelancer_id)
                                <br>
                                @if($msg->user->id == $project->user_id)
                                    <span class="badge badge-success">کارفرما</span>
                                @else
                                    <span class="badge badge-info">مجری</span>
                                @endif
                            @endif
                        </td>
                        <td class="text-center"><a href="{{ route('users.edit',['user_id'=>$msg->target_id]) }}">{{ $msg->to->nicky }}</a>
                            @if($msg->to->id == $project->user_id || $msg->target_id == optional($project)->freelancer_id)
                                <br>
                                @if($msg->to->id == $project->user_id)
                                    <span class="badge badge-success">کارفرما</span>
                                @else
                                    <span class="badge badge-info">مجری</span>
                                @endif
                            @endif
                        </td>
                        <td>{!! $msg->message !!}</td>
                        <td data-toggle="tooltip" title="{{ jdate($msg->created_at)->format('H:i:s Y/m/d') }}">{{ jdate($msg->created_at)->ago() }}</td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>از</th>
                    <th>به</th>
                    <th>پیام</th>
                    <th>تاریخ ارسال</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">آخرین پیام ها</h3>
        </div>
        <div class="card-body">
            <table class="datatable table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>از</th>
                    <th>به</th>
                    <th>پیام</th>
                    <th>تاریخ ارسال</th>
                    <th>فایل ضمیمه</th>
                </tr>
                </thead>
                <tbody>
                @foreach($conversations as $msg)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-center"><a href="{{ route('users.edit',['user_id'=>$msg->user_id]) }}">{{ $msg->user->nicky }}</a>
                        @if($msg->user->id == $project->user_id || $msg->user_id == optional($project)->freelancer_id)
                            <br>
                            @if($msg->user->id == $project->user_id)
                                <span class="badge badge-success">کارفرما</span>
                            @else
                                <span class="badge badge-info">مجری</span>
                            @endif
                        @endif
                        </td>
                        <td class="text-center"><a href="{{ route('users.edit',['user_id'=>$msg->target_id]) }}">{{ $msg->to->nicky }}</a>
                        @if($msg->to->id == $project->user_id || $msg->target_id == optional($project)->freelancer_id)
                            <br>
                            @if($msg->to->id == $project->user_id)
                                <span class="badge badge-success">کارفرما</span>
                            @else
                                <span class="badge badge-info">مجری</span>
                            @endif
                        @endif
                        </td>
                        <td>{!! $msg->message !!}</td>
                        <td data-toggle="tooltip" title="{{ jdate($msg->created_at)->format('H:i:s Y/m/d') }}">{{ jdate($msg->created_at)->ago() }}</td>
                        <td>
                            @if($msg->files()->count())
                                @foreach($msg->files()->get() as $file)
                                    <div class="my-1 text-center">
                                        <a href="{{ $file->link() }}" class="btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="{{ humanSize($file->size,true) }}"><span class="ltr">{{ $file->id }}.{{ $file->type }}</span> <i class="fa fa-download"></i></a>
                                    </div>
                                @endforeach
                            @else
                               <div class="text-center">
                                   <span class="text-danger"><i class="fa fa-close"></i></span>
                               </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>از</th>
                    <th>به</th>
                    <th>پیام</th>
                    <th>تاریخ ارسال</th>
                    <th>فایل ضمیمه</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    {{--
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">آخرین ورود های پروژه</h3>
        </div>
        <div class="card-body">
            <table class="datatable table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>آیپی</th>
                    <th>وضعیت</th>
                    <th>یوزر ایجنت</th>
                    <th>تاریخ ورود</th>
                </tr>
                </thead>
                <tbody>
                @foreach($project->loginHistory()->latest()->take(100)->get() as $login)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $login->ip }}</td>
                        <td><span class="text-{{ $login->status ? 'primary' : 'danger' }}">{{ $login->status ? 'موفق' : 'ناموفق' }}</span></td>
                        <td data-toggle="tooltip" title="{{ $login->ua }}">{{ limit($login->ua,20) }}</td>
                        <td data-toggle="tooltip" title="{{ jdate($login->created_at)->format('H:i:s Y/m/d') }}">{{ jdate($login->created_at)->ago() }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>آیپی</th>
                    <th>وضعیت</th>
                    <th>یوزر ایجنت</th>
                    <th>تاریخ ورود</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>--}}
@stop
@section('script')
    <script src="{{ asset('admin/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/select2/i18n/fa.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2();
            $(".datatable").DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Persian.json"
                },
                "info" : false,
            });
            $('[data-toggle="popover"]').popover();
        });
    </script>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap4.css') }}">
@stop
