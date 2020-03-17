<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use DB;
use App\Employeer;
use App\Models\TransactionMember;
use App\Models\Ebook;

class MyBonusController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!\Auth::user()) {
                return redirect('/');
            }
            return $next($request);
        });
    }
    
    public function index(){
        $data = Auth::user();
        return view('frontend.bonus.index')->with('profile',$data);
    }

    public function bonus(){
        $bonus = [];
        $bonus['total'] = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('info',1)->select(DB::raw('SUM(nominal) as nominal'))->first();
        $bonus['sponsor'] = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('type', 0)->where('info',1)->select(DB::raw('SUM(nominal) as nominal'))->first();
        $bonus['pairing'] = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('type', 1)->where('info',1)->select(DB::raw('SUM(nominal) as nominal'))->first();
        $bonus['profit'] = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('type', 2)->where('info',1)->select(DB::raw('SUM(nominal) as nominal'))->first();
        $bonus['rewards'] = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('type', 3)->where('info',1)->select(DB::raw('SUM(nominal) as nominal'))->first();
        $bonus['event'] = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('type', 4)->where('info',1)->select(DB::raw('SUM(nominal) as nominal'))->first();
        return response()->json($bonus, 200);
    }

    public function rewards(){
        $user = Auth::user();
        return view('frontend.bonus.rewards.index')->with('profile',$user);
    }

    public function event(){
        $user = Auth::user();
        return view('frontend.bonus.event.index')->with('profile',$user);
    }

    public function sponsor(){
        $user = Auth::user();
        return view('frontend.bonus.sponsor.index')->with('profile',$user);
    }

    public function bonusSponsor(){
        $data = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('type', 0)->select('nominal','created_at','description')->orderBy('id', 'DESC')->paginate(4);
        return response()->json($data, 200);
    }

    public function bonusRewards(){
        $data = DB::table('got_rewards')->join('gift_rewards','got_rewards.reward_id','=','gift_rewards.id')
                                        ->where('got_rewards.member_id',Auth::id())->where('status', 2)
                                        ->select('gift_rewards.nominal as nominal','got_rewards.created_at as created_at','gift_rewards.description as description')
                                        ->orderBy('got_rewards.id', 'DESC')->paginate(4);
        return response()->json($data, 200);
    }

    public function bonusEvent(){
        $data = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('type', 4)->select('nominal','created_at','description')->orderBy('id', 'DESC')->paginate(4);
        return response()->json($data, 200);
    }

    public function profit(){
        $user = Auth::user();
        return view('frontend.bonus.profit.index')->with('profile',$user);
    }

    public function bonusProfit(){
        $data = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('type', 2)->select('nominal','created_at','description')->orderBy('id', 'DESC')->paginate(4);
        return response()->json($data, 200);
    }

    public function pairing(){
        $user = Auth::user();
        return view('frontend.bonus.pairing.index')->with('profile',$user);
    }

    public function bonusPairing(){
        $data = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('type', 1)->select('nominal','created_at','description')->orderBy('id', 'DESC')->paginate(4);
        return response()->json($data, 200);
    }

    public function generatePv(){
        Employeer::select('parent_id','id')->chunk(100, function($datas) {
            foreach ($datas as $data) {
                DB::table('employeers')->where('id', $data->id)->update(['pv' => 100, 'updated_at' => now()]);
                DB::table('transaction_member')->insert(['member_id' => $data->id, 'ebook_id' => 1, 'created_at' => now(), 'updated_at' => now(), 'status' => 1, 'expired_at' => '2020-09-18', 'transaction_ref' => null]);
                DB::table('transaction_member')->insert(['member_id' => $data->id, 'ebook_id' => 1, 'created_at' => now(), 'updated_at' => now(), 'status' => 1, 'expired_at' => '2020-09-18', 'transaction_ref' => null]);
                if ($data->parent_id) {
                    $this->recursive($data->id);
                }
            }
        });
    }

    public function recursive($id){
        $data = Employeer::where('id',$id)->select('parent_id','id','position')->first();
        $rank_parent = DB::table('pv_rank')->where('id_member',$data->parent_id)->select('pv_left','pv_midle','pv_right')->first();
        if ($data->position == 0) {
            if($rank_parent==null){
                DB::table('pv_rank')->insert(['pv_left' => 100, 'pv_midle' => 0, 'pv_right' => 0, 'id_member' => $data->parent_id , 'created_at' => now(), 'updated_at' => now()]);
                DB::table('pv_rewards')->insert(['pv_left' => 100, 'pv_midle' => 0, 'pv_right' => 0, 'id_member' => $data->parent_id , 'created_at' => now(), 'updated_at' => now()]);
            }else{
                DB::table('pv_rank')->where('id_member', $data->parent_id)->update(['pv_left' => $rank_parent->pv_left + 100, 'updated_at' => now()]);
                DB::table('pv_rewards')->where('id_member', $data->parent_id)->update(['pv_left' => $rank_parent->pv_left + 100, 'updated_at' => now()]);        
            }
        }elseif ($data->position == 1) {
            if($rank_parent==null){
                DB::table('pv_rank')->insert(['pv_left' => 0, 'pv_midle' => 100, 'pv_right' => 0, 'id_member' => $data->parent_id , 'created_at' => now(), 'updated_at' => now()]);
                DB::table('pv_rewards')->insert(['pv_left' => 0, 'pv_midle' => 100, 'pv_right' => 0, 'id_member' => $data->parent_id , 'created_at' => now(), 'updated_at' => now()]);
            }else{
                DB::table('pv_rank')->where('id_member', $data->parent_id)->update(['pv_midle' => $rank_parent->pv_midle + 100, 'updated_at' => now()]);        
                DB::table('pv_rewards')->where('id_member', $data->parent_id)->update(['pv_midle' => $rank_parent->pv_midle + 100, 'updated_at' => now()]);        
            }
        }elseif ($data->position == 2) {
            if($rank_parent==null){
                DB::table('pv_rank')->insert(['pv_left' => 0, 'pv_midle' => 0, 'pv_right' => 100, 'id_member' => $data->parent_id , 'created_at' => now(), 'updated_at' => now()]);
                DB::table('pv_rewards')->insert(['pv_left' => 0, 'pv_midle' => 0, 'pv_right' => 100, 'id_member' => $data->parent_id , 'created_at' => now(), 'updated_at' => now()]);
            }else{
                DB::table('pv_rank')->where('id_member', $data->parent_id)->update(['pv_right' => $rank_parent->pv_right + 100, 'updated_at' => now()]);        
                DB::table('pv_rewards')->where('id_member', $data->parent_id)->update(['pv_right' => $rank_parent->pv_right + 100, 'updated_at' => now()]);        
            }
        }
        $parent = Employeer::where('id',$data->parent_id)->select('parent_id','id','position')->first();
        if ($parent->parent_id) {
            $this->recursive($parent->id);
        }
    }
}
