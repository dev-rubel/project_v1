<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>@yield('title','Laravel')</title>
        <meta charset="utf-8">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('inc.src.header')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- navbar -->
            @include('inc.navbar')

            <!-- aside -->
            @include('inc.aside')

            <!-- main content -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
            </div>    
            <!-- /.content-wrapper -->

            <!-- footer -->
            @include('inc.footer')
        </div>
        @include('inc.src.footer')
    </body>
</html>