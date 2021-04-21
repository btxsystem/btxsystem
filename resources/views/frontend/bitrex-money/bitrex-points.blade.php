@extends('frontend.default')
@section('title')
    Bitrex points
    @parent
@stop
@section('content')
<div class="modal fade" id="topup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="topup">Top Up Bitrex Points</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-line">
                        <input class="form-control" name="nominal" id="nominal" type="number" min="5">
                        <label class="form-label">Nominal</label>
                    </div>
                    <p class="notif" style="color:green">Minimum input bitrex points 10000, and Multiples 1000</p>
                </div>
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-line">
                        <input class="form-control" name="points" id="points" type="text" readonly>
                    </div>
                    {{--<p class="notif" style="color:green">Convert from IDR 1000</p>--}}
                </div>
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="pickup_quarter" name="pickup_quarter" value="1">
                    <label class="form-check-label" for="pickup_quarter">
                        Pick up at headquarter
                    </label>
                    </div>
                    <div id="pickup_form">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shipping-form">
    						<div class="form-group">
    							<select id="province" name="province" class="province" style="width:100%!important"></select>
                                <input type="hidden" name="province_name" id="province_name" value="">
    						</div>
    						<div class="form-group city-form">
    							<select id="city" name="city" class="city"></select>
                                <input type="hidden" name="city_name" id="city_name" value="">
    						</div>
    						<div class="form-group district-form">
    							<select id="district" name="district" class="district"></select>
                                <input type="hidden" name="district_name" id="district_name" value="">
    						</div>
    						<div class="form-group kurir-form">
    							<select id="kurir" name="kurir" class="kurir"></select>
                                <input type="hidden" name="kurir_name" id="kurir_name" value="">
    						</div>
    						<div class="cost-form form-line" style="display:none">
                                <h3>Total Ongkir : <span id="cost-summary"></span> </h3>
                                <input type="hidden" id="cost_summary_value" value="0">
    						</div>
    					</div>
                    </div>
                </div>
                @if(getCurrentPaymentMethod() == 'va')
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h5 class="card-inside-title">Select Payment Method</h5>
                    <div class="demo-radio-button">
                        <input name="method" type="radio" value="bca" id="bca" class="with-gap radio-col-red" checked />
                        <label for="bca">BCA VA</label>
                    </div>
                    <div class="demo-radio-button">
                        <input name="method" type="radio" value="cc" id="cc" class="with-gap radio-col-red"/>
                        <label for="cc">Other Payment (Credit Card, Bank Transfer & E-money)</label>
                    </div>
                    <br>
                    <!-- <div class="form-line cc-form" style="display:none">
                        <input class="form-control" name="ccNumber" id="ccNumber" type="number">
                        <label class="form-label">Credit Card Number</label>
                    </div>
                    <br>
                    <div class="form-line exp-month-form" style="display:none">
                        <input class="form-control" name="expMonth" id="expMonth" type="number" min="2">
                        <label class="form-label">Exp Month</label>
                    </div>
                    <br>
                    <div class="form-line exp-year-form" style="display:none">
                        <input class="form-control" name="expYear" id="expYear" type="number" min="4">
                        <label class="form-label">Exp Year</label>
                    </div>
                    <br>
                    <div class="form-line cvn-form" style="display:none">
                        <input class="form-control" name="cvn" id="cvn" type="number" min="3">
                        <label class="form-label">CVN</label>
                    </div> -->
                </div>
                @endif
                @if(getCurrentPaymentMethod() == 'transfer')
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h5>Select Payment Method</h5>
                  <div class="demo-radio-button">
                    <input name="method" type="radio" value="transfer" id="transfer" class="with-gap radio-col-red" checked />
                    <label for="transfer">Transfer</label>


                     <!-- <input name="method" type="radio" value="bca" id="bca" class="with-gap radio-col-red" checked/>
                    <label for="bca">BCA VA</label>
                    <input name="method" type="radio" value="transfer" id="transfer" class="with-gap radio-col-red"/>
                    <label for="bca">Transfer</label> -->

                    <!--<input name="method" type="radio" value="other" id="other" class="with-gap radio-col-red"/>
                    <label for="other">Other Transfer</label>-->

                    <!-- <input name="method" type="radio" value="ovo" id="ovo" class="with-gap radio-col-red" />
                    <label for="ovo">OVO</label>

                    <input name="method" type="radio" value="mandiri" id="mandiri" class="with-gap radio-col-red" />
                    <label for="mandiri">MANDIRI ATM</label>

                    <input name="method" type="radio" value="bni" id="bni" class="with-gap radio-col-red" />
                    <label for="bni">BNI VA</label>

                    <input name="method" type="radio" value="maybank" id="maybank" class="with-gap radio-col-red"/>
                    <label for="maybank">MAYBANK VA</label>

                    <input name="method" type="radio" value="permata" id="permata" class="with-gap radio-col-red" />
                    <label for="permata">PERMATA VA</label> -->
                  </div>
                </div>

                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12" id="transfer-form">
                  <h4>Bank Name : BCA</h4>
                  <h4>Bank Account : PT. BITREXGO SOLUSI PRIMA</h4>
                  <h4>Bank Number : 5810598168</h4>
                </div>
                @endif
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <a href="#" id="payment-bca" style="cursor:pointer; display:none;" class="btn btn-primary"></a>
                    <button type="button" id="topup-points" disabled=true class="btn btn-primary" style="cursor:pointer;">Topup</a>
                </div>

        </div>
    </div>
</div>

<div class="modal fade" id="no-virtual" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{asset('img/bca.png')}}" alt="" srcset="" style="width:100px">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height: 450px; overflow-y: auto;">
                <center>
                    <p style="font-size:14px">BCA Virtual Account Number</p>
                        <div class="form-line focused success">
                            <input style="color:green; font-size:25px; font-weight:bold; text-align:center;" type="text" class="form-control" id="va" name="va" value="" readonly>
                        </div>
                    <button type="button" class="btn btn-raised bg-grey waves-effect" style="cursor:pointer" id="copy">Copy</button>
                </center>
                <br>
                <center><p style="font-size:14px" id="nominal_plus_fee"></p></center>
                <center><p style="font-size:14px" id="time-expired"></p></center>
                <br>
                <h4>Bagaimana cara melakukan Pembayaran BCA Virtual Account ?</h4>
                <h5>1. ATM BCA</h5>
                <ul style="font-size:12px">
                    <li>
                        <p>Masukkan kartu ATM dan PIN BCA anda</p>
                    </li>
                    <li>
                        <p>Pilih menu TRANSAKSI LAINNYA > TRANSFER > KE REKENING BCA VIRTUAL ACCOUNT</p>
                    </li>
                    <li>
                        <p id="des_noreq"></p>
                    </li>
                    <li>
                        <p>Masukkan jumlah transfer sesuai detail transaksi. (Jumlah pembayaran harus sama dengan jumlah tagihan yang harus dibayar).</p>
                    </li>
                    <li>
                        <p>Ikuti instruksi untuk menyelesaikan transaksi</p>
                    </li>
                </ul>
                <h5>2. KLIK BCA</h5>
                <ul style="font-size:12px">
                    <li>
                        <p>Masuk ke website KLIK BCA</p>
                    </li>
                    <li>
                        <p>Pilih menu TRANSFER DANA > TRANSFER KE BCA VIRTUAL ACCOUNT</p>
                    </li>
                    <li>
                        <p id="des_noreq2"></p>
                    </li>
                    <li>
                        <p>Masukkan jumlah transfer sesuai detail transaksi. Jumlah pembayaran harus sama dengan jumlah tagihan yang harus dibayar.</p>
                    </li>
                    <li>
                        <p>Ikuti instruksi untuk menyelesaikan transaksi</p>
                    </li>
                </ul>
                <h5>3. m-BCA (BCA MOBILE)</h5>
                <ul style="font-size:12px">
                    <li>
                        <p>Masuk ke aplikasi mobile m-BCA</p>
                    </li>
                    <li>
                        <p>Pilih menu M-TRANSFER > BCA VIRTUAL ACCOUNT</p>
                    </li>
                    <li>
                        <p id="des_noreq3"></p>
                    </li>
                    <li>
                        <p>Masukkan jumlah transfer sesuai detail transaksi. Jumlah pembayaran harus sama dengan jumlah tagihan yang harus dibayar.</p>
                    </li>
                    <li>
                        <p>Masukkan PIN m-BCA Anda</p>
                    </li>
                    <li>
                        <p>Ikuti instruksi untuk menyelesaikan transaksi</p>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor:pointer">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cekongkir" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="topup">Cek Ongkos Kirim</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shipping-form">
    						<div class="form-group">
    							<select id="province_2" name="province_2" class="province" style="width:100%!important"></select>
                  <input type="hidden" name="province_name_2" id="province_name_2" value="">
    						</div>
    						<div class="form-group city-form">
    							<select id="city_2" name="city_2" class="city"></select>
                  <input type="hidden" name="city_name_2" id="city_name_2" value="">
    						</div>
    						<div class="form-group district-form">
    							<select id="district_2" name="district_2" class="district"></select>
                  <input type="hidden" name="district_name_2" id="district_name_2" value="">
    						</div>
    						<div class="form-group kurir-form">
    							<select id="kurir_2" name="kurir_2" class="kurir"></select>
                  <input type="hidden" name="kurir_name_2" id="kurir_name_2" value="">
    						</div>
    						<div class="cost-form form-line" style="display:none">
    							<h3>Total Ongkir : <span id="cost-summary-2"></span> </h3>
    						</div>
    					</div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="transferBp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-line">
                    <input class="form-control" name="username_bp" id="username_bp" type="text">
                    <label class="form-label">Username</label>
                </div>
                <p id="username_danger" style="color:red"></p>
                <div class="username_confirm">

                </div>
                <br>
                <div class="form-line">
                    <input class="form-control" name="nominal_bp" id="nominal_bp" type="number" min="1">
                    <label class="form-label">Nominal (Bitrex Points)</label>
                </div>
                <p id="nominal_bp_danger" style="color:red"></p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                <a href="#" class="btn btn-md btn-info sendBp" data-toggle="modal" data-target="#confirmationTf" id="success-button">Transfer</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmationTf" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-line">
                    <input class="form-control" name="password_bp" id="password_bp" type="password">
                    <label class="form-label">Password</label>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                <button type="button" class="btn btn-primary sendBpConfirmation" style="cursor:pointer">Transfer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="convert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="topup">Convert Bitrex Points</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shipping-form">
                    <form action="{{Route('member.convert-bitrex-points')}}" method="post">
                        @csrf
                        <input type="hidden" name="bitrex-val" id="bitrex-val">
                        <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-line">
                                <input class="form-control" name="points-convert" id="points-convert" type="number" min="1">
                                <label class="form-label">Points</label>
                            </div>
                        </div>
                        <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-line">
                                <input class="form-control" name="nominal-convert" id="nominal-convert" type="text" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                            <a href="#" id="convert-load" style="display:none" class="btn btn-primary"></a>
                            <button type="submit" id="convert-bp" disabled=true class="btn btn-primary" style="cursor:pointer">Convert
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="content ecommerce-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h2>Bitrex Points History
                    <small class="text-muted">Bitrexgo</small>
                </h2>
            </div>
        </div>
    </div>
    <div class="block-header">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="body">
                    <a href="#" class="btn btn-md btn-info topup" id="success-button">Success</a>
                    <a href="#" class="btn btn-md cek-ongkir" id="failed-button">Failed</a>
                </div>
                <br> <br>
                <div>
                    <hr>
                </div>
                <div class="body">
                    <a href="#" class="btn btn-md btn-info" data-toggle="modal" data-target="#transferBp" id="success-button">Transfer Bitrex Points</a>
                </div>
                <br> <br>
                <div>
                    <hr>
                </div>
                <div class="body">
                    <a href="#" class="btn btn-primary btn-md topup" data-toggle="modal" data-target="#topup">Topup</a>
                    <a href="#" class="btn btn-primary btn-md cek-ongkir" data-toggle="modal" data-target="#cekongkir">Cek Ongkir</a>
                    {{--<a href="#" class="btn btn-primary btn-md convert" data-toggle="modal" data-target="#convert">Convert to BV</a>--}}
                    <h5 class="d-flex flex-row-reverse">Bitrex Points: {{number_format($profile->bitrex_points,0,".",".")}}</h5>
                </div>
                <br> <br>
                <div>
                    <hr>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12" id="bill">

            </div>
        </div>
    </div>
    <div class="ajax-load text-center" style="display:none">
        <p>Loading...</p>
    </div>
</section>
@stop

<style>
    @media only screen and (max-width: 1200px) {
        .topup{
            margin-bottom: 5px !important;
            margin-right: 150px !important;
            width: 136px;
        }

        .cek-ongkir{
            margin-bottom: 5px !important;
            margin-right: 300px !important;
            width: 136px;
        }

        .convert{
            margin-bottom: -20px !important;
            width: 136px;
        }
    }
    @media only screen and (min-width: 1200px) {
        .topup{
            margin-bottom: -20px !important;
            margin-right: 3px !important;
            width: 136px;
        }

        .cek-ongkir{
            margin-bottom: -20px !important;
            margin-right: 3px !important;
            width: 136px;
        }

        .convert{
            margin-bottom: -20px !important;
            margin-right: 3px !important;
            width: 136px;
        }
    }
</style>

@section('footer_scripts')
<script type="text/javascript" src="https://js.xendit.co/v1/xendit.min.js"></script>
<script type="text/javascript">
     Xendit.setPublishableKey('xnd_public_production_PgadVNAF3uQzWLxeK0T7GpjDo4M9hJus8cdXeLX1mfK9f8w5UUTzY301ldVoT0r3');
</script>
<script src="{{asset('assets2/js/moment.js')}}"></script>
<script src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<script type="text/javascript">

    function check_button_disabled() {
        if(!$('#pickup_quarter').prop("checked")) {
            if(parseInt($('#cost_summary_value').val()) == 0) {
                $("#topup-points").prop('disabled',true);
            } else {
                $("#topup-points").prop('disabled',false);
            }
        } else {
            if ($('#nominal').val() % 1000 == 0 && $('#nominal').val() >= 10000) {
                $("#topup-points").prop('disabled',false);
            } else {
                $("#topup-points").prop('disabled',true);
            }
        }
    }

    $('#success-button').click(function(){
        $('#success-button').prop('class', "btn btn-md btn-info topup");
        $('#failed-button').prop('class', "btn btn-md topup");
        bitrexPoint();
    })

    var cekValidateUsername = false;
    var cekValidateBP = false;

    $('#nominal_bp').keyup(function(){
        cekBP(this.value);
    });

    function cekTermSendBP(){
        cekValidateBP && cekValidateUsername ?  $('.sendBp').prop('disabled', false): $('.sendBp').prop('disabled', true);
    }

    $('.sendBp').click(function(){
        $("#transferBp").hide();
    });

    $('.sendBpConfirmation').click(function(){
        $.ajax({
			type: 'POST',
			url: '/member/sendBp/store',
            data:
            {
                "_token": "{{ csrf_token() }}",
                username : $('#username_bp').val(),
                bitrex_points : $('#nominal_bp').val(),
                password : $('#password_bp').val()
            },
			success: function (data) {
                console.log(data);
                if (data.success == 1) {
                    swal("Success", "Transfer Success!", "success");
                }else{
                    swal("Failed", data.message);
                }
                window.location.href = '/member/income-and-expenses/bitrex-points'
			},
			error: function() {
				console.log("Error");
			}
		});
    })

    function cekBP(bp){
        let totalBP = '{{Auth::user()->bitrex_points}}';
        if (parseInt(bp) > parseInt(totalBP)) {
            $('#nominal_bp_danger').text('your balance is less');
        }else if (bp == '') {
            $('#nominal_bp_danger').text('Bitrex Point is required');
        }else{
            $('#nominal_bp_danger').empty();
        }
        if (parseInt(bp) <= parseInt(totalBP) && bp != '') {
            cekValidateBP = true;
        }else{
            cekValidateBP = false;
        }
        cekTermSendBP();
    }

    function cekUsername(username){
        let myUsername = '{{Auth::user()->username}}';
        let cek = /^[a-zA-Z0-9_]*$/.test(username);
		username = !cek ? username.match(/[a-zA-Z0-9_]/g).join('') : username;
		var text = username;
		$.ajax({
			type: 'GET',
			url: '/member/select/username/'+text,
			success: function (data) {
                if (!data.username) {
                    $('#username_danger').text('username you entered doesn\'t exists')
                    $(".username_confirm").html('');
                }else if(username == myUsername){
				    $('#username_danger').text('can not transfer bp to your self')
                    $(".username_confirm").html('');
                }else{
                    $.ajax({
                        url: '/member/select/user/'+text,
                        success:function(data){
                            $(".username_confirm").html('<div class="form-control fullname_user">Fullname : '+data.first_name+' '+data.last_name+'</div><div class="form-control id_user">User ID : '+data.id_member+'</div>');
                        }
                    });
                    $('#username_danger').empty();
                }
				cekValidateUsername = !data.username || username == myUsername ? false  : true;
			},
			error: function() {
				console.log("Error");
			}
		});
        cekTermSendBP();
    }

    $('#username_bp').keyup(function(){
		let username = this.value;
        cekUsername(username);
	})

    $('#failed-button').click(function(){
        $('#failed-button').prop('class', "btn btn-md btn-info topup");
        $('#success-button').prop('class', "btn btn-md topup");
        topupPoint();
    })
    $(document).ready(function () {
    $('input[type=number]').on('wheel',function(e){ $(this).blur(); });
    <?php if(getCurrentPaymentMethod() == 'va'):?>
        let is_bca_method = true;
    <?php else:?>
        let is_bca_method = false;
    <?php endif;?>

    if($('input[name ="method"]').val() != 'bca'){
        is_bca_method = false;
    }

      $("#province").select2({
        placeholder: "Province",
        width: '100%'
      });

      $("#province_2").select2({
        placeholder: "Province",
        width: '100%'
      });

      $('#copy').click(function(){
            var copyText = document.getElementById("va");
            var selection = document.getSelection();
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            try {
                var success = document.execCommand('copy')
            } catch (error) {
                console.log(error)
            }
      })

      $('#transfer').change(function(){
          $('#topup-points').prop('type','submit');
          $('#bca').removeAttr("checked")
          $('#bca').prop('checked', false)
          $('#transfer').prop('checked', true)
          is_bca_method = false;
      })

      $('#cc').change(function(){
          $('#topup-points').prop('type','submit');
          $('#bca').removeAttr("checked")
          $('#bca').prop('checked', false)
          $('#cc').prop('checked', true)
          $('.cvn-form').css('display', "block")
          $('.cc-form').css('display', "block")
          $('.exp-month-form').css('display', "block")
          $('.exp-year-form').css('display', "block")
          is_bca_method = false;
      })

      $('#other').change(function(){
        is_bca_method = false;
      })

      $('#ipay').change(function(){
          $('#topup-points').prop('type','submit');
          is_bca_method = false;
      })

      $('#bca').change(function(){
          $('#topup-points').prop('type','button');
          $('#transfer').removeAttr("checked")
          $('#bca').prop('checked', true)
          $('#transfer').prop('checked', false)
          $('.cvn-form').css('display', "none")
          $('.cc-form').css('display', "none")
          $('.exp-month-form').css('display', "none")
          $('.exp-year-form').css('display', "none")
          is_bca_method = true;
      })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

      $('#topup-points').click(function(){
          let nominal = $('#nominal').val();
          let cvn = $('#cvn').val();
          let points = $('#points').val();

          if(is_bca_method){
            var $this = $(this);
            var loadingText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
            if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.hide();
                $('#payment-bca').html(loadingText);
                $('#payment-bca').show();
            }
            setTimeout(function() {
                $this.html($this.data('original-text'));
                $('#payment-bca').hide();
                $this.show();
            }, 100000);

            $.ajax({
                type: 'POST',
                url: '{{route("member.bp.store")}}',
                data: {nominal: nominal, points: points},
                success: function (data) {
                    if(!data.status) {
                        $('#payment-bca').hide();
                        alert('Minimum topup is : 10.000 and multiple : 1.000');
                        $("#topup-points").show()
                        $("#topup-points").prop('disabled',true);
                        return;
                    }

                    $('#va').val(data.customer_number);
                    $('#des_noreq').text('Masukkan '+data.customer_number+' sebagai rekening tujuan');
                    $('#des_noreq2').text('Masukkan '+data.customer_number+' sebagai rekening tujuan');
                    $('#des_noreq3').text('Masukkan '+data.customer_number+' sebagai rekening tujuan');
                    $('#time-expired').text('Transfer Sebelum '+moment(data.time_expired).format('D MMMM Y - HH:mm'));
                    $('#nominal_plus_fee').text('Nominal Transfer '+addCommas(data.total_amount)+' (include fee)')
                    $('#no-virtual').modal('show');
                    $('#topup').modal('hide');
                },
                error: function() {
                    console.log("Error");
                }
            });
          }else{

            let charge = parseInt(nominal * (3.5 / 100) + 2000);
            let ppn = parseInt(charge * 0.1);
            let total = parseInt(nominal) + parseInt(charge) + parseInt(ppn);
            var nf = new Intl.NumberFormat();

            swal({
                title: "Bitrex Point : IDR "+nf.format(nominal)+"\nAdmin Fee + TAX : IDR "+nf.format(charge + ppn)+"\n__________________________\nGrand total : IDR "+ nf.format(total),
                type: "warning",
                confirmButtonClass: "btn-warning",
                confirmButtonText: "Yes!",
                showCancelButton: true,
            },function(){

                $("#topup-points").prop('disabled',true);
                $.ajax({
                    type: 'POST',
                    url: '{{route("xendit-payment")}}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        nominal: nominal,
                        tax: charge + ppn
                    },
                    success: function (data) {
                        window.location.replace(data.invoice_url);
                    }
                });
            })

            // $.post("{{ route('member.payment.midtrans') }}",
            // {
            //     _method: 'POST',
            //     _token: '{{ csrf_token() }}',
            //     amount: nominal,
            // },
            // function (data, status) {
            //     snap.pay(data.snap_token, {
            //         // Optional
            //         onSuccess: function (result) {
            //             location.reload();
            //         },
            //         // Optional
            //         onPending: function (result) {
            //             location.reload();
            //         },
            //         // Optional
            //         onError: function (result) {
            //             location.reload();
            //         }
            //     });
            // });
            // return false;
          }
      })

      $('#convert-bp').click(function(){
        var $this = $(this);
        var loadingText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
        if ($(this).html() !== loadingText) {
            $this.data('original-text', $(this).html());
            $this.hide();
            $('#convert-load').html(loadingText);
            $('#convert-load').show();
        }
        setTimeout(function() {
            $this.html($this.data('original-text'));
            $('#convert-load').hide();
            $this.show();
        }, 2000);
      })

      $('#cost_summary_value').val(0)
      $('#province').html('<option disabled>Province<option>');
      $('#province_2').html('<option disabled>Province<option>');
  		$.ajax({
  			type: 'GET',
  			url: '/member/shipping/province',
  			success: function (data) {
  				$('#province').select2({
  					placeholder: 'Province',
  					data: data,
                    width: '100%'
  				});
                $('#cost_summary_value').val(0)
  			},
  			error: function() {
  				console.log("masuk province");
  			}
  		});
          $.ajax({
  			type: 'GET',
  			url: '/member/shipping/province',
  			success: function (data) {
  				$('#province_2').select2({
  					placeholder: 'Province',
  					data: data,
                    width: '100%'
  				});
  			},
  			error: function() {
  				console.log("masuk province");
  			}
  		});
      $('.dropdown-toggle').remove();
      $('div').removeClass('btn-group');
      $('.div').removeClass('bootstrap-select');

      $("#city").select2({
        placeholder: "City",
        width: '100%'
      });
      $("#district").select2({
        placeholder: "Kecamatan",
        width: '100%'
      });
      $("#kurir").select2({
        placeholder: "Kurir",
        width: '100%'
      });

      $("#city_2").select2({
        placeholder: "City",
        width: '100%'
      });
      $("#district_2").select2({
        placeholder: "Kecamatan",
        width: '100%'
      });
      $("#kurir_2").select2({
        placeholder: "Kurir",
        width: '100%'
      });

      $('#province').change(function(){
    		let id = $(this).val();
        $('#province_name').val($(this).find(":checked").text())
    		$('#city').empty().trigger('change');
    		$('#district').empty().trigger('change');
    		$('#kurir').empty().trigger('change');
    		$('#city').html('<option disabled>City<option>');
    		$.ajax({
    			type: 'GET',
    			url: '/member/shipping/city/'+id,
    			success: function (data) {
    				$('#city').select2({
    					placeholder: 'City',
    					data: data,
              width: '100%'
    				});
    			},
    			error: function() {
    				console.log("Error");
    			}
    		});
    	})


        $('#province_2').change(function(){
    		let id = $(this).val();
        $('#province_name_2').val($(this).find(":checked").text())
    		$('#city_2').empty().trigger('change');
    		$('#district_2').empty().trigger('change');
    		$('#kurir_2').empty().trigger('change');
    		$('#city_2').html('<option disabled>City<option>');
    		$.ajax({
    			type: 'GET',
    			url: '/member/shipping/city/'+id,
    			success: function (data) {
    				$('#city_2').select2({
    					placeholder: 'City',
    					data: data,
              width: '100%'
    				});
    			},
    			error: function() {
    				console.log("Error");
    			}
    		});
    	})

      $('#city').change(function(){
    		let id = this.value;
        $('#city_name').val($(this).find(":checked").text())
    		$('#district').empty().trigger('change');
    		$('#kurir').empty().trigger('change');
    		$('#district').html('<option disabled>Kecamatan<option>');
    		$.ajax({
    			type: 'GET',
    			url: '/member/shipping/subdistrict/'+id,
    			success: function (data) {
    				$('#district').select2({
    					placeholder: 'Kecamatan',
    					data: data,
              width: '100%'
    				});
    			},
    			error: function() {
    				console.log("Error");
    			}
    		});
    	})

        $('#city_2').change(function(){
    		let id = this.value;
        $('#city_name_2').val($(this).find(":checked").text())
    		$('#district_2').empty().trigger('change');
    		$('#kurir_2').empty().trigger('change');
    		$('#district_2').html('<option disabled>Kecamatan<option>');
    		$.ajax({
    			type: 'GET',
    			url: '/member/shipping/subdistrict/'+id,
    			success: function (data) {
    				$('#district_2').select2({
    					placeholder: 'Kecamatan',
    					data: data,
              width: '100%'
    				});
    			},
    			error: function() {
    				console.log("Error");
    			}
    		});
    	})

    	$('#district').change(function() {
    		let id = this.value;
    		$('#kurir').empty().trigger('change');
            $('#district_name').val($(this).find(":checked").text())
    		$('#kurir').html('<option disabled>Kurir<option>');
    		$.ajax({
    			type: 'GET',
    			url: '/member/shipping/cost/'+id,
    			success: function (data) {
    				$('#kurir').select2({
    					placeholder: 'Kurir',
    					data: data,
              width: '100%'
    				});
    			},
    			error: function() {
    				console.log("Error");
    			}
    		});
    	});

        $('#district_2').change(function() {
    		let id = this.value;
    		$('#kurir_2').empty().trigger('change');
            $('#district_name_2').val($(this).find(":checked").text())
    		$('#kurir_2').html('<option disabled>Kurir<option>');
    		$.ajax({
    			type: 'GET',
    			url: '/member/shipping/cost/'+id,
    			success: function (data) {
    				$('#kurir_2').select2({
    					placeholder: 'Kurir',
    					data: data,
              width: '100%'
    				});
    			},
    			error: function() {
    				console.log("Error");
    			}
    		});
    	});

    	$('#kurir').change(function(){
        if($(this).val() != null) {
          $('.cost-form').show();
          $('#cost-summary').html(`
            ${$(this).val()} = ${parseInt($(this).val()) / 1000} Points
          `)
          $('#nominal').val(
              parseInt($('#nominal').val()) + parseInt($(this).val())
          )
          $('#points').val(
              parseInt($('#points').val()) + parseInt($(this).val() / 1000)
          )

          $('#cost_summary_value').val(parseInt($(this).val()) / 1000)
          check_button_disabled()
        } else {
          $('.cost-form').hide();
        }
    	});

        $('#kurir_2').change(function(){
        if($(this).val() != null) {
          $('.cost-form').show();
          $('#cost-summary-2').html(`
            ${$(this).val()} = ${parseInt($(this).val()) / 1000} Points
          `)
        } else {
          $('.cost-form').hide();
        }
    	});

        $('#pickup_quarter').change(function() {
            if($(this).prop("checked")) {
                $('#pickup_form').hide()

                if($("#kurir").val() != null) {
                    $('#nominal').val(
                        parseInt($('#nominal').val()) - (parseInt($('#cost_summary_value').val()) * 1000)
                    )
                    $('#points').val(
                        parseInt($('#points').val()) - parseInt( $('#cost_summary_value').val())
                    )
                }

                $("#province").empty()
                $("#city").empty()
                $("#district").empty()
                $("#kurir").empty()
            } else {
                $('#pickup_form').show()
                $.ajax({
                    type: 'GET',
                    url: '/member/shipping/province',
                    success: function (data) {
                        $('#province').select2({
                            placeholder: 'Province',
                            data: data,
                            width: '100%'
                        });
                        $('#cost_summary_value').val(0)
                    },
                    error: function() {
                        console.log("masuk province");
                    }
                });
            }

            check_button_disabled()
        })
        bitrexPoint();
    });

    var page = 1;
    var isBp = 0;
    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            isBp==1 ? loadMoreData(page) : loadMoreData2(page) ;
        }
    });

    let topupPoint = () => {
        $('#bill div').remove();
        $.ajax({
            url: '{{route("member.select.history-topup")}}',
            data: data,
            success:function(data){
                if (data.data[0]==undefined) {
                    $('#bill').html('<div class="body" style="color:red;"><center><strong>History is currently empty</strong></center></div>');
                }else{
                    $.each(data.data, function(i, item) {
                        date = moment(item.created_at).format('MMMM Do Y - HH:mm');
                        type = item.product_type;
                        color = 'green';
                        nominal = addCommas(item.total_amount);
                        $('#bill').append('<div class="card ke-'+i+'" style="border: 1px solid #ccc; box-shadow: 1px 1px 3px 0px  rgba(0,0,0,0.3);"><div class="body"><div class="row"><strong class="col-sm-4" id="date">Date Time: '+date+'</strong></div><hr><div class="row"><div class="col" id="type">Type: <b style="color:'+color+'">'+type+'</b></div><div class="col" id="nominal">Nominal: '+nominal+'</div><hr></div><div class="row"></div></div></div>');
                    });
                }
                isBp = 0;
            }
        });
    }

    let bitrexPoint = () => {
        $('#bill div').remove();
        $.ajax({
            url: '{{route("member.select.history-points")}}',
            data: data,
            success:function(data){
                if (data.points.data[0]==undefined) {
                    $('#bill').html('<div class="body" style="color:red;"><center><strong>History is currently empty</strong></center></div>');
                }else{
                    $.each(data.points.data, function(i, item) {
                        date = moment(item.created_at).format('MMMM Do Y - HH:mm');
                        type = item.info ? 'Income' : 'Spending';
                        color = item.info ? 'green' : 'red';
                        nominal = addCommas(item.nominal);
                        points = addCommas(item.points);
                        $('#bill').append('<div class="card ke-'+i+'" style="border: 1px solid #ccc; box-shadow: 1px 1px 3px 0px  rgba(0,0,0,0.3);"><div class="body"><div class="row"><strong class="col-sm-4" id="date">Date Time: '+date+'</strong></div><hr><div class="row"><div class="col" id="type">Type: <b style="color:'+color+'">'+type+'</b></div><div class="col" id="nominal">Nominal: '+nominal+'</div><hr></div><div class="row"><div class="col" id="description">Description: '+item.description+'</div><div class="col" id="points">Points: '+points+'</div></div></div></div>');
                    });
                }
                isBp = 1;
            }
        });
    }

    function loadMoreData2(page){
        $.ajax({
            url: '/member/select/history-topup?page=' + page,
            beforeSend: function(){
                $('.ajax-load').show();
            }
        }).done(function(data){
            if(data.points.data[0]==undefined){
                $('.ajax-load').html("No more records found");
                return;
            }
            $('.ajax-load').hide();$.each(data.data, function(i, item) {
                date = moment(item.created_at).format('MMMM Do Y - HH:mm');
                type = item.product_type;
                color = 'green';
                nominal = addCommas(item.total_amount);
                $('#bill').append('<div class="card ke-'+i+'" style="border: 1px solid #ccc; box-shadow: 1px 1px 3px 0px  rgba(0,0,0,0.3);"><div class="body"><div class="row"><strong class="col-sm-4" id="date">Date Time: '+date+'</strong></div><hr><div class="row"><div class="col" id="type">Type: <b style="color:'+color+'">'+type+'</b></div><div class="col" id="nominal">Nominal: '+nominal+'</div><hr></div><div class="row"></div></div></div>');
            });
        })
        .fail(function(jqXHR, ajaxOptions, thrownError){
            $('.ajax-load').html("Server not responding");
            return;
        });
    }

    function loadMoreData(page){
        $.ajax({
            url: '/member/select/history-points?page=' + page,
            beforeSend: function(){
                $('.ajax-load').show();
            }
        }).done(function(data){
            if(data.points.data[0]==undefined){
                $('.ajax-load').html("No more records found");
                return;
            }
            $('.ajax-load').hide();
            $.each(data.points.data, function(i, item) {
                date = moment(item.created_at).format('MMMM Do Y - HH:mm');
                type = item.info ? 'Income' : 'Spending';
                color = item.info ? 'green' : 'red';
                nominal = addCommas(item.nominal);
                points = addCommas(item.points);
                $('#bill').append('<div class="card ke-'+i+'" style="border: 1px solid #ccc; box-shadow: 1px 1px 3px 0px  rgba(0,0,0,0.3);"><div class="body"><div class="row"><strong class="col-sm-4" id="date">Date Time: '+date+'</strong></div><hr><div class="row"><div class="col" id="type">Type: <b style="color:'+color+'">'+type+'</b></div><div class="col" id="nominal">Nominal: '+nominal+'</div><hr></div><div class="row"><div class="col" id="description">Description: '+item.description+'</div><div class="col" id="points">Points: '+points+'</div></div></div></div>');
            });
        })
        .fail(function(jqXHR, ajaxOptions, thrownError){
            $('.ajax-load').html("Server not responding");
            return;
        });
    }

    $('#nominal').keyup(function(){
        var points = $('#nominal').val() / 1000;
        $('#points').val(points);
        if ($('#nominal').val() % 1000 == 0 && $('#nominal').val() >= 10000) {
            $("#topup-points").prop('disabled',false);
        }else{
            $("#topup-points").prop('disabled',true);

        }

        check_button_disabled()
    })

    // $('#points-convert').keyup(function(){
    //     $('#convert-bp').prop('disabled', false);
    //     let bp = {!!$profile->bitrex_points!!};
    //     var points = 'IDR ' + addCommas(this.value * 1000);
    //     $('#nominal-convert').val(points);
    //     $('#bitrex-val').val(this.value*1000);
    //     var check = /^[0-9]+$/.test(this.value);
    //     if (bp >= this.value && check) {
    //         $('#convert-bp').prop('disabled', false);
    //     }else{
    //         $('#convert-bp').prop('disabled', true);
    //     }

    //     check_button_disabled()
    // })

    $('.demo-radio-button input').change(function() {
      $(this).val() == "transfer" ? $('#transfer-form').show() : $('#transfer-form').hide();
    })
</script>
@stop
