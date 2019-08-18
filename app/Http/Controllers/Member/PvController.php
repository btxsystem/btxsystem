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
    public function generate(){
        $pairings = DB::table('pairings')->join('employeers','pairings.id_member','=','employeers.id')
                                         ->select('pairings.pv_left','pairings.pv_midle','pairings.pv_right','pairings.id_member','employeers.rank_id','employeers.bitrex_cash')
                                         ->get();
        //dd($pairings);
        foreach ($pairings as $key => $pairing) {
            $bonus = 0;
            $bonus_pairing = 0;
            $max = true;
            while (($max) && (($pairing->pv_left >= 100 and $pairing->pv_midle >= 100) || ($pairing->pv_left >= 100 and $pairing->pv_right >= 100) || ($pairing->pv_right >= 100 and $pairing->pv_midle >= 100))) {
                if (($pairing->pv_right <= $pairing->pv_left) and ($pairing->pv_right <= $pairing->pv_midle)) {
                    if (($pairing->pv_left <= $pairing->pv_midle)) {
                        $bonus = $pairing->pv_left / 100;
                    }else{
                        $bonus = $pairing->pv_midle / 100;
                    }
                    $bonus_pairing += $bonus*100000; 
                    $pairing->pv_left = $pairing->pv_left - (100 * $bonus);
                    $pairing->pv_midle = $pairing->pv_midle - (100 * $bonus);
                }elseif (($pairing->pv_midle <= $pairing->pv_left) and ($pairing->pv_midle <= $pairing->pv_right)) {
                    if (($pairing->pv_left <= $pairing->pv_right)) {
                        $bonus = $pairing->pv_left / 100;
                    }else{
                        $bonus = $pairing->pv_right / 100;
                    }
                    $bonus_pairing += $bonus*100000;
                    $pairing->pv_left = $pairing->pv_left - (100 * $bonus);
                    $pairing->pv_right = $pairing->pv_right - (100 * $bonus);
                }elseif (($pairing->pv_left <= $pairing->pv_midle) and ($pairing->pv_left <= $pairing->pv_right)) {
                    if (($pairing->pv_midle <= $pairing->pv_right)) {
                        $bonus = $pairing->pv_midle / 100;
                    }else{
                        $bonus = $pairing->pv_right / 100;
                    }
                    $bonus_pairing += $bonus*100000;
                    $pairing->pv_midle = $pairing->pv_midle - (100 * $bonus);
                    $pairing->pv_right = $pairing->pv_right - (100 * $bonus);
                }
                if ($pairing->rank_id == null || $pairing->rank_id == 0 || $pairing->rank_id < 1) {
                    $bonus_pairing = 0;
                    $max = false;
                }elseif($pairing->rank_id <= 3 && $bonus_pairing >= 3500000){
                    $bonus_pairing = 3500000;
                    $max = false;
                }elseif($pairing->rank_id <= 6 && $bonus_pairing >= 7000000){
                    $bonus_pairing = 7000000;
                    $max = false;
                }elseif($pairing->rank_id <= 8 && $bonus_pairing >= 10000000){
                    $bonus_pairing = 10000000;
                    $max = false;
                }
                    
            }
           if($bonus_pairing>0){
                DB::table('pairings')->where('id_member', $pairing->id_member)->update(['pv_left' => $pairing->pv_left,'pv_midle' => $pairing->pv_midle, 'pv_right' => $pairing->pv_right, 'updated_at' => Carbon::now()]);
                DB::table('history_bitrex_cash')->insert(['id_member' => $pairing->id_member, 'nominal' => $bonus_pairing, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'description' => 'Bonus pairing', 'info' => 1]);
                DB::table('employeers')->where('id', $pairing->id_member)->update(['bitrex_cash' => $pairing->bitrex_cash += $bonus_pairing, 'updated_at' => Carbon::now()]); 
           }   
        }
    }
}
