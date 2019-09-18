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
            <div id="trfx-embed"></div>
        </div>
    </div>
</section>

@stop

@section('footer_scripts')
<script>
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
