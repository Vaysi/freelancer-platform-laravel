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
                    <th>کاربر</th>
                    <th>بانک</th>
                    <th>کد پیگیری</th>
                    <th>مبلغ</th>
                    <th>وضعیت</th>
                    <th>تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($withdraws as $withdraw)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('users.edit',['user'=>$withdraw->user->id]) }}">{{ $withdraw->user->name }}</a></td>
                        <td>{{ $withdraw->bank }}</td>
                        <td>{{ $withdraw->refId ?? '-' }}</td>
                        <td>{{ money($withdraw->price) }}</td>
                        <td>
                            @if($withdraw->status == 'pending')
                                <span class="badge badge-warning">در انتظار پرداخت<span>
                            @elseif($withdraw->status == 'deposited')
                                <span class="badge badge-success">واریز شده</span>
                            @else
                                <span class="badge badge-danger">لغو شده</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('withdraws.view',['withdraw'=>$withdraw->id]) }}" class="btn btn-info btn-sm">واریز / نمایش جزئیات</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>کاربر</th>
                    <th>بانک</th>
                    <th>کد پیگیری</th>
                    <th>مبلغ</th>
                    <th>وضعیت</th>
                    <th>تنظیمات</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            {!! render($withdraws->render()) !!}
        </div>
    </div>
    <!-- /.card -->
@stop
@section('script')
    <script>
        $(function () {
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
@stop
