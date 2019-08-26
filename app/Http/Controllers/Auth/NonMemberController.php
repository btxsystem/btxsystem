<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class NonMemberController extends Controller
{
  public function getLogin()
  {
    return view('member-v2.components.login');
  }
  
  public function postLogin(Request $request)
  {
    $this->validate($request, [
      'username' => 'required',
      'password' => 'required'
    ]);

    if (Auth::guard('nonmember')->attempt(['username' => $request->username, 'password' => $request->password])){
      //dd(Auth::guard('nonmember')->user()->id);
      return redirect()->route('member.subscription');
    } else if (Auth::guard('user')->attempt(['username' => $request->username, 'password' => $request->password])) {
      return redirect()->route('member.subscription');
    }
    // Tambah logic member

    return view('member-v2.components.login');
  }

  public function logout()
  {
    if (Auth::guard('nonmember')->check()) {
      Auth::guard('nonmember')->logout();
    } else if (Auth::guard('user')->check()) {
      Auth::guard('user')->logout();
    }
    // Tambah logic member
    return redirect()->route('member.login');
  }
}
