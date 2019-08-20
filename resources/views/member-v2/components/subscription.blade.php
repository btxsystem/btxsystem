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
								<span>Materi basic untuk mempermudah anda dalam tahap belajar forex.</span><br>
								<button onclick="selectedSubscription('{{$ebook}}')" class="btn btn-purple btn-sm mt-3 px-5">BUY</button>
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
<!-- <div class="pt-md-5 pb-md-4 text-center mb-4 title-3">
  <h3 class="text-center colorwhite bit-relative"><b>Bitrexgo Premium</b></h3>
</div>
<div class="container c1">
  <div class="row justify-content-center">
    <div class="card-deck mb-3 bit-relative">
      <div class="card mb-4 shadow-sm mb-5">
        <div class="card-logo">
          <img src="{{asset('assetsebook/assets/img/basic.jpg')}}" class="img-fluid"> 
        </div>
        <div class="card-body d-flex flex-column">
        <button class="btn btn-md btn-warning mr-auto">Basic + Intermediate</button><br/>
          <p>Pada modul ini anda akan mempelajari trading dari dasar. Pertama anda akan mengerti istilah-istilah yang digunakan dalam dunia trading, anda akan mempelajari cara membaca grafik dan membuat analisa dasar sendiri.
          </p>
          <b><label>Apa yang anda dapatkan :</label></b><br>
          <ul style="margin-left:20px;">
            <li>Pembelajaran dasar mengenai dunia trading forex</li>
            <li>Mempersiapkan pawa trader pemula sebelum trading forex</li>
            <li>Menyadari dan mengenal resiko-resiko trading di dunia forex</li>
            <li>Mengetahui siapa saja pelaku dan penggerak dunia forex</li>
            <li>Mempelajari dasar-dasar analisa fundamental</li>
            <li>Mempelajari dasar-dasar analisa teknikal</li>
            <li>Mengetahui kapan moment terbaik untuk melakukan trading forex</li>
            <li>Mempelajari sifat-sifat dasar yang harus dimiliki trader</li>
          </ul>
        </div>
      </div>
      <div class="card mb-4 shadow-sm mb-5">
        <div class="card-logo">
          <img src="{{asset('assetsebook/assets/img/advance.jpg')}}" class="img-fluid"> 
        </div>
        <div class="card-body d-flex flex-column">
          <button class="btn btn-md btn-warning mr-auto">Basic + Intermediate</button><br/>
          <p>Pada modul ini anda akan mempelajari dunia trading lanjutan. Bagaimana cara membaca pasar dengan penggabungan dua atau lebih analisa, diantaranya analisa secara fundamental dan teknikal, serta mempelajari secara mendalam indikator-indikator teknikal.</p>
          <b><label>Apa yang anda dapatkan :</label></b><br>
          <ul style="margin-left:20px;">
            <li>Merupakan kelanjutan dari modul basic + intermediate</li>
            <li>Membahas materi yang lebih dalam mengenai analisa teknikal dan fundamental</li>
            <li>Mengupas lebih dalam fungsi-fungsi indikator di dalam metatrader</li>
            <li>Mengajarkan cara penggunaan indikator dan kombinasinya</li>
            <li>Mengajarkan mental trading</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</div> -->
@stop
@section('footer_scripts')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
function selectedSubscription(param = null) {
  $('#modal-subscription').modal('show')

  const data = JSON.parse(param)

  $('#total_price').html(data.price)
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
			alert('Success Register')
		},
		error: function(err) {
			console.log(err)
			alert('Failed Register')
		}});
}
</script>
@stop