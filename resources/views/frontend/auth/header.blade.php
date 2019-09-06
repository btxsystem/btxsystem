<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
  <title>Bitrexgo</title>
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
  <script src="{{asset('assets3/js/jquery-1.11.3.min.js')}}"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

</head>

<body>
@include('sweet::alert')
@extends('frontend.auth.style.header')


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
                <input class="form-control" type="text" placeholder="Referal">
                <input class="form-control" type="text" placeholder="First Name">
                <input class="form-control" type="text" placeholder="Last Name">
                <input class="form-control" type="text" placeholder="Username">
                <input class="form-control" type="text" placeholder="Email">
                <input class="form-control" type="text" placeholder="NIK/Passport">
                <input class="form-control" type="text" placeholder="Birthdate">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" style="border-radius: 5px; background-color: #b92240; color: #fff;">Join</button>
                <button type="button" class="btn" style="border-radius: 5px; background-color: orange; color: #fff; margin-top: -5px;" data-dismiss="modal">Close</button>
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
                    <li><a data-toggle="modal" data-target="#join"><button class="btn btn-effect btn-info btn-buy" style="background: #b92240; margin-top: -10px;">JOIN</button></a></li>
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
