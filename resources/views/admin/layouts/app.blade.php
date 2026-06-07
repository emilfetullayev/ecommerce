<!doctype html>
<html lang="en" data-layout="vertical" data-layout-style="detached" data-sidebar="light" data-topbar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">


<head>

    <meta charset="utf-8" />
    <title>Dashboard | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.ico') }}">

    <link href="{{ asset('admin/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Swiper slider css -->
    <link href="{{ asset('admin/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{ asset('admin/js/layout.js') }}"></script>

    <!-- Bootstrap Css -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Icons Css -->
    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App Css -->
    <link href="{{ asset('admin/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Custom Css -->
    <link href="{{ asset('admin/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body>
<!-- Begin page -->
<div id="layout-wrapper">

    @include('admin.partials.header')

    @include('admin.partials.sidebar')


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            @yield('content')

            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        @include('admin.partials.footer')

    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

@include('admin.partials.end')


</body>
</html>
