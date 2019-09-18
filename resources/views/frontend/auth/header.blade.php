<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
  <title>Bitrexgo</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="{{asset('assets3/img/favicon.png')}}" type="image/x-icon" rel="shortcut icon">
  <!-- <link href="http://templines.rocks/html/academica/assets/css/master.css" rel="stylesheet"> -->
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

</head>

<body>
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
 -->              <form action="{{route('register-member')}}" method="post" id="payment">
                @csrf
                    <div class="input-group col-md-12">
                        <input class="form-control" type="text" name="referral" id="referal" placeholder="Sponsor Username" required>
                        <p class="alert-referal"></p>
                    </div>
                    <br>
                    <div class="input-group col-md-12">
                        <input class="form-control" type="text" name="firstName" minlength="2" placeholder="First Name" required>
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
                    <br>
                    <div class="input-group col-md-12">
                        <input class="form-control" type="number" placeholder="NIK/Passport" name="passport" id="passport" required>
                    </div>
                    <br>
                    <div class="input-group col-md-12">
                        <input type="text" name="birthdate" class="datepicker form-control" placeholder="Birthdate" required>
                    </div>
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
                    <div class="input-group col-md-12">
                      <h5 class="card-inside-title">Choose a ebook</h5>
                      <div class="demo-radio-button">
                        <div id="ebook-list"></div>
                        <!-- <input name="method" type="checkbox" value="0" id="basic" class="with-gap radio-col-red" checked />
                        <label for="shipping">Basic + Intermediate</label>
                        <input name="method" type="checkbox" value="0" id="advanced" class="with-gap radio-col-red" checked />
                        <label for="shipping">Advanced</label> -->
                        <!-- <input name="method" type="radio" value="1" id="starterpackebook" class="with-gap radio-col-red" />
                        <label for="pickup">Starter Pack + Ebook</label> -->
                      </div>
                      <input type="hidden" id="choosepack">
                    </div>
                    <div class="input-group col-md-12 mt-4">
                      <h5 class="card-inside-title">Choose a shipping method</h5>
                      <div class="demo-radio-button">
                        <input name="shipping" type="radio" value="1" id="shipping" class="with-gap radio-col-red" />
                        <label for="shipping">Shipping</label>
                        <input name="shipping" type="radio" value="0" id="pickup" class="with-gap radio-col-red" />
                        <label for="pickup">Pickup</label>
                      </div>
                    </div>
                    <div class="input-group col-md-12" id="shipping-form">
                      <div class="form-group">
                        <select style="width:100%;" id="province" name="province" class="form-control province"></select>
                      </div>
                      <div class="form-group city-form">
                        <select style="width:100%;" id="city" name="city" class="form-control city"></select>
                      </div>
                      <div class="form-group district-form">
                        <select style="width:100%;" id="district" name="district" class="form-control district"></select>
                      </div>
                      <div class="form-group kurir-form">
                        <select style="width:100%;" id="kurir" name="kurir" class="form-control kurir"></select>
                      </div>
                      <div class="form-group address-form">
                        <textarea class="form-control" name="description" placeholder="Address"></textarea>
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
                        <h4 class="hidden">Starter Pack : <span id="cost-starter">0</span></h4>
                        <h4 class="hidden">Total Ebook : <span id="cost-ebook">0</span></h4>
                        <h4 class="hidden">Total Postal Fee : <span id="cost-postal">0</span></h4>
                        <h4>Grand Total : <span id="grand-total"></span></h4>
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

<div class="layout-theme animated-css"  data-header="sticky" data-header-top="200">

  <div id="wrapper">

    <!-- HEADER -->
    <header class="header">

      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <a class="header-logo" href="javascript:void(0);">
              <img class="header-logo__img" src="{{asset('img/logo.png')}}"  alt="Logo" height="auto" width="190px">
            </a>
            <div class="btnBook">
              <div class="btn">
                <a href="{{route('member.home')}}">EBOOK</a>
              </div>
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
                    <li><a id="about" href="#">About Us</a></li>
                    <li><a id="product" href="#">Our Product</a></li>
                    <li><a id="event" href="#">Event</a></li>
                    <!-- <li><a data-toggle="modal" data-target="#join"><button class="btn btn-effect btn-info btn-buy" style="background: #b92240; margin-top: -10px;">JOIN</button></a></li> -->
                    <li><a href="#"><button class="btn btn-effect btn-info btn-buy" style="background: #b92240; margin-top: -10px;">JOIN</button></a></li>
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
