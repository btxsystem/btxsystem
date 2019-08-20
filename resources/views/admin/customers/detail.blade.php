@extends('layouts.admin')

@section('title')
Detail Customer
@parent
@stop

@section('content')

<section class="content-header">
    <h1> Customer</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Customer Management</a>
        </li>
        <li class="active">Detail Data Customer</li>
    </ol>

    <div class="container">
            <table class="table table-striped">
               <tbody>
                  <tr>
                  <td colspan="1">
                    <div class="well form-horizontal">
                     <fieldset>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-5 control-label">First Name &nbsp; :</label>
                                <div class="col-md-7">
                                    <p class="form-control-static">
                                        {{$data->first_name}}
                                    </p>
                                </div>
                            </div>   

                            <div class="form-group">
                                <label class="col-md-5 control-label">Last Name &nbsp; :</label>
                                <div class="col-md-7">
                                    <p class="form-control-static">
                                        {{$data->last_name}}
                                    </p>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label class="col-md-5 control-label">Last Name &nbsp; :</label>
                                <div class="col-md-7">
                                    <p class="form-control-static">
                                        {{$data->username}}
                                    </p>
                                </div>
                            </div>                        
                        </div>

                        <!--Right Part  -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Email &nbsp; :</label>
                                <div class="col-md-7">
                                    <p class="form-control-static">
                                        {{$data->email}}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 control-label">Reffered &nbsp; :</label>
                                <div class="col-md-7">
                                    <p class="form-control-static">
                                        <!-- {{$data->email}} -->
                                    </p>
                                </div>
                            </div>

                        </div>
                     </fieldset>
                    </div>
                    </td>
                  </tr>
               </tbody>
            </table>
     </div>
</section>
<!--section ends-->
<section class="content">

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript">

       
      </script>
@stop
