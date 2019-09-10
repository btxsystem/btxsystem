<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Expired member</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- global level js -->
    <link rel="stylesheet" href="{{asset('assets2/css/505.css')}}">
    <!-- end of global js-->
    <!-- page level styles-->
    <style>
    body {
        text-align: center;
        font-family: 'Lato', sans-serif;
    }

    .btn {
        border-radius: 4px;
        font-size: 15px;
        font-weight: 400;
        line-height: 1.4;
        padding: 7px 24px;
        transition: border 0.25s linear 0s, color 0.25s linear 0s, background-color 0.25s linear 0s;
    }

    h1 {
        font-size: 120px;
        text-align: center;
    }

    .form-control {
        background-color: #FFFFFF !important;
        border: 1px solid #D3D3D3;
        border-radius: 2px;
        box-shadow: none;
        color: #555555;
        display: inline-block;
        font-size: 13px;
        height: auto;
        padding: 8px 12px;
        width: 100%;
    }
    </style>
    <!-- end of page level styles-->
</head>
<body>
    <div class="container-fluid">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-offset-1 col-xs-10 middle">
            <div class="error-container">
                <div class="error-main">
                    <h1>
                        Sorry
                    </h1>
                    <h3>
                        Expired,
                        <br>your membership period has expired, contact the admin to follow up.
                    </h3>
                        <a href="/login" class="btn btn-warning">Back</a>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <!-- global js -->
    <script src="js/app.js" type="text/javascript"></script>
    <!-- end of global js -->
    <!-- begining of page level js-->
    <script>
    $("document").ready(function() {
        setTimeout(function() {
            $(".livicon").trigger('click');
        }, 10);
    });
    // code for aligning center
    $(document).ready(function() {
        var x = $(window).height();
        var y = $(".middle").height();
        //alert(x);
        x = x - y;
        x = x / 2;
        $(".middle").css("padding-top", x);
    });
    </script>
    <!-- end of page level js-->
</body>
</html>