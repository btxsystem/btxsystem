@extends('member-v2.layouts.main')
@section('title')
    Explore
    @parent
@stop

@section('styles')
<link rel="stylesheet" href="{{asset('assetsebook/assets/css/style.css')}}">
@stop

@section('style_class')bit-bg4 @stop

@section('content')
@include('member-v2.partials.navbar')
<div class="container kakti" style="padding-left: 5%; padding-right: 5%;">
  <div class="col-12">
    <div class="row mt50">
      <div class="col-xl-8 col-lg-8 col-sm-7 col-12 mx-auto">
        <h4 class="mb20">{{$book->title}}</h4>
        <div class="card noborder mb30">
            <div class="card-body">
              <div class="row">
                  <div class="col-xl-8 col-lg-7 col-sm-6" style="padding-right: 0px;">
                    <h5 class="fz16">Materi</h5>
                  </div>
              </div>
              <hr>
              @if(count($book->chapters) > 0)
              @foreach($book->chapters as $chapter)
              <a href="{{route('chapter.detail', ['id' => $chapter->id])}}">
                <div class="media mb10">
                    <div class="media-left">
                      <img src="{{asset('assetsebook/assets/img/1.png')}}" class="media-object" style="width:50px">
                    </div>
                    <div class="media-body pr50 pl15 pt7">
                      <h5 class="media-heading fz14 text-dark">{{ $chapter->title }}</h5>
                    </div>
                </div>
              </a>
              @endforeach
              @else
              <span>Belum ada materi.</span>
              @endif

            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop