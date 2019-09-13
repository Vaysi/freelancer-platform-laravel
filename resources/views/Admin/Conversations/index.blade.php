@extends('Admin.master')
@section('title',$title)
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>پروژه مربوطه</th>
                    <th>از کاربر</th>
                    <th>به کاربر</th>
                    <th>وضعیت</th>
                    <th>تاریخ ارسال</th>
                    <th>تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($conversations as $conversation)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td data-toggle="tooltip" title="{{ $conversation->project->title }}"><a href="{{ route('projects.edit',$conversation->project->id) }}">{{ limit($conversation->project->title,20) }}</a></td>
                            <td><a href="{{ route('users.edit',['user'=>$conversation->user->id]) }}">{{ $conversation->user->nicky }}</a></td>
                            <td><a href="{{ route('users.edit',['user'=>$conversation->to->id]) }}">{{ $conversation->to->nicky }}</a></td>
                            <td>
                            @if($conversation->status == 'confirmed')
                                <span class="badge badge-success">تایید شده</span>
                            @elseif($conversation->status == 'pending')
                                <span class="badge badge-warning">در حال انتظار</span>
                            @else
                                <span class="badge badge-danger">رد شده</span>
                            @endif
                            </td>
                            <td data-toggle="tooltip" title="{{ jdate($conversation->created_at)->format('H:i:s Y/m/d') }}">{{ jdate($conversation->created_at)->ago() }}</td>
                            <td class="d-flex">
                                <button type="button" class="btn btn-outline-primary btn-sm mx-1" data-toggle="modal" data-target="#msg{{ $conversation->id }}">نمایش پیام</button>
                                <div class="modal fade" id="msg{{ $conversation->id }}" tabindex="-1" role="dialog" aria-labelledby="msg{{ $conversation->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex justify-content-between align-items-center">
                                                <h5 class="modal-title" id="exampleModalLabel">محتوای پیام</h5>
                                            </div>
                                            <div class="modal-body">
                                                {!! justBr($conversation->message) !!}
                                                @if($conversation->files()->count())
                                                    <div class="mb-2 mt-4">
                                                        <span class="bg-secondary-3 rounded-half px-2"><i class="fa fa-link"></i> ضمیمه </span>
                                                        @foreach($conversation->files()->get() as $file)
                                                            <div class="my-1 text-left">
                                                                <a href="{{ $file->link() }}" class="btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="{{ humanSize($file->size,true) }}"><span class="ltr">{{ $file->id }}.{{ $file->type }}</span> <i class="fa fa-download"></i></a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($conversation->status != 'confirmed')
                                    <form action="{{ route('conversation.active',$conversation->id) }}" method="post">
                                        @csrf
                                        {{ method_field('PATCH') }}
                                        <button class="btn btn-success btn-sm btn-ask mx-1" type="submit">تایید</button>
                                    </form>
                                @endif
                                @if($conversation->status != 'rejected')
                                <form action="{{ route('conversation.reject',$conversation->id) }}" method="post">
                                    @csrf
                                    {{ method_field('PATCH') }}
                                    <button class="btn btn-danger btn-sm btn-ask mx-1" type="submit">رد کردن</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>پروژه مربوطه</th>
                    <th>از کاربر</th>
                    <th>به کاربر</th>
                    <th>وضعیت</th>
                    <th>تاریخ ارسال</th>
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
