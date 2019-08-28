@extends('member-v2.layouts.main')
@section('title')
    Explore
    @parent
@stop

@section('styles')
<link rel="stylesheet" href="{{asset('assetsebook/v2/css/style.css')}}">
@stop

@section('style_class')bit-bg4 @stop

@section('content')
<div class="bg-1 col-12 d-flex justify-content-center" style="position: absolute; height: 50vh;">
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
							<img src="http://demo.viewpreview.online/assets/img/bookmark-green.png" class="float-right d-block">
							<h3>Menjadi Seorang Trader Forex</h3>
							<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
						</div>
					</div>
				</div>
        @foreach($books as $book)
				@if(!$book->access)
				<div class="d-flex align-items-center">
					<img src="http://demo.viewpreview.online/assets/img/star.png" class="img-fluid mr-3">
					<span>{{ ucwords($book->title) }}</span><button class="btn btn-purple px-5 ml-3" onclick="selectedSubscription('{{$book}}')">BUY</button>
				</div>
				@endif
				<hr>
        <div class="row mb-5">
        @foreach($book->bookEbooks as $ebook)
					@if(!$book->access)
          <a href="#" class="col-lg-3 mb-3 hover">
						<div class="shadow rounded p-3" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
							<div style="overflow: hidden;" class="mb-2">
								@if(count($ebook->book->imageBooks) > 0)
								<img src="{{asset($ebook->book->imageBooks[0]->image->src)}}" class="img-fluid w-100">
								@else
								<img src="{{asset('assetsebook/v2/img/logo-white.png')}}" class="img-fluid w-100">
								@endif
							</div>
							<span style="font-size: 20px; font-weight: bold;">{{ $ebook->book->title }}</span><br>
							<span>{{ $ebook->book->article }}</span>
						</div>
					</a>
					@else
					<a href="{{route('chapter.list', ['id' => $ebook->id])}}" class="col-lg-3 mb-3 hover">
						<div class="shadow rounded p-3" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
							<div style="overflow: hidden;" class="mb-2">
								@if(count($ebook->book->imageBooks) > 0)
								<img src="{{asset($ebook->book->imageBooks[0]->image->src)}}" class="img-fluid w-100">
								@else
								<img src="{{asset('assetsebook/v2/img/logo-white.png')}}" class="img-fluid w-100">
								@endif
							</div>
							<span style="font-size: 20px; font-weight: bold;">{{ $ebook->book->title }}</span><br>
							<span>{{ $ebook->book->article }}</span>
						</div>
					</a>
					@endif
        @endforeach
        </div>
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
					  <div class="form-group">
					    <label for="exampleInputEmail1">Referral <small class="text-danger">*</small></label>
							@if($username != '')
					    <input type="text" class="form-control" id="referralCode" aria-describedby="emailHelp" placeholder="Referral" required value="{{$username}}" readonly>
							@else
							<input type="text" class="form-control" id="referralCode" aria-describedby="emailHelp" placeholder="Referral" required>
							@endif
							<span class="text-white d-none" id="referralErrorMessage">Referral tidak ditemukan.</span>
					  </div>
						@if(!Auth::guard('nonmember')->user() && !Auth::guard('user')->user())
						<div class="form-group">
					    <label for="exampleInputPassword1">Username <small class="text-danger">*</small></label>
					    <input type="text" class="form-control" id="username" placeholder="Username" required>
							<span class="text-white d-none" id="usernameErrorMessage">Username telah dipakai.</span>
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
					  <span>Total yang dibayar : IDR </span><b><span id="total_price"></span></b>
		      </div>
		      <div class="modal-footer justify-content-center">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" onclick="submit()">Submit</button>
		      </div>
		    </div>
		  </div>
		</div>
	<!-- End Modal -->

<!-- <div class="bit-jumbo"></div>
<div class="container mb50" style="padding-left: 5%; padding-right: 5%;">
<div class="row mt50">
    <div class="col-md-12">
      <div class="card noborder" style="margin-top: -230px;">
          <div class="card-body">
            <div class="media row">
                <div class="media-left col-lg-4 col-sm-5 col-12 mb-4">
                  <img src="{{asset('assetsebook/assets/img/illustration.png')}}" class="img-fluid media-object mx-auto d-block">
                </div>
                <div class="media-body m30 col-lg-7 col-sm-6 col-10" style="padding: 0px;">
                  <button class="btn btn-sm btn-warning bit-btn3">
                  FEATURED
                  </button>
                  <h5 class="media-heading fz20">Menjadi Seorang Web Developer</h5>
                  <p class="fz14">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                  <hr>
                  <div class="float-right">
                      <button class="btn btn-md btn-warning bit-btn5">
                      Mulai Belajar
                      </button>
                  </div>
                </div>
            </div>
          </div>
      </div>

      <div class="bit-line">
          <img src="{{asset('assetsebook/assets/img/book-icon.png')}}" class="mtmin5 mr10"> <span>Semua Pelajaran</span>
          <hr class="mb40">
          <div class="row">
            @foreach($books as $book)
            <div class="col-lg-3 col-sm-6 col-6">
                <div class="card bit-card2 shadow-sb">
                  <div class="card-body d-flex flex-column">
                    <a href="{{route('chapter.list', ['id' => $book->id])}}">
                      <img src="{{asset('assetsebook/assets/img/illustration7.png')}}" class="img-fluid media-object mx-auto d-block">
                        <h5 class="media-heading fz20 mt20 text-dark">{{ $book->title }}</h5>
                        <p class="fz14 text-dark">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore ab quas atque, vero ipsa odio quod quia, dolor pariatur exercitationem aperiam soluta.</p>
                    </a>

                  </div>
                </div>
            </div>
            @endforeach
          </div>
      </div>
    </div>
</div> -->
@stop

@section('footer_scripts')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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

	$('#total_price').html(toIDR(data.price))
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
				$('#usernameErrorMessage').removeClass('d-none')
				return false
			}

			$('#usernameErrorMessage').addClass('d-none')
			//window.location.reload()
		},
		error: function(err) {
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
				$('#referralErrorMessage').removeClass('d-none')
				return false
			}

			$('#referralErrorMessage').addClass('d-none')

			//alert(message)
			//window.location.reload()
		},
		error: function(err) {
			console.log(err)
		}});
}

function submit() {
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
		return false;
	}

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
	$.ajax({
		url: "{{ route('member.register-v2') }}",
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
				alert('Failed Regiester')
				return false
			}

			alert('Success register')
			
			if(auth != '') {
				window.location.href = '{{ route("member.home") }}'
			} else {
				window.location.href = '{{ route("member.login") }}'
			}
		},
		error: function(err) {
			console.log(err)
			alert('Failed Register')
		}});
}
</script>
@stop