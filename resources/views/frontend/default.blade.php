<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>BitrexGo</title>
<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="assets2/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets2/plugins/jvectormap/jquery-jvectormap-2.0.3.css"/>
<link rel="stylesheet" href="assets2/plugins/morrisjs/morris.css" />
<!-- Custom Css -->
<link rel="stylesheet" href="assets2/css/main.css">
<link rel="stylesheet" href="assets2/css/color_skins.css">
</head>
<body class="theme-orange">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">        
        <div class="line"></div>
		<div class="line"></div>
		<div class="line"></div>
        <p>Please wait...</p>
        <div class="m-t-30"><img src="assets/images/logo.svg" width="48" height="48" alt="Nexa"></div>
    </div>
</div>
<!-- Overlay For Sidebars -->
<div class="overlay"></div><!-- Search  -->
<div class="search-bar">
    <div class="search-icon"> <i class="material-icons">search</i> </div>
    <input type="text" placeholder="Explore Nexa...">
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
@yield('footer_scripts')

<!-- Jquery Core Js --> 
<script src="assets2/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets2/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets2/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->
<script src="assets2/bundles/morrisscripts.bundle.js"></script><!-- Morris Plugin Js -->
<script src="assets2/bundles/sparkline.bundle.js"></script> <!-- Sparkline Plugin Js -->
<script src="assets2/bundles/knob.bundle.js"></script> <!-- Jquery Knob Plugin Js -->

<script src="assets2/bundles/mainscripts.bundle.js"></script>
<script src="assets2/js/pages/index.js"></script>
<script src="assets2/js/pages/charts/jquery-knob.min.js"></script>
</body>
</html>