@extends('member-v2.layouts.main')
@section('title')
    Explore
    @parent
@stop

@section('style_class')bit-bg4 @stop

@section('content')
@include('member-v2.partials.navbar')
<div class="bit-jumbo"></div>
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
                  <!-- <div class="float-left">
                    <span><img src="assets/img/materi.png" class="media-object"> 5</span>
                    <span><img src="assets/img/pilot.png" class="media-object"> 3</span>
                  </div> -->
                  <div class="float-right">
                      <button class="btn btn-md btn-warning bit-btn5">
                      Mulai Belajar
                      </button>
                  </div>
                </div>
                <!-- <div class="media-right col-lg-1 col-sm-1 col-2">
                  <img src="assets/img/bookmark-green.png" class="media-object">
                </div> -->
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
                      <!-- <div class="mt-auto">
                        <hr>
                        <div class="float-left">
                            <span><img src="{{asset('ebook/assets/img/materi.png')}}" height="15" class="mtmin3 mr5"> 5</span>
                            <span><img src="{{asset('ebook/assets/img/pilot.png')}}" height="18" class="mtmin3 mr5"> 3</span>
                        </div>
                        <div class="float-right">
                            <img src="assets/img/bookmark.png" class="media-object">
                        </div>
                      </div> -->
                  </div>
                </div>
            </div>
            @endforeach
          </div>
      </div>
    </div>
</div>
@stop