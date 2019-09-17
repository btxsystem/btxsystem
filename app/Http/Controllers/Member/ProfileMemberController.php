<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Employeer;
use DB;
use Carbon\Carbon;

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
            'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'position' => $request->position,
            'parent_id' => $request->parent,
            'sponsor_id' => $sponsor->id,
            'bitrex_cash' => 0,
            'bitrex_points' => 0,
            'pv' => 0,
            'nik' => $request->nik,
        ];

        Employeer::create($data);
        return redirect()->route('member.tree');
    }

    public function isSameUsername($user){
        $data = [
            'status' => 200,
            'username' => false,
        ];
        $cek = Employeer::where('username','=',$user)->select('username')->first();
        $cek ? $data['username'] = true : $data['username'] = false;
        return response()->json($data);
    }

    public function rewards(){
        $data = Auth::user();
        $ranks = DB::table('ranks')->select('name','pv_needed_left','pv_needed_midle','pv_needed_right')->get();
        $rewards = DB::table('gift_rewards')->select('id','description','nominal')->get();
        return view('frontend.rewards.index',['profile'=>$data, 'ranks'=> $ranks, 'rewards'=> $rewards]);
    }

    public function getRewards(){
        $member = Auth::user();
        $rewards = DB::table('got_rewards')->join('gift_rewards','got_rewards.reward_id','=','gift_rewards.id')
                                           ->where('member_id',$member->id)
                                           ->select('gift_rewards.id','gift_rewards.description','gift_rewards.nominal','got_rewards.status','got_rewards.created_at')
                                           ->orderBy('got_rewards.created_at','desc')
                                           ->paginate(4);
        return response()->json($rewards, 200);
    }

    public function getMyRewards($id){
        $member = Auth::user();
        if($id==1){
            $pajak = $member->verification == 1 ? 0.025 : 0.03;
           try {
                DB::beginTransaction();
                DB::table('got_rewards')->where('reward_id', $id)->andWhere('member_id', Auth::id())->update(['status' => 1, 'updated_at' => now()]);
                DB::table('history_bitrex_cash')->insert(['id_member' => $member->id, 'nominal' => 3000000 - (3000000 * $pajak), 'created_at' => now(), 'updated_at' => now(), 'description' => 'Bonus Rewards', 'info' => 1, 'type' => 3]);
                DB::table('employeers')->where('id', $member->id)->update(['bitrex_cash' => $member->bitrex_cash += 3000000 - (3000000 * $pajak), 'updated_at' => now()]);
                DB::table('history_pajak')->insert(['id_member' => $member->id, 'id_bonus' => 4, 'persentase' => $pajak, 'nominal' => 3000000 * $pajak, 'created_at' => now(), 'updated_at' => now()]);
                return 'yes';
            } catch (\Throwable $th) {
                DB::rollback();
           }
        }else{
            DB::table('got_rewards')->where('reward_id', $id)->update(['status' => 1, 'updated_at' => now()]);
        }
        return redirect()->route('member.reward');
    }

    public function getExpiredMember(){
        $time = DB::table('employeers')->where('id',Auth::id())->select('expired_at')->first();
        return response()->json($time, 200);
    }

    public function findChild($id, $sponsor, $data){
        $isHaveChild = Employeer::where('parent_id',$id)->select('position')->get();
        if (count($isHaveChild) == 3) {
            $pv = DB::table('pv_rank')->where('id_member',$id)->select('pv_left', 'pv_midle', 'pv_right')->first();
            if($pv != null){
                if ($pv->pv_left <= $pv->pv_midle and $pv->pv_left <= $pv->pv_right) {
                    $child = Employeer::where('parent_id',$id)->where('position',0)->select('id')->first();
                    $this->findChild($child->id, $sponsor, $data);
                }elseif ($pv->pv_midle < $pv->pv_left and $pv->pv_midle <= $pv->pv_right) {
                    $child = Employeer::where('parent_id',$id)->where('position',1)->select('id')->first();
                    $this->findChild($child->id, $sponsor, $data);
                }else {
                    $child = Employeer::where('parent_id',$id)->where('position',2)->select('id')->first();
                    $this->findChild($child->id, $sponsor, $data);
                }
            }else{
                $child = Employeer::where('parent_id',$id)->where('position',0)->select('id')->first();
                $this->findChild($child->id, $sponsor, $data);
            }
        }elseif (count($isHaveChild)==0) {
            $member = [
                'id_member' => invoiceNumbering(),
                'username' => $data->username,
                'first_name' => $data->first_name,
                'last_name' => $data->last_name,
                'email' => $data->email,
                'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
                'birthdate' => $data->birthdate,
                'gender' => 0,
                'position' => 0,
                'parent_id' => $id,
                'sponsor_id' => $sponsor,
                'bitrex_cash' => 0,
                'bitrex_points' => 0,
                'pv' => 0,
                'nik' => $data->passport,
                'expired_at' => Carbon::now()->addMonths(2)
            ];
            Employeer::create($member);
        }else{
            $left = false;
            $midle = false;
            $right = false;
            foreach ($isHaveChild as $key => $child) {
                if ($child->position == 0) {
                    $left = true;
                }elseif ($child->position == 1) {
                    $midle = true;
                }elseif ($child->position == 2) {
                    $right = true;
                }
            }
            if (!$left) {
                $member = [
                    'id_member' => invoiceNumbering(),
                    'username' => $data->username,
                    'first_name' => $data->first_name,
                    'last_name' => $data->last_name,
                    'email' => $data->email,
                    'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
                    'birthdate' => $data->birthdate,
                    'gender' => 0,
                    'position' => 0,
                    'parent_id' => $id,
                    'sponsor_id' => $sponsor,
                    'bitrex_cash' => 0,
                    'bitrex_points' => 0,
                    'pv' => 0,
                    'nik' => $data->passport,
                    'expired_at' => Carbon::now()->addMonths(2)
                ];
                Employeer::create($member);
            }elseif (!$midle) {
                $member = [
                    'id_member' => invoiceNumbering(),
                    'username' => $data->username,
                    'first_name' => $data->first_name,
                    'last_name' => $data->last_name,
                    'email' => $data->email,
                    'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
                    'birthdate' => $data->birthdate,
                    'gender' => 0,
                    'position' => 1,
                    'parent_id' => $id,
                    'sponsor_id' => $sponsor,
                    'bitrex_cash' => 0,
                    'bitrex_points' => 0,
                    'pv' => 0,
                    'nik' => $data->passport,
                    'expired_at' => Carbon::now()->addMonths(2)
                ];
                Employeer::create($member);
            }else {
                $member = [
                    'id_member' => invoiceNumbering(),
                    'username' => $data->username,
                    'first_name' => $data->first_name,
                    'last_name' => $data->last_name,
                    'email' => $data->email,
                    'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
                    'birthdate' => $data->birthdate,
                    'gender' => 0,
                    'position' => 2,
                    'parent_id' => $id,
                    'sponsor_id' => $sponsor,
                    'bitrex_cash' => 0,
                    'bitrex_points' => 0,
                    'pv' => 0,
                    'nik' => $data->passport,
                    'expired_at' => Carbon::now()->addMonths(2)
                ];
                Employeer::create($member);
            }
        }
        return redirect()->back();
    }

    public function registerAuto(Request $request){
        $sponsor = $request->referal ? Employeer::where('username',$request->referal)->select('id')->first() : Employeer::where('username',Auth::user()->username)->select('id')->first() ;
        $isHaveChild = Employeer::where('parent_id',$sponsor->id)->select('position')->get();
        if (count($isHaveChild) == 3) {
            $pv = DB::table('pv_rank')->where('id_member',$sponsor->id)->select('pv_left', 'pv_midle', 'pv_right')->first();
            if($pv != null){
                if ($pv->pv_left <= $pv->pv_midle and $pv->pv_left <= $pv->pv_right) {
                    $child = Employeer::where('parent_id',$sponsor->id)->where('position',0)->select('id')->first();
                    $this->findChild($child->id, $sponsor->id, $request);
                }elseif ($pv->pv_midle < $pv->pv_left and $pv->pv_midle <= $pv->pv_right) {
                    $child = Employeer::where('parent_id',$sponsor->id)->where('position',1)->select('id')->first();
                    $this->findChild($child->id, $sponsor->id, $request);
                }else {
                    $child = Employeer::where('parent_id',$sponsor->id)->where('position',2)->select('id')->first();
                    $this->findChild($child->id, $sponsor->id, $request);
                }
            }else{
                $child = Employeer::where('parent_id',$sponsor->id)->where('position',0)->select('id')->first();
                $this->findChild($child->id, $sponsor->id, $request);
            }
        }elseif (count($isHaveChild)==0) {
            $member = [
                'id_member' => invoiceNumbering(),
                'username' => $request->username,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
                'birthdate' => $request->birthdate,
                'gender' => 0,
                'position' => 0,
                'parent_id' => $sponsor->id,
                'sponsor_id' => $sponsor->id,
                'bitrex_cash' => 0,
                'bitrex_points' => 0,
                'pv' => 0,
                'nik' => $request->passport,
                'expired_at' => Carbon::now()->addMonths(2)
            ];
            Employeer::create($member);
        }else{
            $left = false;
            $midle = false;
            $right = false;
            foreach ($isHaveChild as $key => $child) {
                if ($child->position == 0) {
                    $left = true;
                }elseif ($child->position == 1) {
                    $midle = true;
                }elseif ($child->position == 2) {
                    $right = true;
                }
            }
            if (!$left) {
                $member = [
                    'id_member' => invoiceNumbering(),
                    'username' => $request->username,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
                    'birthdate' => $request->birthdate,
                    'gender' => 0,
                    'position' => 0,
                    'parent_id' => $sponsor->id,
                    'sponsor_id' => $sponsor->id,
                    'bitrex_cash' => 0,
                    'bitrex_points' => 0,
                    'pv' => 0,
                    'nik' => $request->passport,
                    'expired_at' => Carbon::now()->addMonths(2)
                ];
                Employeer::create($member);
            }elseif (!$midle) {
                $member = [
                    'id_member' => invoiceNumbering(),
                    'username' => $request->username,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
                    'birthdate' => $request->birthdate,
                    'gender' => 0,
                    'position' => 1,
                    'parent_id' => $sponsor->id,
                    'sponsor_id' => $sponsor->id,
                    'bitrex_cash' => 0,
                    'bitrex_points' => 0,
                    'pv' => 0,
                    'nik' => $request->passport,
                    'expired_at' => Carbon::now()->addMonths(2)
                ];
                Employeer::create($member);
            }else {
                $member = [
                    'id_member' => invoiceNumbering(),
                    'username' => $request->username,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
                    'birthdate' => $request->birthdate,
                    'gender' => 0,
                    'position' => 2,
                    'parent_id' => $sponsor->id,
                    'sponsor_id' => $sponsor->id,
                    'bitrex_cash' => 0,
                    'bitrex_points' => 0,
                    'pv' => 0,
                    'nik' => $request->passport,
                    'expired_at' => Carbon::now()->addMonths(2)
                ];
                Employeer::create($member);
            }
        }
        return redirect()->back();
    }

    public function expNotif(){
        $notif['darurat'] = Auth::user()->expired_at <= Carbon::now()->addMonths(3);
        return $notif;
    }
}
