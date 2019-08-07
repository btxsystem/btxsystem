<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>
    @section('title')
     | Betrixgo
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

<!-- Datatable -->
<link rel="stylesheet" href="{{asset('assets2/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">

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

<!-- Right Sidebar -->
    @include('frontend.layouts.right_bar')

<!-- Chat-launcher -->
    @include('frontend.layouts._chat')

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
<script src="{{asset('assets2/js/pages/charts/jquery-knob.min.js')}}"></script>

<!-- Jquery Datatable -->
<!-- Jquery DataTable Plugin Js --> 
<script src="{{asset('assets2/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets2/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets2/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets2/plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets2/plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets2/plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>

@yield('footer_scripts')
</body>
</html>