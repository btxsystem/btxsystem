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
{{-- <link rel="stylesheet" href="{{asset('assets2/css/modal.css')}}"> --}}
<link rel="stylesheet" href="{{asset('assets2/plugins/bootstrap-select/css/bootstrap-select.css')}}">
<link rel="stylesheet" href="{{asset('assets2/css/color_skins.css')}}">
<link rel="stylesheet" href="{{asset('assets2/css/datatable.css')}}">
<link rel="stylesheet" href="{{asset('assets2/css/raw.css')}}">
<link rel="stylesheet" href="{{asset('assets2/css/responsive.css')}}">

<link rel="stylesheet" href="{{asset('assets2/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

<!-- tree -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/tree/Treant.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/tree/basic-example.css') }}">

</head>

@yield('header_styles')
<body class="theme-orange">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">        
        <div class="line"></div>
		<div class="line"></div>
		<div class="line"></div>
        <p>Please wait...</p>
    </div>
</div>
<!-- Overlay For Sidebars -->
<div class="overlay"></div><!-- Search  -->
<div class="search-bar">
    <div class="search-icon"> <i class="material-icons">search</i> </div>
    <input type="text" placeholder="search...">
    <div class="close-search"> <i class="material-icons">close</i> </div>
</div>
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
<!-- Jquery DataTable Plugin Js --> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<!-- tree -->
<script type="text/javascript" src="{{ asset('assets/tree/Treant.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/tree/basic-example.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/tree/raphael.js') }}" ></script>
<script src="{{ asset('assets/tree/panzoom.js') }}"></script>
<script src="{{ asset('assets/tree/d3.js') }}"></script>

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
})
    
</script>
@yield('footer_scripts')
@include('sweet::alert')
</body>
</html>