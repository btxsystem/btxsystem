@extends('layouts.admin')

@section('title')
Edit Video Category
@parent
@stop

@section('content')

<section class="content-header">
    <h1> Edit Video Category</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('ebook.index') }}">Ebook </a>
        </li>
        <li>
            <a href="{{ route('ebook.show', $data->ebook->id) }}">{{$data->ebook->title}} </a>
        </li>
        <li class="active">Edit Video Category</li>
    </ol>

    <div class="container">
            <table class="table table-striped">
               <tbody>
                  <tr>
                     <td colspan="1">
                        <form class="well form-horizontal" id="form-video" method="post" enctype="multipart/form-data" action="{{route('video-category.update', [$data->id])}}">
                            {{ csrf_field() }} {{ method_field('PATCH')}}
                           <fieldset>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Name</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input id="name" name="name" placeholder="Name" class="form-control" required="true" value="{{$data->name}}" type="text">
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
        CKEDITOR.replace( 'article');  
    </script>
@stop
