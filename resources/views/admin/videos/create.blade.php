@extends('layouts.admin')

@section('title')
Create Video
@parent
@stop

@section('content')

<section class="content-header">
    <h1> Create Video</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('ebook.index') }}">Ebook </a>
        </li>
        <li>
            <a href="{{ route('ebook.show', $data->id) }}">{{$data->title}} </a>
        </li>
        <li class="active">Create Video</li>
    </ol>

    <div class="container">
            <table class="table table-striped">
               <tbody>
                  <tr>
                     <td colspan="1">
                        <form class="well form-horizontal" id="form-video" method="post" enctype="multipart/form-data" action="{{route('video.store')}}">
                            {{ csrf_field() }}
                           <fieldset>
                           <input type="hidden" id="ebook_id" name="ebook_id" value="{{$data->id}}">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Title</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input id="title" name="title" placeholder="Title" class="form-control" required="true" value="{{old('title')}}" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Category</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                        <select name="category_id" id="category_id" class="form-control">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Video</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                        <input id="video" name="path" placeholder="video" class="form-control" required="true" value="{{old('video')}}" type="text">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label class="col-md-2 control-label">Video</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <input id="path" name="path" class="form-control" required="true" value="{{old('path')}}" type="file">
                                    <small class="text-danger">{{ $errors->first('path') }}</small>
                                </div>
                            </div> -->

                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-8 inputGroupContainer">                                
                                       <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                </div>
                            </div>
                                                            
                           </fieldset>
                        </form>
                        <div class="wrapper-loader hidden">
                            <h5>Upload Progress</h5>
                            <div id="upload-status">
                                
                            </div>
                            <div class="progress">
                                <div id="progress" class="progress-bar progress-bar-striped active" role="progressbar"
                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                    <div id="progress-text"></div>
                                </div>
                            </div>
                        </div>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
</section>
<!--section ends-->
<section class="content">

@stop

@section('footer_scripts')
    <script src="/editor/ckeditor/ckeditor.js"></script>  
    <script>
        CKEDITOR.replace( 'article');  
        $(function() {
            $('#form-video').submit(function(e) {
                e.preventDefault();

                $('.wrapper-loader').removeClass('hidden')
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = Math.ceil(((evt.loaded / evt.total) * 100));
                                //$(".progress-bar").width(percentComplete + '%');
                               // $(".progress-bar").html(percentComplete+'%');
                               console.log('percentComplete', percentComplete)
                               $("#progress").attr('aria-valuenow', percentComplete)
                               $('#progress').css({
                                   width: `${percentComplete}%`
                               })
                               $('#progress-text').html(`${percentComplete}%`)

                               if(percentComplete > 99) {
                                   $('#progress').removeClass('progress-bar-striped')
                                   $('#progress').addClass('progress-bar-success')
                               }
                            }
                        }, false);
                        return xhr;
                    },
                    type: 'POST',
                    url: "{{route('video.store')}}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                        //$(".progress-bar").width('0%');
                        //$('#uploadStatus').html('<img src="images/loading.gif"/>');
                        $('#progress').removeClass('progress-bar-success')
                        $("#progress").attr('aria-valuenow', 0)
                        $('#progress').css({
                            width: `0%`
                        })
                        $('#progress-text').html(`0%`)
                        $('#upload-status').html('');
                    },
                    error:function(){
                        //$('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
                    },
                    success: function(res){
                        if(res.status) {
                            $('#title').val('')
                            $('#path').val('')
                        }

                        $('#upload-status').html(`
                            <div class="alert alert-${res.status ? 'success' : 'error'}">
                                ${res.message}
                            </div>
                        `)
                    }
                });
            })
        });
    </script>
@stop
