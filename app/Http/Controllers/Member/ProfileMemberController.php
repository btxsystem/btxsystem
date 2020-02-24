<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Employeer;
use App\Models\TransactionMember;
use App\HistoryBitrexPoints;
use DB;
use Carbon\Carbon;
use Alert;
use File;
use App\Service\PaymentVa\TransactionPaymentService as Va;
use App\Service\NotificationService;

use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMemberMail;
use App\models\GotReward;
use Redirect;

class ProfileMemberController extends Controller
{
    protected $service;

    public function __construct(NotificationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = Auth::user();
        $rank = DB::table('ranks')->select('name')->where('id','=',$data->rank_id)->first();
        $profile = array(
            "id_member" => $data->id_member,
            "username" =>  $data->username,
            "name" => $data->first_name.' '.$data->last_name,
            "email" => $data->email,
            "phone_number" => $data->phone_number,
            "birthdate" => date('F j, Y',strtotime($data->birthdate)),
            "npwp_number" => $data->npwp_number ? $data->npwp_number : null,
            "is_married" => $data->is_married ? 'Married' : 'Single',
            "gender" => $data->gender ? 'Male' : 'Female',
            "status" => $data->status ? 'Active' : 'Nonactive',
            "phone_number" => $data->phone_number,
            "no_rec" => $data->no_rec,
            "bank_name" => $data->bank_name,
            "bank_account_name" => $data->bank_account_name,
            "bitrex_cash" => $data->bitrex_cash,
            "bitrex_points" => $data->bitrex_points,
            "src" => $data->src,
            "pv" => $data->pv
        );
        return view('frontend.account.profile')->with('profile',$profile);
    }

    public function changePhoto(Request $request){
        $old_image = DB::table('employeers')->select('src')->where('id',Auth::id())->first();
        if($old_image) {
            File::delete($old_image->src);
        }
        if ($request->hasFile('photo')) {
            $image = $request->photo;
            $imageName = time() . str_random(15).'.'.$image->getClientOriginalExtension();
            $uploadPath = 'upload/member/image/' . $imageName;
            $image->move('upload/member/image/', $imageName);
            $data['src'] = $uploadPath;
            Employeer::find(Auth::id())->update($data);
            Alert::success('Profile photo has been updated', 'Success')->persistent("OK");
            return redirect()->route('member.profile.index');
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
                Alert::success('The password has been updated', 'Success')->persistent("OK");
            }else{
                Alert::error('The password must difference', 'Error')->persistent("OK");
            }
        }else{
            Alert::error('Your password incorrect', 'Error')->persistent("OK");
        }
        return redirect()->back();
    }

    public function register(Request $request){
        try {
            if (!isset($request->bank_name) || $request->bank_name==null) {
                $request->bank_name = 'BCA';
            }
            DB::beginTransaction();

            $cek_npwp = 0;
            if (isset($request->npwp_number)) {
                $cek_npwp = strlen($request->npwp_number) >= 15 ? 1 : 0;
            }

            $method = $request->input('payment_method') ?? 'point';
            $shippingMethod = $request->input('shipping_method') ?? "0";

            $checkEmail = Employeer::where('email', $request->email)->count();

            if($checkEmail > 0) {
                DB::rollback();
                Alert::error('Email sudah terdaftar', 'Error')->persistent("OK");
                $data = Auth::user();
                $data['data'] = $request;
                return view('frontend.tree')->with('profile',$data);
            }

            // $checkPhoneNumber = Employeer::where('phone_number', $request->phone_number)->count();

            // if($checkPhoneNumber > 0) {
            //     DB::rollback();
            //     Alert::error('Nomor Telephon sudah terdaftar', 'Error')->persistent("OK");
            //     return redirect()->route('member.tree');
            // }

            $cek_parent = DB::table('employeers')->where('parent_id', $request->parent)->select('position')->get();
            foreach ($cek_parent as $key => $data) {
                if ($data->position == $request->position) {
                    DB::rollback();
                    Alert::error('the chosen position is already occupied by someone else', 'Error')->persistent("OK");
                    $data = Auth::user();
                    $data['data'] = $request;
                    return view('frontend.tree')->with('profile',$data) ;
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
                    $data = Auth::user();
                    $data['data'] = $request;
                    return view('frontend.tree')->with('profile',$data) ;
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
                    "phone_number" => $request->phone_number,
                    'password' => bcrypt($password),//bcrypt('Mbitrex'.rand(100,1000)),
                    'birthdate' => $request->birthdate,
                    'npwp_number' => $request->npwp_number ? $request->npwp_number : null,
                    'gender' => $request->gender,
                    'position' => $request->position,
                    'parent_id' => $request->parent,
                    'sponsor_id' => $sponsor->id,
                    'verification' => $cek_npwp,
                    'bitrex_cash' => 0,
                    'bitrex_points' => 0,
                    'pv' => 0,
                    'nik' => $request->nik,
                    'expired_at' => count($ebooks) < 2 ? Carbon::create(date('Y-m-d H:i:s'))->addYear(1) : Carbon::create(date('Y-m-d H:i:s'))->addYear(5),
                    'bank_name' => $request->bank_name,
                    'bank_account_name' => $request->bank_account_name,
                    'no_rec' => $request->bank_account_number
                ];

                Employeer::create($data);
                $employeer = Employeer::where('id_member', $idMember)->first();

                if((int)$shippingMethod == 1) {
                    $kurir = substr($request->kurir_name, 0, strpos($request->kurir_name, " -"));
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
                        'kurir' => $kurir,
                        'cost' => $request->kurir,
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
                }

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
                    $data = Auth::user();
                    $data['data'] = $request;
                    return view('frontend.tree')->with('profile',$data) ;
                }

                // histories points
                $prefixRefBp = 'BITREX05';

                $checkRefBp = HistoryBitrexPoints::where('transaction_ref', $prefixRefBp . (time() + rand(100, 500)))->first();

                $afterCheckRefBp = $prefixRefBp . (time() + rand(100, 500));

                while($checkRefBp) {
                  $afterCheckRefBp = $prefixRefBp . (time() + rand(100, 500));
                  if(!$checkRefBp) {
                    break;
                  }
                }

                //insert histories points
                HistoryBitrexPoints::insert([
                    'id_member' => Auth::id(),
                    'nominal' => (int) $price * 1000,
                    'points' => $price,
                    'description' => "Register <strong>{$employeer->username}</strong> from Tree",
                    'transaction_ref' => $prefixRefBp,
                    'status' => 1,
                    'info' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

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
            $data = Auth::user();
            $data['data'] = $request;
            return view('frontend.tree')->with('profile',$data) ;
        }
    }

    public function isSameUsername($user){
        $data = [
            'status' => 200,
            'username' => false,
        ];
        $cek = Employeer::where('username',$user)->select('username')->first();
        $cek ? $data['username'] = true : $data['username'] = false;
        return response()->json($data);
    }

    public function isSameEmail($user){
        $data = [
            'status' => 200,
            'email' => false,
        ];
        $cek = Employeer::where('email',$user)->select('id')->first();
        $cek ? $data['email'] = true : $data['email'] = false;
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
        DB::beginTransaction();
        if($request->id==1){
            try {
                    $pajak = $member->verification == 1 ? 0.025 : 0.03;
                    $reward = DB::table('gift_rewards')->where('id',$request->id)->select('*')->first();
                    $data = [
                        'title' => 'Achieve Reward',
                        'desc'  => 'Telah Request Achieve Reward '.$reward->description,
                        'isRead' => 0,
                        'member_id' => Auth::id(),
                        'type' => 2,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $this->service->store($data, $reward->description, $reward->nominal);
                    DB::table('got_rewards')->where('reward_id', $request->id)->where('member_id', Auth::id())->update(['status' => 2, 'updated_at' => now()]);
                    DB::table('history_bitrex_cash')->insert(['id_member' => Auth::id(), 'nominal' => 3000000 - (3000000 * $pajak), 'created_at' => now(), 'updated_at' => now(), 'description' => 'Bonus Rewards', 'info' => 1, 'type' => 3]);
                    DB::table('employeers')->where('id', Auth::id())->update(['bitrex_cash' => $member->bitrex_cash += 3000000 - (3000000 * $pajak), 'updated_at' => now()]);
                    DB::table('history_pajak')->insert(['id_member' => Auth::id(), 'id_bonus' => 4, 'persentase' => $pajak, 'nominal' => 3000000 * $pajak, 'created_at' => now(), 'updated_at' => now()]);
                DB::commit();
                Alert::success('Claim Rewards Success, Check your history', 'Success')->persistent("OK");
            } catch (\Exception $e) {
                DB::rollback();
                Alert::success('Something wrong', 'Error')->persistent("OK");
            }
        }else{
            try {
                $reward = DB::table('gift_rewards')->where('id',$request->id)->select('*')->first();
                $data = [
                    'title' => 'Achieve Reward',
                    'desc'  => 'Telah Request Achieve Reward '.$reward->description,
                    'isRead' => 0,
                    'member_id' => Auth::id(),
                    'type' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $this->service->store($data, $reward->description, $reward->nominal);
                DB::table('got_rewards')->where('reward_id', $request->id)->where('member_id', Auth::id())->update(['status' => 1, 'updated_at' => now()]);
                DB::commit();
                Alert::success('Claim Reward Success, Waiting approval admin', 'Success')->persistent("OK");
            } catch (\Throwable $th) {
                DB::rollback();
                Alert::success('Something wrong', 'Error')->persistent("OK");
            }
            }
        return redirect()->route('member.reward');
    }

    public function rewardClaim(){
        $data = DB::table('got_rewards')->where('member_id',Auth::id())->orderBy('reward_id')->get();
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
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
           }
        }else{
            DB::table('got_rewards')->where('reward_id', $id)->andWhere('member_id', Auth::id())->update(['status' => 1, 'updated_at' => now()]);
        }
        return redirect()->route('member.reward');
    }

    public function getExpiredMember(){
        $time['date'] = DB::table('employeers')->where('id',Auth::id())->select('expired_at')->first();
        $time['des'] = Auth::user()->expired_at <= Carbon::now()->addMonths(3) ? true : false;
        return response()->json($time, 200);
    }

    public function findChild($id, $sponsor, $data){
        $cek_npwp = 0;
        if (isset($data->npwp_number)) {
            $cek_npwp = strlen($data->npwp_number) >= 15 ? 1 : 0;
        }
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
                "phone_number" => $data->phone_number,
                'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
                'birthdate' => $data->birthdate,
                'gender' => 0,
                'position' => 0,
                'parent_id' => $id,
                'sponsor_id' => $sponsor,
                'verification' => $cek_npwp,
                'bitrex_cash' => 0,
                'bitrex_points' => 0,
                'pv' => 0,
                'nik' => $data->passport ?? $data->nik,
                'no_rec' => $data->bank_account_number,
                'bank_account_name' => $data->bank_account_name,
                'bank_name' => $data->bank_name,
                'npwp_number' => $data->npwp_number ? $data->npwp_number : null,
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
                    "phone_number" => $data->phone_number,
                    'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
                    'birthdate' => $data->birthdate,
                    'gender' => 0,
                    'position' => 0,
                    'parent_id' => $id,
                    'sponsor_id' => $sponsor,
                    'verification' => $cek_npwp,
                    'bitrex_cash' => 0,
                    'bitrex_points' => 0,
                    'pv' => 0,
                    'nik' => $data->passport ?? $data->nik,
                    'no_rec' => $data->bank_account_number,
                    'bank_account_name' => $data->bank_account_name,
                    'bank_name' => $data->bank_name,
                    'npwp_number' => $data->npwp_number ? $data->npwp_number : null,
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
                    "phone_number" => $data->phone_number,
                    'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
                    'birthdate' => $data->birthdate,
                    'gender' => 0,
                    'position' => 1,
                    'parent_id' => $id,
                    'sponsor_id' => $sponsor,
                    'verification' => $cek_npwp,
                    'bitrex_cash' => 0,
                    'bitrex_points' => 0,
                    'pv' => 0,
                    'nik' => $data->passport ?? $data->nik,
                    'no_rec' => $data->bank_account_number,
                    'bank_account_name' => $data->bank_account_name,
                    'bank_name' => $data->bank_name,
                    'npwp_number' => $data->npwp_number ? $data->npwp_number : null,
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
                    "phone_number" => $data->phone_number,
                    'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
                    'birthdate' => $data->birthdate,
                    'gender' => 0,
                    'position' => 2,
                    'parent_id' => $id,
                    'sponsor_id' => $sponsor,
                    'verification' => $cek_npwp,
                    'bitrex_cash' => 0,
                    'bitrex_points' => 0,
                    'pv' => 0,
                    'nik' => $data->passport ?? $data->nik,
                    'no_rec' => $data->bank_account_number,
                    'bank_account_name' => $data->bank_account_name,
                    'bank_name' => $data->bank_name,
                    'npwp_number' => $data->npwp_number ? $data->npwp_number : null,
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
                "phone_number" => $request->phone_number,
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
                'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1),
                'bank_name' => $request->bank_name,
                'bank_account_name' => $request->bank_account_name,
                'no_rec' => $request->bank_account_number
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
                    "phone_number" => $request->phone_number,
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
                    'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1),
                    'bank_name' => $request->bank_name,
                    'bank_account_name' => $request->bank_account_name,
                    'no_rec' => $request->bank_account_number
                ];
                Employeer::create($member);
            }elseif (!$midle) {
                $member = [
                    'id_member' => invoiceNumbering(),
                    'username' => $request->username,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    "phone_number" => $request->phone_number,
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
                    'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1),
                    'bank_name' => $request->bank_name,
                    'bank_account_name' => $request->bank_account_name,
                    'no_rec' => $request->bank_account_number
                ];
                Employeer::create($member);
            }else {
                $member = [
                    'id_member' => invoiceNumbering(),
                    'username' => $request->username,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    "phone_number" => $request->phone_number,
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
                    'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1),
                    'bank_name' => $request->bank_name,
                    'bank_account_name' => $request->bank_account_name,
                    'no_rec' => $request->bank_account_number
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

            $cek_npwp = 0;
            if (isset($request->npwp_number)) {
                $cek_npwp = strlen($request->npwp_number) >= 15 ? 1 : 0;
            }

            $method = $request->input('payment_method') ?? 'point';
            $shippingMethod = $request->input('shipping_method') ?? "0";

            $checkEmail = Employeer::where('email', $request->email)->count();

            if($checkEmail > 0) {
                DB::rollback();
                Alert::error('Email sudah terdaftar', 'Error')->persistent("OK");
                return redirect()->route('member.tree');
            }

            // $checkPhoneNumber = Employeer::where('phone_number', $request->phone_number)->count();

            // if($checkPhoneNumber > 0) {
            //     DB::rollback();
            //     Alert::error('Nomor sudah terdaftar', 'Error')->persistent("OK");
            //     return redirect()->route('member.tree');
            // }

            $checkUsername = Employeer::where('username', $request->username)->count();

            if($checkUsername > 0) {
                DB::rollback();
                Alert::error('Username sudah terdaftar', 'Error')->persistent("OK");
                return redirect()->route('member.tree');
            }

            if($method == 'point') {
                if (Auth::user()->bitrex_cash > 6000) {

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
                            "phone_number" => $request->phone_number,
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
                            'npwp_number' => $request->npwp_number ? $request->npwp_number : null,
                            'verification' => $cek_npwp,
                            'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1),
                            'bank_name' => $request->bank_name,
                            'bank_account_name' => $request->bank_account_name,
                            'no_rec' => $request->bank_account_number
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
                                    "phone_number" => $request->phone_number,
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
                                    'verification' => $cek_npwp,
                                    'bank_account_name' => $request->bank_account_name,
                                    'bank_name' => $request->bank_name,
                                    'npwp_number' => $request->npwp_number ? $request->npwp_number : null,
                                    'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1),
                                    'bank_name' => $request->bank_name,
                                    'bank_account_name' => $request->bank_account_name,
                                    'no_rec' => $request->bank_account_number
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
                                    "phone_number" => $request->phone_number,
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
                                    'npwp_number' => $request->npwp_number ? $request->npwp_number : null,
                                    'verification' => $cek_npwp,
                                    'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1),
                                    'bank_name' => $request->bank_name,
                                    'bank_account_name' => $request->bank_account_name,
                                    'no_rec' => $request->bank_account_number
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
                                    "phone_number" => $request->phone_number,
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
                                    'npwp_number' => $request->npwp_number ? $request->npwp_number : null,
                                    'verification' => $cek_npwp,
                                    'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1),
                                    'bank_name' => $request->bank_name,
                                    'bank_account_name' => $request->bank_account_name,
                                    'no_rec' => $request->bank_account_number
                                ];
                                Employeer::create($member);
                            }
                        }

                        //Employeer::create($data);
                        $employeer = Employeer::where('id_member', $idMember)->first();

                        if((int)$shippingMethod == 1) {
                            $kurir = substr($request->kurir_name, 0, strpos($request->kurir_name, " -"));
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
                                'kurir' => $kurir,
                                'cost' => $request->kurir,
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

                        // histories points
                        $prefixRefBp = 'BITREX05';

                        $checkRefBp = HistoryBitrexPoints::where('transaction_ref', $prefixRefBp . (time() + rand(100, 500)))->first();

                        $afterCheckRefBp = $prefixRefBp . (time() + rand(100, 500));

                        while($checkRefBp) {
                        $afterCheckRefBp = $prefixRefBp . (time() + rand(100, 500));
                        if(!$checkRefBp) {
                            break;
                        }
                        }

                        //insert histories points
                        HistoryBitrexPoints::insert([
                            'id_member' => Auth::id(),
                            'nominal' => (int) $price * 1000,
                            'points' => $price,
                            'description' => "Register <strong>{$employeer->username}</strong> Auto-Placement",
                            'transaction_ref' => $prefixRefBp,
                            'status' => 1,
                            'info' => 0,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);

                        Employeer::find($sponsor->id)->update($input);
                        DB::commit();

                        $dataEmail = (object) [
                        'member' => $employeer,
                        'password' => $password
                        ];

                        Mail::to($employeer->email)
                        ->send(new RegisterMemberMail($dataEmail, null));
                        Alert::success('Berhasil Register Member Autoplacement', 'Success')->persistent("OK");
                        return redirect()->route('member.tree');
                    }else{
                        Alert::success('Gagal Register', 'Error')->persistent("OK");
                        return redirect()->route('member.tree');
                    }
            }else{
                $data = Auth::user();
                $rank = DB::table('ranks')->select('name')->where('id','=',$data->rank_id)->first();
                $profile = array(
                    "id_member" => $data->id_member,
                    "username" =>  $data->username,
                    "name" => $data->first_name.' '.$data->last_name,
                    "email" => $data->email,
                    "phone_number" => $data->phone_number,
                    "birthdate" => date('F j, Y',strtotime($data->birthdate)),
                    "npwp_number" => $data->npwp_number ? $data->npwp_number : null,
                    "is_married" => $data->is_married ? 'Married' : 'Single',
                    "gender" => $data->gender ? 'Male' : 'Female',
                    "status" => $data->status ? 'Active' : 'Nonactive',
                    "phone_number" => $data->phone_number,
                    "no_rec" => $data->no_rec,
                    "bank_name" => $data->bank_name,
                    "bank_account_name" => $data->bank_account_name,
                    "bitrex_cash" => $data->bitrex_cash,
                    "bitrex_points" => $data->bitrex_points,
                    "src" => $data->src,
                    "pv" => $data->pv
                );

                $date = now();

                do {
                    $no_invoice = date_format($date,"ymdh").rand(100,999);
                    $cek = DB::table('transaction_bills')->where('customer_number',$no_invoice)->select('id')->get();
                } while (count($cek)>0);

                $data = [
                    'user_id' => Auth::user()->id,
                    'product_type' => 'topup',
                    'user_type' => 'member',
                    'total_amount' => 282750,
                    'customer_number' => '11210'.$no_invoice,
                    'time_expired' => Carbon::create(date('Y-m-d H:i:s'))->addDay(1),
                ];

                $data['total_amount'] += isset($request['kurir']) ? $request['kurir'] : 0;

                $profile['no_invoice'] = $data['customer_number'];
                $profile['amount'] = $data['total_amount'];
                $profile['expired'] = $data['time_expired'];
                $va = new Va;
                $va->register(Auth::user()->id, $request, $no_invoice);
                DB::commit();
                foreach ($request['ebooks'] as $key => $ebook) {
                    $price_ebook = DB::table('ebooks')->where('id',$ebook)->select('price')->first();
                    $profile['amount'] += $price_ebook->price;
                }
                return view('frontend.virtual-account-autoplacement')->with('profile',$profile);
            }
        } catch(\Illuminate\Database\QueryException $e) {
            DB::rollback();
            Alert::error('Kesalahan teknis', 'Error')->persistent("OK");
            return redirect()->route('member.tree');
        }
    }

    public function expNotif(){
        $notif['darurat'] = Auth::user()->expired_at <= Carbon::now()->addMonths(3);
        return $notif;
    }

    public function updateProfile(){
        $data = DB::table('employeers')->where('id',Auth::id())->select('is_update')->first();
        return response()->json($data, 200);
    }

    public function data(){
        $data = DB::table('employeers')->where('id',Auth::id())->select('npwp_number','phone_number','bank_account_name','bank_name','no_rec')->first();
        return response()->json($data, 200);
    }

    public function update_profile(Request $request){
        $data = [
            'npwp_number' => $request->npwp ? $request->npwp : null ,
            'phone_number' => $request->phone_number ? $request->phone_number : null,
            'no_rec' => $request->no_rec ? $request->no_rec : null,
            'bank_account_name' => $request->bank_account_name ? $request->bank_account_name : null,
            'bank_name' => $request->bank_name ? $request->bank_name : null,
            'is_update' => 0,
            'verification' => strlen($request->npwp) >= 15 ? 1 : 0
        ];
        $cek = Employeer::find(Auth::id())->update($data);
        if ($cek) {
            $dat['status'] = true;
            return response()->json($dat, 200);
        }else {
            $dat['status'] = false;
            return response()->json($dat, 200);
        }
    }
}
