@extends('frontend.default')
@section('title')
    Dashboard
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
                
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="card l-parpl">
                        <div class="body">
                            <h3 class="m-t-0 bitrex-points">{{$profile->bitrex_points}}</h3>
                            <p class="m-b-0">Bitrex Points</p>
                        </div>
                        <div class="sparkline" data-type="line" data-spot-Radius="3" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#222"
                        data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(0, 150, 136)" data-spot-Color="rgb(0, 188, 212)"
                        data-offset="90" data-width="100%" data-height="60px" data-line-Width="2" data-line-Color="rgba(255, 255, 255, 0.2)"
                        data-fill-Color="rgba(255, 255, 255, 0.3)"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="card l-amber">
                        <div class="body">
                            <h3 class="m-t-0 bitrex-cash">{{$profile->bitrex_cash}}</h3>
                            <p class="m-b-0">Bitrex Cash</p>
                        </div>
                        <div class="sparkline" data-type="line" data-spot-Radius="3" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#222"
                        data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(0, 150, 136)" data-spot-Color="rgb(0, 188, 212)"
                        data-offset="90" data-width="100%" data-height="60px" data-line-Width="2" data-line-Color="rgba(255, 255, 255, 0.2)"
                        data-fill-Color="rgba(255, 255, 255, 0.3)"></div>
                    </div>
                </div>
            </div>
        <div class="row clearfix">
                <div class="col-lg-8 col-md-12">
                    <div class="card product-report">
                        <div class="header">
                            <h2>Daily Bonus</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix m-b-15">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="icon l-amber"><i class="zmdi zmdi-chart-donut"></i></div>
                                    <div class="col-in">
                                        <h3 class="counter m-b-0 auto-retail"></h3>
                                        <small class="text-muted m-t-0">Auto Retail</small>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="icon l-turquoise"><i class="zmdi zmdi-chart"></i></div>
                                    <div class="col-in">
                                        <h3 class="counter m-b-0">6,481</h3>
                                        <small class="text-muted m-t-0">Pairing</small>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="icon l-parpl"><i class="zmdi zmdi-card"></i></div>
                                    <div class="col-in">
                                        <h3 class="counter m-b-0">3,915</h3>
                                        <small class="text-muted m-t-0">Rewords</small>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="icon l-parpl"><i class="zmdi zmdi-card"></i></div>
                                    <div class="col-in">
                                        <h3 class="counter m-b-0 sponsor"></h3>
                                        <small class="text-muted m-t-0">Sponsor</small>
                                    </div>
                                </div>
                            </div>
                            <div id="area_chart" class="graph"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>   
@stop


@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajax({
                url: '{{route("member.select.daily-retail")}}',
                data: data,
                success:function(data){
                    $('.auto-retail').append(data.bonus_retail.nominal);
                    $('.auto-retail').each(function () {
                        $(this).prop('Counter',0).animate({
                            Counter: $(this).text()
                        }, {
                            duration: 2000,
                            easing: 'swing',
                            step: function (now) {
                                $(this).text(Math.ceil(now));
                            }
                        });
                    });
                }
            });

            $.ajax({
                url: '{{route("member.select.daily-bonus-sponsor")}}',
                data: data,
                success:function(data){
                    $('.sponsor').append(data.bonus_sponsor.nominal);
                    $('.sponsor').each(function () {
                        $(this).prop('Counter',0).animate({
                            Counter: $(this).text()
                        }, {
                            duration: 2000,
                            easing: 'swing',
                            step: function (now) {
                                $(this).text(Math.ceil(now));
                            }
                        });
                    });
                }
            });

            $('.bitrex-cash').each(function () {
                $(this).prop('Counter',0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });

            $('.bitrex-points').each(function () {
                $(this).prop('Counter',0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });

        });
    </script>
@stop

