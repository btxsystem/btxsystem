@extends('ebook.layout')
@section('styles')
<link rel="stylesheet" href="{{asset('assetsebook/v2/css/style.css')}}">
<style type="text/css">
.transparent {
	background-color: transparent!important;
	background: transparent!important;
}
div#flag { 
	background-color: #333;
	padding: 6%;
	font-size: 11px !important;
	border-radius: 2px;
	-ms-transform: rotate(40deg);
	-webkit-transform: rotate(40deg);
	transform: rotate(40deg);
	width: 50%;
	text-align: center;
	position: absolute;
	right: -12%;
	height: 8%;
	z-index: 0;
	top: -5%;
	background-color:#D4AF37;
	z-index: 2;
}
#flag span {
	position: relative;
	left: 25%;
	top: 41%;;
}
.triangle{
	overflow: hidden;
	position: relative;
	box-shadow: 0 2px 3px rgba(0, 0, 0, 0.3);
}
h2.plan-title {
	text-align:center !important;		
	margin-top: 5px !important;
}
@media only screen and (min-width: 992px) {
	h2.plan-title {
		text-align:left !important;	
	}
	div#flag { 
		background-color: #333;
		padding: 10px;
		font-size: 16px !important;
		border-radius: 2px;
		-ms-transform: rotate(40deg);
		-webkit-transform: rotate(40deg);
		transform: rotate(40deg);
		width: 160px;
		text-align: center;
		position: absolute;
		right: -8%;
		height: 73px;
		z-index: 0;
		top: -30;
		background-color:#D4AF37;
	}
	#flag span {
		position: relative;
		left: 20px;
		top: 28px;
	}
	.triangle{
		overflow: hidden;
		position: relative;
	}
	.clockdiv{
		font-family: sans-serif;
		color: #fff;
		display: inline-block;
		font-weight: 100;
		text-align: center;
		font-size: 20px;
	}

	.clockdiv > div{
		padding: 10px;
		border-radius: 3px;
		background: #00BF96;
		display: inline-block;
	}

	.clockdiv div > span{
		padding: 15px;
		border-radius: 3px;
		background: #00816A;
		display: inline-block;
	}

	.smalltext{
		padding-top: 5px;
		font-size: 15px;
	}	
}
</style>
@stop
@section('content')
  <home-component
    endpoint-ebooks="{{route('api.ebook.ebooks')}}"
    :prop-auth="{{$isLogged ?? 'false'}}"/>
@stop