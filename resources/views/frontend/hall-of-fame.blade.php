@extends('frontend.default')
@section('title')
    Dashboard
    @parent
@stop
<head>
<style>
    .bg-main {
        height: 100vh; background-image:  url({{asset('assets3/img/hero-fallback.jpg')}}); background-size: cover;background-repeat:no-repeat;background-attachment: fixed;
    }

    .shadow {
        box-shadow: 0 3px 3px rgba(0,0,0,0.30) !important;
    }

    footer, header {
        position: relative;
        z-index: 100;
    }

    .bg-upper:before {
        content: "";
        width: 100%;
        height: 100%;
        position: fixed;
        background: #22919b;
        opacity: .5;
        top: 0px;
        left: 0;
        z-index: 1;
        mix-blend-mode: saturation;
    }

    .container {
        width: 100% !important;
    }
    .bg-upper > * {
        z-index: 100;
        position: relative;
    }
    .title {
        font-weight: bold;
        color: #000;
    }
    .title:before {
        content: "";
        position: absolute;
        margin-left: -66px;
        width: 60px;
        height: 60px;
        background-image: url({{asset('assets3/img/Asset2.png')}});
        background-size: 60px auto;
        background-repeat: no-repeat;
        mix-blend-mode: normal;
    }
    .title:after {
        content: "";
        position: absolute;
        margin-left: 6px;
        width: 60px;
        height: 60px;
        background-image: url({{asset('assets3/img/Asset1.png')}});
        background-size: 60px auto;
        background-repeat: no-repeat;
        mix-blend-mode: normal;
    }

    .wrap-img{
    border-radius: 50%; width: 150px; height: 150px; overflow: hidden;
    }

    .sub-judul-1 {
    font-weight: bold; letter-spacing: 5px;
    }

    .sub-judul-2 {
    letter-spacing: 3px; font-weight: 300;
    }

    .img-user {
        height: 100px!important; width: 100px!important;
    }

    .bg-gray {
    background-color: #dadada;
    }

    .img-frame {
    position: absolute; width: 150px; height: 150px;
    }

    @media (max-width: 480px) {
    .title {
        font-size: 25px;
    }
    .h3, h3 {
        font-size: 18px;
    }
    .p-5 {
        padding: 13px !important;
    }
    }

    div .bg-gray {
        margin-left: 40px !important;
        margin-right: 40px !important;
    }
</style>
</head>
@section('content')
<section class="content profile-page">
    <div class="container-fluid bg-upper">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="container p-5">
                    <div class="w-100 p-3 p-4 bg-white rounded shadow">
                    <h2 class="title text-center mb-5">HALL OF FAME</h2>
                    
                    @if(count($data['chairman2']) > 0)
                    <div class="row mb-4 bg-gray">
                        <div class="col-lg-12 pt-3">
                            <h3 class="text-center"><span class="sub-judul-1">CHAIRMAN II </span><span class="sub-judul-2">ACHIEVERS</span></h3>
                        </div>
                        @foreach ($data['chairman2'] as $item)
                            <div class="col-lg-4 p-3">
                                <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                                    <img src="{{$item['src'] != null ? asset($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user rounded-circle" style="height: 100px!important; width: 100px!important;">
                                    <img src="{{asset('assets3/img/Chairman2.png')}}" class="img-fluid img-frame">
                                </div>
                                <h5 class="text-center mt-2">{{strtoupper($item['first_name'])}} {{strtoupper($item['last_name'])}}</h5>
                            </div>
                        @endforeach
                    </div>
                    {{$data['chairman2']->links()}}
                    @endif

                    @if(count($data['chairman1']) > 0)
                    <div class="row mb-4 bg-gray">
                        <div class="col-lg-12 pt-3">
                            <h3 class="text-center"><span class="sub-judul-1">CHAIRMAN I </span><span class="sub-judul-2">ACHIEVERS</span></h3>
                        </div>
                        @foreach ($data['chairman1'] as $item)
                            <div class="col-lg-4 p-3">
                                <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                                    <img src="{{$item['src'] != null ? asset($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user rounded-circle" style="height: 100px!important; width: 100px!important;">
                                    <img src="{{asset('assets3/img/Chairman1.png')}}" class="img-fluid img-frame">
                                </div>
                                <h5 class="text-center mt-2">{{strtoupper($item['first_name'])}} {{strtoupper($item['last_name'])}}</h5>
                            </div>
                        @endforeach
                    </div>
                    {{$data['chairman1']->links()}}
                    @endif

                    @if(count($data['director3']) > 0)
                    <div class="row mb-4 bg-gray">
                        <div class="col-lg-12 pt-3">
                            <h3 class="text-center"><span class="sub-judul-1">DIRECTOR III </span><span class="sub-judul-2">ACHIEVERS</span></h3>
                        </div>
                        @foreach ($data['director3'] as $item)
                            <div class="col-lg-4 p-3">
                                <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                                    <img src="{{$item['src'] != null ? asset($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user rounded-circle" style="height: 100px!important; width: 100px!important;">
                                    <img src="{{asset('assets3/img/Director3.png')}}" class="img-fluid img-frame">
                                </div>
                                <h5 class="text-center mt-2">{{strtoupper($item['first_name'])}} {{strtoupper($item['last_name'])}}</h5>
                            </div>
                        @endforeach
                    </div>
                    @endif

                    @if(count($data['director2']) > 0)
                    <div class="row mb-4 bg-gray">
                        <div class="col-lg-12 pt-3">
                            <h3 class="text-center"><span class="sub-judul-1">DIRECTOR II </span><span class="sub-judul-2">ACHIEVERS</span></h3>
                        </div>
                        @foreach ($data['director2'] as $item)
                            <div class="col-lg-4 p-3">
                                <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                                    <img src="{{$item['src'] != null ? asset($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user rounded-circle" style="height: 100px!important; width: 100px!important;">
                                    <img src="{{asset('assets3/img/Director2.png')}}" class="img-fluid img-frame">
                                </div>
                                <h5 class="text-center mt-2">{{strtoupper($item['first_name'])}} {{strtoupper($item['last_name'])}}</h5>
                            </div>
                        @endforeach
                    </div>
                    @endif

                    @if(count($data['director1']) > 0)
                    <div class="row mb-4 bg-gray">
                        <div class="col-lg-12 pt-3">
                            <h3 class="text-center"><span class="sub-judul-1">DIRECTOR I </span><span class="sub-judul-2">ACHIEVERS</span></h3>
                        </div>
                        @foreach ($data['director1'] as $item)
                            <div class="col-lg-4 p-3">
                                <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                                    <img src="{{$item['src'] != null ? asset($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user rounded-circle" style="height: 100px!important; width: 100px!important;">
                                    <img src="{{asset('assets3/img/Director1.png')}}" class="img-fluid img-frame">
                                </div>
                                <h5 class="text-center mt-2">{{strtoupper($item['first_name'])}} {{strtoupper($item['last_name'])}}</h5>
                            </div>
                        @endforeach
                    </div>
                    @endif

                    @if(count($data['platinum3']) > 0)
                    <div class="row mb-4 bg-gray">
                        <div class="col-lg-12 pt-3">
                            <h3 class="text-center"><span class="sub-judul-1">PLATINUM III </span><span class="sub-judul-2">ACHIEVERS</span></h3>
                        </div>
                        @foreach ($data['platinum3'] as $item)
                            <div class="col p-3">
                                <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                                    <img src="{{$item['src'] != null ? asset($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user rounded-circle" style="height: 100px!important; width: 100px!important;">
                                    <img src="{{asset('assets3/img/Platinum3.png')}}" class="img-fluid img-frame">
                                </div>
                                <h5 class="text-center mt-2">{{strtoupper($item['first_name'])}} {{strtoupper($item['last_name'])}}</h5>
                            </div>
                        @endforeach
                    </div>
                    {{$data['platinum3']->links()}}
                    @endif

                    @if(count($data['platinum2']) > 0)
                    <div class="row mb-4 bg-gray">
                        <div class="col-lg-12 pt-3">
                            <h3 class="text-center"><span class="sub-judul-1">PLATINUM II </span><span class="sub-judul-2">ACHIEVERS</span></h3>
                        </div>
                        @foreach ($data['platinum2'] as $item)
                            <div class="col p-3">
                                <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                                    <img src="{{$item['src'] != null ? asset($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user rounded-circle" style="height: 100px!important; width: 100px!important;">
                                    <img src="{{asset('assets3/img/Platinum2.png')}}" class="img-fluid img-frame">
                                </div>
                                <h5 class="text-center mt-2">{{strtoupper($item['first_name'])}} {{strtoupper($item['last_name'])}}</h5>
                            </div>
                        @endforeach
                    </div>
                    {{$data['platinum2']->links()}}
                    @endif

                    @if(count($data['platinum1']) > 0)
                    <div class="row mb-4 bg-gray">
                        <div class="col-lg-12 pt-3">
                            <h3 class="text-center"><span class="sub-judul-1">PLATINUM I </span><span class="sub-judul-2">ACHIEVERS</span></h3>
                        </div>
                        @foreach ($data['platinum1'] as $item)
                            <div class="col-lg-4 p-3">
                                <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                                    <img src="{{$item['src'] != null ? asset($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user rounded-circle" style="height: 100px!important; width: 100px!important;">
                                    <img src="{{asset('assets3/img/Platinum1.png')}}" class="img-fluid img-frame">
                                </div>
                                <h5 class="text-center mt-2">{{strtoupper($item['first_name'])}} {{strtoupper($item['last_name'])}}</h5>
                            </div>
                        @endforeach
                    </div>
                    {{$data['platinum1']->links()}}
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>
<style>

</style>
@stop

@section('footer_scripts')
    <script>
        var body = document.body;

        body.classList.add("bg-main");
    </script>
@stop
