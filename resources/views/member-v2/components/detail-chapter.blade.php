@extends('member-v2.layouts.main')
@section('title')
    Explore
    @parent
@stop

@section('style_class')bit-bg4 @stop

@section('content')
@include('member-v2.partials.navbar-lesson')
<div class="d-sm-none container" style="margin-top: 20px;">
    <a href="#" data-toggle="collapse" data-target="#view">
      <i style="color: #8321d8; margin-right: 10px;" class="fa fa-align-left fa-2x"></i>
      <span style="font-size: 25px; color:#8321d8;">Introduction</span>
    </a>
</div>
<div class="container-fluid">
    <div class="row">
      <div id="view" class="col-xl-3 col-lg-4 col-sm-5 scroll" style="background: #FFF;height:100vh !important">
          <h3 class="mt30 pl15">{{ $chapter->title }}</h3>
          <nav class="navbar">
            <ul class="navbar-nav bit-ul">
                @php
                $i = 1
                @endphp
                @foreach($chapter->lessons as $lesson)
                <li class="nav-item" onclick="changeLesson({{$i  - 1}})">
                  <p class="float-left w8">{{$i++}}. {{ $lesson->title }}</p>
                  <!-- <div class="float-right radio icheck-emerland">
                      <input type="radio" id="emerland8" name="bit1">
                      <label for="emerland8"></label>
                  </div> -->
                </li>
                @endforeach
            </ul>
          </nav>
      </div>
      <div class="col-xl-9 col-lg-8 col-sm-7 mt50">
        <div id="lesson_content"></div>
      </div>
    </div>
</div>
@stop

@section('footer_scripts')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
  let lessons = [];

  <?php foreach($chapter->lessons as $k => $v){?>

  lessons[<?=$k;?>] = <?=$v;?>;
  <?php } ?>

  let chapterId = '{{ $chapter->id }}'
  let currentLesson = lessons[0]
  refreshContent()

  function changeLesson(index) {
    currentLesson = lessons[index]
    refreshContent()
  }

  function nextLesson() {
    refreshContent()
  }

  function refreshContent() {
    $('#lesson_content').html(currentLesson.content);
  }
</script>
@stop