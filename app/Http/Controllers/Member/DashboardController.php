<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        return view('frontend.dashboard')->with('profile',$data);
    }

    public function getAutoRetailDaily(){
        $id = Auth::id();
        $now = \Carbon\Carbon::now()->format('d m Y');
        $data = DB::table('history_bitrex_cash')->where('id_member',$id)->where('description','Bonus Retail')
                                                ->where(DB::raw('DATE_FORMAT(created_at, "%d %m %Y")'), $now)
                                                ->where('id_member', $id)->select(DB::raw('SUM(nominal) as nominal'))->first();
        if($data->nominal == null){
            $data->nominal = 0;
        }
        return response()->json(['bonus_retail'=>$data]);
    }

    public function getBonusSponsorDaily(){
        $id = Auth::id();
        $now = \Carbon\Carbon::now()->format('d m Y');
        $data = DB::table('history_bitrex_cash')->where('id_member',$id)->where('description','Bonus sponsor')
                                                ->where(DB::raw('DATE_FORMAT(created_at, "%d %m %Y")'), $now)
                                                ->where('id_member', $id)->select(DB::raw('SUM(nominal) as nominal'))->first();
        if($data->nominal == null){
            $data->nominal = 0;
        }
       return response()->json(['bonus_sponsor'=>$data]);
    }
}
