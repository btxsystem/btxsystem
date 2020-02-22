@extends('member-v2.layouts.main')
@section('title')
    Explore
    @parent
@stop

@section('styles')
<link rel="stylesheet" href="{{asset('assetsebook/v2/css/style.css')}}">
<style type="text/css">
.transparent {
	background-color: transparent!important;
	background: transparent!important;
}
div#flag {
	background-color: #333;
	padding: 6%;
	font-size: 11px !important;
	border-radius: 2px;
	-ms-transform: rotate(40deg);
	-webkit-transform: rotate(40deg);
	transform: rotate(40deg);
	width: 50%;
	text-align: center;
	position: absolute;
	right: -12%;
	height: 8%;
	z-index: 0;
	top: -5%;
	background-color:#D4AF37;
	z-index: 2;
}
#flag span {
	position: relative;
	left: 25%;
	top: 41%;;
}
.triangle{
	overflow: hidden;
	position: relative;
	box-shadow: 0 2px 3px rgba(0, 0, 0, 0.3);
}
h2.plan-title {
	text-align:center !important;
	margin-top: 5px !important;
}
div#flag {
	background-color: #333;
	padding: 10px;
	font-size: 16px !important;
	border-radius: 2px;
	-ms-transform: rotate(40deg);
	-webkit-transform: rotate(40deg);
	transform: rotate(40deg);
	width: 160px;
	text-align: center;
	position: absolute;
	right: -8%;
	height: 73px;
	z-index: 0;
	top: -30;
	background-color:#D4AF37;
}
#flag span {
	position: relative;
	left: 20px;
	top: 28px;
}
.triangle{
	overflow: hidden;
	position: relative;
}
.clockdiv{
	font-family: sans-serif;
	color: #fff;
	display: inline-block;
	font-weight: bold;
	text-align: center;
	font-size: 18px;
}

.clockdiv > div{
	padding: 6px;
	border-radius: 3px;
	background: #00BF96;
	display: inline-block;
}

.clockdiv div > span{
	padding: 8px;
	border-radius: 3px;
	background: #00816A;
	display: inline-block;
}

.smalltext{
	padding-top: 5px;
	font-size: 12px;
}
@media only screen and (min-width: 992px) {
	h2.plan-title {
		text-align:left !important;
	}
	div#flag {
		background-color: #333;
		padding: 10px;
		font-size: 16px !important;
		border-radius: 2px;
		-ms-transform: rotate(40deg);
		-webkit-transform: rotate(40deg);
		transform: rotate(40deg);
		width: 160px;
		text-align: center;
		position: absolute;
		right: -8%;
		height: 73px;
		z-index: 0;
		top: -30;
		background-color:#D4AF37;
	}
	#flag span {
		position: relative;
		left: 20px;
		top: 28px;
	}
	.triangle{
		overflow: hidden;
		position: relative;
	}
	.clockdiv{
		font-family: sans-serif;
		color: #fff;
		display: inline-block;
		font-weight: bold;
		text-align: center;
		font-size: 20px;
	}

	.clockdiv > div{
		padding: 10px;
		border-radius: 3px;
		background: #00BF96;
		display: inline-block;
	}

	.clockdiv div > span{
		padding: 15px;
		border-radius: 3px;
		background: #00816A;
		display: inline-block;
	}

	.smalltext{
		padding-top: 5px;
		font-size: 15px;
	}
}
</style>
@stop

@section('style_class')bg-1 @stop

@section('content')
	<div class="modal fade" id="no-virtual" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<a href="{{url('')}}">
						<img src="{{asset('img/bca.png')}}" alt="" srcset="" style="width:100px">
					</a>
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
							<button type="button" class="mt-3 btn btn-raised bg-grey waves-effect" style="cursor:pointer" id="copy">Copy</button>
						<br>
                    </center>
                    <br>
                    <center><p style="font-size:14px" id="ammount_bca"></p></center>
                    <br>
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

	@include('member-v2.partials.navbar-home')
	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="max-height: 455px; overflow: hidden;">
	  <div class="carousel-inner" style="background: #333;">
	    <div class="carousel-item active">
	      <img src="https://assets.regus.com/images/nwp/homepage-product-office-space.jpg" class="d-block w-100" style="opacity: 0.5">
	    </div>
	    <div class="carousel-item">
	      <img src="https://img-prod-cms-rt-microsoft-com.akamaized.net/cms/api/am/imageFileData/RE2uXZM?ver=a904&q=90&m=2&h=768&w=1024&b=%23FFFFFFFF&aim=true" class="d-block w-100" style="opacity: 0.5">
	    </div>
	    <div class="carousel-item">
	      <img src="https://www.it.unsw.edu.au/students/software/office365.jpeg" class="d-block w-100" style="opacity: 0.5">
	    </div>
	  </div>
	</div>

	<!-- <div class="my-5 bg-dark">

	</div> -->
	<div style="position:relative;margin-top:-80px;">
		<div class="container">
			<div class="row">
				<div class="col-md-2 mx-auto">
					<div class="mt-3">
					@if(Auth::guard('nonmember')->user() != null || Auth::guard('user')->user() != null)
						<a href="{{route('member.logout')}}" class="btn btn-identity-red btn-block">Logout</a>
					@else
						<button onclick="showModalLogin()" class="btn btn-identity-red btn-block text-white">Login</button>
					@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="pt-5 pb-5" style="background-color:#ffb320;">
		<div class="container pt-5">
			<div class="row">
				@foreach($ebooks as $ebook)
				<div class="col-lg-6 mb-3">
					<div class="row">
						@if(Auth::guard('nonmember')->user() || Auth::guard('user')->user())
						<div class="col-8 mx-auto">
							@if($expired_basic != null && $ebook->id == 1)
							<div id="clockdiv_basic" class="clockdiv mt-2">
								<div>
									<span class="days"></span>
									<div class="smalltext">Days</div>
								</div>
								<div>
									<span class="hours"></span>
									<div class="smalltext">Hours</div>
								</div>
								<div>
									<span class="minutes"></span>
									<div class="smalltext">Minutes</div>
								</div>
								<div>
									<span class="seconds"></span>
									<div class="smalltext">Seconds</div>
								</div>
							</div>
							@elseif($expired_advanced != null && $ebook->id == 2)
							<div id="clockdiv_advanced" class="clockdiv mt-2">
								<div>
									<span class="days"></span>
									<div class="smalltext">Days</div>
								</div>
								<div>
									<span class="hours"></span>
									<div class="smalltext">Hours</div>
								</div>
								<div>
									<span class="minutes"></span>
									<div class="smalltext">Minutes</div>
								</div>
								<div>
									<span class="seconds"></span>
									<div class="smalltext">Seconds</div>
								</div>
							</div>
							@else
							<div style="margin-top:115px">
							</div>
							@endif
						</div>
						@endif
					</div>
					<div class="shadow rounded p-3 border-hover bg-white triangle">
						@if($ebook->access)
						<!-- <div id="flag" aria-hidden="true">
							<span class="text-light">Renewal</span>
						</div> -->
						@endif
						<div class="row">
							<div class="col-lg-3 d-flex align-items-center">
								@if($ebook->id == 1 || $ebook->id == 3)
								<img src="{{asset($ebook->src)}}" class="mx-auto d-block img-fluid">
								@else
								<img src="{{asset($ebook->src)}}" class="mx-auto d-block img-fluid">
								@endif
							</div>
							<div class="col-lg-9">
								@php
								$title = explode("_", $ebook->title)
								@endphp
								<h2 class="plan-title mb-1 text-dark" style="color: #fb6e10;">
									@if($ebook->access)
										<span>{{ucwords(str_replace('_', ' ', $ebook->title))}}</span>
										<div class="clearfix"></div>
									@else
										<span>{{ucwords(str_replace('_', ' ', $ebook->title))}}</span>
									@endif
								</h2>
								@if($ebook->id == 1)
								<span class="text-dark">{!! $ebook->description !!}<!--Pada modul ini anda akan mempelajari trading dari dasar. Pertama anda akan mengerti istilah-istilah yang digunakan dalam dunia trading, anda akan mempelajari cara membaca grafik dan membuat analisa dasar sendiri.<br></span><br>-->
								@else
								<span class="text-dark">{!! $ebook->description !!}<!--Pada modul ini anda akan mempelajari dunia trading lanjutan. Bagaimana cara membaca pasar dengan penggabungan dua atau lebih analisa, diantaranya analisa secara fundamental dan teknikal, serta mempelajari secara mendalam indikator-indikator teknikal.</span><br>-->
								@endif
								@if($ebook->id == 3 || $ebook->id == 4)
									<form action="{{route('payment')}}" method="post">
										{{csrf_field()}}
										<input type="hidden" name="ebook" value="{{$ebook->id}}">
										<input type="text" name="transactionRef" value="">
										<button type="submit" class="btn btn-identity-red text-white btn-sm mt-3 px-5">BUY</button>
										<a href="{{route('member.ebook.detail', ['type' => strtolower($ebook->id == 3 ? 'basic' : 'advanced')])}}" class="btn btn-secondary text-white btn-sm mt-3 px-5">Detail</a>
									</form>
								@else
									<div>
										@if($ebook->id == 1 && $expired_basic != null || $ebook->id == 2 && $expired_advanced!= null)
										<form action="{{route('re.payment')}}" method="post">
											{{csrf_field()}}
											<input type="hidden" name="ebook" value="{{$ebook->id}}">
                      <input type="hidden" name="repeat" value="true">
											<!-- <button onclick="changeValueRepeat('{{json_encode($ebook)}}')" data-toggle="modal" data-target="#repeatModal" type="button" class="btn btn-identity-red text-white btn-sm mt-3 px-5">REPEAT ORDER</button> --->

											@if($ebook->id == 1)
												<button onclick="changeValueRepeat(JSON.stringify({'price': '{{$renewal_basic->price}}', 'price_markup': '{{$renewal_basic->price_markup}}', 'id': '{{$renewal_basic->id}}'}))" data-toggle="modal" data-target="#repeatModal" type="button" class="btn btn-identity-red text-white btn-sm mt-3 px-5">REPEAT ORDER</button>
											@elseif($ebook->id == 2)
												<button onclick="changeValueRepeat(JSON.stringify({'price': '{{$renewal_advanced->price}}', 'price_markup': '{{$renewal_advanced->price_markup}}', 'id': '{{$renewal_advanced->id}}'}))" data-toggle="modal" data-target="#repeatModal" type="button" class="btn btn-identity-red text-white btn-sm mt-3 px-5">REPEAT ORDER</button>
											@endif
											@if($ebook->id == 1 && $expired_basic != null || $ebook->id == 2 && $expired_advanced!= null)
												<a href="{{route('member.ebook.detail', ['type' => strtolower($ebook->title)])}}" class="btn btn-secondary text-white btn-sm mt-3 px-5">VIEW</a>
											@endif
										@else
                      @if($ebook->status == 6)
                        <!-- <form action="{{route('re.payment')}}" method="post">
                          {{csrf_field()}}
                          <input type="hidden" name="ebook" value="{{$ebook->id}}">
                          <button type="submit" class="btn btn-identity-red text-white btn-sm mt-3 px-5">BUY</button>
                        </form> -->
												<form action="">
													<a href="{{route('member.ebook.detail', ['type' => strtolower($ebook->title), 'username' => $username])}}" class="btn btn-identity-red btn-sm mt-3 px-5">BUY</a>
												</form>
                      @else
                      <form action="">
                        <a href="{{route('member.ebook.detail', ['type' => strtolower($ebook->title), 'username' => $username])}}" class="btn btn-identity-red btn-sm mt-3 px-5">BUY</a>
                      </form>
                      @endif
										@endif
									</div>
								@endif
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	<div class="bg-white p-4">
		<div class="container mt-5 mb-4">
			<div class="row">
				<div class="col-12">
					<h2 class="text-center">Our Facility</h2>
					<div class="row mt-5	">
						<div class="col-md-4">
							<img style="height:250;object-fit:cover" src="{{asset('img/facility/robot-expert-advisor.png')}}"  class="img-fluid" alt="">
							<h5 class="mt-2 text-left">Module</h5>
						</div>
						<div class="col-md-4">
							<img style="height:250;object-fit:cover" src="{{asset('img/facility/market-analysis.jpg')}}"  class="img-fluid" alt="">
							<h5 class="mt-2 text-left">Education Videos</h5>
						</div>
						<!-- <div class="col-md-3">
							<img src="https://www.ebook.bitrexgo.co.id/beta/img/preview-3.png"  class="img-fluid" alt="">
							<h5 class="mt-2 text-center">Online & Offline Class</h5>
						</div> -->
						<div class="col-md-4">
							<img style="height:250;object-fit:cover" src="{{asset('img/facility/trading-community.png')}}"  class="img-fluid" alt="">
							<h5 class="mt-2 text-left">Smart Financial Community</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('member-v2.partials.footer')
	<!-- Modal -->
	<!-- End Modal -->
	<!-- Modal -->
		<div class="modal fade" id="repeatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
				<div class="modal-content bg-1 text-white">
		      <div class="modal-body">
						<form id="repeatBtn" action="{{route('re.payment')}}" method="post">
							{{csrf_field()}}
							<input type="hidden" id="repeatEbook" name="ebook">
							<input type="hidden" id="repeatPaymentMethod" name="payment_method">
							<input type="hidden" name="repeat" value="true">
							<div class="form-group">
								<!-- <div class="form-check form-check-inline">
									<input onclick="selectPayment('transfer')" class="form-check-input transfer" type="radio" name="payment_method" id="payment_method" value="transfer" checked>
									<label class="form-check-label" for="inlineRadio1">Transfer</label>
								</div> -->
								<!-- <div class="form-check form-check-inline">
									<input onclick="selectPayment('ipay')" class="form-check-input ipay" type="radio" name="payment_method" id="payment_method" value="ipay" checked>
									<label class="form-check-label" for="inlineRadio1">VA & OVO</label>
								</div> -->
								<div class="form-check form-check-inline">
									<input onclick="selectPayment('va')" class="form-check-input va-submit" type="radio" name="payment_method" id="payment_method" value="va">
									<label class="form-check-label" for="inlineRadio1">BCA VA</label>
								</div>
							</div>
							<h4>Total yang dibayar : IDR </span><b><span id="total_price"></h4></b>
						</div>
						<div class="modal-footer justify-content-center">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-identity-red" onclick="submit()" id="register">Submit</button>
							<button type="button" class="btn btn-identity-red" id="buy-va">Submit</button>
							<a href="#" id="payment-bca" style="cursor:pointer; display:none;" class="btn btn-identity-red"></a>
						</div>
						</form>
		      </div>
		    </div>
		  </div>
		</div>
	<!-- End Modal -->
	<div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content text-white">
		      <div class="modal-body">
						<h4 class="card-title text-dark">Login Untuk Melanjutkan</h4>
						<form method="post" class="my-login-validation" novalidate="" action="{{route('member.login.post')}}">
						@csrf
								<div class="form-group">
									<label for="email" class="text-dark">Username</label>
									<label class="sr-only" for="inlineFormInputGroup"></label>
									<div class="input-group mb-2">
											<div class="input-group-prepend">
												<div class="input-group-text"><img src="{{asset('assetsebook/assets/img/email.png')}}"></div>
											</div>
											<input type="text" class="form-control" name="username" placeholder="Masukan username anda">
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="text-dark">Password</label>
									<label class="sr-only" for="inlineFormInputGroup"></label>
									<div class="input-group mb-2">
											<div class="input-group-prepend">
												<div class="input-group-text"><img src="{{asset('assetsebook/assets/img/password.png')}}"></div>
											</div>
											<input type="password" class="form-control" name="password" placeholder="Masukan password anda">
									</div>
									<a href="#" class="float-right linkgray mb30 fz13">Lupa Password?</a>
								</div>
								<div class="form-group">
									<button class="btn btn-md btn-block btn-identity-red text-white" style="border-radius: 30px;">
									Login
									</button>
								</div>

								<!-- <div class="mt-4 text-center colorgray">
									Belum punya akun? <a href="{{route('member.home')}}" class="linkgrayoutline">Daftar</a>
								</div> -->
						</form>
		      </div>
		    </div>
		  </div>
		</div>
	<!-- End Modal -->
@stop
@section('footer_scripts')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="{{asset('assetsebook/js/helper.js')}}"></script>
<script src="https://momentjs.com/downloads/moment.min.js"></script>
<script>
<?php if(\Request::get('redirect') != ''){?>
showModalLogin();
<?php } ?>
function selectedSubscription(param = null) {
  $('#modal-subscription').modal('show')

  const data = JSON.parse(param)

  $('#total_price').html(toIDR(data.price))
}

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

$('.va-submit').change(function(){
	$('#register').hide();
	$('#buy-va').show();
});

$('.ipay').change(function(){
	$('#register').show();
	$('#buy-va').hide();
});

$('.transfer').change(function(){
	$('#register').show();
	$('#buy-va').hide();
});

$('#buy-va').click(function(){
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

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});

	$.ajax({
		type: 'POST',
		url: '{{route("member.buy-ebook")}}',
		data: {ebook_id: $('#repeatEbook').val()},
		success: function (data) {
			$('#va').val(data.customer_number);
			$('#des_noreq').text('Masukkan '+data.customer_number+' sebagai rekening tujuan');
			$('#des_noreq2').text('Masukkan '+data.customer_number+' sebagai rekening tujuan');
			$('#des_noreq3').text('Masukkan '+data.customer_number+' sebagai rekening tujuan');
            $('#ammount_bca').text('Nominal transaksi : '+data.total_amount+' (Include fee)');
            $('#time-expired').text('Transfer Sebelum '+moment(data.time_expired).format('D MMMM Y - HH:mm'));
			$('#no-virtual').modal('show');
			$('#repeatModal').modal('hide');
		},
		error: function() {
			console.log("Error");
		}
	});
})

function changeValueRepeat(param) {
	$('#register').show();
	$('#buy-va').hide();
	let data = JSON.parse(param)
	$('#repeatEbook').val(data.id)
	$('#repeatPaymentMethod').val('transfer')

	<?php if(Auth::guard('user')->user()){?>
		$('#total_price').html(toIDR(data.price))
	<?php } else {?>
		$('#total_price').html(toIDR(parseInt(data.price) + parseInt(data.price_markup)))
	<?php } ?>
	$('#ebook').val(data.id)
	$('#income').val(data.price_markup)
}

function selectPayment(data) {
	$('#repeatPaymentMethod').val(data)
}

function submit() {
	let required = [
		{
			field: 'firstName',
			message: 'First Name Required'
		},
		{
			field: 'referralCode',
			message: 'Referral Code Required'
		}
	]

	let errors = [];

	required.map(v => {
		if($(`#${v.field}`).val() == '') {
			alert(v.message)
			errors.push(v)
		}
	})

	if(errors.length > 0) {
		alert('Some field are required')
		return false;
	}

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
	$.ajax({
		url: "{{ route('member.register') }}",
		method: 'post',
		data: {
				referralCode: $('#referralCode').val(),
				lastName: $('#lastName').val(),
				firstName: $('#firstName').val(),
				email: $('#email').val(),
				phoneNumber: $('#phoneNumber').val()
		},
		success: function(result){
			const {message} = result

			if(!message) {
				alert('Failed Regiester')
				return false
			}

			alert('Success register')
		},
		error: function(err) {
			console.log(err)
			alert('Failed Register')
		}});
}

function showModalLogin() {
	$('#modal-login').modal('show')
}

function getTimeRemaining(endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor((t / 1000) % 60);
  var minutes = Math.floor((t / 1000 / 60) % 60);
  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
  var days = Math.floor(t / (1000 * 60 * 60 * 24));
  return {
    'total': t,
    'days': days,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
}

function initializeClock(id, endtime) {
  var clock = document.getElementById(id);
  var daysSpan = clock.querySelector('.days');
  var hoursSpan = clock.querySelector('.hours');
  var minutesSpan = clock.querySelector('.minutes');
  var secondsSpan = clock.querySelector('.seconds');

  function updateClock() {
    var t = getTimeRemaining(endtime);

    daysSpan.innerHTML = t.days;
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

    if (t.total <= 0) {
      clearInterval(timeinterval);
    }
  }

  updateClock();
  var timeinterval = setInterval(updateClock, 1000);
}

<?php foreach($ebooks as $ebook){?>
	<?php if($expired_basic != null && $ebook->id == 1) {?>
		initializeClock('clockdiv_basic', '{{$expired_basic->expired_at}}');
	<?php } ?>
	<?php if($expired_advanced != null && $ebook->id == 2) {?>
		initializeClock('clockdiv_advanced', '{{$expired_advanced->expired_at}}');
	<?php } ?>
<?php } ?>
</script>
@stop
