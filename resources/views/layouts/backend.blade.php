<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} | Admin | @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/skins/_all-skins.min.css') }}">

    <!-- Vue -->
    <script src="{{ asset('assets/plugins/vue/vue.min.js') }}"></script>

    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">

    <!-- toastr -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">


    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>


    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>P</b>L</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>{{ config('app.name') }}</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="user-image"
                                 alt="User Image">
                            <span class="hidden-xs">{{ Auth::user()->fullName }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle"
                                     alt="User Image">

                                <p>
                                    {{ Auth::user()->fullName }}
                                    <small>{{ Auth::user()->email }}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Sign out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->fullName }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <ul class="sidebar-menu" data-widget="tree">
                <li @if(request()->is('admin/dashboard')) class="active" @endif>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @can('user-list')
                    <li @if(request()->is('admin/users')) class="active" @endif>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user-secret"></i>
                            <span>Users</span>
                        </a>
                    </li>
                @endcan
                @can('role-list')
                    <li @if(request()->is('admin/roles')) class="active" @endif>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-user-secret"></i>
                            <span>Role</span>
                        </a>
                    </li>
                @endcan
                @can('department-list')
                    <li @if(request()->is('admin/departments')) class="active" @endif>
                        <a href="{{ route('admin.departments.index') }}">
                            <i class="fa fa-user-secret"></i>
                            <span>Department</span>
                        </a>
                    </li>
                @endcan
                @can('work-list')
                    <li @if(request()->is('admin/works')) class="active" @endif>
                        <a href="{{ route('admin.works.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>Work</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper" id="app">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            Developed by <a href="#">Sohana Kabir Barna</a>
        </div>
        <strong>Copyright &copy; {{ date('Y') }} {{ config('app.name') }}.</strong> All rights
        reserved.
    </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('assets/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap  -->
<script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('assets/bower_components/chart.js/Chart.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('assets/dist/js/pages/dashboard2.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/dist/js/demo.js') }}"></script>
<!-- swal2 -->
<script src="{{ asset('assets/plugins/swal2/sweetalert2.all.min.js') }}"></script>

<!-- toastr -->
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
</body>
</html>
<script>
    $(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        @if (session('successMessage'))
        Swal.fire({
            title: 'Success!',
            text: "{!! session('successMessage') !!}",
            type: 'success',
            confirmButtonText: 'Ok'
        });
        @elseif (session('errorMessage'))
        Swal.fire({
            title: 'Error!',
            text: "{!! session('errorMessage') !!}",
            type: 'error',
            confirmButtonText: 'Ok'
        });
        @endif

        //Initialize Select2 Elements
        $('.select2').select2({
            width: '100%',
            placeholder: 'Select',
        });

        $('.tags').select2({
            tags: true,
            tokenSeparators: [',']
        });
    });

    Vue.directive('select2', {
        inserted(el) {
            $(el).on('select2:select', () => {
                const event = new Event('change', {bubbles: true, cancelable: true});
                el.dispatchEvent(event);
            });
            $(el).on('select2:unselect', () => {
                const event = new Event('change', {bubbles: true, cancelable: true})
                el.dispatchEvent(event)
            })
        },
    });
</script>

@stack('scripts')
