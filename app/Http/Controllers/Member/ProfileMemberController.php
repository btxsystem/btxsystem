<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Employeer;
use App\Models\TransactionMember;
use DB;
use Carbon\Carbon;
use Alert;

use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMemberMail;

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

    public function changePhoto(Request $request){
        if ($request->hasFile('photo')) {
            $image = $request->photo;
            $imageName = time() . str_random(15).'.'.$image->getClientOriginalExtension();
            $uploadPath = 'upload/member/image/' . $imageName; //make sure folder path already exist
            $image->move('upload/member/image/', $imageName);
            $data->src = $uploadPath;
        }
    }

    public function isHaveChange(){
        $isHaveStatus = DB::table('employeers')->where('id',Auth::id())->select('is_update')->first();
        $data['change'] = $isHaveStatus->is_update;
        return response()->json($data, 200);
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
        try {
            DB::beginTransaction();
            $method = $request->input('payment_method') ?? 'point';
            $shippingMethod = $request->input('shipping_method') ?? "0"; 
            
            $checkEmail = Employeer::where('email', $request->email)->count();

            if($checkEmail > 0) {
                DB::rollback();
                Alert::error('Email sudah terdaftar', 'Error')->persistent("OK");
                return redirect()->route('member.tree');
            }

            $cek_parent = DB::table('employeers')->where('parent_id', $request->parent)->select('position')->get();
           // dd($request->parent);
            foreach ($cek_parent as $key => $data) {
                if ($data->position == $request->position) {
                    DB::rollback();
                    Alert::error('the chosen position is already occupied by someone else', 'Error')->persistent("OK");
                    return redirect()->route('member.tree');
                }
            }

            if($method == 'point') {
                // return response()->json([
                //     'data' => $request->all()
                // ]);
                $ebooks = $request->input('ebooks') ?? [];
                $term_one = $request->input('term_one') ?? '';
                $term_two = $request->input('term_two') ?? '';

                if($term_one == '' || $term_two == '') {
                    DB::rollback();
                    Alert::error('Kode etik Bitrexgo belum di Centang', 'Error')->persistent("OK");
                    return redirect()->route('member.tree');
                }

                $price = 280;
                $sponsor = Auth::user();
                $idMember = invoiceNumbering();

                $password = strtolower(str_random(8));

                $data = [
                    'id_member' => $idMember,
                    'username' => $request->username,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => bcrypt($password),//bcrypt('Mbitrex'.rand(100,1000)),
                    'birthdate' => $request->birthdate,
                    'gender' => $request->gender,
                    'position' => $request->position,
                    'parent_id' => $request->parent,
                    'sponsor_id' => $sponsor->id,
                    'bitrex_cash' => 0,
                    'bitrex_points' => 0,
                    'pv' => 0,
                    'nik' => $request->nik,
                    'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1)
                ];

                Employeer::create($data);
                $employeer = Employeer::where('id_member', $idMember)->first();

                if((int)$shippingMethod == 1) {
                    DB::table('address')->insert([
                        'decription' => $request->input('address'),
                        'city_id' => $request->input('city'),
                        'city_name' => $request->input('city_name'),
                        'province_id' => $request->input('province'),
                        'province' => $request->input('province_name'),
                        'subdistrict_id' => $request->input('district'),
                        'subdistrict_name' => $request->input('district_name'),
                        'type' => 1,
                        'user_id' => $employeer->id,
                    ]);
                }
                
                $totalPriceEbook = 0;

                if(count($ebooks) > 0) {
                    $totalPriceEbook = DB::table('ebooks')
                        ->whereIn('id', $ebooks)
                        ->sum('price');
                    $price = ((int) $price + (int) ($totalPriceEbook / 1000));
                }

                if($request->input('shipping_method') == "1") {
                    $price = (int) $price + (int) + $request->input('cost');
                }//

                foreach($ebooks as $ebook) {
                    $prefixRef = 'BITREX02';

                    $checkRef = TransactionMember::where('transaction_ref', $prefixRef . (time() + rand(100, 500)))->first();
              
                    $afterCheckRef = $prefixRef . (time() + rand(100, 500));
              
                    while($checkRef) {
                      $afterCheckRef = $prefixRef . (time() + rand(100, 500));
                      if(!$checkRef) {
                        break;
                      }
                    }

                    $trxMember = new TransactionMember();
                    $trxMember->transaction_ref = $afterCheckRef;
                    $trxMember->ebook_id = (int) $ebook;
                    $trxMember->expired_at = Carbon::create(date('Y-m-d H:i:s'))->addYear(1);
                    $trxMember->member_id = $employeer->id;
                    $trxMember->status = 1;
                    $trxMember->save();
                }

                $input['bitrex_points'] = $sponsor->bitrex_points - $price;

                if($sponsor->bitrex_points < $price) {
                    DB::rollback();
                    Alert::error('Bitrex Point tidak cukup', 'Error')->persistent("OK");
                    return redirect()->route('member.tree');
                }

                Employeer::find($sponsor->id)->update($input);
                DB::commit();

                $dataEmail = (object) [
                  'member' => $employeer,
                  'password' => $password
                ];
      
                Mail::to($employeer->email)
                  ->send(new RegisterMemberMail($dataEmail, null));                
                // return response()->json([
                //     'data' => $price
                // ]);
                Alert::success('Berhasil Register Member Tree', 'Success')->persistent("OK");
                return redirect()->route('member.tree');
            }
        } catch(\Illuminate\Database\QueryException $e) {
            DB::rollback();
            Alert::error('Kesalahan teknis', 'Error')->persistent("OK");
            return redirect()->route('member.tree');
        }
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

    public function claimReward(Request $request){
        $member = Auth::user();
        if($request->id==1){
            $pajak = $member->verification == 1 ? 0.025 : 0.03;
           try {
                DB::beginTransaction();
                DB::table('got_rewards')->where('reward_id', 1)->where('member_id', Auth::id())->update(['status' => 2, 'updated_at' => now()]);
                DB::table('history_bitrex_cash')->insert(['id_member' => $member->id, 'nominal' => 3000000 - (3000000 * $pajak), 'created_at' => now(), 'updated_at' => now(), 'description' => 'Bonus Rewards', 'info' => 1, 'type' => 3]);
                DB::table('employeers')->where('id', $member->id)->update(['bitrex_cash' => $member->bitrex_cash += 3000000 - (3000000 * $pajak), 'updated_at' => now()]);
                DB::table('history_pajak')->insert(['id_member' => $member->id, 'id_bonus' => 4, 'persentase' => $pajak, 'nominal' => 3000000 * $pajak, 'created_at' => now(), 'updated_at' => now()]);
                return 'yes';
            } catch (\Throwable $th) {
                DB::rollback();
           }
        }else{
            DB::table('got_rewards')->where('reward_id', $request->id)->update(['status' => 1, 'updated_at' => now()]);
        }
        return redirect()->route('member.reward');
    }

    public function rewardClime(){
        $data = DB::table('got_rewards')->where('member_id',Auth::id())->orderBy('reward_id')->get();
        $total = (int) ceil(count($data)/8);
        return($data);
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
                'nik' => $data->passport ?? $data->nik,
                'no_rec' => $data->bank_account_number,
                'bank_account_name' => $data->bank_account_name,
                'bank_name' => $data->bank_name,
                'npwp_number' => $data->npwp_number,
                'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1)
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
                    'nik' => $data->passport ?? $data->nik,
                    'no_rec' => $data->bank_account_number,
                    'bank_account_name' => $data->bank_account_name,
                    'bank_name' => $data->bank_name,
                    'npwp_number' => $data->npwp_number,
                    'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1)
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
                    'nik' => $data->passport ?? $data->nik,
                    'no_rec' => $data->bank_account_number,
                    'bank_account_name' => $data->bank_account_name,
                    'bank_name' => $data->bank_name,
                    'npwp_number' => $data->npwp_number,
                    'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1)
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
                    'nik' => $data->passport ?? $data->nik,
                    'no_rec' => $data->bank_account_number,
                    'bank_account_name' => $data->bank_account_name,
                    'bank_name' => $data->bank_name,
                    'npwp_number' => $data->npwp_number,
                    'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1)
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
                'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1)
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
                    'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1)
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
                    'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1)
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
                    'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1)
                ];
                Employeer::create($member);
            }
        }
        return redirect()->back();
    }

    public function registerAutoPlacement(Request $request)
    {

        try {
            DB::beginTransaction();
            $method = $request->input('payment_method') ?? 'point';
            $shippingMethod = $request->input('shipping_method') ?? "0"; 
            
            $checkEmail = Employeer::where('email', $request->email)->count();

            if($checkEmail > 0) {
                DB::rollback();
                Alert::error('Email sudah terdaftar', 'Error')->persistent("OK");
                return redirect()->route('member.tree');
            }

            $checkUsername = Employeer::where('username', $request->username)->count();

            if($checkUsername > 0) {
                DB::rollback();
                Alert::error('Username sudah terdaftar', 'Error')->persistent("OK");
                return redirect()->route('member.tree');
            }

            if($method == 'point') {
                // return response()->json([
                //     'data' => $request->all()
                // ]);
                $ebooks = $request->input('ebooks') ?? [];
                $term_one = $request->input('term_one') ?? '';
                $term_two = $request->input('term_two') ?? '';

                if($term_one == '' || $term_two == '') {
                    DB::rollback();
                    Alert::error('Kode etik Bitrexgo belum di Centang', 'Error')->persistent("OK");
                    return redirect()->route('member.tree');
                }

                $price = 280;
                $sponsor = Auth::user();
                $idMember = invoiceNumbering();

                $password = strtolower(str_random(8));

                // $data = [
                //     'id_member' => $idMember,
                //     'username' => $request->username,
                //     'first_name' => $request->first_name,
                //     'last_name' => $request->last_name,
                //     'email' => $request->email,
                //     'password' => bcrypt($password),//bcrypt('Mbitrex'.rand(100,1000)),
                //     'birthdate' => $request->birthdate,
                //     'gender' => $request->gender,
                //     'position' => $request->position,
                //     'parent_id' => $request->parent,
                //     'sponsor_id' => $sponsor->id,
                //     'bitrex_cash' => 0,
                //     'bitrex_points' => 0,
                //     'pv' => 0,
                //     'nik' => $request->nik,
                //     'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1)
                // ];

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
                    $idMember = invoiceNumbering();
                    $member = [
                        'id_member' => $idMember,
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
                        'nik' => $request->nik,
                        'no_rec' => $request->bank_account_number,
                        'bank_account_name' => $request->bank_account_name,
                        'bank_name' => $request->bank_name,
                        'npwp_number' => $request->npwp_number,
                        'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1)
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
                        $idMember = invoiceNumbering();
                        $member = [
                            'id_member' => $idMember,
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
                            'nik' => $request->nik,
                            'no_rec' => $request->bank_account_number,
                            'bank_account_name' => $request->bank_account_name,
                            'bank_name' => $request->bank_name,
                            'npwp_number' => $request->npwp_number,
                            'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1)
                        ];
                        Employeer::create($member);
                    }elseif (!$midle) {
                        $idMember = invoiceNumbering();
                        $member = [
                            'id_member' => $idMember,
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
                            'nik' => $request->nik,
                            'no_rec' => $request->bank_account_number,
                            'bank_account_name' => $request->bank_account_name,
                            'bank_name' => $request->bank_name,
                            'npwp_number' => $request->npwp_number,
                            'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1)
                        ];
                        Employeer::create($member);
                    }else {
                        $idMember = invoiceNumbering();
                        $member = [
                            'id_member' => $idMember,
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
                            'nik' => $request->nik,
                            'no_rec' => $request->bank_account_number,
                            'bank_account_name' => $request->bank_account_name,
                            'bank_name' => $request->bank_name,
                            'npwp_number' => $request->npwp_number,
                            'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1)
                        ];
                        Employeer::create($member);
                    }
                }

                //Employeer::create($data);
                $employeer = Employeer::where('id_member', $idMember)->first();

                if((int)$shippingMethod == 1) {
                    DB::table('address')->insert([
                        'decription' => $request->input('address'),
                        'city_id' => $request->input('city'),
                        'city_name' => $request->input('city_name'),
                        'province_id' => $request->input('province'),
                        'province' => $request->input('province_name'),
                        'subdistrict_id' => $request->input('district'),
                        'subdistrict_name' => $request->input('district_name'),
                        'type' => 1,
                        'user_id' => $employeer->id,
                    ]);
                }
                
                $totalPriceEbook = 0;

                if(count($ebooks) > 0) {
                    $totalPriceEbook = DB::table('ebooks')
                        ->whereIn('id', $ebooks)
                        ->sum('price');
                    $price = ((int) $price + (int) ($totalPriceEbook / 1000));
                }

                if($request->input('shipping_method') == "1") {
                    $price = (int) $price + (int) + $request->input('cost');
                }//

                foreach($ebooks as $ebook) {
                    $prefixRef = 'BITREX02';

                    $checkRef = TransactionMember::where('transaction_ref', $prefixRef . (time() + rand(100, 500)))->first();
              
                    $afterCheckRef = $prefixRef . (time() + rand(100, 500));
              
                    while($checkRef) {
                      $afterCheckRef = $prefixRef . (time() + rand(100, 500));
                      if(!$checkRef) {
                        break;
                      }
                    }

                    $trxMember = new TransactionMember();
                    $trxMember->transaction_ref = $afterCheckRef;
                    $trxMember->ebook_id = (int) $ebook;
                    $trxMember->expired_at = Carbon::create(date('Y-m-d H:i:s'))->addYear(1);
                    $trxMember->member_id = $employeer->id;
                    $trxMember->status = 1;
                    $trxMember->save();
                }

                $input['bitrex_points'] = $sponsor->bitrex_points - $price;

                if($sponsor->bitrex_points < $price) {
                    DB::rollback();
                    Alert::error('Bitrex Point tidak cukup', 'Error')->persistent("OK");
                    return redirect()->route('member.tree');
                }

                Employeer::find($sponsor->id)->update($input);
                DB::commit();

                $dataEmail = (object) [
                  'member' => $employeer,
                  'password' => $password
                ];
      
                Mail::to($employeer->email)
                  ->send(new RegisterMemberMail($dataEmail, null));                
                // return response()->json([
                //     'data' => $price
                // ]);

                // return response()->json([
                //     'data' => $employeer
                // ]);
                Alert::success('Berhasil Register Member Autoplacement', 'Success')->persistent("OK");
                return redirect()->route('member.tree');
            }
        } catch(\Illuminate\Database\QueryException $e) {
            DB::rollback();
            // return response()->json([
            //     'data' => $e
            // ]);
            Alert::error('Kesalahan teknis', 'Error')->persistent("OK");
            return redirect()->route('member.tree');
        }        
    }

    public function expNotif(){
        $notif['darurat'] = Auth::user()->expired_at <= Carbon::now()->addMonths(3);
        return $notif;
    }
}
