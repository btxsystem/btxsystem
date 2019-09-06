@extends('frontend.default')
@section('title')
    My Bonus
    @parent
@stop
@section('content')
<section class="content ecommerce-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h2>My Bonus
                <small class="text-muted">Bitrexgo</small>
                </h2>
            </div>
        </div>
        <br><br>
        <div class="row clearfix">
            <div class="col-lg-4 col-sm-6 col-md-6">
                <a href="{{route('member.history-bonus.sponsor')}}">
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-6 col-7">
                                    <h4>IDR</h4>
                                    <h3 class="m-t-0 bonus-sponsor"></h3>
                                    <p class="m-b-0">Bonus Sponsor</p>
                                </div>
                                <div class="col-sm-6 col-5 pl-0">
                                    <img src="{{url('img/money-bag.png')}}" class="img-fluid" style="opacity: 0.3;">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-6">
                <a href="{{route('member.history-bonus.sales-profit')}}">
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-6 col-7">
                                    <h4>IDR</h4>
                                    <h3 class="m-t-0 bonus-sales-profit"></h3>
                                    <p class="m-b-0">Bonus Sales Profit</p>
                                </div>
                                <div class="col-sm-6 col-5 pl-0">
                                    <img src="{{url('img/money-bag.png')}}" class="img-fluid" style="opacity: 0.3;">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-6">
                <a href="{{route('member.history-bonus.pairing')}}">
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-6 col-7">
                                    <h4>IDR</h4>
                                    <h3 class="m-t-0 bonus-pairing"></h3>
                                    <p class="m-b-0">Bonus Pairing</p>
                                </div>
                                <div class="col-sm-6 col-5 pl-0">
                                    <img src="{{url('img/money-bag.png')}}" class="img-fluid" style="opacity: 0.3;">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-4 col-sm-6 col-md-6">
                <a href="#">
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-6 col-7">
                                    <h4>IDR</h4>
                                    <h3 class="m-t-0 bonus-rewards"></h3>
                                    <p class="m-b-0">Bonus Rewards</p>
                                </div>
                                <div class="col-sm-6 col-5 pl-0">
                                    <img src="{{url('img/money-bag.png')}}" class="img-fluid" style="opacity: 0.3;">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-6">
                <a href="#">
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-6 col-7">
                                    <h4>IDR</h4>
                                    <h3 class="m-t-0 bonus-event"></h3>
                                    <p class="m-b-0">Bonus Event</p>
                                </div>
                                <div class="col-sm-6 col-5 pl-0">
                                    <img src="{{url('img/money-bag.png')}}" class="img-fluid" style="opacity: 0.3;">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
@extends('frontend.bonus.style')
@extends('frontend.bonus.scripts')
@stop
