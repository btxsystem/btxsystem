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
<style type="text/css">
img.header-logo__img {
    margin-top: 15px;
    margin-bottom: 15px;
}
.border-decor_top {
    border-top: 0px solid #ddd;
}
header.header {
    background: #fff;
}
.header.sticky {
    left: 0;
    position: fixed;
    top: 0;
    width: 100%;
    background-color: #fff;
    border: #e8e9ed 1px solid;
    z-index: 888;
    padding-top: 0px;
}
.yamm .nav > li > a {
    position: relative;
    display: block;
    padding: 0 10px 0 20px;
    text-transform: uppercase;
    transition: all .1s ease-out;
    font-family: Montserrat , arial;
    color: #222;
}
.yamm .nav-subtitle {
    display: block;
    color: #6d6d6d;
    font-size: 10px;
    margin-top: 5px;
    line-height: 1.2;
}
.btn-warning {
    color: #ffffff;
    background-color: #b92240;
    border-color: #ff0054;
    box-shadow: 0 4px 0 0 #ff0054;
}
.btn-warning:after {
    background-color: #b92240;
}
.bg-color_primary, .btn-header, .btn-primary, .find-course__title, .find-course .form-group {
    background-color: #b92240;
}
.find-course_mod-a .form-group:after, .staff:hover .staff__inner, .post:hover .entry-main, .nav-tabs > li {
    border-top-color: #b92240;
}
.btn-info {
    color: #ffffff;
    box-shadow: none;
    border-radius: 5px;
    background-color: #b92240;
}
.btn-info:after {
    background-color: #b92240;
}
.section-video:after {
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(34, 145, 155, 0.84);
    content: '';
}
.section-subscribe {
    background-color: #22919b;
}
.btn-success {
    color: #fff;
    background-color: #b92240;
    box-shadow: 0 4px 0 0 #8c0733;
}
.btn-success:after {
    background-color: #b92240;
}
.footer {
    color: #fff;
    background-color: #1d2228;
}
.footer-contacts__inner {
    display: block;
    margin-left: 26px;
    color: #fff;
}
.footer-list__link {
    color: #fff;
}
.footer-title:after {
    display: block;
    width: 30px;
    margin-top: 18px;
    margin-bottom: 42px;
    border-top: 1px solid #fff;
    content: '';
}
a, .color_primary, .rtd ul > li:before, .yamm .nav > li > a:hover, .footer-list__link:hover, .post_mod-a .entry-date, .post_mod-c .entry-date, .panel-default .panel-title, .accordion .panel-heading .panel-active, .breadcrumb > li .icon, .list-courses__number, .list-categories__link:hover .list-categories__name, .list-categories__link:hover .list-categories__number, .list-courses__meta .icon, blockquote:before, .about__title strong, .reviews__text:before {
    color: #b92240;
}
.tweets__link {
    font-family: Montserrat , arial;
    font-size: 12px;
    color: #ffffff;
}
.list-clients__item:nth-child(1) img {
    border-bottom-color: #9c0939;
}
.list-clients__item:nth-child(2) img {
    border-bottom-color: #9c0838;
}
.list-clients__item:nth-child(3) img {
    border-bottom-color: #9c0838;
}
.post .entry-main {
    position: relative;
    border-top: 2px solid #b92240;
    cursor: default;
    transition: all 0.3s;
}
.section-progress {
    padding-top: 80px;
    padding-bottom: 100px;
    background: url(https://cdn2.hubspot.net/hubfs/2828691/bimbel%20online/asset-bg-3@3x.png);
    background-size: cover;
}
.section_mod-a {
    padding-bottom: 30px;
    background-color: #22919b;
}
.footer .form-control {
    margin-bottom: 8px;
    padding-top: 13px;
    padding-bottom: 12px;
    border-color: #e6ebf1;
    background-color: #e6ebf1;
}
.wrap-title-page {
    position: relative;
    padding-top: 40px;
    padding-bottom: 70px;
    background-color: #22919b;
}
.post .entry-hover {
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(67, 158, 166, 0.84);
    opacity: 0;
    transition: all 0.3s;
    text-align: center;
}
.post .entry-main {
    position: relative;
    border-top: 2px solid #439ea5;
    cursor: default;
    transition: all 0.3s;
}
.find-course_mod-a .form-group:after, .staff:hover .staff__inner, .post:hover .entry-main, .nav-tabs > li {
    border-top-color: #439EA0;
}
.wrap-breadcrumb {
    margin-top: -20px;
    margin-bottom: 0;
    padding: 21px 40px 20px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    background-color: #155253;
    list-style: none;
}
.breadcrumb > li {
    font-family: 'Open Sans';
    font-weight: 400;
    text-transform: uppercase;
    color: #ffffff;
    font-size: 11px;
    display: inline-block;
}

.jelect-current {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
    padding: 2px 21px 0px 0px;
    overflow-wrap: normal;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: #fff;
    font-size: 11px;
    font-family: "Open Sans";
    text-transform: uppercase;
}
.bg-color_primary, .btn-header, .btn-primary, .find-course__title, .find-course .form-group {
    background-color: #27cbbd;
}
.btn-primary {
    box-shadow: 0 4px 0 0 #009286;
}
.btn-primary, .header.sticky .navbar, .staff .social-links li > a:hover {
    border-color: #27cbbd;
}
.btn-primary:after {
    background-color: #145253;
}
.widget_courses {
    border-top-color: #439ea6;
}
.widget_categories {
    border-top-color: #439ea6;
}
.list-collapse {
    margin-top: 23px;
    margin-bottom: 50px;
    border-top: 3px solid #439da6;
}
.list-collapse__inner .icon {
    padding-right: 16px;
    font-size: 16px;
    color: #439da6;
}
ul.nav.navbar-nav {
    padding-top: 10px;
}
</style>

<!-- Loader -->
<div id="page-preloader"><span class="spinner"></span></div>
<!-- Loader end -->

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
                <a href="{{route('member.subscription')}}">EBOOK</a>
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
                    <li><a href="{{route('member.subscription')}}"><button class="btn btn-effect btn-info btn-buy" style="background: #b92240; margin-top: -10px;">BUY</button></a></li>
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
