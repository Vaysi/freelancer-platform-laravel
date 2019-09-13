@extends('Admin.master')
@section('title',$title)
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if(isset($page) && isset($request))
                <form action="{{ route('projects.search.post') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="id">کد پروژه</label>
                                <input type="text" class="form-control" id="id" name="id" value="{{ $request->id }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="title">نام پروژه</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $request->title }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="price_range">محدوده قیمت</label>
                                <select class="form-control select2 w-100" id="price_range" name="price_range">
                                    <option value="">هیچکدام</option>
                                    <option value="1" {{ $request->price_range == 1 ? 'selected' : '' }}> خیلی کوچک » از 5,000 تومان تا 100,000 تومان </option>
                                    <option value="2" {{ $request->price_range  == 2 ? 'selected' : '' }}> کوچک » از 100,000 تومان تا 300,000 تومان </option>
                                    <option value="3" {{ $request->price_range  == 3 ? 'selected' : '' }}> متوسط » از 300,000 تومان تا 750,000 تومان </option>
                                    <option value="4" {{ $request->price_range  == 4 ? 'selected' : '' }}> نسبتا بزرگ » از 750,000 تومان تا 5,000,000 تومان </option>
                                    <option value="5" {{ $request->price_range  == 5 ? 'selected' : '' }}> بزرگ » از 5,000,000 تومان تا 15,000,000 تومان </option>
                                    <option value="6" {{ $request->price_range  == 6 ? 'selected' : '' }}> خیلی بزرگ » از 15,000,000 تومان تا 50,000,000 تومان </option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="features">ویژگی ها</label>
                                <select class="form-control select2 w-100" multiple id="features" name="features[]">
                                    <option value="hidden" {{ isset($features['hidden']) ? 'selected' : '' }}>مخفی</option>
                                    <option value="hire" {{ isset($features['hire']) ? 'selected' : '' }}>استخدامی</option>
                                    <option value="urgent" {{ isset($features['urgent']) ? 'selected' : '' }}>فوری</option>
                                    <option value="sticky" {{ isset($features['sticky']) ? 'selected' : '' }}>چسبنده</option>
                                    <option value="private" {{ isset($features['private']) ? 'selected' : '' }}>شخصی</option>
                                    <option value="special" {{ isset($features['special']) ? 'selected' : '' }}>ویژه</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="publish_status">وضعیت انتشار</label>
                                <select class="form-control select2 w-100" id="publish_status" name="publish_status">
                                    <option value="">مهم نیست</option>
                                    <option value="pending" {{ $request->publish_status  == "pending" ? 'selected' : '' }}>مخفی</option>
                                    <option value="closed" {{ $request->publish_status  == "closed" ? 'selected' : '' }}>پایان یافته</option>
                                    <option value="canceled" {{ $request->publish_status  == "canceled" ? 'selected' : '' }}>لغو شده</option>
                                    <option value="open" {{ $request->publish_status  == "open" ? 'selected' : '' }}>باز</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="status">وضعیت پروژه</label>
                                <select class="form-control select2 w-100" id="status" name="status">
                                    <option value="">مهم نیست</option>
                                    <option value="emp_trust" {{ $request->status  == "emp_trust" ? 'selected' : '' }}>در انتظار گروگزاری کارفرما</option>
                                    <option value="flc_trust" {{ $request->status  == "flc_trust" ? 'selected' : '' }}>در انتظار گروگزاری مجری</option>
                                    <option value="trust_done" {{ $request->status  == "trust_done" ? 'selected' : '' }}>در حال انجام</option>
                                    <option value="flc_done" {{ $request->status  == "flc_done" ? 'selected' : '' }}>مجری تحویل داده</option>
                                    <option value="open" {{ $request->status  == "open" ? 'selected' : '' }}>باز</option>
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <button type="submit" class="btn btn-info">جستجو</button>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
            <table id="datatable" class="table table-bordered table-striped">
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
                    @foreach($projects as $project)
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
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@stop
@section('script')
    <script src="{{ asset('admin/plugins/select2/select2.min.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2();
            $("#datatable").DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Persian.json"
                },
                "info" : false,
            });
        });
    </script>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
@stop
