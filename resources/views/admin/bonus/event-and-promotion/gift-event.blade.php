@extends('layouts.admin')

@section('title')
Gift event and promotion
@parent
@stop

@section('content')

<section class="content-header">
    <h1>Gift Event and Promotion</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Bonus</a>
        </li>
        <li class="active">Gift Event and Promotion</li>
    </ol>

    <div class="container">
        <table class="table table-striped">
           <tbody>
              <tr>
                 <td colspan="1">
                    <form action="" class="well form-horizontal" method="POST" enctype="multipart/form-data"> 
                        @csrf
                        <fieldset>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Description</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                                        <textarea name="description" id="" cols="30" rows="10" class="form-control" required="true" value=""></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Nominal</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                        <input id="nominal" name="nominal" class="form-control" required="true" value="" type="number">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-8 inputGroupContainer">
                                    <span class="btn btn-info btn-sm select-all">Select all</span>
                                    <span class="btn btn-danger btn-sm deselect-all">Deselect all</span>
                                </div>        
                            </div>

                            <div class="form-group">                
                                <label class="col-md-2 control-label">Choose Member</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <select name="member[]" id="member" class="form-control select2" multiple="multiple" required="true">

                                        </select>
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

@stop