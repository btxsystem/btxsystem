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
}
</style>
@stop

@section('style_class')bg-1 @stop

@section('content')
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
					<div class="shadow rounded p-3 border-hover bg-white triangle">
						@if($ebook->access)
						<div id="flag" aria-hidden="true">
							<span class="text-light">Renewal</span>
						</div>
						@endif
						<div class="row">
							<div class="col-lg-3 d-flex align-items-center">
								@if($ebook->id == 1 || $ebook->id == 3)
								<img src="{{asset('assetsebook/v2/img/basic-and-intermediate.jpeg')}}" class="mx-auto d-block img-fluid">
								@else
								<img src="{{asset('assetsebook/v2/img/advance.jpeg')}}" class="mx-auto d-block img-fluid">
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
								<span class="text-dark">Pada modul ini anda akan mempelajari trading dari dasar. Pertama anda akan mengerti istilah-istilah yang digunakan dalam dunia trading, anda akan mempelajari cara membaca grafik dan membuat analisa dasar sendiri.<br></span><br>
								@else
								<span class="text-dark">Pada modul ini anda akan mempelajari dunia trading lanjutan. Bagaimana cara membaca pasar dengan penggabungan dua atau lebih analisa, diantaranya analisa secara fundamental dan teknikal, serta mempelajari secara mendalam indikator-indikator teknikal.</span><br>
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
										@if($ebook->access)
										<form action="{{route('payment')}}" method="post">
											{{csrf_field()}}
											<input type="hidden" name="ebook" value="{{$ebook->id}}">
											<button type="submit" class="btn btn-identity-red text-white btn-sm mt-3 px-5">BUY</button>
											@if(!$ebook->expired)
												<a href="{{route('member.ebook.detail', ['type' => strtolower($ebook->title)])}}" class="btn btn-secondary text-white btn-sm mt-3 px-5">Detail</a>
											@endif
										</form>
										Berakhir dalam {{$ebook->countdown_days}}
										@else
										<form action="">
											<a href="{{route('member.ebook.detail', ['type' => strtolower($ebook->title), 'username' => $username])}}" class="btn btn-identity-red btn-sm mt-3 px-5">BUY</a>
										</form>
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
							<img src="https://www.ebook.bitrexgo.co.id/beta/img/preview-1.png"  class="img-fluid" alt="">
							<h5 class="mt-2 text-left">Module</h5>
						</div>
						<div class="col-md-4">
							<img src="https://www.ebook.bitrexgo.co.id/beta/img/preview-2.png"  class="img-fluid" alt="">
							<h5 class="mt-2 text-left">Education Videos</h5>
						</div>
						<!-- <div class="col-md-3">
							<img src="https://www.ebook.bitrexgo.co.id/beta/img/preview-3.png"  class="img-fluid" alt="">
							<h5 class="mt-2 text-center">Online & Offline Class</h5>
						</div> -->
						<div class="col-md-4">
							<img src="https://www.ebook.bitrexgo.co.id/beta/img/preview-4.png"  class="img-fluid" alt="">
							<h5 class="mt-2 text-left">Smart Financial Community</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('member-v2.partials.footer')
	<!-- Modal -->
	<div class="modal fade" id="modal-subscription" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content bg-1 text-white">
		      <div class="modal-body">
		      	<img src="{{asset('assetsebook/v2/img/logo-white.png')}}" class="img-fluid mb-3 mx-auto d-block" style="width: 130px;">
						@if($username == '')
					  <div class="form-group">
					    <label for="exampleInputEmail1">Refferal <small class="text-danger">*</small></label>
					    <input type="text" class="form-control" id="referralCode" aria-describedby="emailHelp" placeholder="Refferal" required>
					  </div>
						@else
						<div class="form-group">
					    <label for="exampleInputEmail1">Refferal <small class="text-danger">*</small></label>
					    <input type="text" class="form-control" id="referralCode" aria-describedby="emailHelp" placeholder="Refferal" readonly value="{{$username}}">
					  </div>
						@endif
					  <div class="form-group">
					    <label for="exampleInputPassword1">Firstname <small class="text-danger">*</small></label>
					    <input type="text" class="form-control" id="firstName" placeholder="Firstname" required>
					  </div>
						<div class="form-group">
					    <label for="exampleInputPassword1">Lastname <small class="text-danger">*</small></label>
					    <input type="text" class="form-control" id="lastName" placeholder="Lastname" required>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Email <small class="text-danger">*</small></label>
					    <input type="email" class="form-control" id="email" placeholder="Email" required>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Phone Number <small class="text-danger">*</small></label>
					    <input type="number" class="form-control" id="phoneNumber" placeholder="Phone number" required>
					  </div>
					  <span>Total yang dibayar : </span><b><span id="total_price"></span></b>
		      </div>
		      <div class="modal-footer justify-content-center">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" onclick="submit()">Submit</button>
		      </div>
		    </div>
		  </div>
		</div>
	<!-- End Modal -->
	<!-- Modal -->
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

<script>
<?php if(\Request::get('redirect') != ''){?>
showModalLogin();
<?php } ?>
function selectedSubscription(param = null) {
  $('#modal-subscription').modal('show')

  const data = JSON.parse(param)

  $('#total_price').html(toIDR(data.price))
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
			console.log(result)

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
</script>
@stop