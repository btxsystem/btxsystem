@extends('layouts.admin')

@section('title')
Create Book
@parent
@stop

@section('content')

<section class="content-header">
    <h1> Member</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Member</a>
        </li>
        <li class="active">Add Member Expired</li>
    </ol>

    <div class="container">
            <table class="table table-striped">
               <tbody>
                  <tr>
                     <td colspan="1">
                        <form class="well form-horizontal" id="form" method="post" action="{{route('member-expired.store')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                           <fieldset>
                            <div class="form-group">
                                <label class="col-md-2 control-label">File CSV (MS-DOS Format)</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-file-photo-o"></i></span>
                                        <input id="csv" name="csv" class="form-control" type="file">
                                    </div>
                                    <p class="text-danger">{{ $errors->first('csv') }}</p>
                                </div>
                            </div>


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
                            <h5>Analisa</h5>
                            <div id="result-analyze"></div>
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
        $(function() {
            $('#form').submit(function(e) {
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
                    url: "{{route('member-expired.store')}}",
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
                            $('#result-analyze').html(`
                                <div class="alert alert-info">
                                    ${res.analyze}
                                    <hr/>
                                    <h4>Total Success : ${res.error.success}</h4>
                                    <h4>Total Warning : ${res.error.warning}</h4>
                                    <h4>Total Error : ${res.error.error}</h4>
                                </div>
                            `)
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
