<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Employeer;
use DB;

class ProfileMemberController extends Controller
{
    
    public function index()
    {
        $data = Auth::user();
        $rank = DB::table('ranks')->select('name')->where('id','=',$data->rank_id)->first();
        $profile = array(
            "id_member" => $data->id_member,
            "username" =>  $data->username,
            "name" => $data->first_name.' '.$data->last_name,
            "email" => $data->email,
            "birthdate" => date('F j, Y',strtotime($data->birthdate)),
            "npwp_number" => $data->npwp_number,
            "is_married" => $data->is_married ? 'Married' : 'Single',
            "gender" => $data->gender ? 'Male' : 'Female',
            "status" => $data->status ? 'Active' : 'Nonactive',
            "phone_number" => $data->phone_number,
            "no_rec" => $data->no_rec,
            "rank" => $rank->name,
            "bitrex_cash" => $data->bitrex_cash,
            "bitrex_points" => $data->bitrex_points,
            "pv" => $data->pv
        );
        return view('frontend.account.profile')->with('profile',$profile);
    }

    public function resetPassword(Request $request){
        $data = Auth::user();
        $new = bcrypt($request->new_password);
        $cek = password_verify($request->old_password, $data->password);
        if ($cek) {
            if($request->new_password != $request->old_password){
                $pass['password'] = $new;
                $info = Employeer::find($data->id)->update($pass);
                Alert::success('pesan yang ingin disampaikan', 'Judul Pesan');
            }else{
                Alert::failed('The password must difference', 'Failed');
            }
        }else{
            // password dont same with password on db
            Alert::failed('The password you entered does not match', 'Failed');
        }
        return view('frontend.dashboard');
    }

    public function register(Request $request){
        $sponsor = Auth::user();
        $data = [
            'id_member' => invoiceNumbering(),
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt('Mbitrex'.rand(100,1000)),
            'birthdate' => $request->birthdate,
            'npwp_number' => '-',
            'is_married' => 0,
            'gender' => $request->gender,
            'status' => 1,
            'phone_number' => $request->number_phone,
            'no_rec' => '-',
            'position' => $request->position,
            'parent_id' => $request->parent,
            'sponsor_id' => $sponsor->id,
            'rank_id' => 1,
            'bitrex_cash' => 0,
            'bitrex_points' => 0,
            'pv' => 0   
        ];
        
        Employeer::create($data);
        return redirect()->route('member.tree');
    }
}
