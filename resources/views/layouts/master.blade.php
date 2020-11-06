<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 3 </title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ url('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
        <link rel="stylesheet" href="{{ url('/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ url('/plugins/jqvmap/jqvmap.min.css') }}">
        <link rel="stylesheet" href="{{ url('/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ url('/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <link rel="stylesheet" href="{{ url('/plugins/daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ url('/plugins/summernote/summernote-bs4.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        @yield('css')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- /.navbar -->
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="index3.html" class="brand-link">
                <img src="/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Sales Report</span>
                </a>
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">Admin</a>
                        </div>
                    </div><nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="{{ url('/dashboard')}}" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">

                                <a href="{{ url('/orders') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Orders</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/orders/upload') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Upload Excel</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/reports') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Reports</p>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="{{ url('/users')}}" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>Users</p>
                                </a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>Logout</p>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="content-wrapper">
                @yield('content')
            </div>
            <footer class="main-footer">
                <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 3.0.5
                </div>
            </footer>
            <aside class="control-sidebar control-sidebar-dark">
            </aside>
        </div>
        <script src="{{ url('/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ url('/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <script src="{{ url('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('/plugins/chart.js/Chart.min.js') }}"></script>
        <script src="{{ url('/plugins/sparklines/sparkline.js') }}"></script>
        <script src="{{ url('/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
        <script src="{{ url('/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
        <script src="{{ url('/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
        <script src="{{ url('/plugins/moment/moment.min.js') }}"></script>
        <script src="{{ url('/plugins/daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ url('/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <script src="{{ url('/plugins/summernote/summernote-bs4.min.js') }}"></script>
        <script src="{{ url('/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <script src="{{ url('/js/adminlte.js') }}"></script>
        <script src="{{ url('/js/pages/dashboard.js') }}"></script>
        <script src="{{ url('/js/demo.js') }}"></script>
        @yield('scripts')
    </body>
</html>