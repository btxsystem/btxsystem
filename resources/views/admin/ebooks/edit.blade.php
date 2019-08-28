@extends('layouts.admin')

@section('title')
Edit Ebook
@parent
@stop

@section('content')

<section class="content-header">
    <h1> Ebook</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Ebook</a>
        </li>
        <li class="active">Edit Data Ebook</li>
    </ol>

    <div class="container">
            <table class="table table-striped">
               <tbody>
                  <tr>
                     <td colspan="1">
                        <form class="well form-horizontal" method="post" action="{{route('ebook.update', $data->id)}}" enctype="multipart/form-data">
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
                                <label class="col-md-2 control-label">Price</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input id="price" name="price" placeholder="Price" class="form-control" required="true" value="{{$data->price}}" type="number">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Markup Price</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input id="price_markup" name="price_markup" placeholder="Markup" class="form-control" required="true" value="{{$data->price_markup}}" type="number">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Point Value</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                                        <input id="pv" name="pv" placeholder="Point" class="form-control" required="true" value="{{$data->pv}}" type="number">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Bonus Value</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-area-chart"></i></span>
                                        <input id="bv" name="bv" placeholder="Bonus" class="form-control" required="true" value="{{$data->bv}}" type="number">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Image</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-file-photo-o"></i></span>
                                        <input id="src" name="src" class="form-control" type="file">
                                    </div>
                                    <p class="text-danger">{{ $errors->first('src') }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Description</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <textarea id="description" name="description" class="description">{{$data->description}}</textarea>
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
        CKEDITOR.replace( 'description',{
            width: "710px",
            height: "350px",
        });  
    </script>
@stop
