@include('frontend.auth.header')
<style>
    .bg-main {
        height: 100%; background-image:  url({{asset('assets3/img/hero-fallback.jpg')}}); background-size: cover;background-repeat:no-repeat;background-attachment: fixed;
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
        border-radius: 50%; width: 100px; height: 100px; overflow: hidden; padding-bottom: 5px;
    }


    .sub-judul-1 {
    font-weight: bold; letter-spacing: 5px;
    }

    .sub-judul-2 {
    letter-spacing: 3px; font-weight: 300;
    }

    .img-user rounded-circle {
    height: 100px!important; width: 100px!important;
    }

    .bg-gray {
    background-color: #dadada;
    }

    .img-frame {
        position: absolute; width: 100px; height: 100px;
    }
    
    .wrap-img-platinum {
        border-radius: 50%; width: 100px; height: 100px; overflow: hidden;
    }
    
    .img-frame-platinum {
        position: absolute;
        width: 50px;
        height: 50px;
        top: -12px;
        left: 13px;
    }
    div .bg-gray {
        margin-left: 40px !important;
        margin-right: 40px !important;
    }
    .wrap-img .img-user {
        height: 60px !important;
        width: 60px !important;
    }
    .platinum {
        text-align: center;
    }
    .text-name2 {
        font-weight: 500;
    }
    .platinum-1 .img-user {
        height: 25px;
        width: 25px;
    }

    @media (max-width: 480px) {
        .title {
            font-size: 25px;
        }
        .p-5 {
            padding: 13px !important;
        }
        div .bg-gray {
            margin-left: 10px !important;
            margin-right: 10px !important;
        }
        .wrap-img {
            height: 45px;
            width: 20px;
            padding-bottom: 5px;
        }
        .wrap-img.director_1 {
            height: 45px;
            width: 65px;
        }
        .wrap-img-platinum {
            width: 130px;
            height: 45px;
            line-height: 1.3;
        }
        .wrap-img .img-user {
            height: 25px !important;
            width: 25px !important;
        }
        .img-frame {
            width: 50px;
            height: 50px;
        }
        .text-name {
            font-size: 7px;
        }
        span.text-name2,small.text-name2 {
            font-size: 7px;
            line-height: 1.3;
            font-weight: 500;
        }
        .platinum {
            text-align: center;
            /* white-space: nowrap; */
            overflow: hidden;
            /* text-overflow: ellipsis; */
            width: 40px;
        }
        .platinum-1 {
            padding: 0px !important;
            width: 120px;
        }
        .img-frame-platinum.platinum-img-1 {
            height: 48px;
            left: 2px;
            top: -11px;
        }
    }
    @media(max-width: 360px) {
        .wrap-img.director_1 {
            height: 45px;
            width: 20px;
        }
        .wrap-img-platinum {
            width: 130px;
        }
    }
    @media(max-width: 320px) {
        .pagination > li > a, .pagination > li > span {
            font-size: 12px;
            padding: 9px;
        }
        .platinum-1 {
            padding: 0 !important;
        }

        .img-frame {
            width: 40px;
            height: 40px;
        }
        .wrap-img-platinum {
            width : 113px;
        }
        .platinum-1 .img-user {
            height: 18px;
            width: 18px;
        }
        .img-frame-platinum.platinum-img-1 {
            height: 40px;
            width: 40px;
            left: 3px;
            top: -10px;
        }
    }
    p:last-child {
        float: right;
    }


@media (min-width:320px)  {
/* smartphones, iPhone, portrait 480x320 phones */
    .text-title {
        font-size: 7px;
    }
    .g-line {
        line-height: 0.8;
    }
}
@media (min-width:481px)  {
/* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */
    .text-title {
        font-size: 10px;
    }
}
@media (min-width:641px)  {
/* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */
    .text-title {
        font-size: 11px;
    }
    .g-line {
        line-height: 1;
    }
}
@media (min-width:961px)  {
/* tablet, landscape iPad, lo-res laptops ands desktops */
    .text-title {
        font-size: 15px;
    }
    .g-line {
        line-height: 1.2;
    }
}
@media (min-width:1025px) {
/* big landscape tablets, laptops, and desktops */

}
@media (min-width:1281px) {
/* hi-res laptops and desktops */

}
</style>
<body class="bg-main">
    <div class="container p-5 bg-upper">
        <div class="w-100 bg-white rounded shadow pb-4">
        <center><img src="{{asset('assets3/img/hof.png')}}" class="img-fluid mb-2" width="550"></center>

        <!-- $data['chairman2'] -->
        @if(count($data['chairman2']) > 0)
        <section id="chairman_2">
            <div class="row bg-gray" style="margin-bottom: 30px; padding-bottom: 15px;">
                <div class="col-lg-12 pt-3">
                    <h1 class="text-center"><span class="sub-judul-1">CHAIRMAN II </span>
                    <br><span class="sub-judul-2">ACHIEVERS</span></h1>
                </div>

                @foreach ($data['chairman2'] as $item)
                    <div class="g-line col-lg-4 p-3 mx-auto d-block text-center">
                        <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                            <img src="{{$item['src'] != null ? checkImageHof($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user rounded-circle" >
                            <img src="{{asset('assets3/img/Chairman2.png')}}" class="img-fluid img-frame">
                        </div>
                        <span class="text-title">{{strtoupper($item['first_name'])}} {{strtoupper($item['last_name'])}}</span>
                    </div>
                @endforeach
            </div>
            {{$data['chairman2']->links()}}
        </section>
        @endif
        
        @if(count($data['chairman1']) > 0)
        <section id="chairman_1">
            <div class="row bg-gray" style="margin-bottom: 30px; padding-bottom: 15px;">
                <div class="col-lg-12 pt-3">
                    <h1 class="text-center"><span class="sub-judul-1">CHAIRMAN I </span>
                        <br><span class="sub-judul-2">ACHIEVERS</span></h1>
                </div>
                @foreach ($data['chairman1'] as $item)
                    <div class="g-line p-3 mx-auto d-block text-center" style="width: 50%;">
                        <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                            <img src="{{$item['src'] != null ? checkImageHof($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user rounded-circle" >
                            <img src="{{asset('assets3/img/Chairman1.png')}}" class="img-fluid img-frame">
                        </div>
                        <span class="text-title">{{strtoupper($item['first_name'])}} {{strtoupper($item['last_name'])}}</span>
                    </div>
                @endforeach
            </div>
        </section>
        {{$data['chairman1']->links()}}
        @endif

        @if(count($data['director3']) > 0)
        <section id="director_3">
            <div class="row bg-gray" style="margin-bottom: 30px; padding-bottom: 15px;">
                <div class="col-lg-12 pt-3">
                    <h1 class="text-center"><span class="sub-judul-1">DIRECTOR III </span>
                        <br><span class="sub-judul-2">ACHIEVERS</span></h1>
                </div>
                @foreach ($data['director3'] as $item)
                    <div class="g-line p-3 mx-auto d-block text-center" style="width: 33%;">
                        <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                            <img src="{{$item['src'] != null ? checkImageHof($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user rounded-circle" >
                            <img src="{{asset('assets3/img/Director3.png')}}" class="img-fluid img-frame">
                        </div>
                        <span class="text-title">{{strtoupper($item['first_name'])}} {{strtoupper($item['last_name'])}}</span>
                    </div>
                @endforeach
            </div>
            {{$data['director3']->links()}}
        </section>
        @endif

        @if(count($data['director2']) > 0)
        <section id="director_2">
            <div class="row bg-gray" style="margin-bottom: 30px; padding-bottom: 15px;">
                <div class="col-lg-12 pt-3">
                    <h1 class="text-center"><span class="sub-judul-1">DIRECTOR II </span>
                        <br><span class="sub-judul-2">ACHIEVERS</span></h1>
                </div>
                @foreach ($data['director2'] as $item)
                    <div class="g-line p-3 mx-auto d-block text-center" style="width: 33%;">
                        <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                            <img src="{{$item['src'] != null ? checkImageHof($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user rounded-circle" >
                            <img src="{{asset('assets3/img/Director2.png')}}" class="img-fluid img-frame">
                        </div>
                        <span class="text-title">{{strtoupper($item['first_name'])}} {{strtoupper($item['last_name'])}}</span>
                    </div>
                @endforeach
            </div>
            {{$data['director2']->links()}}
        </section>
        @endif

        @if(count($data['director1']) > 0)
        <section id="director_1">
            <div class="row bg-gray" style="margin-bottom: 30px; padding-bottom: 15px;">
                <div class="col-lg-12 pt-3">
                    <h1 class="text-center"><span class="sub-judul-1">DIRECTOR I </span>
                        <br><span class="sub-judul-2">ACHIEVERS</span></h1>
                </div>
                @foreach ($data['director1'] as $item)
                    <div class="g-line p-3 mx-auto d-block text-center" style="width: 33%;">
                        <div class="d-flex align-items-center mx-auto justify-content-center wrap-img director_1">
                            <img src="{{$item['src'] != null ? checkImageHof($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user rounded-circle" >
                            <img src="{{asset('assets3/img/Director1.png')}}" class="img-fluid img-frame">
                        </div>
                        <span class="text-title">{{strtoupper($item['first_name'])}} {{strtoupper($item['last_name'])}}</span>
                    </div>
                @endforeach
            </div>
            {{$data['director1']->links()}}
        </section>
        @endif

        @if(count($data['platinum3']) > 0)
        <section id="platinum_3">
            <div class="row bg-gray" style="margin-bottom: 30px; padding-bottom: 15px;">
                <div class="col-lg-12 pt-3">
                    <h1 class="text-center"><span class="sub-judul-1">PLATINUM III </span>
                        <br><span class="sub-judul-2">ACHIEVERS</span></h1>
                </div>
                <?php
                $getLast = 0;
                ?>
                @foreach ($data['platinum3'] as $item)
                    <div class="p-3 d-flex justify-content-center"
                     style="width: 20%; <?php if ($getLast == 11) {
                        echo "margin-left: auto; margin-right: 20%;";
                     } elseif ($getLast == 10) {
                        echo "margin-left: 20%;";
                     } ?>">
                        <div class="g-line platinum">
                            <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                                <img src="{{$item['src'] != null ? checkImageHof($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user rounded-circle">
                                <img src="{{asset('assets3/img/Platinum3.png')}}" class="img-fluid img-frame">
                            </div>
                            <span class="text-title">{{strtoupper($item['first_name'])}} {{strtoupper($item['last_name'])}}</span>
                        </div>
                    </div>
                    <?php $getLast++; ?>
                @endforeach
            </div>
            {{$data['platinum3']->links()}}
        </section>
        @endif

        @if(count($data['platinum2']) > 0)
        <section id="platinum_2">
            <div class="row bg-gray" style="margin-bottom: 30px; padding-bottom: 15px;">
                <div class="col-lg-12 pt-3">
                    <h1 class="text-center"><span class="sub-judul-1">PLATINUM II </span>
                        <br><span class="sub-judul-2">ACHIEVERS</span></h1>
                </div>
                @foreach ($data['platinum2'] as $item)
                    <div class="g-line p-3 d-flex justify-content-center" style="width: 20%;">
                        <div class="platinum">
                            <div class="d-flex align-items-center mx-auto justify-content-center wrap-img">
                                <img src="{{$item['src'] != null ? checkImageHof($item['src']) : asset('assets3/img/favicon.png')}}" class="img-fluid img-user rounded-circle">
                                <img src="{{asset('assets3/img/Platinum2.png')}}" class="img-fluid img-frame">
                            </div>
                            <span class="text-title">{{strtoupper($item['first_name'])}} {{strtoupper($item['last_name'])}}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            {{$data['platinum2']->links()}}
        </section>
        @endif
        
        @if(count($data['platinum1']) > 0)
        <section id="platinum_1">
            <div class="row bg-gray" style="margin-bottom: 30px; padding-bottom: 15px;">
                <div class="col-lg-12 pt-3 mb-4">
                    <h1 class="text-center"><span class="sub-judul-1">PLATINUM I </span>
                        <br><span class="sub-judul-2">ACHIEVERS</span></h1>
                </div>
                @foreach ($data['platinum1'] as $item)
                    <div class="g-line p-3 platinum-1" style="width: 20%;">
                        <div class="d-flex align-items-center mx-auto justify-content-center text-center" style="overflow: hidden; border-radius: 0; height: 60px;">
                            <div class="col-lg-6 col-7 p-0 name-platinum-1" 
                            style="">
                                <span class="text-title">{{strtoupper($item['first_name'])}} {{strtoupper($item['last_name'])}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{$data['platinum1']->links()}}
        </section>
        @endif
        </div>
    </div>
</body>
<br>
@include('frontend.auth.footer')
<script>
$('a.page-link').click(function(e) {
    e.preventDefault()
    let section = $(this).parents()[2].id
    let link = $(this).prop("href")
    window.location.href = link + `&element=${section}` + '#' + section
})

<?php

if(request()->get('element')):?>
    $('html, body').animate({
        scrollTop: $("#<?=request()->get('element');?>").offset().top - 240
    }, 1000);
<?php endif;?>

</script>