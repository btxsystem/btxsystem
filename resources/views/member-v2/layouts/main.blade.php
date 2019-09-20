<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="_token" content="{{csrf_token()}}" />
<title>
    @section('title')
     | Bitrexgo
    @show
</title>

<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="{{asset('assetsebook/assets/css/bootstrap.css')}}">
@yield('styles')
<link rel="stylesheet" href="{{asset('assetsebook/assets/css/responsive.css')}}">
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,700" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assetsebook/assets/css/icheck.css')}}">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<style>
* {
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: -moz-none;
    -o-user-select: none;
    user-select: none;
}
</style>

</head>

@yield('header_styles')
<body oncopy="return false" oncut="return false" onpaste="return false" class="@section('style_class')@show">
<!-- Main Content -->
@yield('content')

@yield('footer_scripts')
@include('sweet::alert')
<script>
var isNS = (navigator.appName == "Netscape") ? 1 : 0;

if(navigator.appName == "Netscape") document.captureEvents(Event.MOUSEDOWN||Event.MOUSEUP);

function mischandler(){
return false;
}

function mousehandler(e){
var myevent = (isNS) ? e : event;
var eventbutton = (isNS) ? myevent.which : myevent.button;
if((eventbutton==2)||(eventbutton==3)) return false;
}
document.oncontextmenu = mischandler;
document.onmousedown = mousehandler;
document.onmouseup = mousehandler;

</script>
</body>
</html>