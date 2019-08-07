@extends('layouts.app')
@section('content')
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- global level css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet"/>
    <!-- end of global level css -->
    <!-- page level css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/login.css') }}" />
    <link href="{{ asset('assets/vendors/iCheck/css/square/blue.css') }}" rel="stylesheet"/>
    <!-- end of page level css -->

</head>
<body>
<div class="container">
    <div class="row vertical-offset-100">
        <!-- Notifications -->
        <div class="col-sm-6 col-sm-offset-3  col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4">
            <div id="container_demo">
                <a class="hiddenanchor" id="tologin"></a>
                <a class="hiddenanchor" id="toforgot"></a>
                <div id="wrapper">
                    <div id="login" class="animate form">                
                        <form method="POST" action="{{ route('login') }}" autocomplete="on" role="form" id="login_form">
                        {{ csrf_field() }}
                        <h3 class="black_bg">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="josh logo">
                                <br>Log In</h3>
                        <div class="form-group ">
                                <label style="margin-bottom:0px;" for="username" class="uname control-label"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                                    Username
                                </label>
                                <input id="username" name="username" type="text" placeholder="Username"
                                        value=""/>
                                <div class="col-sm-12">
                                </div>
                            </div>

                        <div class="form-group ">
                                <label style="margin-bottom:0px;" for="password" class="youpasswd"> <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                                    Password
                                </label>
                                <input id="password" name="password" type="password" placeholder="Enter a password" />
                                <div class="col-sm-12">
                                </div>
                            </div>

                        <div class="form-group">
                                <label>
                                    <input type="checkbox" name="remember-me" id="remember-me" value="remember-me"
                                            class="square-blue"/>
                                    Keep me logged in
                                </label>
                            </div>

                        <p class="login button">
                                <input type="submit" value="Log In" class="btn btn-success" />
                            </p>
                            <p class="change_link">
                                <a href="{{ route('password.request') }}">
                                    <button type="button" class="btn btn-responsive botton-alignment btn-warning btn-sm">Forgot password</button>
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- global js -->
    <script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <!--livicons-->
    <script src="{{ asset('assets/js/raphael-min.js') }}"></script>
    <script src="{{ asset('assets/js/livicons-1.4.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/login.js') }}" type="text/javascript"></script>
    <!-- end of global js -->

</body>
@endsection

