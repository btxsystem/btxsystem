<nav class="navbar navbar-inverse" style="background-color:#ffb320;">
    <div class="container">
      <div class="navbar-header d-none d-sm-block">
          <a class="navbar-brand" href="{{ route('member.explore') }}">
          <button type="button" class="btn btn-transparent-border border text-white">
            <img src="{{asset('assetsebook/assets/img/back-icon2.png')}}" class="pr5"> 
            <span>KEMBALI</span>
          </button>
          </a>
      </div>
      <div class="navbar-header d-sm-none">
          <a class="navbar-brand" href="#">
          <button type="button" class="btn btn-transparent-border border text-white">
            <img src="{{asset('assetsebook/assets/img/back-icon2.png')}}" class="pr5"> 
          </button>
          </a>
      </div>
      <a class="navbar-brand" href="{{ route('member.explore') }}">
      <img src="{{asset('assetsebook/v2/img/logo-white.png')}}" alt="logo" height="50">
      </a>
      <ul class="nav navbar-nav navbar-right">
          <!-- <li>
            <a href="#">
            <img src="{{asset('assetsebook/assets/img/big-profile.png')}}" class="img-circle" width="35" height="35"> 
            </a>
          </li> -->
      </ul>
    </div>
</nav>