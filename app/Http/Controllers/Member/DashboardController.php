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

    public function getBonusPairing(){
        $id = Auth::id();
        $now = \Carbon\Carbon::now()->format('d m Y');
        $data = DB::table('history_bitrex_cash')->where('id_member',$id)->where('description','Bonus pairing')
                                                ->where(DB::raw('DATE_FORMAT(created_at, "%d %m %Y")'), $now)
                                                ->where('id_member', $id)->select(DB::raw('SUM(nominal) as nominal'))->first();
        if($data->nominal == null){
            $data->nominal = 0;
        }
       return response()->json(['bonus_pairing'=>$data]);
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
        $user = Employeer::where('id',Auth::id())->with('children')->first();
        $child = array();
        for ($i=0; $i < 3; $i++) {
            if(isset($user->children[$i])){
                $user->children[$i] = Employeer::where('id',$user->children[$i]->id)->with('children')->first(); 
                for ($j=0; $j<3; $j++){
                    if(!(isset($user->children[$i]->children[$j]))){
                        $user->children[$i]->children[$j] = [
                            'available' => true,
                            'position' => $j
                        ];        
                    }
                }
            }else{
                $user->children[$i] = [
                    'available' => true,
                    'position' => $i
                ];
            }
        };
        return response()->json($user);
    }
    
    // public function getTree(){
    //     $user = Employeer::where('id',Auth::id())->with('children')->first();
    //     $position = 0;
    //     $tree = new \stdClass();
    //     for ($i=0; $i < 3; $i++) {
    //         if(isset($user->children[$i])){
    //             $position = $user->children[$i]->position;
    //             $child->children[$position] =  $user->children[$i];
    //             $user->children[$i] = Employeer::where('id',$user->children[$i]->id)->with('children')->first(); 
    //             for ($j=0; $j<3; $j++){
    //                 if(isset($user->children[$i]->children[$j])){
    //                     $position = $user->children[$i]->children[$j]->position;
    //                     $child->children[$i]->children[$position] = $user->children[$i]->children[$j];           
    //                 }
    //             }
    //         }
    //     };
    //    // dd($child);
    //     return response()->json($child);
    // }
        
}
