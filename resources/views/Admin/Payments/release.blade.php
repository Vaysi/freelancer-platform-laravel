@extends('Admin.master')
@section('title','آخرین آزادسازی ها')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">آخرین آزادسازی ها</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>کاربر</th>
                    <th>عنوان</th>
                    <th>نوع</th>
                    <th>مبلغ</th>
                    <th>وضعیت</th>
                    <th>درصد</th>
                    <th>روش پرداخت</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $payment->user->name }}</td>
                        <td>{{ $payment->message }}</td>
                        <td>{{ paymentType($payment) }}</td>
                        <td>{{ money($payment->price) }}</td>
                        <td>{!! $payment->status ? '<span class="badge badge-success">موفق<span>' : '<span class="badge badge-danger">نا موفق</span>' !!}</td>
                        <td>{{ $payment->percent }}%</td>
                        <td>{{ $payment->method == 'balance' ? 'اعتباری' : 'آنلاین' }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>کاربر</th>
                    <th>عنوان</th>
                    <th>نوع</th>
                    <th>مبلغ</th>
                    <th>وضعیت</th>
                    <th>درصد</th>
                    <th>روش پرداخت</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            {!! render($payments->render()) !!}
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
