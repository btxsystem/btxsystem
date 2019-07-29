@extends('admin/layouts/default')

@section('header_styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/tree/Treant.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/tree/basic-example.css') }}">

  <!-- end of page level css-->
@stop

@section('content')
	<section class="content-header">
    <!--section starts-->
    <h1>Tree</h1>
    <ol class="breadcrumb">
        <li>
            <a href="/">Admin</a>
        </li>
        <li class="active">Tree</li>
    </ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="chart" id="basic-example"></div>
			</div>
		</div>
	</section>
@stop

@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/tree/Treant.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/tree/basic-example.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/tree/raphael.js') }}" ></script>
    <script>
      new Treant( chart_config );
    </script>
@stop