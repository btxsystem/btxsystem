<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Employeer;

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

    public function getTraining(){
        $id = Auth::id();
        $now = \Carbon\Carbon::now()->format('d m Y');
        $data = DB::table('trainings')->where('open', 1)->select('location','note','price','capacity','start_training as date')->first();
        return response()->json(['training'=>$data]);
    }

    public function tree(){
        $data = Auth::user();
        return view('frontend.tree')->with('profile',$data);;
    }

    public function getTree(){
        $employeers = Employeer::parent(Auth::id())->renderAsArray();
        $user = DB::table('employeers')->where('id',Auth::id())->first();
        $data = [
            "id" => $user->id,
            "username" => $user->username,
            "position" => $user->position,
            "sponsor_id" => $user->sponsor_id,
            "pv" => $user->pv,
            "pv_left" => 0,
            "pv_midle" => 0,
            "pv_right" => 0,
            "children" => $employeers,
            "parent_id" => $user->parent_id,
        ];
        return response()->json($data);
        $this->buildTree($employeers, 1);
    }

    public function buildTree(array &$employeers, $parentId) {
        $tamp = [];
        foreach ($employeers as $key => $employeer) {
            
        }
        dd($tamp);
    }
        
        
}
