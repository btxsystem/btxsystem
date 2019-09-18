@extends('member-v2.layouts.main')
@section('title')
    Explore
    @parent
@stop

@section('styles')
<link rel="stylesheet" href="{{asset('assetsebook/v2/css/style.css')}}">
<style>
.text-bold {
	font-weight:bold !important;
}
</style>
@stop

@section('style_class')bit-bg4 @stop

@section('content')
<div class="col-12 d-flex justify-content-center" style="position: absolute; height: 50vh;background-color:#ffb320;">
</div>
	<div class="col-lg-12 pb-3">
		@include('member-v2.partials.navbar-detail')
		<div class="detail-padding">
			<div class="container">
				<div class="bg-white shadow rounded p-3 mb-5">
					<div class="row">
						<div class="col-lg-4 pb-sm">
							<img src="http://demo.viewpreview.online/assets/img/illustration6.png" class="w-100">
						</div>
						<div class="col-lg-8">
							<!-- <img src="http://demo.viewpreview.online/assets/img/bookmark-green.png" class="float-right d-block"> -->
							<h3>Menjadi Seorang Trader Forex</h3>
							<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
						</div>
					</div>
				</div>
        @foreach($books as $book)
				<div class="d-flex align-items-center">
					<!-- <img src="http://demo.viewpreview.online/assets/img/star.png" class="img-fluid mr-3"> -->
					<span class="text-bold">{{ ucwords($book->title) }} Module</span>
					@if(!$book->access)
					<button class="btn btn-identity-red text-white px-5 ml-3" onclick="selectedSubscription(JSON.stringify({'price': '{{$book->price}}', 'price_markup': '{{$book->price_markup}}', 'id': '{{$book->id}}'}))">BUY</button>
					@endif
				</div>
				<hr>
        <div class="row mb-5">
        @foreach($book->bookEbooks as $ebook)
					@if(!$book->access)
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
				@if($book->access)
				<div class="d-flex align-items-center">
					<!-- <img src="http://demo.viewpreview.online/assets/img/star.png" class="img-fluid mr-3"> -->
					<span class="text-bold">{{ ucwords($book->title) }} Videos</span>
				</div>
				<hr>
				<div class="row mb-5">
        @foreach($book->videoEbooks as $video)
          <div class="col-lg-4 mb-3 hover">
						<div class="embed-responsive embed-responsive-16by9">
							<video controls>
								<source src="{{$video->videos[0]->path_url}}" type="video/mp4">
							Your browser does not support the video tag.
							</video>
						</div><br/>
						<span style="font-size: 20px; font-weight: bold;">{{ $video->videos[0]->title }}</span>
					</div>
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
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="payment_method" id="payment_method" value="transfer" checked>
								<label class="form-check-label" for="inlineRadio1">Transfer</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="payment_method" id="payment_method" value="ipay">
								<label class="form-check-label" for="inlineRadio1">VA / OVO</label>
							</div>
					  </div>
					  <h4>Total yang dibayar : IDR </span><b><span id="total_price"></h4></b>
		      </div>
		      <div class="modal-footer justify-content-center">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-identity-red" onclick="submit()" id="register">Submit</button>
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
<script>
let auth = "{{Auth::guard('nonmember')->user() || Auth::guard('user')->user()}}"
$('#username').on('change', function() {
	checkUsername()
})

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
</script>
@stop