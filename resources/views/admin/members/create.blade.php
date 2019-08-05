@extends('layouts.admin')

@section('title')
Registration User
@parent
@stop

@section('content')

<section class="content-header">
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
                                            <select name="is_married" id="is_married" class="form-control" required="true">
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
                                        <select name="gender" id="gender" class="form-control" required="true">
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
                                        <select name="sponsor_id" id="sponsor_id" class="form-control cari" required="true">

                                        </select>
                                    </div>
                                </div>
                                </div>
                        
                                            
                                <div class="form-group">
                                <label class="col-md-2 control-label">Upline</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                        <select name="parent_id" id="parent_id" class="form-control" required="true">

                                        </select>
                                    </div>
                                </div>
                                </div>

                                                    
                                <div class="form-group">
                                <label class="col-md-2 control-label">Position</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-crosshairs"></i></span>
                                        <select name="position" id="position" class="form-control" required="true">

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

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.cari').select2({
            placeholder: "Choose sponsor...",
            ajax: {
                url: '{{ route("select.sponsor") }}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
                }
            });
        });

        $('.cari').change(function(){
            id = $('.cari').val();
            $('#parent_id').select2({
            placeholder: "Choose upline...",
            ajax: {
                url: '/select/'+id+'/upline',
                dataType: 'json',
                data: function (params) {
                    console.log(params);
                    
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
                }
            });
        })
    </script>
@stop
