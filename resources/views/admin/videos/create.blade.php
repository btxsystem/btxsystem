@extends('layouts.admin')

@section('title')
Create Book
@parent
@stop

@section('content')

<section class="content-header">
    <h1> Book</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Book Management</a>
        </li>
        <li class="active">Add Data Book</li>
    </ol>

    <div class="container">
            <table class="table table-striped">
               <tbody>
                  <tr>
                     <td colspan="1">
                        <form class="well form-horizontal" method="post" enctype="multipart/form-data" action="{{route('video.store')}}">
                            {{ csrf_field() }}
                           <fieldset>

                           <div class="form-group">
                                    <label class="col-md-2 control-label">Type</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-book"></i></span>
                                            <select name="ebook_id" id="ebook_id" class="form-control" required="true">
                                                <option value="" disabled selected>Select Type</option>
                                                @foreach($ebooks as $ebook)
                                                <option value="{{$ebook->id}}">{{$ebook->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                            </div>

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
                                        <input id="video" name="video" class="form-control" required="true" value="{{old('title')}}" type="file">
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
        CKEDITOR.replace( 'article');  
    </script>
@stop
