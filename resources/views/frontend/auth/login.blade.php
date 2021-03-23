@include('frontend.auth.header')
<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="min-height: 200px;position:absolute;right:0;left:0;top:0">
<div role="alert" aria-live="assertive" aria-atomic="true" class="bg-white border" id="corona" data-autohide="false" style="width:400px;font-size:1.6rem;margin-top:100px;z-index:999!important;margin-right:120px">
  <div class="toast-header bg-light">
    <strong class="mr-auto">ANNOUNCEMENT</strong>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close" onclick="closeCorona()">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
    <a target="_blank" href="{{asset('assets3/Surat_Himbauan_Covid-19-revisi_2.pdf')}}">Corona Virus Update</a>
  </div>
  <div class="toast-body">
    <a target="_blank" href="{{asset('assets3/maintenance_announcement.pdf')}}">Update for Maintenance</a>
  </div>
</div>
</div>
    <div class="main-content">
      <div class="slide">
        <div class="imgSlide">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">

                <!-- slide-banner -->
                @if (count($data['hall_of_fame']) >= 0)
                <div class="col-lg-6 col-xs-12 slide-banner d-none">
                    <div class="body-banner">
                        <div class="owl-carousel" id="owl-banner">
                                @foreach ($data['hall_of_fame'] as $item)
                                    <div class="items">
                                        <div class="row">
                                            <div class="col-lg-5 col-xs-7 mb-sm-3">
                                            <img src="{{$item->member->src != null ?  asset($item->member->src) : url('/img/logo.png')}}" class="img-fluid">
                                            </div>
                                            <div class="col-lg-7 col-xs-12">
                                            <h3 class="mb-0">{{isset($item->member->rank->name) ? strtoupper(trans($item->member->rank->name)) : '-'}}</h3>
                                            {{$item->desc}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        </div>
                    </div>
                </div>
                @endif
                    <!-- endSlide-Banner -->
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

      <div class="section_mod-a" id="about">
        <div class="container">
          <div class="section_mod-a__inner">
            <div class="row">
              <div class="col-md-12">
                <section class="section-advantages wow bounceInLeft" data-wow-duration="1s" style="padding-bottom: 10px;">
                  <div class="row">
                  @if (count($data['hall_of_fame']) >= 0)
                <div class="col-lg-6 col-xs-12 d-none">
                    <div class="body-banner">
                        <div class="owl-carousel">
                                @foreach ($data['hall_of_fame'] as $item)
                                    <div class="items">
                                        <div class="row">
                                            <div class="col-lg-5 col-xs-7 mb-sm-3">
                                            <img src="{{$item->member->src != null ?  asset($item->member->src) : url('/img/logo.png')}}" class="img-fluid">
                                            </div>
                                            <div class="col-lg-7 col-xs-12">
                                            <h3 class="mb-0">{{isset($item->member->rank->name) ? strtoupper(trans($item->member->rank->name)) : '-'}}</h3>
                                            {{$item->desc}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        </div>
                    </div>
                </div>
                @endif
                  </div>
                  <h2 class="ui-title-block ui-title-block_mod-a">About Bitrexgo</h2>
                  <div class="ui-subtitle-block ui-subtitle-block_mod-a">Bitrexgo is one of the best learning platform for financial education in Indonesia.</div>
                  <ul class="advantages advantages_mod-a list-unstyled">
                    @if (count($data['about_us']) >= 0)
                        @foreach ($data['about_us'] as $item)
                            <li class="advantages__item"> <span class="advantages__icon"><i class="{{$item->img}}"></i></span>
                                <div class="advantages__inner">
                                    <h3 class="ui-title-inner decor decor_mod-a">{{$item->title}}</h3>
                                    <div class="advantages__info">
                                        <p>{{$item->desc}}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endif
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

      <section class="section-default" id="product">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div class="wrap-title">
                <h2 class="ui-title-block">Our <strong>Product</strong></h2>
              </div>
              <br>
              <div class="posts-wrap">
                @foreach ($data['ourProduct'] as $item)
                    <article class="post post_mod-a clearfix wow zoomIn" data-wow-duration="1s" style="width: 46%!important;">
                        <div class="entry-media">
                          <div class="entry-thumbnail"> <a href="javascript:void(0);" ><img class="img-responsive" src="{{$item->img}}" style="width: 100%;" alt="Foto"/></a> </div>
                        </div>
                        <div class="entry-main">
                          <h3 class="entry-title ui-title-inner decor decor_mod-b"><a href="javascript:void(0);">{{$item->title}}</a></h3>
                          <div class="entry-content hidden">
                            <p>{{$item->title}}</p>
                          </div>
                        </div>
                      </article>
                    <!-- end post -->
                @endforeach
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


      <section class="section-video wow fadeInUp hidden" data-wow-duration="1s">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div class="video-block"> <a class="video-block__link" href="https://www.youtube.com/watch?v=eaQ0x93SxGY" rel="prettyPhoto"><i class="icon stroke icon-Play"></i></a>
                <h2 class="video-block__title">Bitrexgo Video</h2>
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
              </div>
              <br>
              <div class="posts-wrap">
                @foreach ($data['ourHeadQuarter'] as $item)
                    <article class="post post_mod-b clearfix wow zoomIn" data-wow-duration="1s">
                        <div class="entry-media">
                            <div class="entry-thumbnail"> <a href="javascript:void(0);" ><img style="height:200px;object-fit:cover" class="img-responsive" src="{{$item->path}}" width="370" height="220" alt="Foto"/></a> </div>
                        </div>
                    </article>
                    <!-- end post -->
                @endforeach
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
      @if($data['video'])
        <section class="section-default">
            <div class="container">
            <div class="row">
                <div class="col-xs-12">
                <div class="wrap-title">
                    <h2 class="ui-title-block">Gallery <strong>Video</strong></h2>
                </div>
                <br>
                <div class="posts-wrap">
                    @foreach ($data['video'] as $video)
                        <article class="post post_mod-b clearfix wow zoomIn" data-wow-duration="1s">
                            <div class="entry-media">
                                <div class="entry-thumbnail"> <a href="javascript:void(0);" >
                                <iframe id="ytplayer" type="text/html"
                                    class="swiper-left"
                                    src="{{ $video->path}}"
                                    allowfullscreen="allowfullscreen"
                                    frameborder="0">
                                </iframe>
                                </a> </div>
                            </div>
                        </article>
                        <!-- end post -->
                    @endforeach
                </div>
                <!-- end posts-wrap -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
            </div>
            <!-- end container -->
        </section>
    @endif

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
              <div class="video-block"> <a class="video-block__link" href="https://www.youtube.com/watch?v=eaQ0x93SxGY" rel="prettyPhoto"><i class="icon stroke icon-Play"></i></a>
                <h2 class="video-block__title">Our Company</h2>
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
          <div class="border-decor_top col-lg-12">
            <div class="col-md-12">
              <section class="section-default wow bounceInLeft" data-wow-duration="1s">
                <h2 class="ui-title-block">Testimonials <strong></strong></h2>
                {{-- <div class="slider-reviews owl-carousel owl-theme owl-theme_mod-c enable-owl-carousel"
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
                  @if (count($data['testimoni']) >= 0)
                      @foreach ($data['testimoni'] as $item)
                          <div class="reviews">
                              <div class="reviews__text" style="text-align: justify;">{{$item->desc}}</div>
                              <span class="reviews_autor">-- {{$item->name}}</span> <span class="reviews_categories"></span>
                          </div>
                        <!-- end reviews -->
                      @endforeach
                  @endif
                  </div>
                </div> --}}
                <!-- end slider-reviews -->
                <div class="owl-carousel" id="owl-testi">
                  @if (count($data['testimoni']) >= 0)
                      @foreach ($data['testimoni'] as $item)
                          <div class="reviews">
                              <div class="reviews__text" style="text-align: justify;">{{$item->desc}}</div>
                              <span class="reviews_autor">-- {{$item->name}}</span> <span class="reviews_categories"></span>
                          </div>
                        <!-- end reviews -->
                      @endforeach
                  @endif
                </div>
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

<!-- Flexbox container for aligning the toasts -->
@include('frontend.auth.footer')
<script src="{{asset('assets2/js/moment.js')}}"></script>
<script src="{{asset('assets2/js/pages/forms/basic-form-elements.js')}}"></script>
<script src="{{asset('assets2/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->
<script>
  function closeCorona() {
    $('#corona').hide()
  }
  function toPrice(value) {
		return value.toString().replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1\.")
	}
  $(document).ready(function(){
    // $('.toast').toast('show')
    $('#owl-banner').owlCarousel({
      loop:true,
      margin:10,
      nav:false,
      responsiveClass:true,
      responsive:{
        0:{
            items:1,
        },
        600:{
            items:1,
        },
        1000:{
            items:1,
        }
      }
    })
    $('#owl-testi').owlCarousel({
      loop:true,
      margin:30,
      nav:true,
      dots:false,
      autoplay : true,
      responsiveClass:true,
      responsive:{
        0:{
          items:1,
          loop:true,
        },
        600:{
          items:1,
          loop:true,
        },
        1000:{
          items:1,
          loop:true,
        }
      }
    })
  });
</script>
<script>

  $("#product").click(function() {
    $('html, body').animate({
        scrollTop: $("#myProduct").offset().top - 100
    }, 1000);
  });

  <?php if(\Session::has('message_success') || \Session::has('message_failed')):?>
    $('html, body').animate({
        scrollTop: $("#contact-form").offset().top - 100
    }, 1000);
  <?php endif;?>

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

  $("#myAbout").click(function() {
    $('html, body').animate({
        scrollTop: $("#about").offset().top - 180
    }, 1000);
  });

  $("#myProduct").click(function() {
    $('html, body').animate({
        scrollTop: $("#product").offset().top - 180
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
  var check = 1;
  var adult = 0;

  function refreshEbook() {
    $.ajax({
      type: 'GET',
      url: '/api/ebook/ebooks'
    }).done(function(res) {
      const {data} = res
      priceEbook = 0
      let render = data.map((v, i) => {
        return `

        <input id="${v.title}" type="checkbox" value="${v.id}" id="${v.title}" class="with-gap radio-col-red" data-price="${v.price}" ${v.title == 'basic' ? 'checked' : ''} name="ebooks[]"/>
        <label for="shipping">${v.title}</label>
        `
    })
    $('#ebook-list').html(`
      <div id="data-ebooks">
        ${render}
      </div>
    `)

    $('#data-ebooks input[type=checkbox]').each(function() {
      if(parseInt($(this).val()) == 1) {
        $(this).prop('checked', true)
        priceEbook = priceEbook + parseInt($(this).data('price'))
        $('#cost-ebook').html(toPrice(priceEbook))
        $('#grand-total').html(toPrice((priceEbook + postalFee + 280000)))
      }
    });

    $('#data-ebooks input[type=checkbox]').change(function(index) {
        let ebookSelected = $('#data-ebooks input[type=checkbox]').filter(function() {
          return $(this).prop("checked")
        })
        n=ebookSelected.length; //Tambah value untuk stored temporary
			let cancelledEbook = false;


			if(n>=2){
				var r = confirm("Apakah Anda yakin membeli " + n +" ebook?");
				if (r == true) {

				} else {
					cancelledEbook = true
					$(this).prop("checked", false)
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
        }*/


        if($(this).prop('checked')) {
          check += 1;
          priceEbook = priceEbook + parseInt($(this).data('price'));
        } else {
          if(!cancelledEbook) {
            check -= 1;
            priceEbook = priceEbook - parseInt($(this).data('price'));
          }

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

        $('#cost-ebook').html(toPrice(priceEbook))
        $('#grand-total').html(toPrice((priceEbook + postalFee + 280000)))

        grandTotal = (priceEbook + postalFee + 280000);

        validasiForm()
      })
    })
  }

  let validasiForm = () => {
    console.log("$('#referal').val()", $('#referal').val())
    console.log("$('#firstName').val()", $('#firstName').val())
    console.log("$('#username').val()", $('#username').val())
    console.log("$('#passport').val()", $('#passport').val())
    console.log("$('#phone_number').val()", $('#phone_number').val())
    console.log("$('#account_name').val()", $('#account_name').val())
    console.log("$('#account_number').val()", $('#account_number').val())
    console.log("$('#birthdate').val()", $('#birthdate').val())
    console.log("$('#basic').val()", $('#basic').val())
    console.log("$('#advance').val()", $('#advance').val())
    console.log("$('#shipping').val()", $('#shipping').val())
    console.log("$('#term_one').val()", $('#term_one').val())
    console.log("$('#term_two').val()", $('#term_two').val())
    console.log("isset_referal", isset_referal)
    console.log("available_username", available_username)
    console.log("available_email", available_email)
    console.log("check_email", check_email)

    if(
      $('#referal').val() != '' &&
      $('#firstName').val() != '' &&
      $('#username').val() != '' &&
      $('#passport').val() != '' &&
      $('#phone_number').val() != '' &&
      $('#account_name').val() != '' &&
      $('#account_number').val() != '' &&
      adult >= 18 &&
      $('#birthdate').val() != '' &&
      ($('#basic').val() != '' || $('#advance').val() != '') &&
      ($('#pickup').val() != '' || $('#shipping').val() != '') &&
      isset_referal == true && available_username == true &&
      check_email == true && available_email == true &&
      parseInt($('#term_one').val()) == 1 && parseInt($('#term_two').val()) == 1
    ){
      $(".btn-join").attr("disabled", false);
    }else{
      $(".btn-join").attr("disabled", true);
    }
  }

  $('#birthdate').on('change', function() {
		var dob = new Date(this.value);
		var today = new Date();
		var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
		adult = age;
		if (age < 18) {
			$('#birthdate_danger').html('<p id="danger_" class="text-danger">Age must be more than 17 years</p>');
		}else{
			$('#danger_').empty();
		}
		validasiForm()
	});

  refreshEbook()

  $('#phone_number').on('input', function() {
    let str = this.value;
    this.value = (str.match(/[0-9]/g)) ? str.match(/[0-9]/g).join('') : '';
    validasiForm();
  })

  $('#term_one').change(function() {
    if($(this).prop('checked')) {
      $(this).val(1)
    } else {
      $(this).val(0)
    }
    validasiForm()
  })

  $('#term_two').change(function() {
    if($(this).prop('checked')) {
      $(this).val(1)
    } else {
      $(this).val(0)
    }
    validasiForm()
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
      url: '/validate-unique-email?email=' + this.value,
      success: function (data) {
        if (data.success) {
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
      url: '/validate-exist-user?username=' + this.value,
      success: function (data) {
        if(data.success) {
          isset_referal = true
        } else {
          isset_referal = false
        }

        validasiForm();

        data.success ? $(".alert-referal").html("<span style=color:green>Sponsor tersedia</span>") : $(".alert-referal").html("<span style=color:red>Sponsor tidak tersedia</span>");
      },
      error: function() {
        console.log("Error");
      }
    });

  })

  $("#username").keyup(function(){
    $.ajax({
      type: 'GET',
      url: '/validate-unique-user?username=' + this.value,
      success: function (data) {
        if(!data.success) {
          available_username = true
        } else {
          available_username = false
        }

        !data.success ? $(".alert-username").html("<span style=color:green>Username dapat digunakan</span>") : $(".alert-username").html("<span style=color:red>Username tidak dapat digunakan</span>");
      },
      error: function() {
        console.log("Error");
      }
    });
    validasiForm();
  })
</script>
