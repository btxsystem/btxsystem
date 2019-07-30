@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Registration User
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
	<link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- end of page level css-->
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
    <!--section starts-->
    <h1>Registration Users</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Admin Management</a>
        </li>
        <li class="active">Registration Users</li>
    </ol>

    <div class="container">
            <table class="table table-striped">
               <tbody>
                  <tr>
                     <td colspan="1">
                        <form class="well form-horizontal">
                           <fieldset>
                              <div class="form-group">
                                 <label class="col-md-2 control-label">Full Name</label>
                                 <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="first_name" name="first_name" placeholder="First Name" class="form-control" required="true" value="" type="text">
                                    </div>
                                 </div>
                                    <div class="col-md-4 inputGroupContainer">
                                       <div class="input-group">
                                           <span class="input-group-addon"><i></i></span>
                                           <input id="last_name" name="last_name" placeholder="Last Name" class="form-control" required="true" value="" type="text">
                                       </div>
                                    </div>
                              </div>

                              <div class="form-group">
                                    <label class="col-md-2 control-label">Username</label>
                                    <div class="col-md-8 inputGroupContainer">
                                       <div class="input-group">
                                           <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                           <input id="username" name="username" placeholder="Username" class="form-control" required="true" value="" type="text">
                                       </div>
                                    </div>
                                 </div>

                              <div class="form-group">
                                 <label class="col-md-2 control-label">Email</label>
                                 <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope-square"></i></span>
                                        <input id="email" name="email" placeholder="Email" class="form-control" required="true" value="" type="email">
                                    </div>
                                 </div>
                              </div>

                              <div class="form-group">
                                 <label class="col-md-2 control-label">Password</label>
                                 <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input id="password" name="password" placeholder="Password" class="form-control" required="true" value="" type="password">
                                    </div>
                                 </div>
                              </div>

                              <div class="form-group">
                                    <label class="col-md-2 control-label">Birth Date</label>
                                    <div class="col-md-8 inputGroupContainer">
                                       <div class="input-group">
                                           <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                           <input id="birthdate" name="birthdate" placeholder="Birth Date" class="form-control" required="true" value="" type="date">
                                       </div>
                                    </div>
                                 </div>

                                 <div class="form-group">
                                        <label class="col-md-2 control-label">Npwp Number</label>
                                        <div class="col-md-8 inputGroupContainer">
                                           <div class="input-group">
                                               <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                               <input id="npwp_number" name="npwp_number" placeholder="Npwp Number" class="form-control" required="true" value="" type="text">
                                           </div>
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

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.responsive.js') }}" ></script>
    <script src="{{ asset('assets/js/pages/table-responsive.js') }}"></script>
@stop
