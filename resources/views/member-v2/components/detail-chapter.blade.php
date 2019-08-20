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
      <div class="col-xl-9 col-lg-8 col-sm-7 mt10">
        <nav aria-label="breadcrumb">
          <div id="breadcrumb"></div>
        </nav>
        <div id="lesson_content"></div>
        <div>
          <div class="s">
            <div>
              <div class="d-flex align-items-center flex-column bd-highlight mb-3" style="height: 72vh;">
                <div class="mt-auto">
                  <button class="btn btn-warning" id="next">Lanjutkan</button>
                </div>
              </div>
            </div>
          </div>
        </div>
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
  let maxIndexLesson = lessons.length - 1
  refreshContent()

  function changeLesson(index) {
    currentLesson = lessons[index]
    refreshContent()
  }

  function nextLesson() {
    refreshContent()
  }

  function breadcrumb() {
    let dataBreadcrumb = ''
    let breadcrumbs = [
      {
        title: 'Home',
        route: 's'
      },
      {
        title: '{{$chapter->book->title}}',
        route: "{{route('chapter.list', ['id' => $chapter->book->id])}}"
      },
      {
        title: '{{$chapter->title}}',
        route: "{{route('chapter.detail', ['id' => $chapter->id])}}"
      },
      {
        title: currentLesson.title,
        route: ''
      }
    ]

    dataBreadcrumb += `<ol class="breadcrumb bg-dark">`
    breadcrumbs.map((v, i) => {
      if(i == breadcrumbs.length - 1) {
        dataBreadcrumb += `<li class="breadcrumb-item active" aria-current="page">${v.title}</li>`
      } else {
        dataBreadcrumb += `<li class="breadcrumb-item"><a href="${v.route}">${v.title}</a></li>`
      }
    })
    dataBreadcrumb += '</ol>'
    $('#breadcrumb').html(dataBreadcrumb)

  }

  function refreshContent() {
    breadcrumb()
    $('#lesson_content').html(currentLesson.content);
  }

  $('#next').on('click', function() {
    let index = lessons.findIndex(data => data.id == currentLesson.id)
    if(index == maxIndexLesson) return
    currentLesson = lessons[index+1]
    refreshContent()
  })
</script>
@stop