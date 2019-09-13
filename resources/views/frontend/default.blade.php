<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>
    @section('title')
     | Bitrexgo
    @show
</title>

<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="{{asset('assets2/plugins/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets2/plugins/morrisjs/morris.css')}}" />
<!-- Custom Css -->
<link rel="stylesheet" href="{{asset('assets2/css/ecommerce.css')}}">
<link rel="stylesheet" href="{{asset('assets2/css/main.css')}}">
<link rel="stylesheet" href="{{asset('assets2/css/color_skins.css')}}">
<link rel="stylesheet" href="{{asset('assets2/css/datatable.css')}}">
<link rel="stylesheet" href="{{asset('assets2/css/raw.css')}}">
<link rel="stylesheet" href="{{asset('assets2/css/responsive.css')}}">

<link rel="stylesheet" href="{{asset('assets2/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<!-- tree -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/tree/Treant.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/tree/basic-example.css') }}">

<!-- select 2 -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets2/css/select2.css') }}">

</head>

@yield('header_styles')
<body class="theme-orange">
<!-- Top Bar -->
    @include('frontend.layouts.top_bar')
<!-- Left Sidebar -->

    @include('frontend.layouts.side_bar')

<!-- Main Content -->
@yield('content')

<!-- Jquery Core Js --> 
<script src="{{asset('assets2/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js --> 
<script src="{{asset('assets2/bundles/vendorscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js --> 

<script src="{{asset('assets2/bundles/jvectormap.bundle.js')}}"></script> <!-- JVectorMap Plugin Js -->
<script src="{{asset('assets2/bundles/morrisscripts.bundle.js')}}"></script><!-- Morris Plugin Js -->
<script src="{{asset('assets2/bundles/sparkline.bundle.js')}}"></script> <!-- Sparkline Plugin Js -->
<script src="{{asset('assets2/bundles/knob.bundle.js')}}"></script> <!-- Jquery Knob Plugin Js -->

<script src="{{asset('assets2/bundles/mainscripts.bundle.js')}}"></script>
<script src="{{asset('assets2/js/pages/index.js')}}"></script>
<script src="{{asset('assets2/js/moment.js')}}"></script>
<script src="{{asset('assets2/js/number.js')}}"></script>
{{-- <script src="{{asset('assets2/js/modal.js')}}"></script> --}}
<script src="{{asset('assets2/js/pages/charts/jquery-knob.min.js')}}"></script>

<!-- Date Picker --> 
<script src="{{asset('assets2/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
<script src="{{asset('assets2/js/pages/forms/basic-form-elements.js')}}"></script>

<!-- Jquery Datatable -->
<script src="{{asset('assets2/js/datatable.js')}}"></script>
<script src="{{asset('assets2/js/raw-order.js')}}"></script>
<script src="{{asset('assets2/js/responsive.js')}}"></script>

<!-- Jquery sweet alert --> 
<script src="{{asset('assets2/js/sweet.js')}}"></script>

<!-- Jquery countdown -->
<script src="{{asset('assets2/js/countdown.js')}}"></script>
<script src="{{asset('assets2/js/countdown.min.js')}}"></script>

<!-- tree -->
<script type="text/javascript" src="{{ asset('assets/tree/Treant.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/tree/basic-example.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/tree/raphael.js') }}" ></script>
<script src="{{ asset('assets/tree/panzoom.js') }}"></script>
<script src="{{ asset('assets/tree/d3.js') }}"></script>

<!-- select2 -->
<script type="text/javascript" src="{{ asset('assets2/js/select2.js') }}" ></script>
<style>
    span#clock{
        background: black;
        border-radius: 5px;
        color: white;
        padding-top: 5px;
        padding-bottom: 5px;
        padding-right: 5px;
        padding-left: 5px;
        font-family: 'Times New Roman', Times, serif;
        font-size: 20px;
    }

    .profile-page .profile{
        font-size: 14px !important;
        text-align: left !important;
    }

    .profile-page .profile-sub-header .box-list ul li a p {
        padding-top: 10px;
    }

    @media only screen and (max-width: 480px) {
    /* For mobile phones: */
        span#clock{
            margin-left: -9px;
            font-size: 12px !important;
        }

        .profile-page .profile-sub-header .box-list li p {
            display: grid;
            padding-top: 5px;
        }

        .profile-page .profile{
            font-size: 13px !important;
            text-align: center !important;
        }
    }

    
    .sidebar .user-info {
        overflow: hidden;
    }
    .sidebar .user-info .image {
        width: 20%;
    }
    .theme-orange .sidebar .user-info .info-container {
        float: left;
        width: 70%;
        padding-top: 5px;
    }
    .sidebar .user-info .info-container .name {
        color: white;
        text-overflow: ellipsis;
        display: -webkit-box !important;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        height: 23px;
    }
    
</style>
<script type="text/javascript">

$(document).ready(function(){
    forhide = 0;    
    $('#old_password').keyup(function (event) {
        var charCode = (event.which) ? event.which : event.keyCode;
        min_length = $('#old_password').val().length;
        if (forhide>=3){
            $('#submit').enabled;
        }

        if (min_length < 6) {
            $('#message_old_password').html( "<p id='message'>Minimum password 6 characters</p>" );
        }else{
            $('#message').remove();
            forhide++;
        }
    });

    $('#new_password').keyup(function (event) {
        var charCode = (event.which) ? event.which : event.keyCode;
        min_length = $('#new_password').val().length;
        
        if (forhide>=3){
            $('#submit').enabled;
        }

        if (min_length < 6) {
            $('#message_new_password').html( "<p id='new_message'>Minimum password 6 characters</p>" );   
        }else{    
            if ($('#new_password').val() === $('#old_password').val()) {
                $('#message_new_password').html( "<p id='new_message'>New password must be difference</p>" );    
            }else{
                $('#new_message').remove();
                forhide++;
            }
        }
    });

    $('#confirm_new_password').keyup(function () {
        var charCode = (event.which) ? event.which : event.keyCode;
        min_length = $('#confirm_new_password').val().length;
        
        if (forhide>=3){
            $('#submit').attr("disabled", false);
        }

        if (min_length < 6) {
            $('#message_confirm_new_password').html( "<p id='confirm_new_message'>Minimum password 6 characters</p>" );   
        }else{
            if ($('#new_password').val() != $('#confirm_new_password').val()) {
                $('#message_confirm_new_password').html( "<p id='confirm_new_message'>Password doesn't match</p>" );       
            }else{
                $('#confirm_new_message').remove();
                forhide++;
            }
        }
    });
    
    $.ajax({
        url: '{{route("member.select.expired-member")}}',
        data: data,
        success:function(data){
            $('#clock').countdown(data.expired_at, function(event) {
                $(this).html(event.strftime('%D days %H:%M:%S'));
            });
        }
    })
})
    
</script>
@yield('footer_scripts')
@include('sweet::alert')
</body>
</html>