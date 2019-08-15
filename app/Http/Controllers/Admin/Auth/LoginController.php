<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
  public function getLogin()
  {
    
    return view('admin.auth.login');
  }
  public function postLogin(Request $request)
  {
    //dd($request);
      // Validate the form data
    $this->validate($request, [
      'email' => 'required',
      'password' => 'required'
    ]);
      // Attempt to log the user in
      // Passwordnya pake bcrypt
    

    if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
      

        // if successful, then redirect to their intended location
      return redirect()->route('user');
    }
    return view('admin.auth.login');
  }

  public function logout()
  {
    if (Auth::guard('admin')->check()) {
      Auth::guard('admin')->logout();
    } 
    return redirect('/login');
  }
}
