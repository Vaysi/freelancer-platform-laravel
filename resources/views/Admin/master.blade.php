<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("admin/dist/css/adminlte.min.css") }}">

    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="{{ asset("admin/dist/css/bootstrap-rtl.min.css") }}">
    <!-- template rtl version -->
    <link rel="stylesheet" href="{{ asset("admin/dist/css/custom-style.css") }}">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset("css/admin.css") }}">
    @hasSection('css')
    <!-- Inline Css -->
    @yield('css')
    @endif
</head>
<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
    @include('Admin.layouts.header')
    @include('Admin.layouts.sidebar')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('title')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="#">داشبورد</a></li>
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            @if($errors->count())
            <section class="errors">
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </section>
            @endif
            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('Admin.layouts.footer')
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset("admin/plugins/jquery/jquery.min.js") }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset("admin/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset("admin/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
    <!-- Datatable -->
    <script src="{{ asset("admin/plugins/datatables/jquery.dataTables.js") }}"></script>
    <script src="{{ asset("admin/plugins/datatables/dataTables.bootstrap4.js") }}"></script>
    <!-- FastClick -->
    <script src="{{ asset("admin/plugins/fastclick/fastclick.js") }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset("admin/dist/js/adminlte.min.js") }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('js/admin.js') }}"></script>
    {{-- Include Sweet Alert --}}
    @include('sweetalert::alert')
    @hasSection('script')
    <!-- Inline Javascript -->
    @yield('script')
    @endif
</body>
</html>

