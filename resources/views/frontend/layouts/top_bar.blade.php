<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="train" style="color:red"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 style="color:red">sure you want to logout?</h5>
            </div>
            <div class="modal-footer">
                <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                <a class="btn btn-primary" href="/logout">Logout</a>
            </div>
        </div>
    </div>
</div>

<nav class="navbar">
    <div class="col-12">
        <div class="nav navbar-header">
            <a href="javascript:void(0);" class="bars" style="color:white"></a>
            <a class="navbar-brand " href="#"><img src="{{asset('assetsebook/v2/img/logo-white.png')}}" alt="" style="height:35px"></a>
        </div>
        <ul class="nav navbar-nav navbar-left">
            <li><a href="javascript:void(0);" class="ls-toggle-btn" data-close="true"><i class="zmdi zmdi-swap"></i></a></li>
            <li><i class="zmsdi"><span id="clock"></span></i></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li style="font-size:13px"><a data-toggle="modal" data-target="#logout" title="sign out" style="text-decoration:none; cursor:pointer;" class="logout"><strong>Logout</strong>&nbsp<i class="fa fa-sign-out" style="color:red; cursor:pointer;"></a></i></li> 
        </ul>
    </div>
</nav>
