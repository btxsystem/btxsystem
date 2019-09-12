@extends('layouts.admin')

@section('title')
Edit Our Products CMS
@parent
@stop

@section('content')

<section class="content-header">
    <h1> Our Product</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">CMS</a>
        </li>
        <li class="active">Edit Data Our Product</li>
    </ol>

    <div class="container">
            <table class="table table-striped">
               <tbody>
                  <tr>
                     <td colspan="1">
                        <form class="well form-horizontal" method="post" action="{{route('cms.our-products.update', $data->id)}}" enctype="multipart/form-data">
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
                                <label class="col-md-2 control-label">Image</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-file-photo-o"></i></span>
                                        <input id="img" name="img" class="form-control" type="file">
                                    </div>
                                    <p class="text-danger">{{ $errors->first('img') }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Article</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <textarea id="article" name="article" class="article">{{$data->article}}</textarea>
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
        CKEDITOR.replace( 'article',{
            width: "710px",
            height: "350px",
        });  
    </script>
@stop
