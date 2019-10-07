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
            <div id="trfx-embed"><canvas id="myChart" width="100" height="40"></canvas></div>
        </div>
    </div>
</section>

@stop

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
</script>

   
@stop
