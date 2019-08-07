@extends('frontend.default')
@section('title')
    Profile
    @parent
@stop

@section('content')
<!-- Top Bar -->
<section class="content ecommerce-page">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Dashboard
                    <small class="text-muted">Bitrexgo</small>
                    </h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i>Bitrexgo</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <a href="{{route('member.bitrex-money.bitrex-points')}}">
                        <div class="card" style="box-shadow: 2px 2px 2px 1px #888888;">
                            <div style="background:#7284b7">
                                <div class="col-lg-12 row">
                                   <div class="col-lg-5" style="padding-top:10%; padding-left:13%; background:#09568d;">
                                        <i class="zmdi zmdi-money zmdi-hc-5x"></i>
                                   </div>
                                   <div class="col-lg-7 row">
                                        <div class="col-lg-12 row">
                                            <div class="header row" style="background:#7284b7">
                                                <h2><strong>Bitrex Points</strong></h1>
                                            </div>
                                            <div class="body row" style="background:#7284b7">
                                                <h1><b>{{$profile->bitrex_points}}</b></h1>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>                    
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <a href="#">
                        <div class="card" style="box-shadow: 2px 2px 2px 1px #888888;">
                            <div class="header">
                                <h2>Bitrex Cash</h2>
                            </div>
                            <div class="body">
                               <h1><b>{{$profile->bitrex_cash}}</b></h1>
                            </div>                    
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>   
@stop


@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            console.log('aaaa');
        });
    </script>
@stop

