<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Employeer;
use DataTables;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OldMemberMail;
use Alert;

class ForgotPasswordController extends Controller
{
    public function sendEmail(Request $request){
        $datas = Employeer::where('email',$request->email)->get();
        $password = strtolower(str_random(8));
        foreach ($datas as $key => $data) {
            $user['password'] = bcrypt($password);
            Employeer::find($data->id)->update($user);
            $dataEmail = (object) [
                'username' => $data->username,
                'password' => $password
            ];
            if ($data->status==0) {
                Alert::error('Your account has been banned, please contact admin', 'Error')->persistent("OK");
                return redirect()->back();
            }else{
                if (filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
                    Mail::to($data->email)->send(new OldMemberMail($dataEmail));
                    Alert::success('Please check your email', 'Success')->persistent("OK");
                }else{
                    Alert::error('Your email is wrong', 'Error')->persistent("OK");
                }
            }
        }
        return redirect()->back();
    }
}
