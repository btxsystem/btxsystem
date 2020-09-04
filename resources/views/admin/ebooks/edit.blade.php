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
                                <label class="col-md-2 control-label">Display Title</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input id="display_title" name="display_title" placeholder="Display Title" class="form-control" required="true" value="{{$data->display_title}}" type="text">
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
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <input type="checkbox" name="promotion[]" value="1" {{$data->started_at ? "checked" : ""}}> Product Promotion
                                    </div>
                                    <p class="text-danger">{{ $errors->first('promotion') }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                            @if ($data->started_at)
                                <div class="start-date">
                                    <label class="col-md-2 control-label">Start Date</label>
                                    <div class="col-md-3 inputGroupContainer">
                                        <div class="input-group">
                                            <input type="date" name="start_date" value="{{\Carbon\Carbon::parse($data->started_at)->format('Y-m-d')}}" class="form-control" placeholder="Start Date">
                                        </div>
                                        <p class="text-danger">{{ $errors->first('start_date') }}</p>
                                    </div>
                                </div>

                                <div class="end-date">
                                    <label class="col-md-2 control-label">End Date</label>
                                    <div class="col-md-3 inputGroupContainer">
                                        <div class="input-group">
                                            <input type="date" name="end_date" value="{{\Carbon\Carbon::parse($data->ended_at)->format('Y-m-d')}}" class="form-control" placeholder="End Date">
                                        </div>
                                        <p class="text-danger">{{ $errors->first('end_date') }}</p>
                                    </div>
                                </div>
                            @else
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
                            @endif
                            </div>

                            <div id="is_promotion">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-4 control-label"></label>
                                            <div class="col-md-6 inputGroupContainer">
                                                <div class="input-group">
                                                    <input type="checkbox" name="register_promotion" value="1" {{$data->register_promotion ? "checked" : ""}}> Allow new register join promotion
                                                </div>
                                                <p class="text-danger">{{ $errors->first('register_promotion') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-md-2 control-label"></label>
                                            <div class="col-md-8 inputGroupContainer">
                                                <div class="input-group">
                                                    <input type="checkbox" name="allow_merge_discount" value="1" {{$data->allow_merge_discount ? "checked" : ""}}> Allow merge/stack promotion
                                                </div>
                                                <p class="text-danger">{{ $errors->first('allow_merge_discount') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Discount (%)</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                            <input id="price_discount" name="price_discount" placeholder="Discount" class="form-control" required="true" value="{{$data->price_discount}}" type="number" min="0" max="100">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Kepemilikan Ebook</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                            <input id="minimum_product" name="minimum_product" placeholder="Kepemilikan Ebook" class="form-control" required="true" value="{{$data->minimum_product}}" type="number">
                                        </div>
                                        <br/>
                                        <span>s.d</span>
                                        <br/><br/>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                            <input id="maximum_product" min="{{$data->minimum_product}}" name="maximum_product" placeholder="Kepemilikan Ebook" class="form-control" required="true" value="{{$data->maximum_product}}" type="number">
                                        </div>
                                    </div>
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

        $('input[type="checkbox"][name="promotion[]"]').change(function() {
            if(this.checked) {
                $('.start-date').show();
                $('.end-date').show();
                $('#is_promotion').show();
            }else{
                $('.start-date').hide();
                $('.end-date').hide();
                $('#is_promotion').hide();
            }
        });

        $('#minimum_product').change(function() {
            if($(this).val() >= 0) {
                $('#maximum_product').attr('disabled', false)
                $('#maximum_product').attr('min', $(this).val())
            }
        })

    </script>
@stop
