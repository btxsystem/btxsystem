@extends('member-v2.layouts.main')
@section('title')
    Explore
    @parent
@stop

@section('styles')
<link rel="stylesheet" href="{{asset('assetsebook/assets/css/style.css')}}">
@stop

@section('style_class')bit-bsg1 @stop

@section('content')
<div class="container mb-3">
  <div class="col-12" style="padding: 16px;">
      <div class="row">
        <div class="col-xl-5 mx-auto mt-5 pt-5">
            <div class="card-wrapper">
              <div class="card fat bg-light" style="margin-top: 20px;">
                  <div class="card-body" style="padding: 40px;">
                    <h4 class="card-title text-dark">Login Untuk Melanjutkan</h4>
                    <form method="post" class="my-login-validation" novalidate="" action="{{route('member.login.post')}}">
                    @csrf
                        <div class="form-group">
                          <label for="email" class="text-dark">Username</label>
                          <label class="sr-only" for="inlineFormInputGroup"></label>
                          <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><img src="{{asset('assetsebook/assets/img/email.png')}}"></div>
                              </div>
                              <input type="text" class="form-control" name="username" placeholder="Masukan username anda">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="password" class="text-dark">Password</label>
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
                          <button class="btn btn-md btn-block btn-identity-red text-white" style="border-radius: 30px;">
                          Login
                          </button>
                        </div>
          
                        <div class="mt-4 text-center colorgray">
                          Belum punya akun? <a href="{{route('member.home')}}" class="linkgrayoutline">Daftar</a>
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