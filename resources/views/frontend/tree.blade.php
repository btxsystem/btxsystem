@extends('frontend.default')
@section('title')
    Tree
    @parent
@stop

@section('content')
<div class="modal fade" id="register" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                <input type="text" hidden id="username_default" value="{{isset($profile->username_default) ? $profile->username_default : ''}}">
				<h5 class="modal-title" id="exampleModalLabel">Register</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- <div id="app">
					<fa-register-member-material-component/>
				</div> -->
				<form id="action-member" action="{{route('member.register-downline')}}" method="POST" class="formTree">
					@csrf
					<input type="hidden" name="parent" id="parent" value="">
					<input type="hidden" name="position" id="position" value="">
          			<div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="forms-line">
							<input class="form-control" disabled value="{{Auth::user()->username}}" type="text" min="3" required>
						</div>
					</div>
					<div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-line">
							<input class="form-control" value="{{ isset($profile['data']['username']) ? $profile['data']['username'] : ''  }}" name="username" id="username" min="8" type="text" required>
							<label class="form-label">Username <em>*</em></label>
						</div>
						<div>
							<b style="color:red" id="username_danger"></b>
						</div>
					</div>
					<div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
						<div class="form-line col">
							<input class="form-control" value="{{ isset($profile['data']['first_name']) ? $profile['data']['first_name'] : ''  }}" name="first_name" id="first_name" type="text" min="2" required>
							<label class="form-label">First Name <em>*</em></label>
						</div>
						<div class="form-line col">
							<input class="form-control" value="{{ isset($profile['data']['last_name']) ? $profile['data']['last_name'] : ''  }}" name="last_name" id="last_name" type="text" min="2" required>
							<label class="form-label">Last Name</label>
						</div>
					</div>
					<div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-line">
							<input class="form-control" value="{{ isset($profile['data']['email']) ? $profile['data']['email'] : ''  }}" name="email" id="email" type="email" min="5" required>
							<label class="form-label">Email <em>*</em></label>
						</div>
						<div>
							<b style="color:red" id="email_danger"></b>
						</div>
					</div>
					<div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-line">
							<input class="form-control" id="phone_number" value="{{ isset($profile['data']['phone_number']) ? $profile['data']['phone_number'] : ''  }}" name="phone_number" type="text" min="11" max='13' required>
							<label class="form-label">Phone Number <em>*</em></label>
						</div>
					</div>
					<div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-line">
							<input class="form-control" value="{{ isset($profile['data']['nik']) ? $profile['data']['nik'] : ''  }}" id="nik" name="nik" id="number_phone" type="text" min="1" required>
							<label class="form-label">NIK / Passport <em>*</em></label>
						</div>
					</div>
          			<div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-line">
							<input class="form-control" value="{{ isset($profile['data']['npwp_number']) ? $profile['data']['npwp_number'] : ''  }}" id="npwp_number" name="npwp_number" type="text" min="1">
							<label class="form-label">NPWP</label>
						</div>
					</div>
          			<div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-line">
							<input class="form-control" value="{{ isset($profile['data']['bank_account_name']) ? $profile['data']['bank_account_name'] : ''  }}" id="bank_account_name" name="bank_account_name" type="text" min="1" required>
							<label class="form-label">Account Name <em>*</em></label>
						</div>
					</div>
          			<div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-line">
							<input class="form-control" value="{{ isset($profile['data']['bank_account_number']) ? $profile['data']['bank_account_number'] : ''  }}" id="bank_account_number" name="bank_account_number" type="text" min="1" required>
							<label class="form-label">Account Number <em>*</em></label>
						</div>
					</div>
          			<div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form">
              				<label class="form-label">Bank Name <em>*</em></label>
							<select class="form-control" id="bank_name_select">
								<option value="BCA" selected>BCA</option>
								<option value="BRI">BRI</option>
								<option value="BNI">BNI</option>
								<option value="Mandiri">Mandiri</option>
								<option value="CIMB NIAGA">CIMB NIAGA</option>
								<option value="other">Other Bank</option>
							</select>
							<input type="hidden" id="selected_ebook" name="selected_ebook">
  							<input type="hidden" class="form-control" name="bank_name" id="bank_name" required>
						</div>
					</div>
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form">
							<label class="form-label">Birth Date <em>*</em></label>
						</div>
						<div class="form-line">
							<input type="date" value="{{ isset($profile['data']['birthdate']) ? $profile['data']['birthdate'] : ''  }}" id="birthdate" name="birthdate" class="form-control" placeholder="Birthdate" required>
						</div>
						<div style="color:red" id="birthdate_danger"></div>
					</div>
					<div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h5 class="card-inside-title">Gender <em>*</em></h5>
						<div class="demo-radio-button">
							<input name="gender" type="radio" value="1" id="male" class="with-gap radio-col-red" checked />
							<label for="male">Male</label>
							<input name="gender" type="radio" value="0" id="female" class="with-gap radio-col-red" />
							<label for="female">Female</label>
						</div>
					</div>
          			<div class="dropdown-divider"></div>
          			<!-- <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="demo-radio-button">
							<input name="pack" type="radio" value="1" id="pack" class="with-gap radio-col-red" checked />
							<label for="shipping">Starter Pack</label>
						</div>
					</div> -->
					<div class="dropdown-divider"></div>
					<div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h5 class="card-inside-title">Select ebook <em>*</em></h5>
						<div class="demo-radio-button">
							<!-- <input name="method" type="radio" value="1" id="shipping" class="with-gap radio-col-red" checked />
							<label for="shipping">Shipping</label> -->
              				<div id="ebook-list"></div>
						</div>
						<div class="buy_ebook"></div>
					</div>
          			<div class="dropdown-divider"></div>
					<!-- <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h5 class="card-inside-title">Choose a shipping method</h5>
						<div class="demo-radio-button">
              				<input name="shipping_method" type="radio" value="0" id="pickup" class="with-gap radio-col-red" checked/>
							<label for="pickup">Pickup</label>
							<input name="shipping_method" type="radio" value="1" id="shipping" class="with-gap radio-col-red" />
							<label for="shipping">Shipping</label>
						</div>
					</div> -->
					<!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pickup-form">
						<h4>B-G 168, Jl. Pluit Indah Raya, Pluit, Penjaringan, North Jakarta City, Jakarta 14450</h4>
					</div> -->
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shipping-form">
						<div class="form-group">
							<select id="province" name="province" class="province"></select>
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
            			<div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-line">
								<input class="form-control" name="address" id="address" type="text" min="3">
								<label class="form-label">Address</label>
							</div>
  						</div>
						<div class="form-group kurir-form">
							<select id="kurir" name="kurir" class="kurir"></select>
              				<input type="hidden" name="kurir_name" id="kurir_name" value="">
						</div>
						<div class="cost-form form-line" style="display:none">
							<input class="cost form-control" name="cost" id="cost" type="text">
							<input class="form-control" id="starter" type="text">
						</div>
					</div>
					<div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h5 class="card-inside-title">Payment Method <em>*</em></h5>
						<div class="demo-radio-button" id="payment_method">
            			</div>
          			</div>
					<div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group address-form">
						<div class="table-responsive">
                <table class="table table-borderless">
                  <!-- <tr>
                    <td> <h4>Starter Pack</h4> </td>
                    <td class="text-right"> <h4><span id="cost-starter">0</span></h4> </td>
                    <td> <h4>Points</h4> </td>
                  </tr> -->
                  <tr>
                    <td> <h4>Total Ebook</h4> </td>
                    <td class="text-right"> <h4><span id="cost-ebook">0</span></h4> </td>
                    <td> <h4>Points</h4> </td>
                  </tr>
                  <!-- <tr>
                    <td> <h4>Total Shipping</h4> </td>
                    <td class="text-right"> <h4><span id="cost-postal">0</span></h4> </td>
                    <td> <h4>Points</h4> </td>
				  </tr> -->
				  <tr id="total-discount-tr" class="hidden">
                    <td> <h4>Total Discount</h4> </td>
                    <td class="text-right"> <h4><span id="total-discount">0</span></h4> </td>
                    <td> <h4>Points</h4> </td>
                  </tr>
                  <tr>
                    <td> <h4>Grand Total</h4> </td>
                    <td class="text-right"> <h4><span id="grand-total">0</span></h4> </td>
                    <td> <h4>Points</h4> </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="term_one" name="term_one" value="1">
              <label class="form-check-label" for="term_one">
                Saya telah membaca dan menyetujui <a href="https://bitrexgo.co.id/assets/img/codethical.pdf" target="_blank">kode etik Bitrexgo</a>.
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="term_two" name="term_two" value="1">
              <label class="form-check-label" for="term_two">
                Saya menyatakan bahwa data yang saya isi sudah benar, dapat dipertanggung jawabkan, dan dapat digunakan untuk keperluan pembuatan ID Startpro Support System
              </label>
            </div>
					</div>
					<div class="modal-footer">
						<a class="btn btn-secondary" data-dismiss="modal" style="cursor:pointer">Close</a>
						<a href="#" id="register-load" style="display:none" class="btn btn-primary"></a>
						<input type="submit" class="btn btn-primary register" value="Register" style="cursor:pointer">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="warning" tabindex="-1" role="dialog" aria-labelledby="modal-warning" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-warning">Warning</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h5>You do not have enough points, please topup</h5>
			</div>
			<div class="modal-footer">
				<a class="btn btn-secondary" data-dismiss="modal">Close</a>
			</div>
		</div>
	</div>
</div>

<section class="content ecommerce-page">
	<div class="block-header">
		<div class="row">
			<div class="col-lg-12 col-md-6 col-sm-12">
				<h2 class="pull-left">Tree
				<small class="text-muted">Bitrexgo</small>
				</h2>
        <div class="pull-right mt-2">
          <button onclick="openAutoPlacement()" class="btn btn-primary btn-md" style="cursor:pointer" {{ session('expired') == true ? 'disabled' : '' }}>Add new Member with Auto-placement</button>
        </div>
			</div>
      <div class="clearfix">

      </div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12">
				<div class="card">
					<div class="container-fluid">
						<div>
							<div class="col-md-12">
								<br>
								<h4 style="color:red">"Untuk register orang dengan pemilihan tempat, silahkan gunakan dan klik tree di bawah"</h4>
								<h3>Detail Summary</h3>
								<hr>
								<div class="row col-md-12">
									<div class="col-md-4">
										<h5 id="_name"></h5>
									</div>
									<div class="col-md-4">
										<h5 id="_username"></h5>
									</div>
									<div class="col-md-4">
										<h5 id="_id_member"></h5>
									</div>
								</div>
								<div class="row col-md-12">
									<div class="col-md-4">
										<h5 id="_pv_pairing_l"></h5>
									</div>
									<div class="col-md-4">
										<h5 id="_pv_pairing_m"></h5>
									</div>
									<div class="col-md-4">
										<h5 id="_pv_pairing_r"></h5>
									</div>
								</div>
								<div class="row col-md-12">
									<div class="col-md-4">
										<h5 id="_pv_group_l"></h5>
									</div>
									<div class="col-md-4">
										<h5 id="_pv_group_m"></h5>
									</div>
									<div class="col-md-4">
										<h5 id="_pv_group_r"></h5>
									</div>
								</div>
								<hr>
								<div class="row col-md-12">
									<input type="text" class="search" placeholder="Search Username">&nbsp;&nbsp;<button type="button" class="btn btn-primary" id="search-downline">Search</button>
								</div>
								<hr>
							</div>
						</div>
					</div>
				</div>
				<span id="tree_button">

				</span>
				<div class="card">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<br>
								<div class="chart" id="tree">

								</div>
								<div id="overlay">
									<div class="cv-spinner">
										<span class="spinner"></span>
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
input, textarea, button {
    -webkit-appearance: none !important;
    -webkit-font-smoothing: antialiased;
    resize: none;
}
input[type="radio"]{
    -webkit-appearance: radio !important;
}
.svg-container {
  display: inline-block;
  position: relative;
  width: 100%;
  padding-bottom: 100%; /* aspect ratio */
  vertical-align: top;
  overflow: hidden;
}
.svg-content-responsive {
  display: inline-block;
  position: absolute;
  top: 10px;
  left: 0;
}

#upline{
	cursor: pointer;
}

svg .rect {
  fill: gold;
  stroke: steelblue;
  stroke-width: 5px;
}

@media only screen and (max-width: 370px) and (min-width: 360px){
/* For mobile phones: */
	svg{
		width: 305px !important;
	}
	span#clock {
    	font-size: 8px !important;
	}

	.search {
		font-size: 14px !important;
		width: 140px !important;
	}
}

@media only screen and (max-width: 500px) and (min-width: 480px) {
/* For mobile phones: */
	.search {
		font-size: 14px !important;
		width: 190px !important;
	}

	#clock{
		font-size: 14px !important;
	}

	svg{
		width: 430px !important;
	}
}



@media only screen and (max-width: 480px) {
/* For mobile phones: */
	.search {
		font-size: 14px !important;
		width: 190px !important;
	}
	rect {
		/* fill: #ebebeb;
		stroke: #ebebeb; */
		width: 150px;
		height: 190px;
		stroke-width: 2;
	}
	path {
		fill: none;
		stroke: #666;
	}
	text {
		dominant-baseline: middle;
		text-anchor: middle;
	}
  rect {
    cursor: pointer;
  }
	.bigger {
		font-size: 13px;
	}
	.link {
		text-decoration: none;
		background: red;
		padding: 20px;
	}
	.img-fluid {
		width: 60px;
		height: 60px;
		display: block;
		margin-right: auto;
		margin-left: auto;
		width: 160px !important;
	}
}

@media only screen and (max-width: 375px) and (min-width: 370px) {
	svg{
		width: 320px !important;
	}
}

@media only screen and (max-width: 800px) and (min-width: 760px) {
	svg{
		width: 710px !important;
	}
}


@media only screen and (max-width: 1080px) and (min-width: 800px) {
	svg{
		width: 940px !important;
	}
}

@media only screen and (max-width: 420px) and (min-width: 400px) {
	svg{
		width: 350px !important;
	}
}

@media only screen and (max-width: 320px) {
/* For mobile phones: */
	svg{
		width: 260px !important;
	}
}

#search-downline{
	cursor: pointer;
}

.search {
	font-size: 14px;
	width: width: 500px;width: 500px;
}
rect {
	/* fill: #ebebeb;
	stroke: #ebebeb; */
	width: 150px;
	height: 190px;
	stroke-width: 2;
}
path {
	fill: none;
	stroke: #666;
}
text {
	dominant-baseline: middle;
	text-anchor: middle;
}
rect {
	cursor: pointer;
}

image {
	cursor: pointer;
}

text {
	cursor: pointer;
}
.bigger {
	font-size: 13px;
}
.link {
	text-decoration: none;
	background: red;
	padding: 20px;
}

em{
	color: red;
}
.img-fluid {
	width: 60px;
	height: 60px;
	display: block;
	margin-right: auto;
	margin-left: auto;
}

.formTree .select2-container {
	width: 100% !important;
}

#overlay{
	position: fixed;
	top: 0;
	z-index: 100;
	width: 100%;
	height:100%;
	display: none;
	background: rgba(0,0,0,0.6);
}
.cv-spinner {
	height: 100%;
	display: flex;
	justify-content: center;
	align-items: center;
}
.spinner {
	width: 40px;
	height: 40px;
	border: 4px #ddd solid;
	border-top: 4px #2e93e6 solid;
	border-radius: 50%;
	animation: sp-anime 0.8s infinite linear;
}
@keyframes sp-anime {
	0% {
		transform: rotate(0deg);
	}
	100% {
		transform: rotate(359deg);
	}
}
.is-hide{
	display:none;
}

@media (pointer: coarse) {
	g{
		transform-origin: 0 0;
		transform: matrix(1.06, 1.84, 0.54, 2.8, 466px, 482px)
	}
}
</style>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/themes/base/jquery-ui.css">
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> -->

<script>
	var priceEbook = 0
	var postalFee = 0
	var grandTotal = 0;
	var bitrexPoint = '{{Auth::user()->bitrex_points}}'
	var adult = 0;
	var check = 1;
	var check_email = false;
	var check_user = false;
	// var check_nik = false;
	var available_email = false;
	var parent_id = undefined;
	var check_cost = true;
	const BASE_SRC = '{{url("/")}}';
	var is_va = false;

	$('#male').change(function(){
		checkTerm()
	})

	$('#female').change(function(){
		checkTerm()
	})

	$('#username').change(function(){
		checkTerm()
	})

	$('#first_name').change(function(){
		checkTerm()
	})

	$('#last_name').change(function(){
		checkTerm()
	})

	$('#email').change(function(){
		checkTerm()
	})

	$('#phone_number').change(function(){
		checkTerm()
	})

	$('#nik').change(function(){
		checkTerm()
	})

	$('#npwp_number').change(function(){
		checkTerm()
	})

	$('#bank_account_name').change(function(){
		checkTerm();
	})

	$('#bank_account_number').change(function(){
		checkTerm()
	})

	$('#birthdate').on('change', function() {
		var dob = new Date(this.value);
		var today = new Date();
		var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
		adult = age;
		if (age < 18) {
			$('#birthdate_danger').html('<p id="danger_">Age must be more than 17 years</p>');
		}else{
			$('#danger_').empty();
		}
		checkTerm()
	});

	$('#nik').keyup(function(){
		checkTerm()
	})

	$('#phone_number').keyup(function(){
		checkTerm()
	})

	$('#bank_account_name').keyup(function(){
		checkTerm()
	})

	$('#bank_name_select').change(function(){
		checkTerm()
	})

	$('#bank_account_number').keyup(function(){
		checkTerm()
	})

	$('#npwp_number').keyup(function(){
		checkTerm()
	})

	$('#first_name').keyup(function(){
		checkTerm()
	})

	$('#last_name').keyup(function(){
		checkTerm()
	})

	$('#va').change(function(){
		checkTerm();
		is_va = true;
	})

	$('#bp').change(function(){
		checkTerm();
		is_va = false;
	})

	function checkTerm() {
		if(is_va) {
			check_cost = true
		} else {
			check_cost = bitrexPoint < grandTotal ? false : true;
		}
		if(!$('#term_one').prop('checked') || !$('#term_two').prop('checked')) {
			$('.register').prop('disabled', true)
		} else {
		if(
			$('#username').val() != ''
			&& $('#email').val() != ''
			&& $('#phone_number').val() != ''
			&& $('#first_name').val() != ''
			&& $('#nik').val() != ''
			&& $('#birthdate').val() != ''
			&& adult >= 18
			&& check > 0
			&& check_email
			&& check_cost
			&& check_user
			// && check_nik
			&& available_email
		) {
			$('.register').prop('disabled', false)
		} else {
			$('.register').prop('disabled', true)
		}
		}
	}

	function openAutoPlacement() {
		$('#action-member').attr('action', '{{route("register-autoplacement")}}')
		$.ajax({
			type: 'GET',
			url: '/member/select/bitrex-points',
			success: function (data) {
				if (data.bitrex_points >= 280) {
					$('#register').modal('show');
				}else{
					$('#register').modal('hide');
					$('#warning').modal('show');
				}
			},
			error: function() {
				console.log("Error");
			}
		});
		$('#payment_method').html(`
				<input name="payment_method" type="radio" value="point" id="bp" class="with-gap radio-col-red" checked/>
				<label for="bp">Bitrex Points</label>
		`);
		$('#action-member').attr('action', '{{route("register-autoplacement")}}');
		$('#register').modal('show');

		$('#va').change(function(){
			is_va = true;
			check_cost = true;
			checkTerm();
		})

		$('#bp').change(function(){
			is_va = false;
			checkTerm();
		})
	}

	function openTree() {
		$('#payment_method').html(`
			<input name="payment_method" type="radio" value="point" id="bp" class="with-gap radio-col-red" checked/>
			<label for="bp">Bitrex Points</label>
		`);
		$('#action-member').attr('action', '{{route("member.register-downline")}}')
	}

	$('.register').click(function(){
		var $this = $(this);
        var loadingText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
        if ($(this).html() !== loadingText) {
            $this.data('original-text', $(this).html());
            $this.hide();
            $('#register-load').html(loadingText);
            $('#register-load').show();
        }
        setTimeout(function() {
            $this.html($this.data('original-text'));
            $('#register-load').hide();
            $this.show();
        }, 10000);
	})

	$(document).ready(function() {
		$('.register').prop('disabled', true)
		// $('#cost-starter').html('280')

		var element = document.querySelector('#bah');

    	checkTerm()

		$('#term_one').change(function() {
			checkTerm()
		})

		$('#term_two').change(function() {
			checkTerm()
		})

    	$('.shipping-form').hide();

		$('#province').select2({
			placeholder: 'Province',
		});
    	$.ajax({
			type: 'GET',
			url: '{{route("api.ebook.ebooks")}}'
		}).done(function(res) {
			const {data} = res
			let render = data.map((v, i) => {
                if (v.id != 7) {
                    return `
                        <div class="form-check">
                        <input class="form-check-input" data-id="${v.id}" data-allow-merge-discount="${v.allow_merge_discount}" data-maximum-product="${v.maximum_product}" data-register-promotion="${v.register_promotion}" data-minimum-product="${v.minimum_product}" data-price-discount="${v.total_price_discount}" data-promotion="${v.is_promotion}" data-price="${v.price}" type="checkbox" name="ebooks[]" value="${v.id}" id="${v.title}">
                        <label class="form-check-label" id="${i}" for="${v.title}" ${v.id == 1 ? 'checked' : ''}>
                            ${v.title}
                        </label>
                        </div>`
                }
		})
		$('#ebook-list').html(`
			<div id="checkboxEbook">
				${render}
			</div>
		`)

		$('#checkboxEbook input[type=checkbox]').each(function() {
			if(parseInt($(this).val()) == 1) {
			$(this).prop('checked', true)
			priceEbook = priceEbook + parseInt($(this).data('price'))
			$('#cost-ebook').html(toPrice(priceEbook / 1000))
			$('#grand-total').html(toPrice((priceEbook + postalFee) / 1000))
			}
		})

		// let isConfirmationEbook = false;
		// let validateEbooks = [];
		// $('form#action-member').on('submit', function(e) {
		// 	$('#checkboxEbook input[type=checkbox]').each(function(i) {
		// 		if($(this).prop('checked')) {
		// 			validateEbooks.push(i)
		// 		}
		// 	});

		// 	if(validateEbooks.length > 1 && !isConfirmationEbook) {
		// 		e.preventDefault();
		// 		var r = confirm("Apakah Anda yakin membeli 2 ebook?");

		// 		if (r == true) {
		// 			isConfirmationEbook = true
		// 			$('form#action-member').submit()
		// 		} else {
		// 			isConfirmationEbook = false
		// 			validateEbooks = [];
		// 			e.preventDefault();
		// 		}
		// 		// swal.fire({
		// 		// 	title: 'Are you sure?',
		// 		// 	text: "Ebook lebih dari satu",
		// 		// 	icon: 'warning',
		// 		// 	showCancelButton: true,
		// 		// 	confirmButtonColor: '#3085d6',
		// 		// 	cancelButtonColor: '#d33',
		// 		// 	confirmButtonText: 'Yes'
		// 		// }).then((result) => {
		// 		// 	if (result.value) {
		// 		// 		isConfirmationEbook = true
		// 		// 		$('form#action-member').submit();
		// 		// 	}
		// 		// })
		// 	}

		// })

		let discountEbooks = []

		$('#checkboxEbook input[type=checkbox]').change(function(index) {
			let ebookSelected = $('#checkboxEbook input[type=checkbox]').filter(function() {
				return $(this).prop("checked")
			})
			let indexEbook = discountEbooks.findIndex(data => data == $(this).prop("id"))

			if(!$(this).prop("checked")) {
				discountEbooks.splice(indexEbook, 1);
			}

			n=ebookSelected.length; //Tambah value untuk stored temporary

			let cancelledEbook = false;

			if(n>=2 && $(this).prop("checked")){
				var r = confirm("Apakah Anda yakin membeli " + n +" ebook?");
				if (r == true) {

				} else {
					cancelledEbook = true
					$(this).prop("checked", false)
					ebookSelected.splice(indexEbook,1)
				}
			}


			/*

			let cancelledEbook = false;

			if(ebookSelected.length == 2) {
				var r = confirm("Apakah Anda yakin membeli 2 ebook?");
				if (r == true) {

				} else {
					cancelledEbook = true
					$(this).prop("checked", false)
				}
			}

			// if($(this).prop('checked')) {
			// 	check += 1;

			// 	if($(this).data('promotion')) {
			// 		if(ebookSelected.length >= $(this).data('minimum-product')) {
			// 			priceEbook = priceEbook + (parseInt($(this).data('price')) - parseInt($(this).data('price-discount')));
			// 		} else {
			// 			priceEbook = priceEbook + (parseInt($(this).data('price')));
			// 		}
			// 	} else {
			// 		priceEbook = priceEbook + parseInt($(this).data('price'));
			// 	}

			// } else {
			// 	if(!cancelledEbook) {
			// 		check -= 1;

			// 		if($(this).data('promotion')) {
			// 			priceEbook = priceEbook - (parseInt($(this).data('price')) - parseInt($(this).data('price-discount')));
			// 		} else {
			// 			priceEbook = priceEbook - parseInt($(this).data('price'));
			// 		}
			// 	}

			// }*/

			priceEbook = 0
			let totalDiscount = 0;
			ebookSelected.each(function(index, book) {
				let idEbook = $(this).data('id')
				let allowMergeDiscount = $(this).data('allow-merge-discount');
				let isPromotion = $(this).data('promotion')
				let isRegisterPromotion = $(this).data('register-promotion')
				let minimumProduct = $(this).data('minimum-product')
				let maximumProduct = $(this).data('maximum-product')
				let price = $(this).data('price')
				let priceDiscount = $(this).data('price-discount')


				if($(this).prop('checked')) {
					if(isPromotion && isRegisterPromotion) {
						if(ebookSelected.length >= minimumProduct && ebookSelected.length <= maximumProduct) {
							priceEbook = priceEbook + (parseInt(price) - parseInt(priceDiscount));
							totalDiscount += parseInt(priceDiscount)

							/*jika member sudah pilih ebook yg ada discount,
								maka blok dan cek apakah ebook lain bisa dapat discount juga
								Jika belum memilih, masukan nilai id ebook yang promosi ke temporary
							*/
							if(discountEbooks.length > 0) {
								// cek allow merge / stack promotion
								if(allowMergeDiscount == 0 && !discountEbooks.includes(idEbook)) {
									priceEbook +=  parseInt(priceDiscount);
									totalDiscount -= parseInt(priceDiscount)
								}
							} else {
								// create temporary untuk cek
								discountEbooks.push(idEbook)
							}
						} else {
							priceEbook = priceEbook + (parseInt(price));
						}
					} else {
						priceEbook = priceEbook + parseInt(price);
					}
				} else {
					if(!cancelledEbook) {
						check -= 1;
						if(isPromotion && isRegisterPromotion && ebookSelected.length <= maximumProduct) {
							priceEbook = priceEbook - (parseInt(price) - parseInt(priceDiscount));
							totalDiscount -= parseInt(priceDiscount)
						} else {
							priceEbook = priceEbook - parseInt(price);
						}
					}
				}

			})

			if(discountEbooks.length > 0) {
				$('#selected_ebook').val(discountEbooks[0])
			} else {
				$('#selected_ebook').val('')
			}

			// filters data temporary, hanya ambil data yang tidak boleh di join/stack promotion
			// let notAllowMergeDiscountIds = discountEbooks.filter(value => value.allowMergePromotion == 0)
			// if(notAllowMergeDiscountIds.length > 0) {
			// 	notAllowMergeDiscountIds = notAllowMergeDiscountIds.map((data, index) => {
			// 		return index > 0 ? data.id : null
			// 	}).filter(data => data != null)
			// }

			if(totalDiscount >= 0) {
				$('#total-discount-tr').show()
				$('#total-discount').html(`${toPrice(totalDiscount / 1000)}`)
			} else {
				$('#total-discount-tr').hide()
			}

			if(priceEbook != 0) {
				$('#cost-ebook').parent().removeClass('hidden');
			} else {
				$('#cost-ebook').parent().addClass('hidden');
				$('.register').prop('disabled', true);
			}

			if(postalFee != 0) {
				$('#cost-postal').parent().removeClass('hidden')
			} else {
				$('#cost-postal').parent().addClass('hidden')
			}

			$('#cost-ebook').html(toPrice(priceEbook / 1000))
			$('#grand-total').html(toPrice((priceEbook + postalFee) / 1000))

			grandTotal = (priceEbook + postalFee) / 1000;

			if(is_va) {
				check_cost = true
			} else {
				check_cost = bitrexPoint < grandTotal ? false : true;
			}

			checkTerm()
		})
	})
	$('#province').html('<option disabled>Province</option>');
	$.ajax({
		type: 'GET',
		url: '/member/shipping/province',
		success: function (data) {
			$('#province').select2({
				placeholder: 'Province',
				data: data,
			});
		},
		error: function() {
			console.log("Error");
		}
	});

		$('.dropdown-toggle').remove();
		$('div').removeClass('btn-group');
		$('.div').removeClass('bootstrap-select');
		$('#city').select2({
			placeholder: 'City',
		});
		$('#district').select2({
			placeholder: 'Kecamatan',
		});
		$('#kurir').select2({
			placeholder: 'Kurir',
			data: data,
		});
	});

    let searchDownline = (data) => {
        $.ajax({
			type: 'GET',
			url: '/member/select/search-downline/'+data,
			success: function (data) {
				parent_id = data.parent_id;
				if (data) {
					$.ajax({
						type: 'GET',
						url: '/member/select/child-tree/'+data.username,
						success: function (data) {
							$('#bah').empty('g');
							tree(data)
						},
						error: function() {
							console.log("Error");
						}
					});
				}else{
					swal("sorry, username not found");
				}
			},
			error: function() {
				console.log("Error");
			}
		});
    }

	$('#search-downline').click(function(){
		let data = $('.search').val();
	    searchDownline(data);
	});

  $('#bank_name_select').change(function() {
    let bankName = $(this).val()
    if(bankName == 'other') {
      $('#bank_name').val('')
      $('#bank_name').prop('type', 'text')
    } else {
      $('#bank_name').val(bankName)
      $('#bank_name').prop('type', 'hidden')
    }
	checkTerm()
  });

	$('#province').change(function(){
		let id = this.value;
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
				});
			},
			error: function() {
				console.log("Error");
			}
		});
		checkTerm()
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
				});
			},
			error: function() {
				console.log("Error");
			}
		});
		checkTerm()
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
				});
			},
			error: function() {
				console.log("Error");
			}
		});
		checkTerm()
	});

	$('#kurir').change(function(){

		$('#kurir_name').val($(this).find(":checked").text())
		$('#cost').val(Math.ceil(this.value/1000))
		$('#cost-starter').html('280')
		postalFee = Math.ceil(this.value)

		if(postalFee != 0) {
			$('#cost-postal').parent().removeClass('hidden')
		} else {
			$('#cost-postal').parent().addClass('hidden')
		}

		$('#cost-postal').html(toPrice(postalFee / 1000))
		$('#grand-total').html(toPrice((priceEbook + postalFee) / 1000))

		grandTotal = (priceEbook + postalFee) / 1000;

		if(is_va) {
			check_cost = true
		} else {
			if(bitrexPoint < grandTotal) {
				$('.register').prop('disabled', true)
				check_cost = false
			} else {
				check_cost = true
			}
		}
		checkTerm()
	});

	$('#shipping').change(function(){
		$('.shipping-form').show();
    	$('.pickup-form').hide();
		$('#province').prop('required',true);
		$('#city').prop('required',true);
		$('#district').prop('required',true);
		$('#kurir').prop('required',true);
    	$('#address').prop('required', true);
		$('#city').empty().trigger('change');
		$('#district').empty().trigger('change');
		$('#kurir').empty().trigger('change');
		grandTotal = (priceEbook + postalFee) / 1000;

		if(is_va) {
			check_cost = true
		} else {
			check_cost = bitrexPoint < grandTotal ? false : true;
		}
		$('#cost-postal').text(postalFee);
		$('#grand-total').text(grandTotal);
		checkTerm();
	});

	$('#pickup').change(function(){
    	$('#address').prop('required', false);
		$('#province').prop('required',false);
		$('#city').prop('required',false);
		$('.shipping-form').hide();
    	$('.pickup-form').show();
		grandTotal -= postalFee;
		postalFee = 0;
		grandTotal = (priceEbook - postalFee) / 1000;

		if(is_va) {
			check_cost = true
		} else {
			check_cost = bitrexPoint < grandTotal ? false : true;
		}
		$('#cost-postal').text(postalFee);
		$('#grand-total').text(grandTotal);
		checkTerm();
	});

	$('#email').keyup(function(){
		let val_email = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.value);
		if (val_email) {
			check_email = true;
			$('#email_danger').empty();
		}else{
			check_email = false;
			$('#email_danger').text('Email Invalid');
		}
		$.ajax({
			type: 'GET',
			url: '/member/select/email/'+this.value,
			success: function (data) {
				if (data.email) {
					$('#email_danger').text('email already exist');
					available_email = false;
				}else{
					$('#email_danger').empty();
					available_email = true;
				}
			},
			error: function() {
				console.log("Error");
			}
		});
		checkTerm();
	});

	$('#username').keyup(function(){
		let cek = /^[a-zA-Z0-9_]*$/.test(this.value);
		this.value = !cek ? $(this).val().match(/[a-zA-Z0-9_]/g).join('') : this.value;
		var text = this.value;
		$.ajax({
			type: 'GET',
			url: '/member/select/username/'+text,
			success: function (data) {
				data.username ? $('#username_danger').text('username you entered already exists') : $('#username_danger').empty();
				check_user = data.username ? false  : true;
			},
			error: function() {
				console.log("Error");
			}
		});
		checkTerm()
	})

	$('#phone_number').on('input', function() {
		let str = this.value;
		this.value = (str.match(/[0-9]/g)) ? str.match(/[0-9]/g).join('') : '';
		checkTerm()
	})

	$('#nik').on('input', function() {
		let str = /^[a-zA-Z0-9_]*$/.test(this.value);
		this.value = !str ? $(this).val().match(/[a-zA-Z0-9_]/g).join('') : this.value;
		// var text = this.value;
		// $.ajax({
		// 	type: 'GET',
		// 	url: '/member/select/nik/'+text,
		// 	success: function (data) {
		// 		data.nik ? $('#nik_danger').text('identity you entered already exists') : $('#nik_danger').empty();
		// 		check_nik = data.nik ? false  : true;
		// 	},
		// 	error: function() {
		// 		console.log("Error");
		// 	}
		// });
        checkTerm()


	})

	$('#bank_account_number').on('input', function() {
		let str = this.value;
		this.value = (str.match(/[0-9]/g)) ? str.match(/[0-9]/g).join('') : '';
		checkTerm()
	})

	var my_transform = d3Transform()
   .translate([-750, -50]);
   if ($('#username_default').val()=='no') {
   	var svg = d3.select("#tree")
		.append("svg")
		.attr("width", 1035).attr("height", 1080)
		.call(d3.zoom().on("zoom", function () {
			svg.attr("transform", d3.event.transform)
		}))
		.append("g")
		.attr("transform", my_transform)
		.attr("id", "bah")
		panzoom(document.querySelector('#bah'), {
			zoomSpeed: 0.030
		});
	$.ajax({
		type: 'GET',
		url: '{{route("member.select.tree")}}',
		success: function (data) {
			tree(data);
		},
		error: function() {
			console.log("Error");
		}
	});
   }else{
    var svg = d3.select("#tree")
		.append("svg")
		.attr("width", 1035).attr("height", 1080)
		.call(d3.zoom().on("zoom", function () {
			svg.attr("transform", d3.event.transform)
		}))
		.append("g")
		.attr("transform", my_transform)
		.attr("id", "bah")
		panzoom(document.querySelector('#bah'), {
			zoomSpeed: 0.030
		});
	$.ajax({
		type: 'POST',
		url: '{{route("member.select.tree-analyzer")}}',
        data: { "_token": "{{ csrf_token() }}", username : $('#username_default').val()},
		success: function (data) {
            parent_id = data.parent_id;
		    $('#bah').empty('g');
			tree(data);
		},
		error: function() {
			console.log("Error");
		}
	});
   }

	var tree_submit = (a, parent, position) => {
		if (a=='available') {
			var expired = "{{ session('expired') }}"
			if (expired != '1') {
				$('#parent').val(parent);
				$('#position').val(position);
				openTree()
				$('#register').modal('show');
			}
		}else{
			$.ajax({
				type: 'GET',
				url: '/member/select/search-downline/'+a,
				success: function (data) {
					parent_id = data.parent_id;
					if (data) {
						$.ajax({
							type: 'GET',
							url: '/member/select/child-tree/'+data.username,
							success: function (data) {
								$('#bah').empty('g');
								tree(data)
							},
							error: function() {
								console.log("Error");
							}
						});
					}else{
						swal("sorry, username not found");
					}
				},
			});
		}
	};

	var tree = (data) => {
        my_id = {!! \Auth::id() !!};
        data.id!=my_id ? $('#tree_button').html('<button id="upline" class="btn btn-primary zmdi zmdi-chevron-up"></button>') : $('#upline').remove();
		$.ajax({
            url: 'select/summary/'+data.id,
            success:function(data){
				$('#_name').text('Name: ' + data.member.first_name + ' ' +data.member.last_name);
				$('#_username').text('Username: ' + data.member.username);
				$('#_id_member').text('Id Member: ' + data.member.id_member);
				data.pairings ? $('#_pv_pairing_l').text('PV Pairing L: ' + addCommas(data.pairings.pv_left)) : $('#_pv_pairing_l').text('PV Pairing L: 0 ') ;
				data.pairings ? $('#_pv_pairing_m').text('PV Pairing M: ' + addCommas(data.pairings.pv_midle)) : $('#_pv_pairing_m').text('PV Pairing M: 0 ');
				data.pairings ? $('#_pv_pairing_r').text('PV Pairing R: ' + addCommas(data.pairings.pv_right)) : $('#_pv_pairing_r').text('PV Pairing R: 0 ');
				data.pv_group ? $('#_pv_group_l').text('PV Rank L: ' + addCommas(data.pv_group.pv_left)) : $('#_pv_group_l').text('PV Rank: 0 ');
				data.pv_group ? $('#_pv_group_m').text('PV Rank M: ' + addCommas(data.pv_group.pv_midle)) : $('#_pv_group_m').text('PV Rank: 0 ');
				data.pv_group ? $('#_pv_group_r').text('PV Rank R: ' + addCommas(data.pv_group.pv_right)) : $('#_pv_group_r').text('PV Rank: 0 ');
            }
        });

		var treeStructure = d3.tree().size([2000,480]);
		var root = d3.hierarchy(data).sort(function(a, b) {return a.data.position - b.data.position ;});
		treeStructure(root);
		var information = treeStructure(root);

		var connections = svg.append("g").selectAll("path")
			.data(information.links());

		connections.enter().append("path")
			.attr("d", function(d){
				return "M" + d.source.x + "," + d.source.y + " v 150 H" +
				d.target.x + " V" + d.target.y;
			});

		var rectangles = svg.append("g").selectAll("rect")
			.data(information.descendants());
		rectangles.enter().append("rect")
			.attr("onclick", function(d){ return `tree_submit(${d.data.username ? `'${d.data.username}'` : `'${"available"}'`}, ${d.data.parent_id}, ${d.data.position} )` })
			.attr("value", function(d){return d.data.username ? d.data.username : "available"})
			.attr("href","#")
			.attr("fill", function(d) {return d.data.username ? '#ebebeb' : '#28a745'})
			.attr("x", function(d){return d.x-75;})
			.attr("y", function(d){return d.y-50;});

		var names = svg.append("g").selectAll("text")
			.data(information.descendants());
		names.enter().append("text")
			.attr("onclick", function(d){ return `tree_submit(${d.data.username ? `'${d.data.username}'` : `'${"available"}'`}, ${d.data.parent_id}, ${d.data.position} )` })
			.text(function(d){return d.data.username ? d.data.username : 'Available';})
			.attr("x", function(d){return d.x+0;})
			.attr("y", function(d){return d.y+40;})
			.classed("bigger", true);

		var levels = svg.append("g").selectAll("text")
			.attr("onclick", function(d){ return `tree_submit(${d.data.username ? `'${d.data.username}'` : `'${"available"}'`}, ${d.data.parent_id}, ${d.data.position} )` })
			.data(information.descendants());
		levels.enter().append("text")
			.attr("onclick", function(d){ return `tree_submit(${d.data.username ? `'${d.data.username}'` : `'${"available"}'`}, ${d.data.parent_id}, ${d.data.position} )` })
			.text(function(d){return d.data.rank ? "Rank : " + d.data.rank : '';})
			.attr("x", function(d){return d.x+0;})
			.attr("y", function(d){return d.y+60;})
			.classed("bigger", true)

		var pv_left = svg.append("g").selectAll("text")
			.attr("onclick", function(d){ return `tree_submit(${d.data.username ? `'${d.data.username}'` : `'${"available"}'`}, ${d.data.parent_id}, ${d.data.position} )` })
			.data(information.descendants());
		pv_left.enter().append("text")
			.attr("onclick", function(d){ return `tree_submit(${d.data.username ? `'${d.data.username}'` : `'${"available"}'`}, ${d.data.parent_id}, ${d.data.position} )` })
			.text(function(d){return d.data.pv_left >= 0 ? "L : " + addCommas(d.data.pv_left) : '';})
			.attr("x", function(d){return d.x+0;})
			.attr("y", function(d){return d.y+80;})
			.classed("bigger", true);

		var pv_midle = svg.append("g").selectAll("text")
			.attr("onclick", function(d){ return `tree_submit(${d.data.username ? `'${d.data.username}'` : `'${"available"}'`}, ${d.data.parent_id}, ${d.data.position} )` })
			.data(information.descendants());
		pv_midle.enter().append("text")
			.attr("onclick", function(d){ return `tree_submit(${d.data.username ? `'${d.data.username}'` : `'${"available"}'`}, ${d.data.parent_id}, ${d.data.position} )` })
			.text(function(d){return d.data.pv_midle >= 0 ? "M : " + addCommas(d.data.pv_midle) : ''})
			.attr("x", function(d){return d.x+0;})
			.attr("y", function(d){return d.y+100;})
			.classed("bigger", true);

		var pv_right = svg.append("g").selectAll("text")
			.attr("onclick", function(d){ return `tree_submit(${d.data.username ? `'${d.data.username}'` : `'${"available"}'`}, ${d.data.parent_id}, ${d.data.position} )` })
			.data(information.descendants());
		pv_right.enter().append("text")
			.attr("onclick", function(d){ return `tree_submit(${d.data.username ? `'${d.data.username}'` : `'${"available"}'`}, ${d.data.parent_id}, ${d.data.position} )` })
			.text(function(d){return d.data.pv_right >= 0 ? "R : " + addCommas(d.data.pv_right) : ''})
			.attr("x", function(d){return d.x+0;})
			.attr("y", function(d){return d.y+120;})
			.classed("bigger", true);

		var image = svg.append("g").selectAll("image")
			.data(information.descendants());
		image.enter().append("a")
			.append("image")
			.attr("onclick", function(d){ return `tree_submit(${d.data.username ? `'${d.data.username}'` : `'${"available"}'`}, ${d.data.parent_id}, ${d.data.position} )` })
			.attr("xlink:href", function(d){return d.data.src == null ? "https://img.icons8.com/bubbles/2x/user.png" : BASE_SRC+'/'+d.data.src})
			.attr("x", function(d){
				if($(window).width() <= 480) {
					return d.x-80;
				}else{
					return d.x-30;
				}
			})
			.attr("y", function(d){return d.y-40;})
			.classed("img-fluid", true);
	}
  	function toPrice(value) {
		return value.toString().replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1\.")
	}
	$(document).on('click','#upline',function(){
		$('#upline').remove();
        $("#overlay").fadeIn(100);
		cek_upline = 0;
        cek_id = 0;
		$.ajax({
			type: 'GET',
			url: '/member/select/tree-upline/'+parent_id,
			success: function (data) {
                data.children.forEach(child => {
                    if (child.id == {!! \Auth::id() !!}) {
                        cek_id += 1;
                    }
                });

                if (cek_id == 0) {
                    parent_id = data.parent_id;
                    $('#bah').empty('g');
                    tree(data);
                    data.parent ? cek_upline = 1 : cek_upline = 0;
                }
                cek_id = 0;
			},
			error: function() {
				console.log("Error");
			}
		}).done(function() {
			setTimeout(function(){
				$("#overlay").fadeOut(100);
				cek_upline==1 ? $('#tree_button').html('<button id="upline" class="btn btn-primary zmdi zmdi-chevron-up"></button>') : $('#upline').remove();
			},300);
		});
	})




	// $( function() {
	// 	$('#birthdate').datepicker();
  	// });
	// $( function() {
	// 	if ( $('#birthdate').prop('type') != 'date' ) {
    // 		$('#birthdate').datepicker();
	// 	}
  	// });

	$( function() {
		if ( $('#birthdate')[0].type != 'date' ) $('#birthdate').datepicker({
			   changeMonth: true,
   			   changeYear: true
  		});
  	});



</script>
@stop
