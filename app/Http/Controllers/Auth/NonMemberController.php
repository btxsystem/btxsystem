<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\NonMember;
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

    if (Auth::guard('non_member')->attempt(['username' => $request->username, 'password' => $request->password])) {
      return redirect()->route('member.subscription');
    }

    return view('member-v2.components.login');
  }

  public function logout()
  {
    if (Auth::guard('non_member')->check()) {
      Auth::guard('non_member')->logout();
    } 
    return redirect()->route('member.login');
  }
}
