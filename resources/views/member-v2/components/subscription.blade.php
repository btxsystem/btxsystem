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
				<div class="col-lg-6 mb-3">
					<div class="bg-white shadow rounded p-3 border-hover">
						<div class="row">
							<div class="col-lg-3 d-flex align-items-center">
								<img src="{{asset('assetsebook/v2/img/1.png')}}" class="mx-auto d-block">
							</div>
							<div class="col-lg-9">
								<h2 class="mb-0" style="color: #8543da;">Basic</h2>
								<span>Materi basic untuk mempermudah anda dalam tahap belajar forex.</span><br>
								<a href="detail.html" class="btn btn-purple btn-sm mt-3 px-5">BUY</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 mb-3">
					<div class="bg-white shadow rounded p-3 border-hover">
						<div class="row">
							<div class="col-lg-3 d-flex align-items-center">
								<img src="{{asset('assetsebook/v2/img/2.png')}}" class="mx-auto d-block">
							</div>
							<div class="col-lg-9">
								<h2 class="mb-0" style="color: #8543da;">Advanced</h2>
								<span>Materi Advanced untuk tingkatan lebih lanjut dalam belajar forex.</span><br>
								<a href="detail.html" class="btn btn-purple btn-sm mt-3 px-5">BUY</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

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