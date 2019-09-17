
    <footer class="footer wow fadeInUp" data-wow-duration="1s">
      <div class="container">
        <div class="footer-inner border-decor_top">
          <div class="row">
            <div class="col-lg-3 col-sm-3">
              <section class="footer-section">
                <div class="footer-info" style="text-align: justify;font-weight: bold;margin-bottom: 10px;">PT. BITREXGO SOLUSI PRIMA</div>
                <div class="footer-contacts footer-contacts_mod-a"> <i class="icon stroke icon-Pointer"></i>
                  <address class="footer-contacts__inner">
                  B-G 168, Jl. Pluit Indah Raya, Pluit, Penjaringan, North Jakarta City, Jakarta 14450
                  </address>
                </div>
                <div class="footer-contacts"> <i class="icon stroke icon-Phone2"></i> <span class="footer-contacts__inner">+62 817-0380-0329, (021) 80823903</span> </div>
                <div class="footer-contacts"> <i class="icon stroke icon-Mail"></i> <a class="footer-contacts__inner" href="mailto:Info@academica.com">cs@bitrexgo.co.id</a> </div>
                <div class="footer-contacts">© 2019 BITREXGO. All Rights Reserved</div>
              </section>
              <!-- end footer-section -->
            </div>
            <!-- end col -->

            <div class="col-lg-2 col-sm-3">
              <section class="footer-section">
                <!-- <h3 class="footer-title">NAVIGATION</h3>
                <ul class="footer-list list-unstyled">
                  <li class="footer-list__item"><a class="footer-list__link" href="javascript:void(0);">Event & Promotion</a></li>
                  <li class="footer-list__item"><a class="footer-list__link" href="javascript:void(0);">Gallery</a></li>
                  <li class="footer-list__item"><a class="footer-list__link" href="javascript:void(0);">About Us</a></li>
                  <li class="footer-list__item"><a class="footer-list__link" href="javascript:void(0);">Testimony</a></li>
                  <li class="footer-list__item"><a class="footer-list__link" href="javascript:void(0);">Contact Us</a></li>
                  <li class="footer-list__item"><a class="footer-list__link" href="javascript:void(0);">Login</a></li>
                </ul> -->
              </section>
              <!-- end footer-section -->
            </div>
            <!-- end col -->

            <div class="col-lg-3 col-sm-3">
              <!-- <section class="footer-section">
                <h3 class="footer-title">RECENT EVENTS & PROMOTION</h3>
                <div class="tweets">
                  <div class="tweets__text">Go-Trip Korea 2019</div>
                  <div><a href="javascript:void(0);">https://bitrexgo.co.id/hVl5G</a></div>
                  <span class="tweets__time">on Agust 21, 2019</span> </div>
                <div class="tweets">
                  <div class="tweets__text">Go-Cruise Singapore 2019<br><a href="javascript:void(0);">https://bitrexgo.co.id/IMDS15</a></div>
                  <span class="tweets__time">on June 30, 2019</span> </div>
                <a class="tweets__link" href="javascript:void(0);">Get Information @Bitrexgo</a> </section> -->
              <!-- end footer-section -->
            </div>
            <!-- end col -->

            <div class="col-lg-4 col-sm-3">
              <section class="footer-section">
                <h3 class="footer-title">OUR CONTACT</h3>
                <form class="form">
                  <div class="form-group">
                    <input class="form-control" type="text" placeholder="Your Name">
                    <input class="form-control" type="email" placeholder="Email address">
                    <textarea class="form-control" rows="7" placeholder="Message"></textarea>
                    <button class="btn" style="background-color: #b92240; border-radius: 5px;">SEND MESSSAGE</button>
                  </div>
                </form>
              </section>
              <!-- end footer-section -->
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
        </div>
        <!-- end footer-inner -->

        <!-- <div class="row">
          <div class="col-xs-12">
            <div class="footer-bottom" style="font-size: 10px;">

              FULL RISK DISCLOSURE: Trading contains substantial risk and is not for every investor. An investor could potentially lose all or more than the initial investment. Risk capital is money that can be lost without jeopardizing financial security or life style. Only risk capital should be used for trading and only those with sufficient risk capital should consider trading. Past performance is no guarantee of future results.

            </div>
          </div>
        </div> -->
        <!-- end row -->
      </div>
      <!-- end container -->
    </footer>
  </div>
  <!-- end wrapper -->
</div>
<!-- end layout-theme -->
</div>
<!-- SCRIPTS -->
<script src="{{asset('assets3/js/jquery-migrate-1.2.1.js')}}"></script>
<script src="{{asset('assets3/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets3/js/modernizr.custom.js')}}"></script>
<script src="{{asset('assets3/js/waypoints.min.js')}}"></script>
<script src="{{asset('assets3/js/jquery.easing.min.js')}}"></script>

<!--THEME-->
<script src="{{asset('assets3/js/jquery.sliderPro.min.js')}}"></script>
<script src="{{asset('assets3/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets3/js/jquery.isotope.min.js')}}"></script>
<script src="{{asset('assets3/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('assets3/js/jquery.datetimepicker.js')}}"></script>
<script src="{{asset('assets3/js/jquery.jelect.js')}}"></script>
<script src="{{asset('assets3/js/jquery.easypiechart.min.js')}}"></script>
<script src="{{asset('assets3/js/cssua.min.js')}}"></script>
<script src="{{asset('assets3/js/wow.min.js')}}"></script>
<script src="{{asset('assets3/js/custom.min.js')}}"></script>

<!--COLOR SWITCHER -->
<script src="{{asset('assets3/js/bootstrap-select.js')}}"></script>
<script src="{{asset('assets3/js/dmss.js')}}"></script>
<script type="text/javascript" src="http://localhost:8000/assets2/js/select2.js" ></script>
<script>
	$(document).ready(function() {
    $('#shipping-form').hide();
    $('#pickup-form').hide();
		// var element = document.querySelector('#bah');
		// $('#upline').hide();
		// panzoom(element);
		$('#province').select2({
			placeholder: 'Province',
		});
		$('#province').html('<option disabled>Province<option>');
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
			placeholder: 'Subistrict',
		});
		$('#kurir').select2({
			placeholder: 'Kurir',
		});
	});

	$('#search-downline').click(function(){
		let data = $('.search').val();
		$.ajax({
			type: 'GET',
			url: '/member/select/search-downline/'+data,
			success: function (data) {
				console.log(data);

			},
			error: function() {
				console.log("Error");
			}
		});
	});

	$('#province').change(function(){
		let id = this.value;
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
	})

	$('#city').change(function(){
		let id = this.value;
		$('#district').empty().trigger('change');
		$('#kurir').empty().trigger('change');
		$('#district').html('<option disabled>Subdistrict<option>');
		$.ajax({
			type: 'GET',
			url: '/member/shipping/subdistrict/'+id,
			success: function (data) {
				$('#district').select2({
					placeholder: 'Subdistrict',
					data: data,
				});
			},
			error: function() {
				console.log("Error");
			}
		});
	})

	$('#district').change(function() {
		let id = this.value;
		$('#kurir').empty().trigger('change');
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
	});

	$('#kurir').change(function(){
		$('.cost-form').show();
		$('#cost').val(Math.ceil(this.value/1000) + ' Points');
	});

	$('#shipping').change(function(){
    $('#shipping-form').show();
    $('#pickup-form').hide();
		$('#province').prop('required',true);
		$('#city').prop('required',true);
	});

	$('#pickup').change(function(){
    $('#shipping-form').hide();
    $('#pickup-form').show();
  });

  $('#starterpack').change(function(){
		$('#choosepack').val(0)
	});

	$('#starterpackebook').change(function(){
		$('#choosepack').val(1)
	});
</script>
</body>
</html>
