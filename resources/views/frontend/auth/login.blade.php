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
                      <input class="form-control" type="text" name="username" placeholder="Username">
                      <input class="form-control" type="password" name="password"  placeholder="Password">
                      <div class="" style="color:red;">
                          
                      </div>
                    </div>
                    <div class="find-course__wrap-btn">
                      <button type="submit" class="btn btn-effect btn-info">SUBMIT</button>
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

      <div class="section_mod-a">
        <div class="container">
          <div class="section_mod-a__inner">
            <div class="row">
              <div class="col-md-12">
                <section class="section-advantages wow bounceInLeft" data-wow-duration="1s" style="padding-bottom: 10px;">
                  <h2 class="ui-title-block ui-title-block_mod-a">About Bitrexgo</h2>
                  <div class="ui-subtitle-block ui-subtitle-block_mod-a">Bitrexgo is one of the best education platform for Foreign Exchange Trading in Indonesia.</div>
                  <ul class="advantages advantages_mod-a list-unstyled">
                    <li class="advantages__item"> <span class="advantages__icon"><i class="icon stroke icon-Cup"></i></span>
                      <div class="advantages__inner">
                        <h3 class="ui-title-inner decor decor_mod-a">Bitrexgo</h3>
                        <div class="advantages__info">
                          <p>We are one of the best Education Platform for Foreign Exchange Trading in Indonesia.</p>
                        </div>
                      </div>
                    </li>
                    <li class="advantages__item"> <span class="advantages__icon"><i class="icon stroke icon-DesktopMonitor"></i></span>
                      <div class="advantages__inner">
                        <h3 class="ui-title-inner decor decor_mod-a">Vision</h3>
                        <div class="advantages__info">
                          <p>Educate and empower people to become Smart Traders.</p>
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
                        <h3 class="ui-title-inner decor decor_mod-a">Mission</h3>
                        <div class="advantages__info">
                          <p>Revolutionize the Financial Educational Industry, with Bitrexgo as the vehicle which will bring people to change their lives, and the lives of others.</p>
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

      <section class="section-default">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div class="wrap-title">
                <h2 class="ui-title-block">Our <strong>Product</strong></h2>
                <div class="ui-subtitle-block ui-subtitle-block_mod-b">Bitrexgo is one of the best education platform for Foreign Exchange Trading in Indonesia.</div>
              </div>
              <div class="posts-wrap">
                <article class="post post_mod-a clearfix wow zoomIn" data-wow-duration="1s">
                  <div class="entry-media">
                    <div class="entry-thumbnail"> <a href="javascript:void(0);" ><img class="img-responsive" src="{{asset('img/1.jpg')}}" style="width: 100%;" alt="Foto"/></a> </div>
                  </div>
                  <div class="entry-main">
                    <h3 class="entry-title ui-title-inner decor decor_mod-b"><a href="javascript:void(0);">Basic to Advanced Financial Education</a></h3>
                    <div class="entry-content">
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
                    <h3 class="entry-title ui-title-inner decor decor_mod-b"><a href="javascript:void(0);">Education Videos</a></h3>
                    <div class="entry-content">
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
                    <h3 class="entry-title ui-title-inner decor decor_mod-b"><a href="javascript:void(0);">Online & Offline Class</a></h3>
                    <div class="entry-content">
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
                    <div class="entry-content">
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

      <section class="section-video wow fadeInUp" data-wow-duration="1s">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div class="video-block"> <a class="video-block__link" href="https://www.youtube.com/watch?v=wh6lxMpffCo" rel="prettyPhoto"><i class="icon stroke icon-Play"></i></a>
                <h2 class="video-block__title">Bitrexgo Video</h2>
                <div class="video-block__subtitle">Bitrexgo is one of the best education platform for Foreign Exchange Trading in Indonesia.</div>
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
                <div class="ui-subtitle-block ui-subtitle-block_mod-b">Bitrexgo is one of the best education platform for Foreign Exchange Trading in Indonesia.</div>
              </div>
              <div class="posts-wrap">
                <article class="post post_mod-b clearfix wow zoomIn" data-wow-duration="1s">
                  <div class="entry-media">
                    <div class="entry-thumbnail"> <a href="javascript:void(0);" ><img class="img-responsive" src="https://bitrexgo.co.id/assets1/images/pic1.jpg" width="370" height="220" alt="Foto"/></a> </div>
                  </div>
                </article>
                <!-- end post -->

                <article class="post post_mod-b clearfix wow zoomIn" data-wow-duration="1s" data-wow-delay=".5s">
                  <div class="entry-media">
                    <div class="entry-thumbnail"> <a href="javascript:void(0);" ><img class="img-responsive" src="https://bitrexgo.co.id/assets1/images/service-0.png" width="370" height="220" alt="Foto"/></a> </div>
                  </div>
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

      <section class="section-default" style="background: #22919b;margin-top: 0px;margin-bottom: 0px;padding-top: 70px;padding-bottom: 50px;">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div class="wrap-title">
                <h2 class="ui-title-block" style="color: #FFF;">Event <strong>Promotion</strong></h2>
                <div class="ui-subtitle-block ui-subtitle-block_mod-b" style="color: #FFF;">Bitrexgo is one of the best education platform for Foreign Exchange Trading in Indonesia.</div>
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
                <div class="video-block__subtitle">Bitrexgo is one of the best education platform for Foreign Exchange Trading in Indonesia.</div>
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
                  <div class="subscribe__description">Bitrexgo is one of the best education for Foreign Exchange Trading.</div>
                </div>
              </div>
              <!-- end col -->
              <div class="col-sm-6">
                <!-- <form class="subscribe__form" action="get"> -->
                  <!-- <input class="subscribe__input form-control" type="text" placeholder="Your Email address ..."> -->
                  <button class="subscribe__btn btn btn-success btn-effect" data-toggle="modal" data-target="#testimony" style="width: 200px;margin-right: 80px;margin-top: 20px;">Submit</button>
                <!-- </form> -->
                <!-- Modal -->
                <div class="modal fade" id="testimony" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Submit Testimony</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <input class="form-control" type="text" placeholder="Nama">
                        <input class="form-control" type="text" placeholder="Email">
                        <input class="form-control" type="text" placeholder="Your Testimony Here..." style="height: 200px;">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success">Send Testimony</button>
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

      <div class="container">
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

      <div class="container">
        <div class="row">
          <div class="border-decor_top">
            <div class="col-md-12">
              <section class="section-default wow bounceInLeft" data-wow-duration="1s">
                <h2 class="ui-title-block">What <strong>Students Say</strong></h2>
                <div class="slider-reviews owl-carousel owl-theme owl-theme_mod-c enable-owl-carousel"
                        data-single-item="true"
                        data-auto-play="7000"
                        data-navigation="true"
                        data-pagination="false"
                        data-transition-style="fade"
                        data-main-text-animation="true"
                        data-after-init-delay="4000"
                        data-after-move-delay="2000"
                        data-stop-on-hover="true">
                  <div class="reviews">
                    <div class="reviews__text" style="text-align: justify;">I am very satisfied with the Web, make it easier to me to know about Trading and made me want to learn more, I am very satisfied with the Web, make it easier to me to know about Trading and made me want to learn more, I am very satisfied with the Web, make it easier to me to know about Trading and made me want to learn more. Thank you </div>
                    <span class="reviews__autor">-- Den Nie Sularso</span> <span class="reviews__categories"></span> </div>
                  <!-- end reviews -->

                  <div class="reviews">
                    <div class="reviews__text" style="text-align: justify;">Great Web and interesting, making me instantly memorized and remember it. I so want to know more about trading on this web, Great Web and interesting, making me instantly memorized and remember it. I so want to know more about trading on this web, Great Web and interesting, making me instantly memorized and remember it. I so want to know more about trading on this web.</div>
                    <span class="reviews__autor">-- Felio Wijoyo</span> <span class="reviews__categories"></span> </div>
                  <!-- end reviews -->

                  <div class="reviews">
                    <div class="reviews__text" style="text-align: justify;">Web content in an attractive and transparent, making people ask questions and want to learn about the trading. could try I am interested, Web content in an attractive and transparent, making people ask questions and want to learn about the trading. could try I am interested, Web content in an attractive and transparent.</div>
                    <span class="reviews__autor">-- Anastasia Mirna</span> <span class="reviews__categories"></span> </div>
                  <!-- end reviews -->
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
