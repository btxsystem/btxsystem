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
                                            <span style="font-size:15px;">Total Member Active</span>
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
                                            <span style="font-size:15px;">Total Member Inactive</span>
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
                                            <span style="font-size:15px;">Total Sales Ebook</span>
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
                                            <span style="font-size:15px;">Total Bonus Credit</span>
                                            <div class="number" id="bonus"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <br>
            <div id="trfx-embed"><canvas id="memberChart" width="100" height="40"></canvas></div>
            <br>
            <hr>    
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
var chartMember = $('#memberChart');
var dt = new Date();
const monthNames = ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                    ];

$.ajax({
    type: 'GET',
    url: '/backoffice/member-daily',
    success: function (data) {
        var myChart = new Chart(chartMember, {
            type: 'bar',
            data: {
                labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12',
                        '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24',
                        '25', '26', '27', '28', '29', '30', '31'
                        ],
                datasets: [{
                    label: 'Chart new member daily ' + monthNames[dt.getMonth()] +' '+ dt.getFullYear(),
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
            $('#member-active').html('<br/>'+addCommas(d.active));
            $('#member-nonactive').html('<br/>'+addCommas(d.non_active));
            $('#member-sales').html('<br/>'+addCommas(d.sales));
            $('#bonus').html('IDR <br/>'+addCommas(d.bonus));
        }
    });
});
</script>

   
@stop
