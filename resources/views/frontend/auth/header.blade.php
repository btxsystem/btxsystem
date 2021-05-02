<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
  <title>Bitrexgo</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="{{asset('assets3/img/favicon.png')}}" type="image/x-icon" rel="shortcut icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- <link href="http://templines.rocks/html/academica/assets/css/master.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

  <link href="{{asset('assets3/css/master.css')}}" rel="stylesheet">
  <!-- SWITCHER -->
  <link href="{{asset('assets3/css/switcher.css')}}" rel="stylesheet" id="switcher-css" media="all">

  <link href="{{asset('assets3/css/style.css')}}" rel="stylesheet">

  <link href="{{asset('assets3/css/color2.css')}}" rel="alternate stylesheet" title="color2" media="all">
  <link href="{{asset('assets3/css/color3.css')}}" rel="alternate stylesheet" title="color3" media="all">
  <link href="{{asset('assets3/css/color4.css')}}" rel="alternate stylesheet" title="color4" media="all">
  <link href="{{asset('assets3/css/color5.css')}}" rel="alternate stylesheet" title="color5" media="all">
  <link rel="stylesheet" type="text/css" href="{{asset('assets2/css/select2.css')}}">
  <script src="{{asset('assets3/js/jquery-1.11.3.min.js')}}"></script>
<!--   <script defer src="{{asset('js/app.js')}}"></script>
 -->  <link rel="stylesheet" href="{{asset('assets2/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    .yamm .nav > li > a {
       padding: 0px 8px 9px !important;
    }
    .btn-buy {
      margin-right: -45px!important
    }
  </style>
</head>

<body>

<script src="{{asset('assets2/js/sweet.js')}}"></script>
@include('sweet::alert')
@extends('frontend.auth.style.header')
<div id="app">
<div class="modal fade" id="join" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b style="font-size: 16px;" class="modal-title" id="exampleModalLabel">Join Member</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height: auto;">
<!--               <fa-register-member-component/>
 -->              <form action="{{route('register-auto-webstore')}}" method="post" id="register-webstore">
                @csrf
                    <div class="input-group col-md-12">
                        <input class="form-control" type="text" name="referral" id="referal" placeholder="Sponsor Username" required>
                        <p class="alert-referal"></p>
                    </div>
                    <br>
                    <div class="input-group col-md-12">
                        <input class="form-control" type="text" name="firstName" id="firstName" minlength="2" placeholder="First Name" required>
                    </div>
                    <br>
                    <div class="input-group col-md-12">
                        <input class="form-control" type="text" placeholder="Last Name" name="lastName">
                    </div>
                    <br>
                    <div class="input-group col-md-12">
                        <input class="form-control" type="text" id="username" placeholder="Username" name="username" required>
                        <p class="alert-username"></p>
                    </div>
                    <br>
                    <div class="input-group col-md-12">
                        <input class="form-control" type="email" placeholder="Email" name="email" id="email" required>
                    </div>
                    <div>
                      <b style="color:red" id="email_danger"></b>
                    </div>
                    <br>
                    <div class="input-group col-md-12">
                        <input class="form-control" type="number" placeholder="NIK/Passport" name="nik" id="passport" required>
                    </div>
                    <br>
                    <div class="input-group col-md-12">
                        <input class="form-control" type="text" placeholder="Phone Number" name="phone_number" id="phone_number" required>
                    </div>
                    <br>
                    <div class="input-group col-md-12">
                        <input class="form-control" type="text" placeholder="NPWP" name="npwp_number" id="npwp">
                    </div>
                    <br>
                    <div class="input-group col-md-12">
                        <input class="form-control" type="text" placeholder="Account Name (Bank)" name="bank_account_name" id="account_name" required>
                    </div>
                    <br>
                    <div class="input-group col-md-12">
                        <input class="form-control" type="text" placeholder="Account Number (Bank)" name="bank_account_number" id="account_number" required>
                    </div>
                    <br>
                    <div class="input-group col-md-12">
                        <div class="form-line">
                          <input type="date" id="birthdate" name="birthdate" class="form-control" placeholder="Birthdate" required>
                        </div>
                        <div id="birthdate_danger"></div>
                    </div>
                    <div class="input-group col-md-12 mt-4">
                      <h5 class="card-inside-title">Gender</h5>
                      <div class="demo-radio-button">
                        <input name="gender" type="radio" value="0" id="male" checked class="with-gap radio-col-red" />
                        <label for="gender">Male</label>&nbsp;&nbsp;
                        <input name="gender" type="radio" value="1" id="female" class="with-gap radio-col-red" />
                        <label for="gender">Female</label>
                      </div>
                    </div>
                    <br>
                    <div class="input-group col-md-12">
              				<label class="form-label">Bank Name <em>*</em></label>
                      <select class="form-control" id="bank_name_select">
                        <option value="BCA" selected>BCA</option>
                        <option value="BRI">BRI</option>
                        <option value="BNI">BNI</option>
                        <option value="Mandiri">Mandiri</option>
                        <option value="CIMB NIAGA">CIMB NIAGA</option>
                        <option value="other">Other Bank</option>
                      </select>
                        <input type="hidden" class="form-control" name="bank_name" id="bank_name" required>
                    </div>
                    <br>
                    <div class="input-group col-md-12">
                      <h5 class="card-inside-title">Choose a pack</h5>
                      <div class="demo-radio-button">
                        <input name="pack" type="radio" value="0" id="starterpack" class="with-gap radio-col-red" checked />
                        <label for="shipping">Starter Pack</label>
                        <!-- <input name="method" type="radio" value="1" id="starterpackebook" class="with-gap radio-col-red" />
                        <label for="pickup">Starter Pack + Ebook</label> -->
                      </div>
                      <input type="hidden" id="choosepack">
                    </div>
                    <br>
                    <div class="input-group col-md-12">
                      <h5 class="card-inside-title">Select ebook</h5>
                      <div class="demo-radio-button">
                        <!-- <div class="btn-group-toggle" data-toggle="buttons" id="data-ebooks">
                            <input type="checkbox" name="basic" id="basic" checked> Basic &nbsp;&nbsp;
                            <input type="checkbox" name="advance" id="advance"> Advance
                        </div> -->
                        <div id="ebook-list"></div>
                      </div>
                      <input type="hidden" id="choosepack">
                    </div>
                    <br>
                    <div class="input-group col-md-12 mt-4">
                      <h5 class="card-inside-title">Choose a shipping method</h5>
                      <div class="demo-radio-button">
                        <input name="shipping" type="radio" value="0" id="pickup" checked class="with-gap radio-col-red" />
                        <label for="pickup">Pickup</label>&nbsp;&nbsp;
                        <input name="shipping" type="radio" value="1" id="shipping" class="with-gap radio-col-red" />
                        <label for="shipping">Shipping</label>
                      </div>
                    </div>
                    <br>
                    <div class="input-group col-md-12" id="shipping-form">
                      <div class="form-group">
                        <select style="width:100%;" id="province" name="province" class="form-control province"></select>
                        <input type="hidden" class="form-control" name="province_name" id="province_name">
                      </div>
                      <div class="form-group city-form">
                        <select style="width:100%;" id="city" name="city" class="form-control city"></select>
                        <input type="hidden" class="form-control" name="city_name" id="city_name">
                      </div>
                      <div class="form-group district-form">
                        <select style="width:100%;" id="district" name="district" class="form-control district"></select>
                        <input type="hidden" class="form-control" name="district_name" id="district_name">
                      </div>
                      <div class="form-group kurir-form">
                        <select style="width:100%;" id="kurir" name="kurir" class="form-control kurir"></select>
                        <input type="hidden" class="form-control" name="kurir_name" id="kurir_name">
                      </div>
                      <div class="form-group address-form">
                        <textarea class="form-control" name="address" placeholder="Address"></textarea>
                      </div>
                      <input id="cost" type="hidden" name="postalFee" value=0>
                      <!-- <div class="cost-form form-line" style="display:none">
                        <input style="width:100%;" class="cost form-control" name="cost" id="cost" type="text">
                      </div> -->
                    </div>
                    <div class="input-group col-md-12" id="pickup-form">
                      <div class="form-group address-form">
                        <p>Alamat Bitrexgo</p>
                      </div>
                    </div>
                    <div class="input-group col-md-12">
                      <div class="form-group address-form">
                        <table class="table table-borderless">
                          <tr>
                            <td> <h4>Starter Pack</h4> </td>
                            <td class="text-right"> <h4><span id="cost-starter">0</span></h4> </td>
                            <td> <h4>IDR</h4> </td>
                          </tr>
                          <tr>
                            <td> <h4>Total Ebook</h4> </td>
                            <td class="text-right"> <h4><span id="cost-ebook">0</span></h4> </td>
                            <td> <h4>IDR</h4> </td>
                          </tr>
                          <!-- <tr>
                            <td> <h4>Total Shipping</h4> </td>
                            <td class="text-right"> <h4><span id="cost-postal">0</span></h4> </td>
                            <td> <h4>IDR</h4> </td>
                          </tr> -->
                          <tr>
                            <td> <h4>Grand Total</h4> </td>
                            <td class="text-right"> <h4><span id="grand-total">0</span></h4> </td>
                            <td> <h4>IDR</h4> </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="input-group col-md-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="term_one" name="term_one" value="0">
                        <label class="form-check-label" for="term_one">
                          Saya telah membaca dan menyetujui <a href="https://drive.google.com/file/d/1I2pDzWx2ITxE3PKplc_6pLdP0jMrmkA1/view?usp=sharing" target="_blank">kode etik Bitrexgo</a>.
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="term_two" name="term_two" value="0">
                        <label class="form-check-label" for="term_two">
                          Saya menyatakan bahwa data yang saya isi sudah benar, dapat dipertanggung jawabkan, dan dapat digunakan untuk keperluan pembuatan ID Startpro Support System
                        </label>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="Submit" class="btn btn-join" style="border-radius: 5px; background-color: #b92240; color: #fff;">Join</button>
                      <button type="button" class="btn" style="border-radius: 5px; background-color: orange; color: #fff; margin-top: -5px;" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="forgot-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b style="font-size: 16px;" class="modal-title" id="exampleModalLabel">Forgot password</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height: auto;">
              <form action="{{route('forgot-password')}}" method="post" id="payment">
                @csrf
                    <div class="input-group col-md-12">
                        <input class="form-control" type="email" name="email" id="email" placeholder="Email" required>
                        <p class="alert-referal"></p>
                    </div>
                    <div class="modal-footer">
                      <button type="Submit" class="btn btn-join" style="border-radius: 5px; background-color: #b92240; color: #fff;">Submit</button>
                      <button type="button" class="btn" style="border-radius: 5px; background-color: orange; color: #fff; margin-top: -5px;" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
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
						<button type="button" class="mt-3 btn btn-raised text-white bg-danger waves-effect" style="cursor:pointer" id="copy">Copy</button>
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
<div class="layout-theme animated-css"  data-header="sticky" data-header-top="200">

  <div id="wrapper">

    <!-- HEADER -->
    <header class="header">

      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <a class="header-logo" href="/login">
              <img class="header-logo__img" src="{{asset('img/logo.png')}}"  alt="Logo" height="auto" width="190px">
            </a>
            <a class="header-logo" href="javascript:void(0);">
              <img class="header-logo__img" src="{{asset('img/ap2li_new_1.png')}}"  alt="AP2LI Logo" height="auto" width="190px">
            </a>

            <div class="btnBook">
              <a class="btn btn-effect btn-info btn-buy" href="https://ebook."{{$_SERVER['SERVER_NAME']}}"./ebook">
                  <span style="color:white">EBOOK</span>
              </a>
            </div>
            <div class="header-inner">
              <div class="header-search">
                <div class="navbar-search">
                  <form id="search-global-form">
                    <div class="input-group">
                      <input type="text" placeholder="Type your search..." class="form-control" autocomplete="off" name="s" id="search" value="">
                      <span class="input-group-btn">
                      <button type="reset" class="btn search-close" id="search-close"><i class="fa fa-times"></i></button>
                      </span> </div>
                  </form>
                </div>
              </div>
              <!-- <a id="search-open" href="#fakelink"><i class="icon stroke icon-Search"></i></a> <a class="header-cart" href="/"> <i class="icon stroke icon-ShoppingCart"></i></a> -->
              <nav class="navbar yamm">
                <div class="navbar-header hidden-md  hidden-lg  hidden-sm ">
                  <button type="button" data-toggle="collapse" data-target="#navbar-collapse-1" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                </div>
                <div id="navbar-collapse-1" class="navbar-collapse collapse">
                  <ul class="nav navbar-nav">
                    <li><a id="myAbout" href="/login#about">About Us</a></li>
                    <li><a id="myProduct" href="/login#product">Our Product</a></li>
                    <!-- <li><a id="event" href="/event">Event</a></li> -->
                    <li><a target="_blank" href="{{asset('assets3/code-ethic.pdf')}}">Ethical Code</a></li>
                    <li><a id="hall-if-fame" href="/hall-of-fame">Hall Of Fame</a></li>
                    <!-- <li><a href="#"><button class="btn btn-effect btn-info btn-buy" style="background: #b92240; margin-top: -10px;">JOIN</button></a></li> -->
                    <!-- <li><a data-toggle="modal" data-target="#join"><button class="btn btn-effect btn-info btn-buy" style="background: #b92240; margin-top: -10px;">JOIN</button></a></li>-->
                     <li><a><button class="btn btn-effect btn-info btn-buy" style="background: #b92240; margin-top: -10px;">JOIN</button></a></li>
                   {{--<li><a data-toggle="modal" data-target="#join"><button class="btn btn-effect btn-info btn-buy" style="background: #b92240; margin-top: -10px;">JOIN</button></a></li>--}}
                    <!-- <li><a href="#"><button class="btn btn-effect btn-info btn-buy" style="background: #b92240; margin-top: -10px;">JOIN</button></a></li> -->

                  </ul>

                </div>
              </nav>
              <!--end navbar -->

            </div>
            <!-- end header-inner -->
          </div>
          <!-- end col  -->
        </div>
        <!-- end row  -->
      </div>
      <!-- end container-->
    </header>
    <!-- end header -->
