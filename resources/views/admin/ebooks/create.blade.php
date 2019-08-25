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
            <a href="#">Ebook</a>
        </li>
        <li class="active">Add Data Ebook</li>
    </ol>

    <div class="container">
            <table class="table table-striped">
               <tbody>
                  <tr>
                     <td colspan="1">
                        <form class="well form-horizontal" method="post" action="{{route('ebook.store')}}">
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
                                <label class="col-md-2 control-label">Price</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input id="price" name="price" placeholder="Price" class="form-control" required="true" value="{{old('price')}}" type="number">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Markup Price</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input id="price_markup" name="price_markup" placeholder="Markup" class="form-control" required="true" value="{{old('price_markup')}}" type="number">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Point Value</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                                        <input id="pv" name="pv" placeholder="Point" class="form-control" required="true" value="{{old('pv')}}" type="number">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Bonus Value</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-area-chart"></i></span>
                                        <input id="bv" name="bv" placeholder="Bonus" class="form-control" required="true" value="{{old('bv')}}" type="number">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Description</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <textarea id="description" name="description" class="description"></textarea>
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
