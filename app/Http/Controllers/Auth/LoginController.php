<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employeer;
use Auth;
use Alert;
use Carbon\Carbon;

class LoginController extends Controller
{
  public function getLogin()
  {
    return view('frontend.auth.login');
  }
  public function postLogin(Request $request)
  {
    $this->validate($request, [
      'username' => 'required',
      'password' => 'required'
    ]);
    if (Auth::guard('user')->attempt(['username' => $request->username, 'password' => $request->password]) || Auth::guard('user')->attempt(['email' => $request->username, 'password' => $request->password])) {
      if (Auth::user()->expired_at <= Carbon::now() || Auth::user()->expired_at==null) {
        Auth::guard('user')->logout();
        return view('frontend.expired-member');
      }
      return redirect()->route('member.dashboard');
    } else if (Auth::guard('nonmember')->attempt(['username' => $request->username, 'password' => $request->password])){
      return redirect()->route('member.home');
    }
    return view('frontend.auth.login');
  }

  public function logout()
  {
    if (Auth::guard('user')->check()) {
      Auth::guard('user')->logout();
    } 
    return redirect('/login');
  }
}
