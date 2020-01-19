@include('frontend.auth.header')
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
        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-4 p-4 mb-3">
                @foreach ($data['chairman2'] as $item)
                    <div class="mb-4">
                        <div class="d-flex mx-auto align-items-center justify-content-center hall-card">
                          <img src="{{$item['url'] != null ? url('/').$item['url'] : url('/img/logo.png')}}" class="img-fluid">
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

        <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
            <div class="row">
                @foreach ($data['chairman1'] as $item)
                    <div class="col-lg-4 p-4 mb-3">
                        <div class="mb-4">
                            <div class="d-flex mx-auto align-items-center justify-content-center hall-card">
                                <img src="{{$item['url'] != null ? url('/').$item['url'] : url('/img/logo.png')}}" class="img-fluid">
                            </div>
                            <img src="./img/bulu.png" class="img-fluid frame">
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

        <div id="collapseThree" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <div class="row">
                    @foreach ($data['director3'] as $item)
                        <div class="col-lg-4 p-4 mb-3">
                            <div class="mb-4">
                                <div class="d-flex mx-auto align-items-center justify-content-center hall-card">
                                    <img src="./img/DC-7_resized.jpeg" class="img-fluid">
                                </div>
                                <img src="{{$item['url'] != null ? url('/').$item['url'] : url('/img/logo.png')}}" class="img-fluid frame">
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

        <div id="collapseFour" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
            <div class="row">
                @foreach ($data['director2'] as $item)
                    <div class="col-lg-4 p-4 mb-3">
                        <div class="mb-4">
                        <div class="d-flex mx-auto align-items-center justify-content-center hall-card">
                            <img src="{{$item['url'] != null ? url('/').$item['url'] : url('/img/logo.png')}}" class="img-fluid">
                        </div>
                            <img src="./img/bulu.png" class="img-fluid frame">
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

            <div id="collapseFive" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                <div class="row">
                    @foreach ($data['director1'] as $item)
                        <div class="col-lg-4 p-4 mb-3">
                            <div class="mb-4">
                            <div class="d-flex mx-auto align-items-center justify-content-center hall-card">
                                <img src="{{$item['url'] != null ? url('/').$item['url'] : url('/img/logo.png')}}" class="img-fluid">
                            </div>
                                <img src="./img/bulu.png" class="img-fluid frame">
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

                <div id="collapseSeven" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($data['platinum3'] as $item)
                            <div class="col-lg-4 p-4 mb-3">
                                <div class="mb-4">
                                <div class="d-flex mx-auto align-items-center justify-content-center hall-card">
                                    <img src="{{$item['url'] != null ? url('/').$item['url'] : url('/img/logo.png')}}" class="img-fluid">
                                </div>
                                    <img src="./img/bulu.png" class="img-fluid frame">
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

                    <div id="collapseSix" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                        <div class="row">
                            @foreach ($data['platinum2'] as $item)
                                <div class="col-lg-4 p-4 mb-3">
                                    <div class="mb-4">
                                    <div class="d-flex mx-auto align-items-center justify-content-center hall-card">
                                        <img  src="{{$item['url'] != null ? url('/').$item['url'] : url('/img/logo.png')}}" class="img-fluid">
                                    </div>
                                        <img src="./img/bulu.png" class="img-fluid frame">
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

                        <div id="collapseEight" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                            <div class="row">
                                @foreach ($data['platinum1'] as $item)
                                    <div class="col-lg-4 p-4 mb-3">
                                        <div class="mb-4">
                                        <div class="d-flex mx-auto align-items-center justify-content-center hall-card">
                                            <img src="{{$item['url'] != null ? url('/').$item['url'] : url('/img/logo.png')}}" class="img-fluid">
                                        </div>
                                            <img src="./img/bulu.png" class="img-fluid frame">
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
  <br>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
@include('frontend.auth.footer')
