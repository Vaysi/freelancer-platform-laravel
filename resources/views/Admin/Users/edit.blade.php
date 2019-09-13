@extends('Admin.master')
@section('title','کاربر ها')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">ویرایش کاربر</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('users.update',['user'=>$user->id]) }}" method="post">
            @csrf
            {{ method_field('PATCH') }}
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-12 text-center collapse show" id="avatar">
                        <img src="{{ $user->avatar }}" class="d-block mx-auto img-circle">
                        <label class="btn btn-outline-danger btn-sm mt-2" data-target="#avatar" data-toggle="collapse">
                            حذف آواتار
                            <input class="hide" type="radio" name="avatar" value="default.jpg">
                        </label>
                    </div>
                    <div class="form-group col-6">
                        <label for="name">نام کاربر</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="nickname">نام نمایشی</label>
                        <input type="text" class="form-control" id="nickname" name="nickname" value="{{ $user->nickname }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="email">ایمیل</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="phone">موبایل</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="balance">موجودی کاربر</label>
                        <input type="text" class="form-control" id="balance" name="balance" value="{{ $user->balance }}">
                        <span class="text-small form-text small">موجودی کاربر  : <b>{{ money($user->balance) }}</b></span>
                    </div>
                    <div class="form-group col-6">
                        <label for="expires_at">تاریخ انقضا حساب ویژه : </label>
                        <input type="text" class="form-control datepicker" id="expires_at" name="expires_at" value="{{ $user->expires_at }}">
                        <span class="text-small form-text small">تاریخ انقضا  : <b>{{ jdate($user->expires_at)->format('Y/m/d') }}</b></span>
                    </div>
                    <div class="form-group col-6">
                        <label for="package_id">پکیج ویژه کاربر :</label>
                        <select name="package_id" id="package_id" class="select2">
                            @foreach(\App\Package::all() as $package)
                            <option value="{{ $package->id }}" {{ $user->package()->id == $package->id ? 'selected' : '' }}>{{ $package->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="admin">ادمین باشد ؟</label>
                        <select name="admin" id="admin" class="select2">
                            <option value="0">خیر</option>
                            <option value="1" {{ $user->admin ? 'selected' : '' }}>بله</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-success">ویرایش</button>
                <a href="{{ route('users.index') }}" class="btn btn-default float-left">بازگشت</a>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">آخرین پروژه های کاربر ( به عنوان کارفرما )</h3>
        </div>
        <div class="card-body">
            <table class="datatable table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان</th>
                    <th>بازه مالی</th>
                    <th>وضعیت</th>
                    <th>وضعیت انتشار</th>
                    <th>تاریخ ایجاد</th>
                    <th>تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user->projects()->latest()->get() as $project)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td data-toggle="tooltip" title="{{ $project->title }}">{{ limit($project->title,20) }}</td>
                        <td>{{ money(project_range($project->price_range,true)[0]) . " تا " . money(project_range($project->price_range,true)[1]) }}</td>
                        <td>{!! project_status($project) !!}</td>
                        <td>{!! publish_status($project) !!}</td>
                        <td data-toggle="tooltip" title="{{ jdate($project->created_at)->format('H:i:s Y/m/d') }}">{{ jdate($project->created_at)->ago() }}</td>
                        <td class="d-flex">
                            <a href="{{ route('projects.edit',['project'=>$project->id]) }}" class="btn btn-outline-warning btn-sm mx-1">ویرایش</a>
                            @if($project->publish_status == 'pending')
                                <form action="{{ route('project.active',['project'=>$project->id]) }}" method="post">
                                    @csrf
                                    {{ method_field('PATCH') }}
                                    <button class="btn btn-info btn-sm btn-ask" type="submit">انتشار</button>
                                </form>
                            @elseif(in_array($project->status,['open']) && $project->publish_status == 'open')
                                <form action="{{ route('project.deactivate',['project'=>$project->id]) }}" method="post">
                                    @csrf
                                    {{ method_field('PATCH') }}
                                    <button class="btn btn-warning btn-sm btn-ask" type="submit">معلق</button>
                                </form>
                            @endif
                            <form class="mr-1" action="{{ route('projects.destroy',['project'=>$project->id]) }}" method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button class="btn btn-danger btn-sm btn-ask" type="submit">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>عنوان</th>
                    <th>بازه مالی</th>
                    <th>وضعیت</th>
                    <th>وضعیت انتشار</th>
                    <th>تاریخ ایجاد</th>
                    <th>تنظیمات</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">آخرین پروژه های کاربر ( به عنوان فریلنسر )</h3>
        </div>
        <div class="card-body">
            <table class="datatable table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان</th>
                    <th>بازه مالی</th>
                    <th>وضعیت</th>
                    <th>وضعیت انتشار</th>
                    <th>تاریخ ایجاد</th>
                    <th>تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user->jobs()->latest()->get() as $project)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td data-toggle="tooltip" title="{{ $project->title }}">{{ limit($project->title,20) }}</td>
                        <td>{{ money(project_range($project->price_range,true)[0]) . " تا " . money(project_range($project->price_range,true)[1]) }}</td>
                        <td>{!! project_status($project) !!}</td>
                        <td>{!! publish_status($project) !!}</td>
                        <td data-toggle="tooltip" title="{{ jdate($project->created_at)->format('H:i:s Y/m/d') }}">{{ jdate($project->created_at)->ago() }}</td>
                        <td class="d-flex">
                            <a href="{{ route('projects.edit',['project'=>$project->id]) }}" class="btn btn-outline-warning btn-sm ">ویرایش</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>عنوان</th>
                    <th>بازه مالی</th>
                    <th>وضعیت</th>
                    <th>وضعیت انتشار</th>
                    <th>تاریخ ایجاد</th>
                    <th>تنظیمات</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">آخرین ورود های کاربر</h3>
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
                @foreach($user->loginHistory()->latest()->take(100)->get() as $login)
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
    </div>
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
        });
    </script>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap4.css') }}">
@stop
