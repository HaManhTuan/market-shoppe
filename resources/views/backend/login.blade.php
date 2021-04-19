
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('admin/assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/assets/libs/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/fontawesome/css/fontawesome-all.css')}}">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    .error{
        color: brown;
        font-size: 14px;
        padding: 5px;
    }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center">
                <span class="splash-description">ĐĂNG NHẬP HỆ THỐNG.</span>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/dang-nhap') }}" method="POST" onsubmit="return false;" id="frm-login">
                    @csrf
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="email" id="email" type="email"
                         placeholder="Email" autocomplete="off" data-rule-required="true" data-msg-required="Vui lòng nhập email.">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="password" id="password" type="password"
                         placeholder="Mật khẩu" data-rule-required="true" data-msg-required="Vui lòng nhập mật khẩu.">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block btn-sign">Đăng nhập</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <script src="{{ asset('admin/assets/js/plugins/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('admin/assets/js/plugins/notify.js')}}"></script>
    <script src="{{ asset('admin/assets/js/login.js') }}"></script>
</body>

</html>
