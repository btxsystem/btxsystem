@include('frontend.auth.header')
    <div class="main-content">

      <div class="slide">
        <div class="imgSlide">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <section class="find-course find-course_mod-a wow bounceInRight colFormSignup" style="visibility: visible; animation-duration: 1s; animation-name: bounceInRight;">
                  <h2 class="find-course__title"><i class="icon stroke icon-User"></i>Login</h2>
                  <form class="find-course__form" action="/login" method="post">
                    @csrf
                    <div class="form-group">
                      <input class="form-control" type="text" name="username" placeholder="Username / Email">
                      <input class="form-control" type="password" name="password"  placeholder="Password">
                      <div class="col-sm-7"></div>
                      <div class="col-sm-5"><a href="#" data-toggle="modal" data-target="#forgot-password" style="cursor:pointer"><b>Forgot password? </b></a></div>
                    </div>
                    <div class="find-course__wrap-btn">
                      <button type="submit" class="btn btn-effect btn-info" >SUBMIT</button>
                    </div>
                  </form>
                </section>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>

      <!-- end main-slider -->

      <div class="section_mod-a" id="myAbout">
        <div class="container">
          <div class="section_mod-a__inner">
            <div class="row">
              <div class="col-md-12">
                <section class="section-advantages wow bounceInLeft" data-wow-duration="1s" style="padding-bottom: 10px;">
                  <h2 class="ui-title-block ui-title-block_mod-a">About Bitrexgo</h2>
                  <div class="ui-subtitle-block ui-subtitle-block_mod-a">Bitrexgo is one of the best learning platform for financial education in Indonesia.</div>
                  <ul class="advantages advantages_mod-a list-unstyled">
                    <li class="advantages__item"> <span class="advantages__icon"><i class="icon stroke icon-Cup"></i></span>
                      <div class="advantages__inner">
                        <h3 class="ui-title-inner decor decor_mod-a">Bitrexgo</h3>
                        <div class="advantages__info">
                          <p>We are one of the best learning platform for financial education in Indonesia.</p>
                        </div>
                      </div>
                    </li>
                    <li class="advantages__item"> <span class="advantages__icon"><i class="icon stroke icon-DesktopMonitor"></i></span>
                      <div class="advantages__inner">
                        <h3 class="ui-title-inner decor decor_mod-a">Vision</h3>
                        <div class="advantages__info">
                          <p>Educate and empower people to become financially smart.</p>
                        </div>
                      </div>
                    </li>
                    <li class="advantages__item"> <span class="advantages__icon"><i class="icon stroke icon-WorldGlobe"></i></span>
                      <div class="advantages__inner">
                        <h3 class="ui-title-inner decor decor_mod-a">Mission</h3>
                        <div class="advantages__info">
                          <p>Revolutionize the Financial Educational Industry, with Bitrexgo as the vehicle which will bring people to change their lives, and the lives of others.</p>
                        </div>
                      </div>
                    </li>
                    <li class="advantages__item"> <span class="advantages__icon"><i class="icon stroke icon-Users"></i></span>
                      <div class="advantages__inner">
                        <h3 class="ui-title-inner decor decor_mod-a">Leader</h3>
                        <div class="advantages__info">
                          <p>We create a leader with wisdom, great vision, and high integrity.</p>
                        </div>
                      </div>
                    </li>
                  </ul>
                </section>
              </div>
              <!-- end col -->
              <!-- <div class="col-md-4">
                <section class="find-course find-course_mod-a wow bounceInRight" data-wow-duration="1s">
                  <h2 class="find-course__title"><i class="icon stroke icon-User"></i>Login</h2>
                  <form class="find-course__form" action="get">
                    <div class="form-group">
                      <input class="form-control" type="text" placeholder="Email">
                      <input class="form-control" type="text" placeholder="Password">
                      <input class="form-control" type="text" placeholder="Phone">
                      <input class="form-control" type="text" placeholder="Email">

                    </div>

                    <div class="find-course__wrap-btn">
                      <button class="btn btn-effect btn-info">SUBMIT</button>
                    </div>
                  </form>
                </section>
              </div> -->
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- end section_mod-a__inner -->
        </div>
        <!-- end container -->
      </div>
      <!-- end section_mod-a -->

      <section class="section-default" id="myProduct">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div class="wrap-title">
                <h2 class="ui-title-block">Our <strong>Product</strong></h2>
                <!-- <div class="ui-subtitle-block ui-subtitle-block_mod-b">Bitrexgo is one of the best education platform for Foreign Exchange Trading in Indonesia.</div> -->
              </div>
              <div class="posts-wrap">
                <article class="post post_mod-a clearfix wow zoomIn" data-wow-duration="1s">
                  <div class="entry-media">
                    <div class="entry-thumbnail"> <a href="javascript:void(0);" ><img class="img-responsive" src="{{asset('img/1.jpg')}}" style="width: 100%;" alt="Foto"/></a> </div>
                  </div>
                  <div class="entry-main">
                    <h3 class="entry-title ui-title-inner decor decor_mod-b"><a href="javascript:void(0);">Basic to Advanced Financial Education</a></h3>
                    <div class="entry-content hidden">
                      <p>Bitrexgo is one of the best education platform for Foreign Exchange Trading in Indonesia</p>
                    </div>
                  </div>
                </article>
                <!-- end post -->
                <article class="post post_mod-a clearfix wow zoomIn" data-wow-duration="1s" data-wow-delay=".5s">
                  <div class="entry-media">
                    <div class="entry-thumbnail"> <a href="javascript:void(0);" ><img class="img-responsive" src="{{asset('img/2.jpg')}}" style="width: 100%;" width="250" height="250" alt="Foto"/></a> </div>
                  </div>
                  <div class="entry-main">
                    <h3 class="entry-title ui-title-inner decor decor_mod-b"><a href="javascript:void(0);">Education Videos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></h3>
                    <div class="entry-content hidden">
                      <p>Bitrexgo is one of the best education platform for Foreign Exchange Trading in Indonesia</p>
                    </div>
                  </div>
                </article>
                <!-- end post -->
                <article class="post post_mod-a clearfix wow zoomIn" data-wow-duration="1s" data-wow-delay="1s">
                  <div class="entry-media">
                    <div class="entry-thumbnail"> <a href="javascript:void(0);" ><img class="img-responsive" src="{{asset('img/3.jpg')}}" style="width: 100%;" width="250" height="250" alt="Foto"/></a> </div>
                  </div>
                  <div class="entry-main">
                    <h3 class="entry-title ui-title-inner decor decor_mod-b"><a href="javascript:void(0);">Online & Offline Learning</a></h3>
                    <div class="entry-content hidden">
                      <p>Bitrexgo is one of the best education platform for Foreign Exchange Trading in Indonesia</p>
                    </div>
                  </div>
                </article>
                <!-- end post -->
                <article class="post post_mod-a clearfix wow zoomIn" data-wow-duration="1s" data-wow-delay="1.5s">
                  <div class="entry-media">
                    <div class="entry-thumbnail"> <a href="javascript:void(0);" ><img class="img-responsive" src="{{asset('img/4.jpg')}}" style="width: 100%;" width="250" height="250" alt="Foto"/></a> </div>
                  </div>
                  <div class="entry-main">
                    <h3 class="entry-title ui-title-inner decor decor_mod-b"><a href="javascript:void(0);">Smart Financial Community</a></h3>
                    <div class="entry-content hidden">
                      <p>Bitrexgo is one of the best education platform for Foreign Exchange Trading in Indonesia</p>
                    </div>
                  </div>
                </article>
                <!-- end post -->
              </div>
              <!-- end posts-wrap -->
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
        </div>
        <!-- end container -->
      </section>
      <!-- end section-default -->

      <!-- <div class="section-progress wow fadeInUp section-parallax"  data-speed="25"  data-wow-duration="1s">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <ul class="list-progress list-unstyled" style="font-size: 30px;margin-top: -45px;">
                <br>The forex market is the largest and most liquid market in the world. With a daily volume over $4 trillion.
              </ul>
            </div>
          </div>
        </div>
      </div> -->

      <section class="section-video wow fadeInUp hidden" data-wow-duration="1s">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div class="video-block"> <a class="video-block__link" href="https://www.youtube.com/watch?v=wh6lxMpffCo" rel="prettyPhoto"><i class="icon stroke icon-Play"></i></a>
                <h2 class="video-block__title">Bitrexgo Video</h2>
                <!-- <div class="video-block__subtitle">Bitrexgo is one of the best education platform for Foreign Exchange Trading in Indonesia.</div> -->
              </div>
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
        </div>
        <!-- end container -->
      </section>

      <!-- end section-video -->
      <section class="section-video wow fadeInUp" data-wow-duration="1s">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div class="video-block">
                <!-- <h2 class="video-block__title">Bitrexgo Video</h2> -->
                <div class="video-block__subtitle" style="font-size:20px;font-weight:bold">“ PT. Bitrexgo Solusi Prima adalah perusahaan penjualan langsung murni yang hanya menjual produk berupa e-book dan menjalankan usahanya sesuai dengan ketentuan pada PERMENDAG No. 32 tahun 2008. PT. Bitrexgo Solusi Prima tidak menjual produk investasi dan software robot investasi. Segala pernyataan di media yang menyebutkan PT. Bitrexgo Solusi Prima menjual produk investasi dan software robot adalah bukan dari PT. Bitrexgo Solusi Prima dan Perusahaan tidak bertanggung jawab atas klaim dan pernyataan yang bukan resmi berasal dari Perusahaan. ”</div>
              </div>
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
        </div>
        <!-- end container -->
      </section>
      <!-- end section-video -->

      <section class="section-default">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div class="wrap-title">
                <h2 class="ui-title-block">Our <strong>Headquarter</strong></h2>
                <!-- <div class="ui-subtitle-block ui-subtitle-block_mod-b">Bitrexgo is one of the best education platform for Foreign Exchange Trading in Indonesia.</div> -->
              </div>
              <div class="posts-wrap">
                <article class="post post_mod-b clearfix wow zoomIn" data-wow-duration="1s">
                  <div class="entry-media">
                    <div class="entry-thumbnail"> <a href="javascript:void(0);" ><img style="height:200px;object-fit:cover" class="img-responsive" src="{{asset('img/hq1.jpg')}}" width="370" height="220" alt="Foto"/></a> </div>
                  </div>
                </article>
                <!-- end post -->

                <article class="post post_mod-b clearfix wow zoomIn" data-wow-duration="1s" data-wow-delay=".5s">
                  <div class="entry-media">
                    <div class="entry-thumbnail"> <a href="javascript:void(0);" ><img style="height:200px;object-fit:cover" class="img-responsive" src="{{asset('img/hq2.jpg')}}" width="370" height="220" alt="Foto"/></a> </div>
                  </div>
                </article>
                <!-- end post -->

                <article class="post post_mod-b clearfix wow zoomIn" data-wow-duration="1s" data-wow-delay="1s">
                  <div class="entry-media">
                    <div class="entry-thumbnail"> <a href="javascript:void(0);" ><img style="height:200px;object-fit:cover" class="img-responsive" src="{{asset('img/hq3.jpg')}}" width="370" height="220" alt="Foto"/></a> </div>
                  </div>
                </article>
                <!-- end post -->
              </div>
              <!-- end posts-wrap -->
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
        </div>
        <!-- end container -->
      </section>
      <!-- end section-default -->

      <!-- end section-video -->
      <section class="section-ui wow fadeInUp" data-wow-duration="1s">
        <div class="container">
          <div class="row">
            <div class="col-xs-15">
                <div class="ui-ktp" style="font-size:20px;font-weight:bold"> ANNOUNCEMENT </div>
                <div class="ui-ktp" style="font-size:20px;font-weight:bold"> PT BITREXGO SOLUSI PRIMA HANYA AKAN MEMBERIKAN 1 HAK USAHA UNTUK 1 KTP KEPADA SELURUH MEMBER TANPA KECUALI </div>
                <div class="ui-ktp" style="font-size:20px;font-weight:bold"> 1 KTP BERLAKU UNTUK 1 HAK USAHA </div><br>
                <div class="entry-thumbnail"><img class="ui-ktp" src="{{asset('img/KTP.png')}}" width="270" height="250" alt="Foto"/></a> </div>
              </div>
            <!-- end col -->
          </div>
          <!-- end row -->
        </div>
        <!-- end container -->
      </section>
      <!-- end section-video -->


      <section class="section-default hidden" id="myEvent" style="background: #22919b;margin-top: 0px;margin-bottom: 0px;padding-top: 70px;padding-bottom: 50px;">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div class="wrap-title">
                <h2 class="ui-title-block" style="color: #FFF;">Event <strong>Promotion</strong></h2>
                <!-- <div class="ui-subtitle-block ui-subtitle-block_mod-b" style="color: #FFF;">Bitrexgo is one of the best education platform for Foreign Exchange Trading in Indonesia.</div> -->
              </div>
              <div class="posts-wrap">
                <article class="post post_mod-b clearfix wow zoomIn" data-wow-duration="1s">
                  <div class="entry-media">
                    <div class="entry-thumbnail"> <a href="javascript:void(0);" ><img class="img-responsive" src="https://bitrexgo.co.id/assets1/images/pic1.jpg" width="370" height="220" alt="Foto"/></a> </div>
                  </div>
                </article>
                <!-- end post -->

                <article class="post post_mod-b clearfix wow zoomIn" data-wow-duration="1s" data-wow-delay=".5s" style="background: none;text-align: center;">
                  <div class="entry-media">
                    <div class="entry-thumbnail"> <a href="javascript:void(0);" ><img class="img-responsive" src="https://bitrexgo.co.id/assets1/images/service-0.png" width="370" height="220" alt="Foto"/></a> </div>
                  </div>
                  <button class="btn btn-effect btn-info" style="background: #b92240;margin-top: 22px;">See More</button>
                </article>
                <!-- end post -->

                <article class="post post_mod-b clearfix wow zoomIn" data-wow-duration="1s" data-wow-delay="1s">
                  <div class="entry-media">
                    <div class="entry-thumbnail"> <a href="javascript:void(0);" ><img class="img-responsive" src="https://bitrexgo.co.id/assets1/images/pic1.jpg" width="370" height="220" alt="Foto"/></a> </div>
                  </div>
                </article>
                <!-- end post -->
              </div>
              <!-- end posts-wrap -->
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
        </div>
        <!-- end container -->
      </section>
      <!-- end section-default -->

      <section class="section-video wow fadeInUp" data-wow-duration="1s">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div class="video-block"> <a class="video-block__link" href="https://www.youtube.com/watch?v=wh6lxMpffCo" rel="prettyPhoto"><i class="icon stroke icon-Play"></i></a>
                <h2 class="video-block__title">Bitrexgo Slide</h2>
                <!-- <div class="video-block__subtitle">Bitrexgo is one of the best education platform for Foreign Exchange Trading in Indonesia.</div> -->
              </div>
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
        </div>
        <!-- end container -->
      </section>
      <!-- end section-video -->

      <section class="section-subscribe wow fadeInUp" data-wow-duration="1s">
        <div class="subscribe">
          <div class="container">
            <div class="row">
              <div class="col-sm-6">
                <div class="subscribe__icon-wrap"> <i class="icon_bg stroke icon-Imbox"></i><i class="icon stroke icon-Imbox"></i> </div>
                <div class="subscribe__inner">
                  <h2 class="subscribe__title">SUBMIT TESTIMONY FOR BITREXGO</h2>
                  <!-- <div class="subscribe__description">Bitrexgo is one of the best education for Foreign Exchange Trading.</div> -->
                </div>
              </div>
              <!-- end col -->
              <div class="col-sm-6">
                <!-- <form class="subscribe__form" action="get"> -->
                  <!-- <input class="subscribe__input form-control" type="text" placeholder="Your Email address ..."> -->
                <div class="btnBook">
                  <button class="subscribe__btn btn btn-effect" data-toggle="modal" data-target="#testimony" style="width: 200px;margin-right: 80px;margin-top: 20px; color: #fff;">Submit</button>
                </div>
                <!-- </form> -->
                <!-- Modal -->
                <div class="modal fade" id="testimony" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <b style="font-size: 16px;" class="modal-title" id="exampleModalLabel">Submit Testimony</b>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="height: auto;">
                        <input class="form-control" type="text" id="name_testi" name="name_testi" placeholder="Name">
                        <input class="form-control" type="text" id="email_testi" name="email_testi" placeholder="Email">
                        <textarea class="form-control" id="testimoni" name="testimoni" placeholder="Your Testimony Here..." style="min-width: 100%; max-width: 100%; min-height: 150px; max-height: 150px;"></textarea>
                      </div>
                      <div class="modal-footer">
                        <button onclick="submit_testimoni()" type="button" class="btn" style="border-radius: 5px; background-color: #b92240; color: #fff;">Send Testimony</button>
                        <button type="button" class="btn" style="border-radius: 5px; background-color: orange; color: #fff; margin-top: -5px;" data-dismiss="modal">Close</button>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- end container -->
        </div>
      </section>
      <!-- end section-subscribe -->

      <div class="container hidden">
        <div class="row">
          <div class="border-decor_top">

            <div class="col-md-12">
              <section class="section-default wow bounceInRight" data-wow-duration="1s">
                <h2 class="ui-title-block">Our <strong>Team</strong></h2>
                <div class="row">
                  <div class="col-lg-3">
                    <img class="img-responsive" src="https://bitrexgo.co.id/assets1/images/gallery/5.jpg" height="100" width="200" alt="Partners" style="width: 100%; margin-bottom: 20px;">
                  </div>
                  <div class="col-lg-3">
                    <img class="img-responsive" src="https://bitrexgo.co.id/assets1/images/gallery/5.jpg" height="100" width="200" alt="Partners" style="width: 100%; margin-bottom: 20px;">
                  </div>
                  <div class="col-lg-3">
                    <img class="img-responsive" src="https://bitrexgo.co.id/assets1/images/gallery/11.jpg" height="100" width="200" alt="Partners" style="width: 100%; margin-bottom: 20px;">
                  </div>
                  <div class="col-lg-3">
                    <img class="img-responsive" src="https://bitrexgo.co.id/assets1/images/gallery/11.jpg" height="100" width="200" alt="Partners" style="width: 100%; margin-bottom: 20px;">
                  </div>
                </div>
                <!-- <ul class="list-clients list-unstyled clearfix">
                  <li class="list-clients__item" style="width: 25%"><img class="img-responsive" src="https://bitrexgo.co.id/assets1/images/gallery/5.jpg" height="100" width="200" alt="Partners"></li>
                  <li class="list-clients__item" style="width: 25%"><img class="img-responsive" src="https://bitrexgo.co.id/assets1/images/gallery/5.jpg" height="100" width="200" alt="Partners"></li>
                  <li class="list-clients__item" style="width: 25%"><img class="img-responsive" src="https://bitrexgo.co.id/assets1/images/gallery/11.jpg" height="100" width="200" alt="Partners"></li>
                  <li class="list-clients__item" style="width: 25%"><img class="img-responsive" src="https://bitrexgo.co.id/assets1/images/gallery/11.jpg" height="100" width="200" alt="Partners"></li>
                </ul> -->
                <!-- end accordion -->
              </section>
            </div>
            <!-- end col -->
          </div>
          <!-- end section-default -->
        </div>
        <!-- end row -->
      </div>

      <!-- end container -->
      <div class="container hidden">
        <div class="row">
          <div class="border-decor_top">

            <div class="col-md-12">
              <section class="section-default wow bounceInRight" data-wow-duration="1s">
                <h2 class="ui-title-block">Our <strong>Facility</strong></h2>
                <div class="row">
                  <div class="col-lg-3">
                    <img class="img-responsive" src="https://www.bitrexgo.co.id/assets/img/training-center.jpg" height="100" width="200" alt="Partners" style="width: 100%; margin-bottom: 20px;">
                  </div>
                  <div class="col-lg-3">
                    <img class="img-responsive" src="https://www.bitrexgo.co.id/assets/img/robot-expert-advisor.png" height="100" width="200" alt="Partners" style="width: 100%; margin-bottom: 20px;">
                  </div>
                  <div class="col-lg-3">
                    <img class="img-responsive" src="https://www.bitrexgo.co.id/assets/img/market-analysis.jpg" height="100" width="200" alt="Partners" style="width: 100%; margin-bottom: 20px;">
                  </div>
                  <div class="col-lg-3">
                    <img class="img-responsive" src="https://www.bitrexgo.co.id/assets/img/trading-community.png" height="100" width="200" alt="Partners" style="width: 100%; margin-bottom: 20px;">
                  </div>
                </div>
                <!-- <ul class="list-clients list-unstyled clearfix">
                  <li class="list-clients__item" style="width: 25%"><img class="img-responsive" src="https://bitrexgo.co.id/assets1/images/gallery/5.jpg" height="100" width="200" alt="Partners"></li>
                  <li class="list-clients__item" style="width: 25%"><img class="img-responsive" src="https://bitrexgo.co.id/assets1/images/gallery/5.jpg" height="100" width="200" alt="Partners"></li>
                  <li class="list-clients__item" style="width: 25%"><img class="img-responsive" src="https://bitrexgo.co.id/assets1/images/gallery/11.jpg" height="100" width="200" alt="Partners"></li>
                  <li class="list-clients__item" style="width: 25%"><img class="img-responsive" src="https://bitrexgo.co.id/assets1/images/gallery/11.jpg" height="100" width="200" alt="Partners"></li>
                </ul> -->
                <!-- end accordion -->
              </section>
            </div>
            <!-- end col -->
          </div>
          <!-- end section-default -->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->

      <div class="container">
        <div class="row">
          <div class="border-decor_top">
            <div class="col-md-12">
              <section class="section-default wow bounceInLeft" data-wow-duration="1s">
                <h2 class="ui-title-block">Testimonials <strong></strong></h2>
                <div class="slider-reviews owl-carousel owl-theme owl-theme_mod-c enable-owl-carousel"
                name="testimoni-word"
                        data-single-item="true"
                        data-auto-play="7000"
                        data-navigation="true"
                        data-pagination="false"
                        data-transition-style="fade"
                        data-main-text-animation="true"
                        data-after-init-delay="4000"
                        data-after-move-delay="2000"
                        data-stop-on-hover="true">
                        @if (count($testimoni) >= 0)
                            @foreach ($testimoni as $item)
                                <div class="reviews">
                                    <div class="reviews__text" style="text-align: justify;">{{$item->desc}}</div>
                                    <span class="reviews_autor">-- {{$item->name}}</span> <span class="reviews_categories"></span>
                                </div>
                              <!-- end reviews -->
                            @endforeach
                        @endif

                        </div>
                </div>
                <!-- end slider-reviews -->
              </section>
              <!-- end section-default -->
            </div>
            <!-- end col -->


            <!-- end col -->
          </div>
          <!-- end section-default -->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->

    </div>
    <!-- end main-content -->


@include('frontend.auth.footer')
<script src="{{asset('assets2/js/moment.js')}}"></script>
<script src="{{asset('assets2/js/pages/forms/basic-form-elements.js')}}"></script>
<script src="{{asset('assets2/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
<script>

  $("#product").click(function() {
    $('html, body').animate({
        scrollTop: $("#myProduct").offset().top - 100
    }, 1000);
  });

  let submit_testimoni = () => {
        $.ajax({
            url: "{{ route('member.testimonial.store') }}",
            type: 'POST',
            data: {
                    _token: "{{ csrf_token() }}",
                    email: $('#name_testi').val(),
                    name: $('#name_testi').val(),
                    desc: $('#testimoni').val(),
                  },
            dataType: 'JSON',
            success: function (data) {
                if (data.success) {
                    swal({
                        title: "Success",
                        text: "Data has saved!",
                        icon: "success",
                        button: "ok",
                    },function() {
                        location.reload();
                    });
                }else{
                    swal({
                        title: "Error",
                        text: "Data can't save!",
                        icon: "error",
                        button: "ok",
                    },function() {
                        location.reload();
                    });
                }
            },error: function(response) {
                swal({
                    title: "Oops",
                    text: "Name and description are required!",
                    icon: "warning",
                    button: "ok",
                },function() {
                    location.reload();
                })
            }

        });
  }

  $("#about").click(function() {
    $('html, body').animate({
        scrollTop: $("#myAbout").offset().top - 180
    }, 1000);
  });

  $("#event").click(function() {
    $('html, body').animate({
        scrollTop: $("#myEvent").offset().top - 130
    }, 1000);
  });

  let isset_referal = false;
  let available_username = false;
  let available_email = false;
  let check_email = false;

  let validasiForm = () => {
    if(
      $('#referal').val() != '' &&
      $('#firstName').val() != '' &&
      $('#username').val() != '' &&
      $('#passport').val() != '' &&
      $('#phone_number').val() != '' &&
      $('#account_name').val() != '' &&
      $('#account_nnumber').val() != '' &&
      $('#birthdate').val() != '' &&
      ($('#basic').val() != '' || $('#advance').val() != '') &&
      ($('#pickup').val() != '' || $('#shipping').val() != '') &&
      isset_referal == true && available_username == true &&
      check_email == true && available_email == true &&
      $('#term_one').val( )== '' && $('#term_two').val() == ''
    ){
      $(".btn-join").attr("disabled", false);
    }else{
      $(".btn-join").attr("disabled", true);
    }
  }

  $('#phone_number').on('input', function() {
		let str = this.value;
		this.value = (str.match(/[0-9]/g)) ? str.match(/[0-9]/g).join('') : '';
		validasiForm();
	})

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
			url: '/email/'+this.value,
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
		validasiForm();
	});

  $("#referal").keyup(function(){
    $.ajax({
			type: 'GET',
			url: '/user/'+this.value,
			success: function (data) {
        data.referal ? $(".alert-referal").html("<span style=color:green>Sponsor tersedia</span>") : $(".alert-referal").html("<span style=color:red>Sponsor tidak tersedia</span>");
      },
			error: function() {
				console.log("Error");
			}
		});
    validasiForm();
  })

  $("#username").keyup(function(){
    $.ajax({
			type: 'GET',
			url: '/user/'+this.value,
			success: function (data) {
        data.username ? $(".alert-username").html("<span style=color:green>Username dapat digunakan</span>") : $(".alert-username").html("<span style=color:red>Username tidak dapat digunakan</span>");
      },
			error: function() {
				console.log("Error");
			}
		});
    validasiForm();
  })
</script>
