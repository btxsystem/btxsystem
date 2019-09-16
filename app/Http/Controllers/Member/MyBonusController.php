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
    public function index(){
        $data = Auth::user();
        return view('frontend.bonus.index')->with('profile',$data);
    }

    public function bonus(){
        $bonus = [];
        $bonus['sponsor'] = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('description', 'like', '%sponsor%')->where('info',1)->select(DB::raw('SUM(nominal) as nominal'))->first();
        $bonus['pairing'] = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('description', 'like', '%pairing%')->where('info',1)->select(DB::raw('SUM(nominal) as nominal'))->first();
        $bonus['profit'] = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('description', 'like', '%profit%')->where('info',1)->select(DB::raw('SUM(nominal) as nominal'))->first();
        return response()->json($bonus, 200);
    }

    public function sponsor(){
        $user = Auth::user();
        return view('frontend.bonus.sponsor.index')->with('profile',$user);
    }

    public function bonusSponsor(){
        $data = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('description', 'like', '%sponsor%')->select('nominal','created_at','description')->paginate(4);
        return response()->json($data, 200);
    }

    public function profit(){
        $user = Auth::user();
        return view('frontend.bonus.profit.index')->with('profile',$user);
    }

    public function bonusProfit(){
        $data = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('description', 'like', '%profit%')->select('nominal','created_at','description')->paginate(4);
        return response()->json($data, 200);
    }

    public function pairing(){
        $user = Auth::user();
        return view('frontend.bonus.pairing.index')->with('profile',$user);
    }

    public function bonusPairing(){
        $data = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('description', 'like', '%pairing%')->select('nominal','created_at','description')->paginate(4);
        return response()->json($data, 200);
    }

    public function generatePv(){
        $datas = Employeer::select('parent_id','id','sponsor_id')->get();
        foreach ($datas as $key => $data) {
            if ($data->parent_id != null) {
                $this->recursive($data->id);
            }else{
                DB::table('employeers')->where('id', $data->id)->update(['pv' => 100, 'updated_at' => now()]);
                DB::table('transaction_member')->insert(['member_id' => $data->id, 'ebook_id' => 1, 'created_at' => now(), 'updated_at' => now(), 'status' => 1, 'expired_at' => '2020-09-18', 'transaction_ref' => null]);
            }
        }
        
    }

    public function recursive($id){
        $data = Employeer::where('id',$id)->select('parent_id','id','sponsor_id','position')->first();
        $rank = DB::table('pv_rank')->where('id_member',$data->id)->select('pv_left','pv_midle','pv_right')->first();
        DB::table('employeers')->where('id', $data->id)->update(['pv' => 100, 'updated_at' => now()]);        
        DB::table('transaction_member')->insert(['member_id' => $data->id, 'ebook_id' => 1, 'created_at' => now(), 'updated_at' => now(), 'status' => 1, 'expired_at' => '2020-09-18', 'transaction_ref' => null]);
        if ($data->position == 0) {
            if($rank==null){
                DB::table('pv_rank')->insert(['pv_left' => 100, 'pv_midle' => 0, 'pv_right' => 0, 'id_member' => $data->parent_id , 'created_at' => now(), 'updated_at' => now()]);
            }else{
                DB::table('pv_rank')->where('id_member', $data->parent_id)->update(['pv_left' => $rank->pv_left + 100, 'updated_at' => now()]);        
            }
        }elseif ($data->position == 1) {
            if($rank==null){
                DB::table('pv_rank')->insert(['pv_left' => 0, 'pv_midle' => 100, 'pv_right' => 0, 'id_member' => $data->parent_id , 'created_at' => now(), 'updated_at' => now()]);
            }else{
                DB::table('pv_rank')->where('id_member', $data->parent_id)->update(['pv_midle' => $rank->pv_midle + 100, 'updated_at' => now()]);        
            }
        }elseif ($data->position == 2) {
            if($rank==null){
                DB::table('pv_rank')->insert(['pv_left' => 0, 'pv_midle' => 0, 'pv_right' => 100, 'id_member' => $data->parent_id , 'created_at' => now(), 'updated_at' => now()]);
            }else{
                DB::table('pv_rank')->where('id_member', $data->parent_id)->update(['pv_right' => $rank->pv_right + 100, 'updated_at' => now()]);        
            }
        }
        $parent = Employeer::where('id',$data->parent_id)->select('parent_id','id','sponsor_id','position')->first();
        if ($parent->parent_id != null) {
            $this->recursive($parent->id);
        }
    }
}
