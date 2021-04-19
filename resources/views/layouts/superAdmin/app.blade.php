<!DOCTYPE html>
<html lang="en">

<head>
    <title>Adminty - Premium Admin Template by Colorlib </title>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')}}"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
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
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/assets/icon/feather/css/feather.css')}}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/assets/css/jquery.mCustomScrollbar.css')}}">
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
<script type="text/javascript" src="{{ asset('superAdmin/bower_components/jquery/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('superAdmin/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('superAdmin/bower_components/popper.js/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('superAdmin/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>
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
<!-- Custom js -->
<script type="text/javascript" src="{{ asset('superAdmin/assets/js/SmoothScroll.js')}}"></script>
<script src="{{ asset('superAdmin/assets/js/pcoded.min.js')}}"></script>
<script src="{{ asset('superAdmin/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{ asset('superAdmin/assets/js/vartical-layout.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('superAdmin/assets/pages/dashboard/analytic-dashboard.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('superAdmin/assets/js/script.js')}}"></script>
</body>

</html>
