@extends('layouts.admin')

@section('title')
Registration User
@parent
@stop

@section('content')

<section class="content-header">
    <h1> Customer</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Customer Management</a>
        </li>
        <li class="active">Edit Data Customer</li>
    </ol>

    <div class="container">
            <table class="table table-striped">
               <tbody>
                  <tr>
                     <td colspan="1">
                        <form class="well form-horizontal" method="post" action="{{route('customer.update',$data->id)}}">
                            {{ csrf_field() }} {{ method_field('PATCH')}}
                           <fieldset>
                           <input id="id"  name="id"  required="true" value="{{$data->id}}" type="hidden">
                              <div class="form-group">
                                 <label class="col-md-2 control-label">Full Name</label>
                                 <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="first_name"  name="first_name" placeholder="First Name" class="form-control" required="true" value="{{$data ? $data->first_name : old('first_name')}}" type="text">
                                    </div>
                                 </div>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i></i></span>
                                        <input id="last_name" name="last_name" placeholder="Last Name" class="form-control" required="true" value="{{$data ? $data->last_name : old('last_name')}}" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Username</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input id="username" name="username" placeholder="Username" class="form-control" required="true" value="{{$data ? $data->username : old('username')}}" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Password</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input id="password" name="password" placeholder="Password" class="form-control" required="true" value="{{$data ? $data->username : old('username')}}" type="password">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Email</label>
                                <div class="col-md-8 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope-square"></i></span>
                                    <input id="email" name="email" placeholder="Email" class="form-control" required="true" value="{{$data ? $data->email : old('email')}}" type="email">
                                </div>
                                </div>
                            </div>

                           <!--  <div class="form-group">
                                <label class="col-md-2 control-label">Password</label>
                                <div class="col-md-8 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input id="password" name="password" placeholder="Password" class="form-control" required="true" value="{{$data ? $data->password : old('password')}}" type="password">
                                </div>
                                </div>
                            </div> -->

                           <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-8 inputGroupContainer">                                

                                    @if($data) 
                                        <button class="btn btn-primary btn-block" name="_method" value="put" type="submit"> Update</button>
                                    @else
                                       <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                    @endif
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
    <script type="text/javascript">

       
      </script>
@stop
