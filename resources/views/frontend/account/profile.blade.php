@extends('frontend.default')
@section('title')
    Profile
    @parent
@stop

@section('content')
<!-- Top Bar -->
<!-- <div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
</div> -->
<!-- Update Profile-->
<!--<div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="topup">Change Photo Profile</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('member.change-photo')}}" enctype="multipart/form-data" method="post">
            @csrf

            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                <button type="submit" class="btn btn-primary" style="cursor:pointer">Change</a>
            </div>
        </form>
        </div>
    </div>
</div>-->

<br/><br/><br/>
<section class="content profile-page">
    <div class="container-fluid">        
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>My Profile</strong></h2>
                        <div class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="modal" data-target="#edit-profile" role="button" aria-haspopup="true" aria-expanded="false" title="Change photo profile"> <i class="zmdi zmdi-edit"></i> </a></li>
                        </div>
                    </div>
                    <div class="body">
                        <form action="{{route('member.change-photo')}}" id="frmFileUpload" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-2 imgUp">
                                        <div class="imagePreview"></div>
                                            <label class="btn btn-primary" id="upload" style="cursor:pointer">
                                                Upload<input type="file" name="photo" class="uploadFile img" style="width: 0px;height: 0px;overflow:">
                                            </label>
                                            <button type="submit" class="btn btn-primary" id="submit" style="cursor:pointer">Submit</button>
                                        </div>
                                    </div>
                                </div><!-- row -->
                            </div><!-- container -->              
                        </form>
                        <br>
                        <p class="text-default">ID Member : {{$profile['id_member']}}</p>
                        <hr>
                        <p class="text-default">Username : {{$profile['username']}}</p>
                        <hr>
                        <p class="text-default">Name : {{$profile['name']}}</p>
                        <hr>
                        <p class="text-default">Email : {{$profile['email']}}</p>
                        <hr>
                        <p class="text-default">Birth Date : {{$profile['birthdate']}}</p>
                        <hr>
                        <p class="text-default">Mobile Number : {{$profile['phone_number']}}</p>
                        <hr>
                        <p class="text-default">NPWP : {{$profile['npwp_number']}}</p>
                        <hr>
                        <p class="text-default">Rek Number : {{$profile['no_rec']}}</p>
                        <hr>
                        <p class="text-default">Marital Status : {{$profile['is_married']}}</p>
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
    <style>
        body
        {
            font-size: 14px;
        }

        @media only screen and (max-width: 780px) {
           .imagePreview{
               width: 100% !important;
           }
            .btn-primary{
                width: 100% !important;
            }
        }

        p
        {
            padding-left: 35px;
        }
        .imagePreview {
            width: 200%;
            height: 280px;
            background-position: center center;
            background:url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
            background-color:#fff;
            background-size: cover;
            background-repeat:no-repeat;
            display: inline-block;
            box-shadow:0px -3px 6px 2px rgba(0,0,0,0.2);
        }
        .btn-primary
        {
            display:block;
            border-radius:0px;
            box-shadow:0px 4px 6px 2px rgba(0,0,0,0.2);
            margin-top:-5px;
            width: 200%;
        }
        .imgUp
        {
            margin-bottom:15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on("change",".uploadFile", function(){
                var uploadFile = $(this);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return;
        
                if (/^image/.test( files[0].type)){
                    var reader = new FileReader();
                    reader.readAsDataURL(files[0]);
        
                    reader.onloadend = function(){
                        uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
                    }
                }
            
            });   
        });
    </script>
@stop

