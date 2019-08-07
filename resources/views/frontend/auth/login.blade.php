<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title>Login</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset('assets2/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets2/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets2/css/authentication.css')}}">
    <link rel="stylesheet" href="{{asset('assets2/css/color_skins.css')}}">
</head>

<body class="theme-orange">
<div class="authentication">
    <div class="card">
        <div class="body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header slideDown">
                        <div class="logo"><img src="assets/images/logo.png" alt="Nexa"></div>
                        <h1>Login</h1>
                    </div>                        
                </div>
                <form class="col-lg-12" id="sign_in" action="/login" method="POST">
                    @csrf
                    <h5 class="title">Sign in to your Account</h5>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" name="username" class="form-control">
                            <label class="form-label">Username</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="password" name="password" class="form-control">
                            <label class="form-label">Password</label>
                        </div>
                    </div>
                    <div>
                        <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-cyan">
                        <label for="rememberme">Remember Me</label>
                    </div>
                    
                <div class="col-lg-12">
                        <input type="submit" class="btn btn-raised btn-primary waves-effect" value="SIGN IN">                        
                    </div>                        
                </form>
                <div class="col-lg-12 m-t-20">
                    <a class="" href="forgot-password.html">Forgot Password?</a>
                </div>                    
            </div>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="{{asset('assets2/bundles/libscripts.bundle.js')}}"></script>    
<script src="{{asset('assets2/bundles/vendorscripts.bundle.js')}}"></script>
<script src="{{asset('assets2/bundles/mainscripts.bundle.js')}}"></script>
</body>
</html>