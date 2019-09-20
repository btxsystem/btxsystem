@extends('frontend.default')
@section('title')
    Ebook
    @parent
@stop
@section('content')

<div class="modal fade" id="buy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buy Ebook</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/" method="POST">
                    @csrf
                    <input type="text" name="id" id="id" hidden>
                    <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-line">
							<input class="form-control" name="price" id="price" type="text" readonly>
						</div>
                    </div>
                    <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h5 class="card-inside-title">Payment</h5>
						<div class="demo-radio-button">
							<input name="payment" type="radio" value="0" id="bp" class="with-gap radio-col-red" />
							<label for="bp">Bitrex Points</label>
							<input name="payment" type="radio" value="1" id="transfer" class="with-gap radio-col-red" />
							<label for="transfer">Ipay</label>
						</div>
                    </div>
                    <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-line">
                            <input class="form-control" name="my-bp" id="my-bp" type="text" readonly>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <button type="button" class="btn btn-primary" id="pay">Pay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<section class="content ecommerce-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Ebook
                <small class="text-muted">Bitrexgo</small>
                </h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card" style="background-color:#b92240">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="ebook">
                                    <div class="my-5">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-6 mb-3">
                                                    <div class="row">
                                                      <div class="col-10 mx-auto">
                                                        <div id="basic-expired" class="ml-md-5 ml-3">
                                                            <span id="clock-basic"></span>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="bg-white shadow rounded p-3 border-hover triangle">
                                                        <!-- <div id="basic-expired" style="position:fixed">
                                                            <span id="clock-basic"></span>
                                                        </div> -->
                                                        <div class="row">
                                                            <div class="col-lg-3 d-flex align-items-center">
                                                                <img src="{{URL::to('/')}}/{{$basic->src}}" class="mx-auto d-block" id="basic-photo">
                                                            </div>
                                                            <input type="text" id="basic-value" hidden>
                                                            <div class="col-lg-9">
                                                                <h2 class="mb-0" style="color: #8543da;" id="basic"></h2>
                                                                <br>
                                                                <h5 style="color:black" id="description-basic"></h5><br>
                                                                <a href="{{route('member.home')}}" class="btn btn-danger btn-sm mt-3 px-5"  id="cart1"></a>
                                                                <a href="{{route('member.ebook.referral', ['type' => 'basic', 'username' => isset($profile->username) ? $profile->username : $profile['username']])}}" class="btn btn-primary btn-sm mt-3 px-5" id="view1">VIEW</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                  <div class="row">
                                                    <div class="col-10 co-lg-8 mx-auto">
                                                      <div id="advance-expired" class="ml-md-5 ml-3">
                                                          <span id="clock-advance"></span>
                                                      </div>
                                                    </div>
                                                  </div>
                                                    <div class="bg-white shadow rounded p-3 border-hover triangle">
                                                        <!-- <div id="advance-expired" style="position:fixed">
                                                            <span id="clock-advance"></span>
                                                        </div> -->
                                                        <div class="row">
                                                            <div class="col-lg-3 d-flex align-items-center">
                                                            <img src="{{URL::to('/')}}/{{$advance->src}}" class="mx-auto d-block" id="advance-photo">
                                                            </div>
                                                            <input type="text" id="advance-value" hidden>
                                                            <div class="col-lg-9">
                                                                <h2 class="mb-0" style="color: #8543da;" id="advance"></h2>
                                                                <br>
                                                                <h5 style="color:black" id="advance-description"></h5><br>
                                                                <br><br><br><br><br><br><br><br><br>
                                                                <a href="{{route('member.home')}}" class="btn btn-danger btn-sm mt-3 px-5" id="cart2"></a>
                                                                <a href="{{route('member.ebook.referral', ['type' => 'advance', 'username' => isset($profile->username) ? $profile->username : $profile['username']])}}" class="btn btn-primary btn-sm mt-3 px-5" id="view2">VIEW</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@extends('frontend.ebook.style')
@extends('frontend.ebook.scripts')
