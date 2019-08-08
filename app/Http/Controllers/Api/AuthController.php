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


    // protected $guard = 'admin';

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

        if ($auth::guard('admin')->attempt($credensial)) {

            $user = $request->user('admin');

            // if (!$user->status) {
            //     return response()->json(['error'=>'User Locked'], 400);
            // }

            User::where('id', $user->id)->update(['fcm_token' => request('fcmToken')]);

            $success['user']  =  $user;
            $success['token'] =  $user->createToken('SmsApi')->accessToken;

            $success['permissions'] = DB::table('permission_role')
            ->join('permissions', 'permission_role.permission_id', '=', 'permissions.id')
            ->where('permission_role.role_id', $user->roles_id)
            ->pluck('name');
            
            return response()->json($success, $this->successStatus, [], JSON_NUMERIC_CHECK);
        }

        return response()->json(['error'=>'Unauthorised'], 401);
    }


    /**
     * Store FCM Token
     *
     * @return \Illuminate\Http\Response
     */
    public function setFCMToken()
    {
        $auth = new Auth;

        if ($auth::check()) {

            $user = $$request->user('admin');

            User::where('id', $user->id)->update(['fcm_token' => request('fcmToken')]);

            return response()->json(['status'=>200], 200);
        }

        return response()->json(['error'=>'Unauthorised'], 401);
    }

        /**
     * Logout api
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        $auth = new Auth;

        if ($auth::check()) {
            $auth::user('admin')->authAcessToken()->delete();
        }

        return response()->json(['success' => 1], $this->successStatus);
    }

}


/*
INSERT INTO `permissions` (`id`,`name`) VALUES

('200', 'System.Users.Create'),
('201', 'System.Users.Edit'),  
('202', 'System.Users.Delete'),
('203', 'System.Roles.Create'),
('204', 'System.Roles.Edit'),  
('205', 'System.Roles.Delete'),
('206', 'System.Users.View'),  
('207', 'System.Roles.View'),  
('208', 'Member.Member.View'), 
('209', 'Member.Member.Create'),
('210', 'Member.Member.Edit'), 
('211', 'Member.Member.Delete'),      
('212', 'Customer.Customer.View'),  
('213', 'Customer.Customer.Create'),
('214', 'Customer.Customer.Edit'),  
('215', 'Customer.Customer.Delete'),
('216', 'Tree.Tree.View'),          
('217', 'Tree.Tree.Create'),          
('218', 'Tree.Tree.Edit'),          
('219', 'Tree.Tree.Delete'),          
('220', 'Training.Management.View'),
('221', 'Training.Class.View'),       
('222', 'Bitrex.Points.View'),      
('223', 'Bitrex.Points.Create'),      
('224', 'Bitrex.Points.Edit'),      
('225', 'Bitrex.Points.Delete'),      
('226', 'Bitrex.Cash.View'),          
('227', 'Bitrex.Cash.Create'),      
('228', 'Bitrex.Cash.Edit'),          
('229', 'Bitrex.Cash.Delete')
*/



/*
INSERT INTO `permission_role` (`permission_id`,`role_id`) VALUES

('200', '1'),
('201', '1'),
('202', '1'),
('203', '1'),
('204', '1'),
('205', '1'),
('206', '1'),
('207', '1'),
('208', '1'),
('209', '1'),
('210', '1'),
('211', '1'),
('212', '1'),
('213', '1'),
('214', '1'),
('215', '1'),
('216', '1'),
('217', '1'),
('218', '1'),
('219', '1'),
('220', '1'),
('221', '1'),
('222', '1'),
('223', '1'),
('224', '1'),
('225', '1'),
('226', '1'),
('227', '1'),
('228', '1'),
('229', '1')
*/