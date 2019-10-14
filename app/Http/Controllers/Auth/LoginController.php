<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employeer;
use Auth;
use DB;
use Alert;
use Carbon\Carbon;

class LoginController extends Controller
{
  public function getLogin()
  {

    // return view('frontend.auth.maintenance');
    return view('frontend.auth.login');
  }
  public function postLogin(Request $request)
  {

    $this->validate($request, [
      'username' => 'required',
      'password' => 'required'
    ]);

    $data = DB::table('close_member')->select('is_close_member')->first();

    if (Auth::guard('user')->attempt(['username' => $request->username, 'password' => $request->password]) || Auth::guard('user')->attempt(['email' => $request->username, 'password' => $request->password])) {
      
      if (Auth::user()->expired_at <= Carbon::now() || Auth::user()->expired_at==null) {
        Auth::guard('user')->logout();
        return view('frontend.expired-member');
      }

      elseif(Auth::user()->status==0) {
        Auth::guard('user')->logout();
        Alert::error('Your account has been banned, please contact admin', 'Error')->persistent("OK");
        return view('frontend.auth.login');
      }

      elseif ($data->is_close_member == 1) {
        Auth::guard('user')->logout();
        return view('frontend.auth.maintenance');
      }

      return redirect()->route('member.dashboard');

    } else if (Auth::guard('nonmember')->attempt(['username' => $request->username, 'password' => $request->password])){
        if ($data->is_close_member == 1) {
          Auth::guard('user')->logout();
          return view('frontend.auth.maintenance');
        }
      return redirect()->route('member.home');
    }

    else{
      Alert::error('Username or password is incorrect', 'Error')->persistent("OK");
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
