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
                        <form class="well form-horizontal" method="post" action="{{route('ebook.store')}}" enctype="multipart/form-data">
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
                                <label class="col-md-2 control-label">Display Title</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input id="display_title" name="display_title" placeholder="Display Title" class="form-control" required="true" value="{{old('display_title')}}" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Price</label>
                                <div class="col-md-3 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input id="price" name="price" placeholder="Price" class="form-control" required="true" value="{{old('price')}}" type="number">
                                    </div>
                                </div>
                                <label class="col-md-2 control-label">Price Renewal</label>
                                <div class="col-md-3 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input id="price_renewal" name="price_renewal" placeholder="Price Renewal" class="form-control" value="{{old('price_renewal')}}" type="number">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Markup Price</label>
                                <div class="col-md-3 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input id="price_markup" name="price_markup" placeholder="Markup" class="form-control" required="true" value="{{old('price_markup')}}" type="number">
                                    </div>
                                </div>

                                <label class="col-md-2 control-label">Markup Price Renewal</label>
                                <div class="col-md-3 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input id="price_markup_renewal" name="price_markup_renewal" placeholder="Markup Renewal" class="form-control" value="{{old('price_markup_renewal')}}" type="number">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Point Value</label>
                                <div class="col-md-3 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                                        <input id="pv" name="pv" placeholder="Point" class="form-control" required="true" value="{{old('pv')}}" type="number">
                                    </div>
                                </div>

                                <label class="col-md-2 control-label">Point Value Renewal</label>
                                <div class="col-md-3 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                                        <input id="pv_renewal" name="pv_renewal" placeholder="Point Renewal" class="form-control" value="{{old('pv_renewal')}}" type="number">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Bonus Value</label>
                                <div class="col-md-3 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-area-chart"></i></span>
                                        <input id="bv" name="bv" placeholder="Bonus" class="form-control" required="true" value="{{old('bv')}}" type="number">
                                    </div>
                                    <p class="text-danger">{{ $errors->first('bv') }}</p>
                                </div>

                                <label class="col-md-2 control-label">Bonus Value Renewal</label>
                                <div class="col-md-3 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-area-chart"></i></span>
                                        <input id="bv_renewal" name="bv_renewal" placeholder="Bonus Renewal" class="form-control" value="{{old('bv_renewal')}}" type="number">
                                    </div>
                                    <p class="text-danger">{{ $errors->first('bv_renewal') }}</p>
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
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <input type="checkbox" name="promotion[]" value="1"> Product Promotion
                                    </div>
                                    <p class="text-danger">{{ $errors->first('promotion') }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="start-date" hidden>
                                    <label class="col-md-2 control-label">Start Date</label>
                                    <div class="col-md-3 inputGroupContainer">
                                        <div class="input-group">
                                            <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                                        </div>
                                        <p class="text-danger">{{ $errors->first('start_date') }}</p>
                                    </div>
                                </div>

                                <div class="end-date" hidden>
                                    <label class="col-md-2 control-label">End Date</label>
                                    <div class="col-md-3 inputGroupContainer">
                                        <div class="input-group">
                                            <input type="date" name="end_date" class="form-control" placeholder="End Date">
                                        </div>
                                        <p class="text-danger">{{ $errors->first('end_date') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Discount (%)</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input id="price_discount" name="price_discount" placeholder="Discount" class="form-control" required="true" type="number" min="0" max="100">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Kepemilikan Ebook</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input id="minimum_product" name="minimum_product" placeholder="Kepemilikan Ebook" class="form-control" required="true" type="number">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Description</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <textarea id="description" name="description" class="description">{{old('description')}}</textarea>
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

        $('input[type="checkbox"][name="promotion[]"]').change(function() {
            if(this.checked) {
                $('.start-date').show();
                $('.end-date').show();
            }else{
                $('.start-date').hide();
                $('.end-date').hide();
            }
        });  
    </script>
@stop
