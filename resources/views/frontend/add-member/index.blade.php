@extends('frontend.default')
@section('title')
    Add New Member
    @parent
@stop
@section('content')
<section class="content ecommerce-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Add New Member
                <small class="text-muted">Bitrexgo</small>
                </h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">        
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{route('member.register-auto')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group form-float col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-line">
                                                <input class="form-control" name="username" id="username" type="text" min="4" required>
                                                <label class="form-label">Username</label>
                                            </div>
                                            <div>
                                                <b id="username_notif"></b>
                                            </div>
                                        </div>
                                        <div class="form-group form-float col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-line">
                                                <input class="form-control" name="email" id="email" type="email" min="4" required>
                                                <label class="form-label">Email</label>
                                            </div>
                                            <div>
                                                <b style="color:red" id="email_notif"></b>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group form-float col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-line">
                                                <input class="form-control" name="first_name" id="first_name" type="text" min="4" required>
                                                <label class="form-label">First Name</label>
                                            </div>
                                            <div>
                                                <b style="color:red" id="first_name_notif"></b>
                                            </div>
                                        </div>
                                        <div class="form-group form-float col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-line">
                                                <input class="form-control" name="last_name" id="last_name" type="text" min="4" required>
                                                <label class="form-label">Last Name</label>
                                            </div>
                                            <div>
                                                <b style="color:red" id="last_name_notif"></b>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group form-float col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-line">
                                                <input class="form-control" name="passport" id="passport" type="number" min="4" required>
                                                <label class="form-label">NIK/Passport</label>
                                            </div>
                                            <div>
                                                <b style="color:red" id="passport_notif"></b>
                                            </div>
                                        </div>
                                        <div class="form-group form-float col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-line">
                                                <input name="birthdate" class="datepicker form-control" min="4" placeholder="Birthdate" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group form-float col-lg-11 col-md-11 col-sm-11 col-xs-11">
                                        </div>
                                        <div class="form-group form-float col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                            <button type="submit" id="goto-join" class="btn btn-primary" style="cursor: pointer;">JOIN</button>
                                        </div>
                                    </div>                           
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop  
@extends('frontend.add-member.scripts')