@include('frontend.auth.header')
<style>
    .bg-main {
        height: 100vh; background-image:  url({{asset('assets3/img/hero-fallback.jpg')}}); background-size: cover;
    }

    footer, header {
        position: relative;
        z-index: 100;
    }

    .bg-upper:before {
        content: "";

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
    border-radius: 50%; width: 250px; height: 250px; overflow: hidden;
    }

    .sub-judul-1 {
    font-weight: bold; letter-spacing: 5px;
    }

    .sub-judul-2 {
    letter-spacing: 3px; font-weight: 300;
    }

    .img-user {
    height: 150px; width: auto;
    }

    .bg-gray {
    background-color: #dadada;
    }

    .img-frame {
    position: absolute; width: 300px; height: 300px;
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
<body class="bg-main">
    <div class="container p-5 bg-upper">
        <div class="w-100 p-3 p-4 bg-white rounded shadow">
        <h2 class="title text-center mb-5">HALL OF FAME</h2>

        <div class="row mb-4 bg-gray">
            <div class="col-lg-12 pt-3">
                <h3 class="text-center"><span class="sub-judul-1">CHAIRMAN II </span><span class="sub-judul-2">ACHIEVERS</span></h3>
            </div>
            @foreach ($data['chairman2'] as $item)
                <div class="col-lg-4 p-3">
                    <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                        <img src="{{$item['src'] != null ? asset($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user">
                        <img src="{{asset('assets3/img/Chairman-1.png')}}" class="img-fluid img-frame">
                    </div>
                    <h5 class="text-center mt-2">{{$item['username']}}</h5>
                </div>
            @endforeach
        </div>
        {{$data['chairman2']->links()}}

        <div class="row mb-4 bg-gray">
            <div class="col-lg-12 pt-3">
                <h3 class="text-center"><span class="sub-judul-1">CHAIRMAN I </span><span class="sub-judul-2">ACHIEVERS</span></h3>
            </div>
            @foreach ($data['chairman1'] as $item)
                <div class="col-lg-4 p-3">
                    <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                        <img src="{{$item['src'] != null ? asset($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user">
                        <img src="{{asset('assets3/img/Chairman-1.png')}}" class="img-fluid img-frame">
                    </div>
                    <h5 class="text-center mt-2">{{$item['username']}}</h5>
                </div>
            @endforeach
        </div>
        {{$data['chairman1']->links()}}

        <div class="row mb-4 bg-gray">
            <div class="col-lg-12 pt-3">
                <h3 class="text-center"><span class="sub-judul-1">DIRECTOR III </span><span class="sub-judul-2">ACHIEVERS</span></h3>
            </div>
            @foreach ($data['director3'] as $item)
                <div class="col-lg-4 p-3">
                    <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                        <img src="{{$item['src'] != null ? asset($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user">
                        <img src="{{asset('assets3/img/Chairman-1.png')}}" class="img-fluid img-frame">
                    </div>
                    <h5 class="text-center mt-2">{{$item['username']}}</h5>
                </div>
            @endforeach
        </div>
        {{$data['director3']->links()}}

        <div class="row mb-4 bg-gray">
            <div class="col-lg-12 pt-3">
                <h3 class="text-center"><span class="sub-judul-1">DIRECTOR II </span><span class="sub-judul-2">ACHIEVERS</span></h3>
            </div>
            @foreach ($data['director2'] as $item)
                <div class="col-lg-4 p-3">
                    <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                        <img src="{{$item['src'] != null ? asset($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user">
                        <img src="{{asset('assets3/img/Chairman-1.png')}}" class="img-fluid img-frame">
                    </div>
                    <h5 class="text-center mt-2">{{$item['username']}}</h5>
                </div>
            @endforeach
        </div>
        {{$data['director2']->links()}}

        <div class="row mb-4 bg-gray">
            <div class="col-lg-12 pt-3">
                <h3 class="text-center"><span class="sub-judul-1">DIRECTOR I </span><span class="sub-judul-2">ACHIEVERS</span></h3>
            </div>
            @foreach ($data['director1'] as $item)
                <div class="col-lg-4 p-3">
                    <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                        <img src="{{$item['src'] != null ? asset($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user">
                        <img src="{{asset('assets3/img/Chairman-1.png')}}" class="img-fluid img-frame">
                    </div>
                    <h5 class="text-center mt-2">{{$item['username']}}</h5>
                </div>
            @endforeach
        </div>
        {{$data['director1']->links()}}

        <div class="row mb-4 bg-gray">
            <div class="col-lg-12 pt-3">
                <h3 class="text-center"><span class="sub-judul-1">PLATINUM III </span><span class="sub-judul-2">ACHIEVERS</span></h3>
            </div>
            @foreach ($data['platinum3'] as $item)
                <div class="col-lg-4 p-3">
                    <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                        <img src="{{$item['src'] != null ? asset($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user">
                        <img src="{{asset('assets3/img/Chairman-1.png')}}" class="img-fluid img-frame">
                    </div>
                    <h5 class="text-center mt-2">{{$item['username']}}</h5>
                </div>
            @endforeach
        </div>
        {{$data['platinum3']->links()}}

        <div class="row mb-4 bg-gray">
            <div class="col-lg-12 pt-3">
                <h3 class="text-center"><span class="sub-judul-1">PLATINUM II </span><span class="sub-judul-2">ACHIEVERS</span></h3>
            </div>
            @foreach ($data['platinum2'] as $item)
                <div class="col-lg-4 p-3">
                    <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                        <img src="{{$item['src'] != null ? asset($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user">
                        <img src="{{asset('assets3/img/Chairman-1.png')}}" class="img-fluid img-frame">
                    </div>
                    <h5 class="text-center mt-2">{{$item['username']}}</h5>
                </div>
            @endforeach
        </div>
        {{$data['platinum2']->links()}}

        <div class="row mb-4 bg-gray">
            <div class="col-lg-12 pt-3">
                <h3 class="text-center"><span class="sub-judul-1">PLATINUM I </span><span class="sub-judul-2">ACHIEVERS</span></h3>
            </div>
            @foreach ($data['platinum1'] as $item)
                <div class="col-lg-4 p-3">
                    <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                        <img src="{{$item['src'] != null ? asset($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user">
                        <img src="{{asset('assets3/img/Chairman-1.png')}}" class="img-fluid img-frame">
                    </div>
                    <h5 class="text-center mt-2">{{$item['username']}}</h5>
                </div>
            @endforeach
        </div>
        {{$data['platinum1']->links()}}

    </div>
</body>
<br>
@include('frontend.auth.footer')
