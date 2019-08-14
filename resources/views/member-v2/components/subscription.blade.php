@extends('member-v2.layouts.main')
@section('title')
    Explore
    @parent
@stop

@section('style_class')bit-bg1 @stop

@section('content')
@include('member-v2.partials.navbar')
<div class="pt-md-5 pb-md-4 text-center mb-4 title-3">
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
      <!-- <div class="card mb-4 shadow-sm mb-5">
        <div class="card-header">
          <h5>12 Bulan</h5>
        </div>
        <div class="card-body d-flex flex-column">
          <h3 class="card-title pricing-card-title">Rp.59,000</h3>
          <p class="fz16 f5 m0">Per Bulan</p>
          <ul class="list-unstyled mt-3 mb-4 price-list">
            <li>Akses Semua Konten</li>
            <li>Akses Semua Kursus</li>
            <li>Coding Area</li>
            <li>Group Facebook</li>
            <li>Tshirt Exclusive</li>
            <li>Konsultasi dengan praktisi</li>
          </ul>
          <button class="btn btn-md btn-warning mt-auto bit-btn4">Pilih Paket</button>
        </div>
      </div> -->
    </div>
  </div>
</div>
</div>
@stop