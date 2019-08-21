@extends('member-v2.layouts.main')
@section('title')
    Explore
    @parent
@stop

@section('styles')
<link rel="stylesheet" href="{{asset('assetsebook/v2/css/style.css')}}">
@stop

@section('style_class')bg-1 @stop

@section('content')
<div class="col-12 d-flex justify-content-center" style="position: absolute; z-index: 1030;">
		<div class="col-lg-2 col-6 py-3">
			<img src="{{asset('assetsebook/v2/img/logo-white.png')}}" class="mx-auto d-block img-fluid logo">
		</div>
	</div>

	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="max-height: 655px; overflow: hidden;">
	  <div class="carousel-inner" style="background: #333;">
	    <div class="carousel-item active">
	      <img src="https://assets.regus.com/images/nwp/homepage-product-office-space.jpg" class="d-block w-100" style="opacity: 0.5">
	    </div>
	    <div class="carousel-item">
	      <img src="https://img-prod-cms-rt-microsoft-com.akamaized.net/cms/api/am/imageFileData/RE2uXZM?ver=a904&q=90&m=2&h=768&w=1024&b=%23FFFFFFFF&aim=true" class="d-block w-100" style="opacity: 0.5">
	    </div>
	    <div class="carousel-item">
	      <img src="https://www.it.unsw.edu.au/students/software/office365.jpeg" class="d-block w-100" style="opacity: 0.5">
	    </div>
	  </div>
	</div>

	<div class="my-5">
		<div class="container">
			<div class="row">
				@foreach($ebooks as $ebook)
				<div class="col-lg-6 mb-3">
					<div class="bg-white shadow rounded p-3 border-hover">
						<div class="row">
							<div class="col-lg-3 d-flex align-items-center">
								<img src="{{asset('assetsebook/v2/img/1.png')}}" class="mx-auto d-block">
							</div>
							<div class="col-lg-9">
								<h2 class="mb-0" style="color: #8543da;">{{ucwords($ebook->title)}}</h2>
								<span>{{ $ebook->description }}</span><br>
								@if($ebook->access)
								<a href="{{route('member.ebook.detail', ['type' => strtolower($ebook->title)])}}?username={{$username}}" class="btn btn-purple btn-sm mt-3 px-5">Detail</a>
								@else
								<a href="{{route('member.ebook.detail', ['type' => strtolower($ebook->title)])}}?username={{$username}}" class="btn btn-purple btn-sm mt-3 px-5">BUY</a>
								@endif
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="modal-subscription" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content bg-1 text-white">
		      <div class="modal-body">
		      	<img src="{{asset('assetsebook/v2/img/logo-white.png')}}" class="img-fluid mb-3 mx-auto d-block" style="width: 130px;">
						@if($username == '')
					  <div class="form-group">
					    <label for="exampleInputEmail1">Refferal <small class="text-danger">*</small></label>
					    <input type="text" class="form-control" id="referralCode" aria-describedby="emailHelp" placeholder="Refferal" required>
					  </div>
						@else
						<div class="form-group">
					    <label for="exampleInputEmail1">Refferal <small class="text-danger">*</small></label>
					    <input type="text" class="form-control" id="referralCode" aria-describedby="emailHelp" placeholder="Refferal" readonly value="{{$username}}">
					  </div>
						@endif
					  <div class="form-group">
					    <label for="exampleInputPassword1">Firstname <small class="text-danger">*</small></label>
					    <input type="text" class="form-control" id="firstName" placeholder="Firstname" required>
					  </div>
						<div class="form-group">
					    <label for="exampleInputPassword1">Lastname <small class="text-danger">*</small></label>
					    <input type="text" class="form-control" id="lastName" placeholder="Lastname" required>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Email <small class="text-danger">*</small></label>
					    <input type="email" class="form-control" id="email" placeholder="Email" required>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Phone Number <small class="text-danger">*</small></label>
					    <input type="number" class="form-control" id="phoneNumber" placeholder="Phone number" required>
					  </div>
					  <span>Total yang dibayar : </span><b><span id="total_price"></span></b>
		      </div>
		      <div class="modal-footer justify-content-center">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" onclick="submit()">Submit</button>
		      </div>
		    </div>
		  </div>
		</div>
	<!-- End Modal -->
@stop
@section('footer_scripts')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="{{asset('assetsebook/js/helper.js')}}"></script>
<script>
function selectedSubscription(param = null) {
  $('#modal-subscription').modal('show')

  const data = JSON.parse(param)

  $('#total_price').html(toIDR(data.price))
}

function submit() {
	let required = [
		{
			field: 'firstName',
			message: 'First Name Required'
		},
		{
			field: 'referralCode',
			message: 'Referral Code Required'
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
		url: "{{ route('member.register') }}",
		method: 'post',
		data: {
				referralCode: $('#referralCode').val(),
				lastName: $('#lastName').val(),
				firstName: $('#firstName').val(),
				email: $('#email').val(),
				phoneNumber: $('#phoneNumber').val()
		},
		success: function(result){
			console.log(result)

			const {message} = result

			if(!message) {
				alert('Failed Regiester')
				return false
			}

			alert('Success register')
		},
		error: function(err) {
			console.log(err)
			alert('Failed Register')
		}});
}
</script>
@stop