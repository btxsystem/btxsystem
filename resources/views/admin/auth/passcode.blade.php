<!DOCTYPE html>
<html>

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

    <style>

        .help-block {
            color: #a94442;
        }
        .change_link .btn-warning{
            color: #fff;
        }
        #wrapper label {
            color: rgb(64, 92, 96);
            font-weight: 700;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row my-3" >
            <div class="col-12 mx-auto">
            <div id="notific">
            </div>
        </div>
        </div>
        <div class="row vertical-offset-100">
            <!-- Notifications -->
            <div class="col-sm-6 col-sm-offset-3  col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4 mx-auto">

                <div id="container_demo">
                    <a class="hiddenanchor" id="tologin"></a>
                    <a class="hiddenanchor" id="toforgot"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form action="{{ route('login.passcode') }}" autocomplete="on" method="post" role="form" id="login_form" class="my-3">
                                <h3 class="black_bg">
                                    <img src="{{ URL::to('/') }}/img/logo.png" alt="Bitrexgo" style="height:70px">
                                    <h3>&nbsp;</h3>
                                    <!-- CSRF Token -->
                                    {{ csrf_field() }}
                                <div class="form-group ">
                                    <label style="margin-bottom:0px;" for="password" class="youpasswd"> <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                                        Passcode
                                    </label>
                                    <input id="passcode" name="passcode" type="password" placeholder="Enter Passcode" />
                                    <div class="col-sm-12">

                                    </div>
                                </div>
                                <div class="form-group ">
                                @if(isset($message))
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @endif
                                </div>
                                <!-- <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="remember-me" id="remember-me" value="remember-me"
                                               class="square-blue"/>
                                        Keep me logged in
                                    </label>
                                </div> -->
                                <p class="login button">
                                    <input type="submit" value="Log In" class="btn btn-success" />
                                </p>
                                <!-- <p class="change_link">
                                    <a href="#toforgot">
                                        <button type="button" class="btn btn-responsive botton-alignment btn-warning btn-sm">Forgot password</button>
                                    </a>

                                </p> -->
                            </form>
                        </div>
                        <div id="forgot" class="animate form">
                            <form action="" autocomplete="on" method="post" role="form" id="reset_pw">
                                <h3 class="black_bg my-3">
                                    <img src="{{ asset('assets/img/logo.png') }}" alt="josh logo"><br>Forgot Password</h3>
                                <p style="font-size:14px !important;">
                                    Enter your email address below and we'll send a special reset password link to your inbox.
                                </p>


                                <input type="hidden" name="_token" />

                                <div class="form-group ">
                                    <label style="margin-bottom:0px;" for="emailsignup1" class="youmai">
                                        <i class="livicon" data-name="mail" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                                        Your email
                                    </label>
                                    <input id="email" name="email" required type="email" placeholder="your@mail.com"
                                           />
                                    <div class="col-sm-12">

                                    </div>
                                </div>
                                <p class="login button">
                                    <input type="submit" value="Reset Password" class="btn btn-success" />
                                </p>
                                <p class="change_link">
                                    <a href="#tologin" class="to_register">
                                        <button type="button" class="btn btn-responsive botton-alignment btn-warning btn-sm">Back</button>
                                    </a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- global js -->
    <script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <!--livicons-->
    <script src="{{ asset('assets/js/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/js/livicons-1.4.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/login.js') }}" type="text/javascript"></script>
    <!-- end of global js -->
</body>
</html>
