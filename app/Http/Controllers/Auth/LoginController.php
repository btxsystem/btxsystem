<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employeer;
use Auth;
class LoginController extends Controller
{
  public function getLogin()
  {
    return view('frontend.auth.login');
  }
  public function postLogin(Request $request)
  {
      // Validate the form data
    $this->validate($request, [
      'username' => 'required',
      'password' => 'required'
    ]);
      // Attempt to log the user in
      // Passwordnya pake bcrypt
    if (Auth::guard('user')->attempt(['username' => $request->username, 'password' => $request->password])) {
        // if successful, then redirect to their intended location
      return redirect()->route('member.dashboard');
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
