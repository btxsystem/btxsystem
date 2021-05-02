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

<div class="modal fade" id="expired" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="train">ANNOUNCEMENT EXPIRED</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>
                    Bagi member yang masa aktif keanggotaan telah habis (non-aktif), member dapat memperpanjang masa aktif, berikut adalah cara-caranya :
                </h3>
                <h3>
                    1. Login ke dalam cabinet,  status keanggotaan dapat dilihat di sudut kanan atas (tertulis non-aktif).
                </h3>
                <h3>
                    2. Untuk pembelian ebook, renewal, dapat diakses melalui menu ebook seperti biasa.
                </h3>
                <h3>
                    3. Selama dalam status non-aktif, member tidak dapat melakukan penjoinan dan tidak mendapatkan pv dari jaringan dan komisi.
                </h3>
            </div>
        </div>
    </div>
</div>

<section class="content profile-page">
    <section class="boxs-simple">
        <div class="profile-header">
            <!-- <div class="text-right" style="margin-bottom: 20px; margin-right: 20px;">
                <span id="clock"></span>
            </div> -->
            <div class="profile_info row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="profile-image float-md-right"> <img src="{{isset($profile['src']) ? asset($profile['src']) : asset('/assetsebook/v2/img/logo-white.png') }}"  alt=""> </div>
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
                            <p class="text-profile-title">{{$profile['rank']}}</p>
                        </a>
                    </li>
                    <li>
                        <a title="pv"><b class="zmdi zmdi" style="font-size:20px">PV Group</b>
                            <p class="pv text-profile-title">{{number_format($profile['pv'])}}</p>
                        </a>
                    </li>
                    <li><a title="username"><i class="zmdi zmdi-account-circle"></i>
                        <p class="text-profile-title">{{$profile['username']}}</p>
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
            <div class="col-lg-4 col-sm-6 col-md-6" style="text-align: center;">
                <div>
                    <a target="_blank" href="{{asset('assets3/compro.pdf')}}" style="cursor: pointer;">
                        <img style="width: 80%;" src="assets3/img/Compro-Icon.png" alt="">
                    </a>
                </div>
                <br>
                <div>
                    <a target="_blank" href="{{asset('assets3/code-ethic.pdf')}}" style="cursor: pointer;">
                        <img style="width: 80%;" src="assets3/img/KE-Icon.png" alt="">
                    </a>
                </div>
                <br>
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
                            <div class="icon l-amber"><i class="zmdi zmdi-trending-up"></i></div>
                            <div class="col-in">
                                <small class="text-muted m-t-0">Total Commission</small> <br><br>
                                <h4 class="counter m-b-0">IDR <b class="commission"></b> </h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-5 col-sm-4">
                            <div class="icon l-parpl"><i class="zmdi zmdi-accounts-outline"></i></div>
                            <div class="col-in">
                                <small class="text-muted m-t-0">Komisi Sponsor</small> <br><br>
                                <h4 class="counter m-b-0">IDR <b class="sponsor"></b> </h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="icon l-turquoise"><i class="zmdi zmdi-swap"></i></div>
                            <div class="col-in">
                                <small class="text-muted m-t-0">Komisi Pairing</small> <br><br>
                                <h4 class="counter m-b-0">IDR <b class="pairing"></b> </h4>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix m-b-15">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="icon l-turquoise"><i class="zmdi zmdi-badge-check"></i></div>
                            <div class="col-in">
                                <small class="text-muted m-t-0">Bonus Rewards</small> <br><br>
                                <h4 class="counter m-b-0">IDR <b class="rewards"></b> </h4>
                            </div>
                        </div>
                        <br>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="icon l-parpl"><i class="zmdi zmdi-card-giftcard"></i></div>
                            <div class="col-in">
                                <small class="text-muted m-t-0">Bonus Event</small> <br><br>
                                <h4 class="counter m-b-0">IDR <b class="event"></b> </h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-5">
                            <div class="icon l-amber"><i class="zmdi zmdi-chart-donut"></i></div>
                            <div class="col-in">
                                <small class="text-muted m-t-0">Bonus Sales Profit</small> <br><br>
                                <h4 class="counter m-b-0">IDR <b class="auto-retail"></b> </h4>
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
    @media only screen and (max-width: 900px){
        .product-report .counter {
            padding-bottom: 15px;
        }
    }
</style>
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
                url: '{{route("member.select.expired-member")}}',
                data: data,
                success:function(data){

                    if (data.des && !data.grace && !data.max) {
                        $('#clock').countdown(data.date.expired_at, function(event) {
                            $(this).html(`
                            <span>Status membership: </span>
                            <span>${event.strftime('%D')}<span class="text-warning"> Days :</span></span>

                            <span>${event.strftime('%H')}<span class="text-warning">h :</span></span>

                            <span>${event.strftime('%M')}<span class="text-warning">m :</span></span>

                            <span>${event.strftime('%S')}<span class="text-warning">s</span></span>

                            `);
                        });
                    }

                    if (data.des && data.grace) {
                        $('#expired').modal('show')
                        $('#clock').countdown(data.graceperiod, function(event) {
                            $(this).html(`
                            <span>Status non-aktif: </span>
                            <span>${event.strftime('%D')}<span class="text-warning"> Days :</span></span>

                            <span>${event.strftime('%H')}<span class="text-warning">h :</span></span>

                            <span>${event.strftime('%M')}<span class="text-warning">m :</span></span>

                            <span>${event.strftime('%S')}<span class="text-warning">s</span></span>

                            `);
                        });
                    }

                    if(!data.des) {
                        $('#clock').html(`
                            <span>Membership active until: </span>
                            <span class="text-warning">${moment(data.date.expired_at).format('D MMMM Y')}</span>
                        `);
                    }
                },
                error : function(err) {
                    console.log(err)
                }
            })

            $.ajax({
                url: '{{route("member.select.bonus")}}',
                data: data,
                success:function(data){
                    $('.commission').text(addCommas(data.total.nominal == null ? 0 : data.total.nominal));
                    $('.event').text(addCommas(data.event.nominal == null ? 0 : data.event.nominal));
                    $('.rewards').text(addCommas(data.rewards.nominal == null ? 0 : data.rewards.nominal));
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
