<!DOCTYPE html>
<html lang="en">

<head>
    <title>Adminty - Premium Admin Template by Colorlib </title>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('superAdmin/assets/images/favicon.ico')}}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css"  href="{{ asset('superAdmin/bower_components/bootstrap/css/bootstrap.min.css')}}">
     <!-- Font Awesome -->
     <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/assets/icon/font-awesome/css/font-awesome.min.css') }}">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/assets/icon/feather/css/feather.css')}}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/assets/css/style.css')}}">
       <!-- sweet alert framework -->
       <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/bower_components/sweetalert/css/sweetalert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/assets/css/jquery.mCustomScrollbar.css')}}">
    <link rel="stylesheet" href="{{ asset('superAdmin/assets/css/dropify.css')}}">
    <script type="text/javascript" src="{{ asset('superAdmin/bower_components/jquery/js/jquery.min.js')}}"></script>
    <script src="{{ asset('superAdmin/assets/js/dropify.min.js')}}"></script>
    <script src="{{ asset('admin/assets/js/plugins/notify.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.1/chart.min.js"></script>
</head>

<body>
<!-- Pre-loader start -->
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
        </div>
    </div>
</div>
<!-- Pre-loader end -->
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
        @include('layouts.superAdmin.navbar')
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                @include('layouts.superAdmin.sidebar')
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <div class="main-body">
                            <div class="page-wrapper">
                                @yield('content')
                            </div>
                            <div id="styleSelector">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Required Jquery -->
    <script type="text/javascript" src="{{ asset('superAdmin/bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('superAdmin/bower_components/popper.js/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('superAdmin/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{ asset('superAdmin/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{ asset('superAdmin/bower_components/modernizr/js/modernizr.js')}}"></script>
    <script type="text/javascript" src="{{ asset('superAdmin/bower_components/modernizr/js/css-scrollbars.js')}}"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="{{ asset('superAdmin/bower_components/chart.js/js/Chart.js')}}"></script>
    <!-- amchart js -->
    <script src="{{ asset('superAdmin/assets/pages/widget/amchart/amcharts.js')}}"></script>
    <script src="{{ asset('superAdmin/assets/pages/widget/amchart/serial.js')}}"></script>
    <script src="{{ asset('superAdmin/assets/pages/widget/amchart/light.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- notification js -->
    <script type="text/javascript" src="{{ asset('superAdmin/assets/js/bootstrap-growl.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('superAdmin/assets/pages/notification/notification.js') }}"></script>
  <script>

  </script>
  <!-- data-table js -->
  <script src="{{ asset('superAdmin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('superAdmin/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{ asset('superAdmin/assets/pages/data-table/js/jszip.min.js')}}"></script>
  <script src="{{ asset('superAdmin/assets/pages/data-table/js/pdfmake.min.js')}}"></script>
  <script src="{{ asset('superAdmin/assets/pages/data-table/js/vfs_fonts.js')}}"></script>
  <script src="{{ asset('superAdmin/bower_components/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
  <script src="{{ asset('superAdmin/bower_components/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
  <script src="{{ asset('superAdmin/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.j')}}s"></script>
  <script src="{{ asset('superAdmin/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{ asset('superAdmin/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>


  <script src="{{ asset('admin/assets/js/plugins/jquery.validate.min.js')}}"></script>
  <script src="{{ asset('superAdmin/assets/js/sweetalert2.js')}}"></script>
  <script src="{{ asset('admin/assets/js/function.js')}}"></script>
  <!-- sweet alert js -->
  <script type="text/javascript" src="{{ asset('superAdmin/bower_components/sweetalert/js/sweetalert.min.js') }}"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="{{ asset('superAdmin/assets/js/SmoothScroll.js')}}"></script>
    <script src="{{ asset('superAdmin/assets/js/pcoded.min.js')}}"></script>
    <script src="{{ asset('superAdmin/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{ asset('superAdmin/assets/js/vartical-layout.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('superAdmin/assets/pages/dashboard/analytic-dashboard.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('superAdmin/assets/js/script.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
</body>

</html>
