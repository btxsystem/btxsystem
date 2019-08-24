@extends('member-v2.layouts.main')
@section('title')
    Explore
    @parent
@stop

@section('styles')
<link rel="stylesheet" href="{{asset('assetsebook/assets/css/style.css')}}">
@stop

@section('style_class')bit-bg1 @stop

@section('content')
@include('member-v2.partials.navbar-lesson')
<div class="container c1 mb-3">
  <div class="col-12" style="padding: 16px;">
      <div class="row">
        <div class="col-xl-3 col-lg-3 col-sm-4 col-12 offset-md-2 d-none d-sm-block">
            <!-- <img src="{{asset('assetsebook/assets/img/mascot.png')}}" class="img-robot"> -->
        </div>
        <div class="col-xl-5 col-lg-5 col-sm-6 col-12">
            <div class="card-wrapper bit-form1">
              <div class="card fat" style="margin-top: 20px;">
                  <div class="card-body" style="padding: 40px;">
                    <h4 class="card-title">Login Untuk Melanjutkan</h4>
                    <form method="post" class="my-login-validation" novalidate="" action="{{route('member.login.post')}}">
                    @csrf
                        <div class="form-group">
                          <label for="email">Username</label>
                          <label class="sr-only" for="inlineFormInputGroup"></label>
                          <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><img src="{{asset('assetsebook/assets/img/email.png')}}"></div>
                              </div>
                              <input type="text" class="form-control" name="username" placeholder="Masukan username anda">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <label class="sr-only" for="inlineFormInputGroup"></label>
                          <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><img src="{{asset('assetsebook/assets/img/password.png')}}"></div>
                              </div>
                              <input type="password" class="form-control" name="password" placeholder="Masukan password anda">
                          </div>
                          <a href="#" class="float-right linkgray mb30 fz13">Lupa Password?</a>
                        </div>
                        <div class="form-group">
                          <button class="btn btn-md btn-block btn-warning" style="border-radius: 30px;">
                          Login
                          </button>
                        </div>
                        <div class="soc mt30">
                          <div class="form-group soc-line position-relative text-center"><span class="position-relative">Atau login dengan</span></div>
                          <div class="row">
                              <div class="col-sm-6 col-6">
                                <a href="#" class="btn btn-lg btn-block btn-fb mb-3">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                              </div>
                              <div class="col-sm-6 col-6">
                                <a href="#" class="btn btn-lg btn-block btn-gplus mb-3">
                                <i class="fa fa-google-plus" aria-hidden="true"></i>
                                </a>
                              </div>
                          </div>
                        </div>
                        <div class="mt-4 text-center colorgray">
                          Belum punya akun? <a href="#" class="linkgrayoutline">Daftar</a>
                        </div>
                    </form>
                  </div>
              </div>
            </div>
        </div>
      </div>
  </div>
</div>
</div>
@stop