<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/fontawesome-free/css/all.min.css">

    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('admin') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin') }}/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">



</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div id="app">
        <admin-master></admin-master>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->

    <script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/dist/js/adminlte.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
