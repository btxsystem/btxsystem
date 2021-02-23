@extends('layouts.admin')

@section('title')
Create Video
@parent
@stop

@section('content')

<section class="content-header">
    <h1> Create Gallery Video</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('galeries.index') }}">Gallery </a>
        </li>
        <li class="active">Create Video</li>
    </ol>

    <div class="container">
            <table class="table table-striped">
               <tbody>
                  <tr>
                     <td colspan="1">
                        <form class="well form-horizontal" id="form-video" method="post" enctype="multipart/form-data" action="{{route('galeries.store')}}">
                            {{ csrf_field() }}
                           <fieldset>
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
                                <label class="col-md-2 control-label">Video</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-video-camera"></i></span>
                                        <input id="video" name="path" placeholder="video" class="form-control" required="true" value="{{old('video')}}" type="file">
                                    </div>
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
<section class="content">

@stop

@section('footer_scripts')

@stop
