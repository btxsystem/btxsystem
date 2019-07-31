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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
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
                                               <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
                                               <input id="npwp_number" name="npwp_number" placeholder="Npwp Number" class="form-control" required="true" value="" type="text">
                                           </div>
                                        </div>
                                     </div>

                                         <div class="form-group">
                                                <label class="col-md-2 control-label">Married Status</label>
                                                <div class="col-md-8 inputGroupContainer">
                                                   <div class="input-group">
                                                       <span class="input-group-addon"><i class="glyphicon glyphicon-heart"></i></span>
                                                       <select name="is_married[]" id="is_married" class="form-control" required="true">
                                                           <option value="" disabled selected>Please choice your married status</option>
                                                           <option value="0">Single</option>
                                                           <option value="1">Married</option>
                                                       </select>
                                                   </div>
                                                </div>
                                             </div>
                                    
                                             <div class="form-group">
                                                    <label class="col-md-2 control-label">Gender</label>
                                                    <div class="col-md-8 inputGroupContainer">
                                                       <div class="input-group">
                                                           <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
                                                           <select name="gender[]" id="gender" class="form-control" required="true">
                                                                <option value="" disabled selected>Please choice your gender</option>
                                                                <option value="0">Male</option>
                                                                <option value="1">Female</option>
                                                           </select>
                                                       </div>
                                                    </div>
                                                 </div>
                                                        
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Phone Number</label>
                                                <div class="col-md-8 inputGroupContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                        <input id="phone_number" name="phone_number" placeholder="Phone Number" class="form-control" required="true" value="" type="text">
                                                    </div>
                                                </div>
                                                </div>

                                                <div class="form-group">
                                                        <label class="col-md-2 control-label">No Rekening</label>
                                                        <div class="col-md-8 inputGroupContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-cc-mastercard"></i></span>
                                                                <input id="no_rec" name="no_rec" placeholder="No Rekening" class="form-control" required="true" value="" type="text">
                                                            </div>
                                                        </div>
                                                        </div>

                                                        <div class="form-group">
                                                                <label class="col-md-2 control-label">Sponsor</label>
                                                                <div class="col-md-8 inputGroupContainer">
                                                                   <div class="input-group">
                                                                       <span class="input-group-addon"><i class="fa fa-male"></i></span>
                                                                       <select name="sponsor_id[]" id="sponsor_id" class="form-control cari" required="true">

                                                                       </select>
                                                                   </div>
                                                                </div>
                                                             </div>
                                                        
                                                
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Upline</label>
                                                            <div class="col-md-8 inputGroupContainer">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                                    <select name="parent_id[]" id="parent_id" class="form-control" required="true">

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            </div>

                                                    
                                                            <div class="form-group">
                                                                    <label class="col-md-2 control-label">Position</label>
                                                                    <div class="col-md-8 inputGroupContainer">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-crosshairs"></i></span>
                                                                            <select name="position[]" id="position" class="form-control" required="true">
        
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                            
                                                        
                                                                    <div class="form-group">
                                                                        <label class="col-md-2 control-label"></label>
                                                                        <div class="col-md-8 inputGroupContainer">
                                                                            <button type="submit" class="btn btn-primary btn-block">Register</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.cari').select2({
                placeholder: 'Choice sponsor',
                ajax: {
                    url: '{{ route("select.sponsor") }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        console.log(data);            
                    return {
                        results:  $.map(data, function (item) {
                        return {
                            text: item.first_name,
                            id: item.id
                        }
                        })
                    };
                    },
                    cache: true
                }
            });
        });
      </script>
@stop
