<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employeer;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  // protected function buildFailedValidationResponse(Request $request, array $errors) {
  //   return ["success" => false, "code"=> 406 , "message" => "forbidden" , "errors" =>$errors];
  // }

  public function login(Request $request)
  {
    $username = $request->input('username');
    $password = $request->input('password');
    
    if($username == '' || $password == '') {
      return response()->json([
        'success' => false,
        'message' => 'Parameter tidak lengkap'
      ]);
    }

    if($check = Employeer::where('username', $username)->orWhere('email', $username)->first()) {
      $checkPassword = Hash::check($password, $check->password);

      if(!$checkPassword) {
        return response()->json([
          'success' => false,
          'message' => 'Password Salah'
        ]);
      }

      return response()->json([
        'success' => true,
        'message' => 'Success Login',
        'data' => $check
      ]);
    }

    return response()->json([
      'success' => false,
      'message' => 'Member tidak ditemukan'
    ]);

  }
}
