<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\HistoryPv;
use DataTables;
use DB;
use Carbon\Carbon;

class PvController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        return view('frontend.pv')->with('profile',$data);
    }

    public function getHistoryPv(){
        $data = Auth::user();
        $history = DB::table('history_pv')->select('pv','pv_today','created_at as date')->where('id_member',$data->id)->orderBy('created_at','desc')->paginate(3);
        return response()->json(['pv'=>$history]); 
    }

    public function historyPvPairing(){
        $data = DB::table('history_pv_pairing')->select('total_pairing','fail_pairing', 'left', 'midle', 'right','created_at')->where('id_member',Auth::id())->orderBy('created_at','desc')->paginate(4);
        return response()->json($data, 200);
    }

    public function pvHistory(){
        $data = Auth::user();
        return view('frontend.pv-pairing')->with('profile',$data);
    }

    public function generate(){
        $pairings = DB::table('pairings')->join('employeers','pairings.id_member','=','employeers.id')
                                         ->select('pairings.pv_left','pairings.pv_midle','pairings.pv_right','pairings.id_member','employeers.rank_id','employeers.bitrex_cash','employeers.verification')
                                         ->get();
        foreach ($pairings as $key => $pairing) {
            
            $bonus = 0;
            $bonus_pairing = 0;
            $tamp = 0;
            $max = true;
            $has_pairing = 0;
            $fail_pairing = 0;
            $left_pairing = $pairing->pv_left;
            $midle_pairing = $pairing->pv_midle;
            $right_pairing = $pairing->pv_right;

            $pajak = $pairing->verification == 1 ? 0.025 : 0.03;
            while (($max) && (($pairing->pv_left >= 100 and $pairing->pv_midle >= 100) || ($pairing->pv_left >= 100 and $pairing->pv_right >= 100) || ($pairing->pv_right >= 100 and $pairing->pv_midle >= 100))) {
                if (($pairing->pv_right <= $pairing->pv_left) and ($pairing->pv_right <= $pairing->pv_midle)) {
                    if (($pairing->pv_left <= $pairing->pv_midle)) {
                        $tamp = $pairing->pv_left % 100;
                        $bonus = ($pairing->pv_left - $tamp) / 100;
                    }else{
                        $tamp = $pairing->pv_midle % 100;
                        $bonus = ($pairing->pv_midle - $tamp) / 100;
                    }
                    $bonus_pairing += $bonus*100000; 
                    $pairing->pv_left = $pairing->pv_left - (100 * $bonus);
                    $pairing->pv_midle = $pairing->pv_midle - (100 * $bonus);
                }elseif (($pairing->pv_midle <= $pairing->pv_left) and ($pairing->pv_midle <= $pairing->pv_right)) {
                    if (($pairing->pv_left <= $pairing->pv_right)) {
                        $tamp = $pairing->pv_left % 100;
                        $bonus = ($pairing->pv_left - $tamp) / 100;
                    }else{
                        $tamp = $pairing->pv_right % 100;
                        $bonus = ($pairing->pv_right - $tamp) / 100;
                    }
                    $bonus_pairing += $bonus*100000;
                    $pairing->pv_left = $pairing->pv_left - (100 * $bonus);
                    $pairing->pv_right = $pairing->pv_right - (100 * $bonus);
                }elseif (($pairing->pv_left <= $pairing->pv_midle) and ($pairing->pv_left <= $pairing->pv_right)) {
                    if (($pairing->pv_midle <= $pairing->pv_right)) {
                        $tamp = $pairing->pv_midle % 100;
                        $bonus = ($pairing->pv_midle - $tamp) / 100;
                    }else{
                        $tamp = $pairing->pv_right % 100;
                        $bonus = ($pairing->pv_right - $tamp) / 100;
                    }
                    $bonus_pairing += $bonus*100000;
                    $pairing->pv_midle = $pairing->pv_midle - (100 * $bonus);
                    $pairing->pv_right = $pairing->pv_right - (100 * $bonus);
                }
                
                $has_pairing = $bonus_pairing / 100000;
                if ($pairing->rank_id == null || $pairing->rank_id == 0 || $pairing->rank_id < 1) {
                    $has_pairing = 0;
                    $fail_pairing = $bonus_pairing / 100000 ;
                    $bonus_pairing = 0;
                    $max = false;
                }elseif($pairing->rank_id <= 3 && $bonus_pairing >= 3500000){
                    $has_pairing = 35;
                    $fail_pairing = ($bonus_pairing - 3500000) / 100000 ;
                    $bonus_pairing = 3500000;
                    $max = false;
                }elseif($pairing->rank_id <= 6 && $bonus_pairing >= 7000000){
                    $has_pairing = 70;
                    $fail_pairing = ($bonus_pairing - 7000000) / 100000 ;
                    $bonus_pairing = 7000000;
                    $max = false;
                }elseif($pairing->rank_id <= 8 && $bonus_pairing >= 10000000){
                    $has_pairing = 100;
                    $fail_pairing = ($bonus_pairing - 10000000) / 100000 ;
                    $bonus_pairing = 10000000;
                    $max = false;
                }
                    
            }
           if($bonus_pairing>0){
                try {
                    DB::beginTransaction();
                    DB::table('history_pv_pairing')->insert(['id_member' => $pairing->id_member, 'total_pairing' => $has_pairing, 'fail_pairing' => $fail_pairing , 'left' => $left_pairing, 'midle' => $midle_pairing, 'right' => $right_pairing, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
                    DB::table('pairings')->where('id_member', $pairing->id_member)->update(['pv_left' => $pairing->pv_left,'pv_midle' => $pairing->pv_midle, 'pv_right' => $pairing->pv_right, 'updated_at' => Carbon::now()]);
                    DB::table('history_bitrex_cash')->insert(['id_member' => $pairing->id_member, 'nominal' => $bonus_pairing - ($bonus_pairing * $pajak), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'description' => 'Bonus pairing', 'info' => 1]);
                    DB::table('employeers')->where('id', $pairing->id_member)->update(['bitrex_cash' => $pairing->bitrex_cash += $bonus_pairing + ($bonus_pairing * $pajak), 'updated_at' => Carbon::now()]);
                    DB::table('history_pajak')->insert(['id_member' => $pairing->id_member, 'id_bonus' => 3, 'persentase' => $pajak, 'nominal' => $bonus_pairing - ($bonus_pairing * $pajak), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);   
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                    return 'gagal';
                }                
           }   
        }
    }
}
