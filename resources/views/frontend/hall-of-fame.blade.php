@extends('frontend.default')
@section('title')
    Dashboard
    @parent
@stop
<head>
    <style>
        .slide-banner {
	position: absolute; top: 200px; z-index: 9998; left: 100px;
}

.body-banner {
	background-color: #fff;
	padding: 20px;
	border-radius: 10px;
}

.btn-link:hover {
	text-decoration: none;
}

.pointer {
	cursor: pointer;
}

.mb-0 {
	margin-bottom: 0;
}

.page-item.disabled .page-link {
	border : 0;
}

.page-item .page-link {
	border : 0;
	color: #333;
}

.page-item.active .page-link {
	background-color: transparent;
	color: #dc3c45;
}

.hall-card {
	min-height: 250px;
	min-width: 250px;
	max-height: 250px;
	max-width: 250px;
	overflow: hidden;
	border-radius: 50%;
}
.frame {
	position: absolute;
	left: auto;
	right: auto;
	top: 0;
	bottom: 0%;
}

.owl-carousel .owl-dots {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 10px;
}
.owl-carousel button.owl-dot.active {
  background: none repeat scroll 0 0 #869791;
  border-radius: 20px;
  display: block;
  height: 12px;
  margin: 5px 7px;
  opacity: 0.5;
  width: 12px;
}
.owl-carousel button.owl-dot {
  background: none repeat scroll 0 0 #cacaca;
  border-radius: 20px;
  display: block;
  height: 12px;
  margin: 5px 7px;
  opacity: 0.5;
  width: 12px;
}

@media (max-width: 1024px) {
	.slide-banner {
		left: 0px;
		width: 51%;
		top: 170px;
	}

	.body-banner {
		background-color: #fff;
		padding: 20px;
		border-radius: 10px;
	}

	.frame {
		left: 19px;
		top: 30px;
	}
}

@media (max-width: 480px) {
	.slide-banner {
		left: 0px;
		width: 100%;
		top: 150px;
	}
	.card-header h3 {
		font-size: 20px;
	}
	.mb-sm-3 {
		margin-bottom: 1.5rem;
	}
}

@media (max-width: 375px) {
	.frame {
		left: 20px;
		top: 15px;
	}
}

@media (max-width: 360px) {
	.frame {
		top: 23px;
		left: 20px;
	}
}

    </style>
</head>
@section('content')
<section class="content profile-page">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card product-report">
                    <br>
                    <div class="header">
                        <center><h2>Hall Of Fame</h2></center>
                    </div>
                    <div class="body">
                    <div class="row clearfix m-b-15">
                            <div class="container pt-5">
                                    <div class="accordion" id="accordionExample">
                                      <div class="card">
                                        <div class="card-header bg-danger pointer" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                          <h2 class="mb-0">
                                            <button class="btn btn-link" type="button">
                                              <h3 class="text-white">CONGRATULATION, CHAIRMAN 2</h3>
                                            </button>
                                          </h2>
                                        </div>
                                        <div id="collapseOne" class="collapse {{$data['page']=='page_8s' ? 'show' : ''}}" aria-labelledby="headingOne" data-parent="#accordionExample">
                                          <div class="card-body">
                                            <div class="row">
                                              <div class="col-lg-4 p-4 mb-3">
                                                @foreach ($data['chairman2'] as $item)
                                                    <div class="mb-4">
                                                        <div class="d-flex mx-auto align-items-center justify-content-center hall-card">
                                                          <img src="{{$item['src'] != null ? asset($item['src']) : url('/img/logo.png')}}" class="img-fluid">
                                                        </div>
                                                          <img src="{{asset('img/bulu.png')}}" class="img-fluid frame">
                                                      </div>
                                                    <h4 class="text-center">{{$item['username']}}</h4>
                                                @endforeach
                                              </div>
                                            {{$data['chairman2']->links()}}
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="card">
                                        <div class="card-header bg-danger pointer" id="headingOne" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                          <h2 class="mb-0">
                                            <button class="btn btn-link" type="button">
                                              <h3 class="text-white">CONGRATULATION, CHAIRMAN 1</h3>
                                            </button>
                                          </h2>
                                        </div>

                                        <div id="collapseTwo" class="collapse {{$data['page']=='page_7s' ? 'show' : ''}}" aria-labelledby="headingOne" data-parent="#accordionExample">
                                          <div class="card-body">
                                            <div class="row">
                                                @foreach ($data['chairman1'] as $item)
                                                    <div class="col-lg-4 p-4 mb-3">
                                                        <div class="mb-4">
                                                            <div class="d-flex mx-auto align-items-center justify-content-center hall-card">
                                                                <img src="{{$item['src'] != null ? asset($item['src']) : url('/img/logo.png')}}" class="img-fluid">
                                                            </div>
                                                            <img src="{{asset('img/bulu.png')}}" class="img-fluid frame">
                                                        </div>
                                                        <h4 class="text-center">{{$item['username']}}</h4>
                                                    </div>
                                                @endforeach
                                            </div>
                                            {{$data['chairman1']->links()}}
                                            </div>
                                        </div>
                                      </div>
                                      <div class="card">
                                        <div class="card-header bg-danger pointer" id="headingOne" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">
                                            <h2 class="mb-0">
                                            <button class="btn btn-link" type="button">
                                                <h3 class="text-white">CONGRATULATION, DIRECTOR 3</h3>
                                            </button>
                                            </h2>
                                        </div>

                                        <div id="collapseThree" class="collapse {{$data['page']=='page_6s' ? 'show' : ''}}" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="row">
                                                    @foreach ($data['director3'] as $item)
                                                        <div class="col-lg-4 p-4 mb-3">
                                                            <div class="mb-4">
                                                                <div class="d-flex mx-auto align-items-center justify-content-center hall-card">
                                                                    <img src="./img/DC-7_resized.jpeg" class="img-fluid">
                                                                </div>
                                                                <img src="{{$item['src'] != null ? asset($item['src']) : url('/img/logo.png')}}" class="img-fluid frame">
                                                            </div>
                                                            <h4 class="text-center">{{$item['username']}}</h4>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                {{$data['director3']->links()}}
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header bg-danger pointer" id="headingOne" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseTwo">
                                            <h2 class="mb-0">
                                            <button class="btn btn-link" type="button">
                                                <h3 class="text-white">CONGRATULATION, DIRECTOR 2</h3>
                                            </button>
                                            </h2>
                                        </div>

                                        <div id="collapseFour" class="collapse {{$data['page']=='page_5s' ? 'show' : ''}}" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                            <div class="row">
                                                @foreach ($data['director2'] as $item)
                                                    <div class="col-lg-4 p-4 mb-3">
                                                        <div class="mb-4">
                                                        <div class="d-flex mx-auto align-items-center justify-content-center hall-card">
                                                            <img src="{{$item['src'] != null ? asset($item['src']) : url('/img/logo.png')}}" class="img-fluid">
                                                        </div>
                                                            <img src="{{asset('img/bulu.png')}}" class="img-fluid frame">
                                                        </div>
                                                        <h4 class="text-center">{{$item['username']}}</h4>
                                                    </div>
                                                @endforeach
                                            </div>
                                            {{$data['director2']->links()}}
                                            </div>
                                        </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header bg-danger pointer" id="headingOne" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseTwo">
                                                <h2 class="mb-0">
                                                <button class="btn btn-link" type="button">
                                                    <h3 class="text-white">CONGRATULATION, DIRECTOR 1</h3>
                                                </button>
                                                </h2>
                                            </div>

                                            <div id="collapseFive" class="collapse {{$data['page']=='page_4s' ? 'show' : ''}}" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                <div class="card-body">
                                                <div class="row">
                                                    @foreach ($data['director1'] as $item)
                                                        <div class="col-lg-4 p-4 mb-3">
                                                            <div class="mb-4">
                                                            <div class="d-flex mx-auto align-items-center justify-content-center hall-card">
                                                                <img src="{{$item['src'] != null ? asset($item['src']) : url('/img/logo.png')}}" class="img-fluid">
                                                            </div>
                                                                <img src="{{asset('img/bulu.png')}}" class="img-fluid frame">
                                                            </div>
                                                            <h4 class="text-center">{{$item['username']}}</h4>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                {{$data['director1']->links()}}
                                                </div>
                                            </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header bg-danger pointer" id="headingOne" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseTwo">
                                                    <h2 class="mb-0">
                                                    <button class="btn btn-link" type="button">
                                                        <h3 class="text-white">CONGRATULATION, PLATINUM 3</h3>
                                                    </button>
                                                    </h2>
                                                </div>

                                                <div id="collapseSeven" class="collapse {{$data['page']=='page_3s' ? 'show' : ''}}" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            @foreach ($data['platinum3'] as $item)
                                                            <div class="col-lg-4 p-4 mb-3">
                                                                <div class="mb-4">
                                                                <div class="d-flex mx-auto align-items-center justify-content-center hall-card">
                                                                    <img src="{{$item['src'] != null ? asset($item['src']) : url('/img/logo.png')}}" class="img-fluid">
                                                                </div>
                                                                    <img src="{{asset('img/bulu.png')}}" class="img-fluid frame">
                                                                </div>
                                                                <h4 class="text-center">{{$item['username']}}</h4>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    {{$data['platinum3']->links()}}
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header bg-danger pointer" id="headingOne" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseTwo">
                                                        <h2 class="mb-0">
                                                        <button class="btn btn-link" type="button">
                                                            <h3 class="text-white">CONGRATULATION, PLATINUM 2</h3>
                                                        </button>
                                                        </h2>
                                                    </div>

                                                    <div id="collapseSix" class="collapse {{$data['page']=='page_2s' ? 'show' : ''}}" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                        <div class="row">
                                                            @foreach ($data['platinum2'] as $item)
                                                                <div class="col-lg-4 p-4 mb-3">
                                                                    <div class="mb-4">
                                                                    <div class="d-flex mx-auto align-items-center justify-content-center hall-card">
                                                                        <img  src="{{$item['src'] != null ? asset($item['src']) : url('/img/logo.png')}}" class="img-fluid">
                                                                    </div>
                                                                        <img src="{{asset('img/bulu.png')}}" class="img-fluid frame">
                                                                    </div>
                                                                    <h4 class="text-center">{{$item['username']}}</h4>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        {{$data['platinum2']->links()}}
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header bg-danger pointer" id="headingOne" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseTwo">
                                                            <h2 class="mb-0">
                                                            <button class="btn btn-link" type="button">
                                                                <h3 class="text-white">CONGRATULATION, PLATINUM 1</h3>
                                                            </button>
                                                            </h2>
                                                        </div>

                                                        <div id="collapseEight" class="collapse {{$data['page']=='page_1s' ? 'show' : ''}}" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                            <div class="row">
                                                                @foreach ($data['platinum1'] as $item)
                                                                    <div class="col-lg-4 p-4 mb-3">
                                                                        <div class="mb-4">
                                                                        <div class="d-flex mx-auto align-items-center justify-content-center hall-card">
                                                                            <img src="{{$item['src'] != null ? asset($item['src']) : url('/img/logo.png')}}" class="img-fluid">
                                                                        </div>
                                                                            <img src="{{asset('img/bulu.png')}}" class="img-fluid frame">
                                                                        </div>
                                                                        <h4 class="text-center">{{$item['username']}}</h4>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            {{$data['platinum1']->links()}}
                                                        </div>
                                                    </div>
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
<style>

</style>
@stop

@section('footer_scripts')
    <script>
    </script>
@stop
