@extends('layouts.admin')

@section('title')
Edit Video
@parent
@stop

@section('content')

<section class="content-header">
    <h1> Edit Video</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('ebook.index') }}">Ebook </a>
        </li>
        <li>
            <a href="{{ route('ebook.show', $data->videoEbook->ebook_id) }}">{{optional($data->videoEbook)->ebook_title}} </a>
        </li>
        <li class="active">{{$data->title}}</li>
    </ol>

    <div class="container">
            <table class="table table-striped">
               <tbody>
                  <tr>
                     <td colspan="1">
                        <form class="well form-horizontal" method="post" action="{{route('video.update', $data->id)}}" enctype="multipart/form-data">
                            {{ csrf_field() }} {{ method_field('PATCH')}}
                           <fieldset>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Title</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input id="title" name="title" placeholder="Title" class="form-control" required="true" value="{{$data->title}}" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Video</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <input id="path" name="path" class="form-control" required="true" value="{{old('path')}}" type="file">
                                    <small class="text-danger">{{ $errors->first('path') }}</small>
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
        CKEDITOR.replace( 'article' );  
    </script>
@stop
