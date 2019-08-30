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
                <form action="{{route('member.ebook.store')}}" method="POST">
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
                                                    <div class="bg-white shadow rounded p-3 border-hover triangle">
                                                        <div id="flag" class="renewal-basic" style="display:none">
                                                            <span>Renewal</span>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-3 d-flex align-items-center">
                                                                <img src="http://ebook.bitrexgo.id/assetsebook/v2/img/1.png" class="mx-auto d-block">
                                                            </div>
                                                            <input type="text" id="basic-value" hidden>
                                                            <div class="col-lg-9">
                                                                <h2 class="mb-0" style="color: #8543da;" id="basic"></h2>
                                                                <br>
                                                                <h5 style="color:black" id="description-basic"></h5><br>
                                                                <a href="#" data-toggle="modal" data-target="#buy" class="btn btn-danger btn-sm mt-3 px-5" id="cart1">BUY</a>
                                                                <a href="{{route('member.ebook.referral', ['type' => 'advance', 'username' => isset($profile->username) ? $profile->username : $profile['username']])}}" class="btn btn-danger btn-sm mt-3 px-5" id="view1">VIEW</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <div class="bg-white shadow rounded p-3 border-hover triangle">
                                                        <div id="flag" class="renewal-advance" style="display:none">
                                                            <span>Renewal</span>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-3 d-flex align-items-center">
                                                                <img src="http://ebook.bitrexgo.id/assetsebook/v2/img/1.png" class="mx-auto d-block">
                                                            </div>
                                                            <input type="text" id="advance-value" hidden>
                                                            <div class="col-lg-9">
                                                                <h2 class="mb-0" style="color: #8543da;" id="advance"></h2>
                                                                <br>
                                                                <h5 style="color:black" id="advance-description"></h5><br>
                                                                <a href="#" data-toggle="modal" data-target="#buy" class="btn btn-danger btn-sm mt-3 px-5" id="cart2">BUY</a>
                                                                <a href="{{route('member.ebook.referral', ['type' => 'advance', 'username' => isset($profile->username) ? $profile->username : $profile['username']])}}" class="btn btn-danger btn-sm mt-3 px-5" id="view2">VIEW</a>
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

@section('footer_scripts')
<style>
    div#flag { 
        background-color: #333;
        padding: 10px;
        font-size: 11px !important;
        border-radius: 2px;
        -ms-transform: rotate(40deg);
        -webkit-transform: rotate(40deg);
        transform: rotate(40deg);
        width: 160px;
        text-align: center;
        position: relative;
        right: -77%;
        height: 53px;
        z-index: 0;
        top: -42px;
        background-color: #D4AF37;
    }
    #flag span {
        position: relative;
        left: 28px;
        top: 18px;
    }
    .triangle{
        overflow: hidden;
        position: relative;
    }
</style>  
<script type="text/javascript">
    var price_basic = 0;
    var price_advance = 0;
    var cek = 0;
    var disable = false;
    $(document).ready(function () {    
        $.ajax({
            type: 'GET',
            url: '{{route("member.select.bitrex-points")}}',
            success: function (data) {
                cek = price_basic != 0 ? price_basic : price_advance;
                cek = cek / 1000;
                btrx_points = data.bitrex_points;
                if (cek < btrx_points) {
                    $('#bp').attr('disabled',true);
                    disable = true;
                }else{
                    $('#pay').attr('type','submit');
                }
            },
            error: function() { 
                console.log("Error");
            }
        });

        $('#cart1').click(function(){
            $('#id').val($('#basic-value').val());
            $('#price').attr('value', 'Price: IDR '+addCommas(price_basic));
        });

        $('#cart2').click(function(){
            $('#id').val($('#advance-value').val());
            $('#price').attr('value', 'Price: IDR '+addCommas(price_advance));
        });

        $('input[type=radio][name=payment]').change(function() {
            if (this.value == 0) {
                $('#pay').attr('type','submit'); 
            }else{
                $('#pay').attr('type','submit');
            };
        });

        $.ajax({
			type: 'GET',
			url: '{{route("member.select.ebook")}}',
			success: function (data) {
				for (let index = 0; index < data.length; index++) {
                    if(index == 0){
                        var str = data[index].id == 3 ? data[index].title.replace('renewal_', ' ') : data[index].title ;
                        str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                            return letter.toUpperCase();
                        });
                        $('#basic').text(str);
                        data[index].id == 3 ? $('.renewal-basic').show() : $('.renewal-basic').hide() ;
                        $('#description-basic').text(data[index].description);
                        $('#basic-value').val(data[index].id);
                        price_basic = data[index].price;
                    }else{
                        var str = data[index].id == 4 ? data[index].title.replace('renewal_', ' ') : data[index].title ;
                        str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                            return letter.toUpperCase();
                        });
                        $('#advance').text(str);
                        data[index].id == 4 ? $('.renewal-advance').show() : $('.renewal-advance').hide() ;
                        $('#advance-description').text(data[index].description);
                        $('#advance-value').val(data[index].id);
                        price_advance = data[index].price;
                    }
                }
			},
			error: function() { 
				console.log("Error");
			}
        });
    });
</script>
@stop