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
          <h3 class="mt30 pl15">{{ $book->title }} <span id="percentage"></span></h3>
          <nav class="navbar">
            <ul class="navbar-nav bit-ul">
            <div id="lessonlist"></div>
            <ul>
          </nav>
      </div>
      <div class="col-xl-9 col-lg-8 col-sm-7 mt10">
        <!-- <nav aria-label="breadcrumb">
          <div id="breadcrumb"></div>
        </nav> -->
        <div id="lesson_content"></div>
        <div class="clearfix"></div>
        <div>
          <div class="s">
            <div>
              <div class="d-flex align-items-center flex-column bd-highlight mb-3">
                <div class="mt-auto">
                  <button class="btn btn-identity text-white" id="next">Lanjutkan</button>
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
  $('#percentage-wrapper').removeClass('d-none')
  let lessons = [];

  <?php foreach($book->lessons as $k => $v){?>

  lessons[<?=$k;?>] = <?=$v;?>;
  <?php } ?>

  let chapterId = '{{ $book->id }}'
  let currentLesson = lessons[0]
  let maxIndexLesson = lessons.length - 1
  let percentage = 0;
  
  refreshContent()
  initLesson()

  function initLesson () {
    let filterPercentage = lessons.filter(v => {
      return v.solved
    })

    let sumPercentage = filterPercentage.length / lessons.length * 100;

    percentage = Math.ceil(sumPercentage)

    $('#percentage-bar').css({
      width: `${percentage}%`
    }).html(`<span style="font-weight:bold">${percentage}%</span>`)
    
    // $('#percentage').html(`${percentage}%`)
    let initLessonList = ''
    lessons.map((v, i) => {
      initLessonList += `
        <li class="nav-item" onclick="changeLesson(${i})">
          <p class="float-left w8">${v.title}</p>
          <p class="float-right ${!v.solved ? 'd-none' : ''}">
            <i class="fa fa-check text-success"></i>
          </p>
        </li>
        `
    })
    $('#lessonlist').html(initLessonList)
  }

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
        route: '{{route("member.home")}}'
      },
      {
        title: '{{ucwords($book->bookEbook->ebook->title)}}',
        route: "{{route('member.ebook.detail', ['type' => $book->bookEbook->ebook->title])}}"
      },
      {
        title: '{{$book->title}}',
        route: '{{route("book.detail", ["slug" => $book->slug])}}'
      },
      {
        title: currentLesson.title,
        route: ''
      }
    ]

    dataBreadcrumb += `<ol class="breadcrumb bg-light border">`
    breadcrumbs.map((v, i) => {
      if(i == breadcrumbs.length - 1) {
        dataBreadcrumb += `<li class="breadcrumb-item active" aria-current="page">${v.title}</li>`
      } else {
        dataBreadcrumb += `<li class="breadcrumb-item"><a class="text-dark" href="${v.route}">${v.title}</a></li>`
      }
    })
    dataBreadcrumb += '</ol>'
    $('#breadcrumb').html(dataBreadcrumb)

  }

  function refreshContent() {
    breadcrumb()
    $('#lesson_content').html(currentLesson.content);
  }

  function solvedLesson(lessonData) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{ route('member.solved-lesson') }}?lesson=" + lessonData.id,
      method: 'get',
      success: function(result){

        const {success} = result

        if(success) {
          lessonData.solved = true
          initLesson()
        }
   
      },
      error: function(err) {
        console.log(err)
      }});    
  }

  $('#next').on('click', function() {
    let index = lessons.findIndex(data => data.id == currentLesson.id)
    if(!currentLesson.solved) {
      solvedLesson(currentLesson)
    }
    if(index == maxIndexLesson) {
      alert('Berhasil menyelesaikan chapter')
      window.location.href = '{{route("member.explore")}}'
      return
    }
    currentLesson = lessons[index+1]
    refreshContent()
    initLesson()
  })
</script>
@stop