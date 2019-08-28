<div class="col-12 d-flex justify-content-center" style="position: absolute; z-index: 1030;">
  <div class="col-lg-2 col-6 py-3">
    <img src="{{asset('assetsebook/v2/img/logo-white.png')}}" class="mx-auto d-block img-fluid logo">
    <div class="mt-3">
    @if(Auth::guard('nonmember')->user() != null || Auth::guard('user')->user() != null)
      <a href="{{route('member.logout')}}" class="btn btn-warning btn-block">Logout</a>
    @else
      <a href="{{route('member.login')}}" class="btn btn-warning btn-block">Login</a>
    @endif;
    </div>
  </div>
</div>