<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="_token" content="{{csrf_token()}}" />
<title>
    @section('title')
     | Betrixgo
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

</head>

@yield('header_styles')
<body class="@section('style_class')@show">
<!-- Main Content -->
@yield('content')

@yield('footer_scripts')
@include('sweet::alert')
</body>
</html>