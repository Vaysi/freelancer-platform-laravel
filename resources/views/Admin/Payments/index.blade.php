@extends('Admin.master')
@section('title','حسابداری')
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h4>{{ money($earning,false) }}<sup style="font-size: 15px" class="mx-1">تومان</sup></h4>

                    <p>کل درامد سایت</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h4>{{ money($site,false) }}<sup style="font-size: 15px" class="mx-1">تومان</sup></h4>

                    <p>درامد از پرداختی ها</p>
                </div>
                <div class="icon" style="font-size: 70px;top: 0;">
                    <i class="fa fa-money"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h4>{{ money($premium,false) }}<sup style="font-size: 15px" class="mx-1">تومان</sup></h4>

                    <p>درامد حساب کاربری ویژه</p>
                </div>
                <div class="icon" style="font-size: 70px;top: 0;">
                    <i class="fa fa-gift"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h4>{{ money($projectsFee,false) }}<sup style="font-size: 15px" class="mx-1">تومان</sup></h4>

                    <p>سود کل پروژه های سایت</p>
                </div>
                <div class="icon" style="font-size: 70px;top: 0;">
                    <i class="fa fa-file-text"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">آخرین پرداختی ها</h3>
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
