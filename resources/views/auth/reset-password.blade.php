<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login - Ad store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/slicknav.min.css') }}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/default-css.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/responsive.css') }}">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    
                    <div class="login-form-head">
                        <img src="{{ asset('backend/assets/images/logo.png') }}" 
                        alt="Sobkisubazar" class="mw-120 h-51px h-md-51px">
                    </div>
                    <div class="login-form-body">

                        <p style="margin-top: 5px;margin-bottom: 17px;text-align: center;color: red;" id="msg"></p>

                        <div class="form-gp focused">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" id="exampleInputEmail1" value="{{ $request->email }}">
                            <i class="ti-email"></i>
                            <small class="form-text" id="erremail"></small>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">New Password</label>
                            <input type="password" name="password" id="exampleInputPassword1">
                            <i class="ti-lock"></i>
                            <small class="form-text" id="errpassword"></small>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="exampleInputPassword1">
                            <i class="ti-lock"></i>
                            <small class="form-text" id="errpassword"></small>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Reset Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    <script src="{{ asset('backend/assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{ asset('backend/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery.slicknav.min.js') }}"></script>
    
    <!-- others plugins -->
    <script src="{{ asset('backend/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('backend/assets/js/scripts.js') }}"></script>

</body>

</html>
