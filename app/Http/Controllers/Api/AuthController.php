<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\User;
use Log;
// use Validator;

class AuthController extends Controller 
{

    public $successStatus = 200;

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
         $auth = new Auth;

         $credensial = [
            'username' => $request->username, 
            'password' => $request->password
        ];

        if ($auth::attempt($credensial)) {

            $user = Auth::user();

            if (!$user->status) {
                return response()->json(['error'=>'User Locked'], 400);
            }

            User::where('id', $user->id)->update(['fcm_token' => request('fcmToken')]);

            $success['user']  =  $user;
            $success['token'] =  $user->createToken('SmsApi')->accessToken;

            $success['permissions'] = DB::table('role_permissions')
            ->join('permissions', 'role_permissions.permissions_id', '=', 'permissions.id')
            ->where('role_permissions.roles_id', $user->roles_id)
            ->pluck('name');
            
            return response()->json($success, $this->successStatus, [], JSON_NUMERIC_CHECK);
        }

        return response()->json(['error'=>'Unauthorised'], 401);
    }


}
