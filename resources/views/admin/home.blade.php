@extends('layouts/admin')
@section('title')
Bonus Sponsor
@parent
@stop

@section('content')

<section class="content-header">
    <h1>Dashboard</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Dashboard</a>
        </li>
        <!-- <li class="active">Sponsor</li> -->
    </ol>
</section>
<section class="content">                
    <div class="row">
        <div class="col-md-12">
            <section class="content">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
                        <!-- Trans label pie charts strats here-->
                        <div class="lightbluebg no-radius">
                            <div class="panel-body squarebox square_boxs">
                                <div class="col-xs-12 nopadmar">
                                    <div class="row">
                                        <div class="square_box col-xs-9">
                                            <span style="font-size:15px;">Member Active</span>
                                            <div class="number" id="member-active"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInUpBig">
                        <!-- Trans label pie charts strats here-->
                        <div class="redbg no-radius">
                            <div class="panel-body squarebox square_boxs">
                                <div class="col-xs-12 nopadmar">
                                    <div class="row">
                                        <div class="square_box col-xs-9">
                                            <span style="font-size:15px;">Member Inactive</span>
                                            <div class="number" id="member-nonactive"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-md-6 margin_10 animated fadeInDownBig">
                        <!-- Trans label pie charts strats here-->
                        <div class="goldbg no-radius">
                            <div class="panel-body squarebox square_boxs">
                                <div class="col-xs-12 nopadmar">
                                    <div class="row">
                                        <div class="square_box col-xs-9">
                                            <span style="font-size:15px;">Sales this year</span>
                                            <div class="number" id="member-sales"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInRightBig">
                        <!-- Trans label pie charts strats here-->
                        <div class="palebluecolorbg no-radius">
                            <div class="panel-body squarebox square_boxs">
                                <div class="col-xs-12 nopadmar">
                                    <div class="row">
                                        <div class="square_box col-xs-9">
                                            <span style="font-size:15px;">Bonus credit</span>
                                            <div class="number" id="bonus"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <br>    
            <div id="trfx-embed"><canvas id="myChart" width="100" height="40"></canvas></div>
        </div>
    </div>
</section>

@stop
<style>
@media (min-width: 1000px){
    .col-lg-3 {
        width: 50% !important;
    }
}
</style>
@section('footer_scripts')
<script>
var ctx = $('#myChart');
var dt = new Date();
$.ajax({
    type: 'GET',
    url: '/backoffice/sales-ebook',
    success: function (data) {
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan.', 'Feb.', 'Mar.', 'Apr.', 'May.', 'Jun.', 'Jul.', 'Aug.', 'Sep.', 'Oct.', 'Nov.', 'Dec.'],
                datasets: [{
                    label: 'Chart report sales ebook ' + dt.getFullYear(),
                    data: data,
                    backgroundColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    },
    error: function() {
        console.log("Error");
    }
});
$(document).ready(function() {
    $.ajax({
        type: 'GET',
        url: '/backoffice/dashboard-values',
        success: function (d) {
            $('#member-active').text(addCommas(d.active));
            $('#member-nonactive').text(addCommas(d.non_active));
            $('#member-sales').text(addCommas(d.sales));
            $('#bonus').text(addCommas(d.bonus));
        }
    });
});
</script>

   
@stop
