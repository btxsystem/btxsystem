@extends('frontend.default')
@section('title')
    Profile
    @parent
@stop

@section('content')
<!-- Top Bar -->
<div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="topup">Top Up Bitrex Points</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="/action_page.php">
            <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-line">
                    <input class="form-control" id="nominal" type="number" min="5">
                    <label class="form-label">Nominal</label>
                </div>
            </div>
            <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-line">
                    <input class="form-control" id="points" type="text" readonly>
                </div>
            </div>
        </form>
        <div class="modal-footer">
            <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
            <a href="#" class="btn btn-primary">Topup</a>
        </div>
        </div>
    </div>
</div>
    
<section class="content profile-page">
    <section class="boxs-simple">
        <div class="profile-header">
            <div class="profile_info row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="profile-image float-md-right"> <img src="assets/images/profile_av.jpg" alt=""> </div>
                </div>
                <div class="col-lg-6 col-md-8 col-12">
                    <h4 class="m-t-5 m-b-0"><strong>{{$profile['name']}}</strong></h4>
                    <span class="job_post"><b>ID : {{$profile['id_member']}}</b></span>
                    <p>Phone Number {{$profile['phone_number']}}</p>
                </div>                
            </div>
        </div>
        <div class="profile-sub-header">
            <div class="box-list">
                <ul class="text-center">
                    <li>
                        <a title="rank"><i class="zmdi zmdi-star-circle"></i>
                            <p>{{$profile['rank']}}</p>
                        </a>
                    </li>
                    <li><a title="email"><i class="zmdi zmdi-email"></i>
                        <p>{{$profile['email']}}</p>
                    </a></li>
                    <li><a title="username"><i class="zmdi zmdi-account-circle"></i>
                        <p>{{$profile['username']}}</p>
                    </a></li>
                    <li><a title="npwp number"><i class="zmdi zmdi-account-box-o"></i>
                        <p>{{$profile['npwp_number']}}</p>
                    </a></li>
                </ul>
            </div>
        </div>
    </section>
    <div class="container-fluid">        
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>My Profile</strong></h2>
                        <div class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="modal" data-target="#edit-profile" role="button" aria-haspopup="true" aria-expanded="false" title="Edit Profile"> <i class="zmdi zmdi-edit"></i> </a></li>
                        </div>
                    </div>
                    <div class="body">
                        <p class="text-default">Birth Date : {{$profile['birthdate']}}</p>
                        <hr>
                        <p class="text-default">Gender : {{$profile['gender']}}</p>
                        <hr>
                        <p class="text-default">Bank Account Number : {{$profile['no_rec']}}</p>
                        <hr>
                    </div>
                </div>                
            </div>
    </div>
</section>
@stop


@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
          console.log('aaaa');
        });
    </script>
@stop

