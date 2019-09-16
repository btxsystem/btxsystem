@extends('frontend.default')
@section('title')
    Dashboard
    @parent
@stop

@section('content')
<!-- Top Bar -->

<div class="modal fade" id="training" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="train">Training Join</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('member.profile.reset-password')}}" method="POST">
                {{ method_field('post') }}
                @csrf    
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <p class="note"></p>
                    <p class="location"></p>
                    <p class="price"></p>
                    <p class="capacity"></p>
                    <p class="date"></p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <input type="submit" class="btn btn-primary" id="join-training" value="Join">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="exp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="train" style="color:red">Warning</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 style="color:red">Your member account will expire in less than three months</h5>
            </div>
            <div class="modal-footer">
                <a class="btn btn-secondary" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>

<section class="content profile-page">
    <section class="boxs-simple">
        <div class="profile-header">
            <div class="profile_info row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="profile-image float-md-right"> <img src="{{asset('img/1.jpg')}}" alt=""> </div>
                </div>
                <div class="col-lg-6 col-md-8 col-12 profile">
                    <h4 class="m-t-5 m-b-0"><strong>{{$profile['name']}}</strong></h4>
                    <br>
                    <span class="job_post"><b>ID : {{$profile['id_member']}}</b></span>
                </div>                
            </div>
        </div>
        <div class="profile-sub-header">
            <div class="box-list">
                <ul class="text-center">
                    <li>
                        <a title="rank"><i class="zmdi zmdi-star-circle"></i>
                            <p>{{$profile['rank']}}</p>
                        </a>
                    </li>
                    <li>
                        <a title="pv"><b class="zmdi zmdi" style="font-size:15px">PV Group</b>
                            <p class="pv">{{number_format($profile['pv'])}}</p>
                        </a>
                    </li>
                    <li><a title="username"><i class="zmdi zmdi-account-circle"></i>
                        <p>{{$profile['username']}}</p>
                    </a></li>
                </ul>
            </div>
        </div>
    </section>
    <div class="container-fluid">
        <div class="row clearfix training_" hidden="true">
            <a href="#" data-toggle="modal" data-target="#training">
            <div class="col-lg-12 col-md-12">
                <div class="card product-report">
                    <div id="area_chart" class="graph">
                        <div class="body">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="icon l-turquoise"><i class="zmdi zmdi-book"></i></div>
                                <div class="col-in">
                                    <h4 class="counter m-b-0">Training</h4>
                                    <small class="text-muted m-t-0 description"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            </div>
        </div>
    
        <div class="row clearfix">
            <div class="col-lg-4 col-sm-6 col-md-6">
                <div class="card l-parpl">
                    <div class="body">
                        <div class="row">
                            <div class="col-sm-6 col-7">
                                <h3 class="m-t-0 bitrex-points">{{number_format($profile['bitrex_points'],0,".",".")}}</h3>
                                <p class="m-b-0">Bitrex Points</p>
                            </div>
                            <div class="col-sm-6 col-5 pl-0">
                                <img src="{{url('img/coin.png')}}" class="img-fluid" style="opacity: 0.3;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-6">
                <div class="card l-amber">
                    <div class="body">
                        <div class="row">
                            <div class="col-sm-6 col-7">
                                <h4>IDR</h4>
                                <h3 class="m-t-0 bitrex-cash">{{number_format($profile['bitrex_cash'],0,".",".")}}</h3>
                                <p class="m-b-0">Bitrex Value</p>
                            </div>
                            <div class="col-sm-6 col-5 pl-0">
                                <img src="{{url('img/money-bag.png')}}" class="img-fluid" style="opacity: 0.3;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card product-report">
                    <div class="header">
                        <h2>My commission</h2>
                    </div>
                    <div class="body">
                    <div class="row clearfix m-b-15">
                        <div class="col-lg-4 col-md-4 col-sm-5">
                            <div class="icon l-amber"><i class="zmdi zmdi-chart-donut"></i></div>
                            <div class="col-in">
                                <small class="text-muted m-t-0">Sales Profit</small> <br><br>
                                <h4 class="counter m-b-0">IDR <b class="auto-retail"></b> </h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="icon l-turquoise"><i class="zmdi zmdi-chart"></i></div>
                            <div class="col-in">
                                <small class="text-muted m-t-0">Pairing</small> <br><br>
                                <h4 class="counter m-b-0">IDR <b class="pairing"></b> </h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="icon l-parpl"><i class="zmdi zmdi-accounts-outline"></i></div>
                            <div class="col-in">
                                <small class="text-muted m-t-0">Sponsor</small> <br><br>
                                <h4 class="counter m-b-0">IDR <b class="sponsor"></b> </h4>
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
@stop


@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajax({
                url: '{{route("member.select.daily-retail")}}',
                data: data,
                success:function(data){
                    $('.auto-retail').append(addCommas(data.bonus_retail.nominal));
                }
            });

            $.ajax({
                url: '{{route("member.select.exp-three-month")}}',
                data: data,
                success:function(data){
                    data.darurat ? $('#exp').modal('show') : $('#exp').modal('hide'); 
                }
            });

            $.ajax({
                url: '{{route("member.select.daily-bonus-sponsor")}}',
                data: data,
                success:function(data){
                    $('.sponsor').append(addCommas(data.bonus_sponsor.nominal));
                }
            });

            $.ajax({
                url: '{{route("member.select.training")}}',
                data: data,
                success:function(data){
                   if (data.training) {
                        $('.training_').removeAttr('hidden');
                        $('.description').append(data.training.note);
                        $('.note').append(data.training.note);
                        $('.location').append('Location : ' + data.training.location);
                        $('.price').append('Price : ' + data.training.price);
                        $('.capacity').append('Capacity : ' + data.training.capacity);
                        $('.date').append('Date : ' + data.training.date);

                   }
                }
            });

            $.ajax({
                url: '{{route("member.select.daily-pairing")}}',
                data: data,
                success:function(data){
                    $('.pairing').append(addCommas(data.bonus_pairing.nominal));
                }
            });

        });
    </script>
@stop

