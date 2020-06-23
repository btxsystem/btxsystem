@extends('member-v2.layouts.main')
@section('title')
    Explore
    @parent
@stop

@section('styles')
<link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css" />
<link rel="stylesheet" href="{{asset('assetsebook/v2/css/style.css')}}">

<style>
.text-bold {
	font-weight:bold !important;
}
</style>
@stop

@section('style_class')bit-bg4 @stop

@section('content')
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
<div class="col-12 d-flex justify-content-center" style="position: absolute; height: 50vh;background-color:#ffb320;">
</div>
	<div class="col-lg-12 pb-3">
		@include('member-v2.partials.navbar-detail')
		<div class="detail-padding">
			<div class="container">
				<div class="bg-white shadow rounded p-3 mb-5">
					<div class="row">
						<div class="col-lg-4 pb-sm">
							<img src="{{asset($books[0]->src)}}" class="w-100">
						</div>
						<div class="col-lg-8">
							<!-- <img src="http://demo.viewpreview.online/assets/img/bookmark-green.png" class="float-right d-block"> -->
							<h3>{{ ucwords($books[0]->title) }}</h3>
							<span>{!! $books[0]->description !!}</span>
						</div>
					</div>
				</div>
        @foreach($books as $book)
				<div class="d-flex align-items-center">
					<!-- <img src="http://demo.viewpreview.online/assets/img/star.png" class="img-fluid mr-3"> -->
					<span class="text-bold">{{ ucwords($book->title) }} Module</span>
					@if($access == null)
					<button class="btn btn-identity-red text-white px-5 ml-3" onclick="selectedSubscription(JSON.stringify({'price': '{{$book->price}}', 'price_markup': '{{$book->price_markup}}', 'id': '{{$book->id}}'}))">BUY</button>
					@endif
				</div>
				<hr>
        <div class="row mb-5">
        @foreach($book->bookEbooks as $ebook)
				@if($access == null)
          <div class="col-lg-3 mb-3 hover">
						<div class="shadow rounded p-3">
							<div style="overflow: hidden;" class="mb-2">
								@if(count($ebook->book->imageBooks) > 0)
								<img style="height: 200px; object-fit: cover;" src="{{asset($ebook->book->imageBooks[0]->image->src)}}" class="img-fluid w-100">
								@else
								<img src="{{asset('assetsebook/v2/img/logo-white.png')}}" class="img-fluid w-100">
								@endif
							</div>
							<span style="font-size: 20px; font-weight: bold;">{{ $ebook->book->title }}</span><br>
						</div>
					</div>
					@else
					<a href="{{route('book.detail', ['slug' => $ebook->book->slug])}}" class="col-lg-3 mb-3 hover">
						<div class="shadow rounded p-3" >
							<div style="overflow: hidden;" class="mb-2">
								@if(count($ebook->book->imageBooks) > 0)
								<img style="height: 200px; object-fit: cover;" src="{{asset($ebook->book->imageBooks[0]->image->src)}}" class="img-fluid w-100">
								@else
								<img src="{{asset('assetsebook/v2/img/logo-white.png')}}" class="img-fluid w-100">
								@endif
							</div>
							<span style="font-size: 20px; font-weight: bold;">{{ $ebook->book->title }}</span><br>
						</div>
					</a>
					@endif
        @endforeach
        </div>
				@if($access != null)
				<div class="d-flex align-items-center">
					<!-- <img src="http://demo.viewpreview.online/assets/img/star.png" class="img-fluid mr-3"> -->
					<span class="text-bold">{{ ucwords($book->title) }} Videos</span>
				</div>
				<hr>
				<div class="row mb-5">
				@if($book->id == 1)
				
				@elseif($book->id == 2)
				
				@endif
				{{-- @foreach($book->videoEbooks as $video)
					@if(count($video->videos) > 0)
          <div class="col-lg-4 mb-3 hover">
						<div class="embed-responsive embed-responsive-16by9">
							<video controls>
								<source src="{{$video->videos[0]->path_url}}" type="video/mp4">
							Your browser does not support the video tag.
							</video>
						</div><br/>
						<span style="font-size: 20px; font-weight: bold;">{{ $video->videos[0]->title }}</span>
					</div>
					@endif
				@endforeach --}}
					
				</div>
					<div class="d-flex flex-row flex-wrap">
						@foreach($book->videoEbooks as $video)
						@if(count($video->videos) > 0)
						<div style="width: 25%;height:200px" class="mb-5">
							<div class="p-2">
								<video id="player" playsinline controls src="{{$video->videos[0]->path_url}}">
									<source src="{{$video->videos[0]->path_url}}" type="video/mp4" />
								</video>
								<span style="font-size: 20px; font-weight: bold;">{{ $video->videos[0]->title }}</span>
							</div>
						</div>
						@endif
						@endforeach
					</div>
				@endif
        @endforeach
				<!-- <div class="d-flex align-items-center">
					<img src="http://demo.viewpreview.online/assets/img/book-icon.png" class="img-fluid mr-2" style="height: 20px;">
					<span>Advanced</span><button class="btn btn-purple px-5 ml-3" data-toggle="modal" data-target="#exampleModal">BUY</button>
				</div>
				<hr>
				<div class="row mb-3">
					<a href="#" class="col-lg-3 mb-3 hover">
						<div class="shadow rounded p-3" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
							<div style="overflow: hidden;" class="mb-2">
								<img src="http://demo.viewpreview.online/assets/img/illustration9.png" class="img-fluid w-100">
							</div>
							<span style="font-size: 20px; font-weight: bold;">Membangun Aplikasi iOS</span><br>
							<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua.</span>
						</div>
					</a>
				</div> -->
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="modal-subscription" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content bg-1 text-white">
		      <div class="modal-body">
		      	<img src="{{asset('assetsebook/v2/img/logo-white.png')}}" class="img-fluid mb-3 mx-auto d-block" style="width: 130px;">
						<input type="hidden" id="ebook">
						<input type="hidden" id="income">
						@if(!Auth::guard('user')->user())
					  <div class="form-group">
					    <label for="exampleInputEmail1">Referral <small class="text-danger">*</small></label>
							@if($username != '')
					    <input type="text" class="form-control" id="referralCode" aria-describedby="emailHelp" placeholder="Referral" required value="{{$username}}" readonly>
							@else
							<input type="text" class="form-control" id="referralCode" aria-describedby="emailHelp" placeholder="Referral" required>
							@endif
							<span class="text-danger d-none" id="referralErrorMessage">Referral tidak ditemukan.</span>
							<span class="text-success d-none" id="referralSuccessMessage">Referral dapat digunakan.</span>
					  </div>
						@endif
						@if(!Auth::guard('nonmember')->user() && !Auth::guard('user')->user())
						<div class="form-group">
					    <label for="exampleInputPassword1">Username <small class="text-danger">*</small></label>
					    <input type="text" class="form-control" id="username" placeholder="Username" required>
							<span class="text-danger d-none" id="usernameErrorMessage">Username tidak dapat digunakan.</span>
							<span class="text-success d-none" id="usernameSuccessMessage">Username dapat digunakan.</span>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">First Name <small class="text-danger">*</small></label>
					    <input type="text" class="form-control" id="firstName" placeholder="First Name" required>
					  </div>
						<div class="form-group">
					    <label for="exampleInputPassword1">Last Name <small class="text-danger">*</small></label>
					    <input type="text" class="form-control" id="lastName" placeholder="Last Name " required>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Email <small class="text-danger">*</small></label>
					    <input type="email" class="form-control" id="email" placeholder="Email" required>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Phone Number <small class="text-danger">*</small></label>
					    <input type="number" class="form-control" id="phoneNumber" placeholder="Phone number" required>
					  </div>
						@endif
						<div class="form-group">
							<!-- <div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="payment_method" id="transfer" value="transfer" checked>
								<label class="form-check-label" for="inlineRadio1">Transfer</label>
							</div> -->
							<!-- <div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="payment_method" id="ipay" value="ipay" checked>
								<label class="form-check-label" for="inlineRadio1">VA & OVO</label>
							</div> -->
							<div class="form-check form-check-inline">
								<!-- <input class="form-check-input" type="radio" name="payment_method" id="transfer" value="transfer" checked>
								<label class="form-check-label" for="inlineRadio1">Transfer</label> -->
								<input class="form-check-input" type="radio" name="payment_method" id="va-bca" value="va-bca" checked>
								<label class="form-check-label" for="inlineRadio1">BCA VA</label>
							</div>
					  </div>
					  <h4>Total yang dibayar : IDR </span><b><span id="total_price"></h4></b>
		      </div>
		      <div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-identity-red" id="submit-va">Submit</button>
		        <button type="button" class="btn btn-identity-red" onclick="submit()" id="submit-nonva">Submit</button>
				<a href="#" id="payment-bca" style="cursor:pointer; display:none;" class="btn btn-identity-red"></a>
		      </div>
		    </div>
		  </div>
		</div>
	<!-- End Modal -->
	<form action="{{route('payment')}}" method="post" id="submitPayment">
		{{csrf_field()}}
		<input type="hidden" name="transactionRef" id="transactionRef">
		<input type="hidden" name="payment_method" id="payment_method_selected">
		<input type="hidden" name="ebook" id="transactionEbook">
	</form>

@stop

@section('footer_scripts')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset('assetsebook/js/helper.js')}}"></script>
<script src="{{asset('assets2/js/moment.js')}}"></script>
<script src="https://cdn.plyr.io/3.6.2/plyr.polyfilled.js"></script>
<script src="https://cdn.jsdelivr.net/hls.js/latest/hls.js"></script>
<script>

const players = Array.from(document.querySelectorAll('#player')).map(p => {
	if (Hls.isSupported()) {
    var hls = new Hls();

		hls.loadSource(p.getAttribute('src'));
    hls.attachMedia(p);
    hls.on(Hls.Events.MANIFEST_PARSED,function() {
      p.play();
    });
		console.log('p',p)
  }
	new Plyr(p, {
		controls: [
			'play-large', 
			'play', 
			'progress', 
			'current-time', 
			'mute', 
			'volume', 
			'captions', 
			'settings', 
			'fullscreen'
		]
	})
});
$('#submit-va').hide();
$('#submit-nonva').show();

</script>

<script>
let auth = "{{Auth::guard('nonmember')->user() || Auth::guard('user')->user()}}";

$('#username').on('change', function() {
	checkUsername()
})


$('#va-bca').change(function(){
	$('#submit-nonva').hide();
	$('#submit-va').show();
})

$('#transfer').change(function(){
	$('#submit-va').hide();
	$('#submit-nonva').show();
})

$('#ipay').change(function(){
	$('#submit-va').hide();
	$('#submit-nonva').show();
})

<?php if(!Auth::guard('nonmember')->user() && !Auth::guard('user')->user()){?>
	$('#submit-va').click(function(){
	var $this = $(this);
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
	$.ajax({
		url: "{{ route('member.register-new') }}",
		method: 'post',
		data: {
				referralCode: $('#referralCode').val(),
				lastName: $('#lastName').val(),
				firstName: $('#firstName').val(),
				email: $('#email').val(),
				phoneNumber: $('#phoneNumber').val(),
				ebook: $('#ebook').val(),
				username: $('#username').val(),
				income: $('#income').val()
		},
		success: function(result){
			console.log(result)

			const {message, success} = result

			if(!success) {
				swal("Fail", "Cant't Register", "error");
				$('#register').prop('disabled', false)
				return false
			}

			var loadingText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
			if ($this.html() !== loadingText) {
				$this.data('original-text', $this.html());
				$this.hide();
				$('#payment-bca').html(loadingText);
				$('#payment-bca').show();
			}
			setTimeout(function() {
				$this.html($this.data('original-text'));
				$('#payment-bca').hide();
				$this.show();
			}, 100000);

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			});
			$.ajax({
				type: 'POST',
				url: '{{route("member.buy-ebook")}}',
				data: {ebook_id: $('#ebook').val(), non_member_id: result.data.id},
				success: function (data) {

					$('#va').val(data.customer_number);
					$('#des_noreq').text('Masukkan '+data.customer_number+' sebagai rekening tujuan');
					$('#des_noreq2').text('Masukkan '+data.customer_number+' sebagai rekening tujuan');
					$('#des_noreq3').text('Masukkan '+data.customer_number+' sebagai rekening tujuan');
								$('#ammount_bca').text('Nominal transaksi : '+data.total_amount+' (Include fee)');
								$('#time-expired').text('Transfer Sebelum '+moment(data.time_expired).format('D MMMM Y - HH:mm'));
					$('#no-virtual').modal('show');
					$('#modal-subscription').modal('hide');

				},
				error: function() {
					console.log("Error");
				}
			});
		},
		error: function(err) {
			console.log(err)
			$('#register').prop('disabled', false)
			alert('Failed Register')
		}});
})
<?php } else { ?>
	$('#submit-va').click(function(){
	var $this = $(this);
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
	var loadingText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
	if ($this.html() !== loadingText) {
		$this.data('original-text', $this.html());
		$this.hide();
		$('#payment-bca').html(loadingText);
		$('#payment-bca').show();
	}
	setTimeout(function() {
		$this.html($this.data('original-text'));
		$('#payment-bca').hide();
		$this.show();
	}, 100000);

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
	$.ajax({
		type: 'POST',
		url: '{{route("member.buy-ebook")}}',
		data: {ebook_id: $('#ebook').val()},
		success: function (data) {

			$('#va').val(data.customer_number);
			$('#des_noreq').text('Masukkan '+data.customer_number+' sebagai rekening tujuan');
			$('#des_noreq2').text('Masukkan '+data.customer_number+' sebagai rekening tujuan');
			$('#des_noreq3').text('Masukkan '+data.customer_number+' sebagai rekening tujuan');
						$('#ammount_bca').text('Nominal transaksi : '+data.total_amount+' (Include fee)');
						$('#time-expired').text('Transfer Sebelum '+moment(data.time_expired).format('D MMMM Y - HH:mm'));
			$('#no-virtual').modal('show');
			$('#modal-subscription').modal('hide');

		},
		error: function() {
			console.log("Error");
		}
	});
})
<?php } ?>

$('#referralCode').on('change', function() {
	checkReferral()
})

function selectedSubscription(param) {
  $('#modal-subscription').modal('show')

  const data = JSON.parse(param)

	<?php if(Auth::guard('user')->user()){?>
		$('#total_price').html(toIDR(data.price))
	<?php } else {?>
		$('#total_price').html(toIDR(parseInt(data.price) + parseInt(data.price_markup)))
	<?php } ?>
	$('#ebook').val(data.id)
	$('#income').val(data.price_markup)
}
function checkUsername () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
	$.ajax({
		url: '{{ route("member.check-username") }}?username=' + $('#username').val(),
		method: 'get',
		success: function(result){
			console.log(result)

			const {message, success} = result

			if(!success) {
				//alert(message)
				$('#username').val('')
				$('#usernameSuccessMessage').addClass('d-none')
				$('#usernameErrorMessage').removeClass('d-none')
				$('#username').addClass('is-valid')
				$('#username').addClass('is-invalid')
				return false
			}

			$('#usernameSuccessMessage').removeClass('d-none')
			$('#usernameErrorMessage').addClass('d-none')
			$('#username').removeClass('is-invalid')
			$('#username').addClass('is-valid')
			//window.location.reload()
		},
		error: function(err) {
			$('#usernameSuccessMessage').addClass('d-none')
			$('#usernameErrorMessage').removeClass('d-none')
			$('#username').addClass('is-valid')
			$('#username').addClass('is-invalid')
			console.log(err)
		}});
}


function checkReferral () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
	$.ajax({
		url: '{{ route("member.check-referral") }}?username=' + $('#referralCode').val(),
		method: 'get',
		success: function(result){
			console.log(result)

			const {message, success} = result

			if(!success) {
				//alert(message)
				$('#referralCode').val('')
				$('#referralSuccessMessage').addClass('d-none')
				$('#referralErrorMessage').removeClass('d-none')
				$('#referralCode').addClass('is-valid')
				$('#referralCode').addClass('is-invalid')
				return false
			}

			$('#referralSuccessMessage').removeClass('d-none')
			$('#referralErrorMessage').addClass('d-none')
			$('#referralCode').removeClass('is-invalid')
			$('#referralCode').addClass('is-valid')

			//alert(message)
			//window.location.reload()
		},
		error: function(err) {
			$('#referralSuccessMessage').addClass('d-none')
			$('#referralErrorMessage').removeClass('d-none')
			$('#referralCode').addClass('is-valid')
			$('#referralCode').addClass('is-invalid')
			$('#register').prop('disabled', true)
		}});
}

function submit() {
	$('#register').prop('disabled', true)
	let required = [
		{
			field: 'referralCode',
			message: 'Referral Code Required'
		},
		{
			field: 'username',
			message: 'Username Required'
		},
		{
			field: 'firstName',
			message: 'First Name Required'
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
		$('#register').prop('disabled', false)
		return false;
	}

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
	$.ajax({
		url: "{{ route('member.register-v3') }}",
		method: 'post',
		data: {
				referralCode: $('#referralCode').val(),
				lastName: $('#lastName').val(),
				firstName: $('#firstName').val(),
				email: $('#email').val(),
				phoneNumber: $('#phoneNumber').val(),
				ebook: $('#ebook').val(),
				username: $('#username').val(),
				income: $('#income').val()
		},
		success: function(result){
			console.log(result)

			const {message, success} = result

			if(!success) {
				swal("Fail", "Cant't Register", "error");
				$('#register').prop('disabled', false)
				return false
			}

			$('#payment_method_selected').val($("input[name='payment_method']:checked").val());

			$('#transactionRef').val(result.data.ref_no)
			$('#transactionEbook').val(result.data.ebook_id)
			$('#submitPayment').submit()

			// swal("Success", "Transaction Successfully", "success").then((value) => {
			// 	$('#transactionRef').val(result.data.transaction_ref)
			// 	$('#submitPayment').submit()
			// 	// if(auth != '') {
			// 	// 	window.location.href = '{{ route("payment") }}?transactionRef=' + result.data.transaction_ref
			// 	// } else {
			// 	// 	window.location.href = '{{ route("payment") }}?transactionRef=' + result.data.transaction_ref
			// 	// }
			// });
			//$('#register').prop('disabled', false)
		},
		error: function(err) {
			console.log(err)
			$('#register').prop('disabled', false)
			alert('Failed Register')
		}});
}

$('#copy').click(function(){
	var copyText = document.getElementById("va");
	var selection = document.getSelection();
	copyText.select();
	copyText.setSelectionRange(0, 99999);
	try {
			var success = document.execCommand('copy')
	} catch (error) {
			console.log(error)
	}
})

</script>
@stop
