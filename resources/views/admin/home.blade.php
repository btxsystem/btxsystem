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
            <div id="trfx-embed"><canvas id="myChart" width="100" height="50"></canvas></div>
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
(function(w,d,t,h,l,b,p,o,a,m){w['TraducationFxObject']=o;w[o]=w[o]||function(){
    w[o].h=h;w[o].b=b;return (w[o].q=w[o].q||[]).push(arguments)};a=d.createElement(t),
    m=d.getElementsByTagName(t)[0];a.async=1;a.src=h+l+'?b='+b+'&p='+p.join(',');a.crossorigin='use-credentials';m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://embedder.traducationfx.com/','embedder.js','PCyAlXfaqVU',['modal'],'TraducationFX');

    TraducationFX('settings', 'configure', {
        langCode: 'id'
    });
    TraducationFX('video', 'configure', {
        containerId: 'trfx-embed',
        playlistKey: 'GMFE0LClS3s',
        layout: 'vertical-tabs'
    });
    TraducationFX('video', 'embed');
</script>

   
@stop
