<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Employeer;
use Carbon\Carbon;

class DashboardController extends Controller
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
            "rank" => $rank ? $rank->name : '-' ,
            "bitrex_cash" => $data->bitrex_cash,
            "bitrex_points" => $data->bitrex_points,
            "pv" => $data->pv
        );
        return view('frontend.dashboard')->with('profile',$profile);
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
        
        $user = Employeer::where('id',Auth::id())->with('children','pv_down','rank')->first();
        $data = [];

        $child = [];
        $data = [
            'id' => $user->id,
            'username' => $user->username,
            'rank' => $user->rank ? $user->rank->name : '-',
            'pv_left' => $user->pv_down ? $user->pv_down->pv_left : 0,
            'pv_midle' => $user->pv_down ? $user->pv_down->pv_midle : 0 ,
            'pv_right' => $user->pv_down ? $user->pv_down->pv_right : 0,
            'parent_id' => $user->parent_id ? $user->parent_id : null,
            'children' => [],
        ];
        for ($i=0; $i < 3; $i++) {
            if(isset($user->children[$i])){
                $tamp = Employeer::where('id',$user->children[$i]->id)->with('children','pv_down','rank')->first();
                for ($j=0; $j<3; $j++){
                    if(isset($user->children[$i]->children[$j])){
                        $tamp2 = Employeer::where('id',$user->children[$i]->children[$j]->id)->with('pv_down','rank')->first();
                        if($user->children[$i]->children[$j]->position == 0){
                            $child[0] =  [
                                'id' => $tamp2->id,
                                'username' => $tamp2->username,
                                'rank' => $tamp2->rank ? $tamp2->rank->name : '-' ,
                                'pv_left' => $tamp2->pv_down ? $tamp2->pv_down->pv_left : 0,
                                'pv_midle' => $tamp2->pv_down ? $tamp2->pv_down->pv_midle  : 0 ,
                                'pv_right' => $tamp2->pv_down ? $tamp2->pv_down->pv_right : 0,
                                'parent_id' => $tamp2->parent_id,
                                'position' => $tamp2->position
                            ];   
                        }else if($user->children[$i]->children[$j]->position == 1){
                            $child[1] =  [
                                'id' => $tamp2->id,
                                'username' => $tamp2->username,
                                'rank' => $tamp2->rank ? $tamp2->rank->name : '-' ,
                                'pv_left' => $tamp2->pv_down ? $tamp2->pv_down->pv_left : 0,
                                'pv_midle' => $tamp2->pv_down ? $tamp2->pv_down->pv_midle  : 0 ,
                                'pv_right' => $tamp2->pv_down ? $tamp2->pv_down->pv_right : 0,
                                'parent_id' => $tamp2->parent_id,
                                'position' => $tamp2->position
                            ];   
                        }else{
                            $child[2] =  [
                                'id' => $tamp2->id,
                                'username' => $tamp2->username,
                                'rank' => $tamp2->rank ? $tamp2->rank->name : '-' ,
                                'pv_left' => $tamp2->pv_down ? $tamp2->pv_down->pv_left : 0,
                                'pv_midle' => $tamp2->pv_down ? $tamp2->pv_down->pv_midle  : 0 ,
                                'pv_right' => $tamp2->pv_down ? $tamp2->pv_down->pv_right : 0,
                                'parent_id' => $tamp2->parent_id,
                                'position' => $tamp2->position
                            ];   
                        }        
                   }
                }
                if ($user->children[$i]->position == 0) {
                    $data['children'][0] =  [
                        'id' => $tamp->id,
                        'username' => $tamp->username,
                        'rank' => $tamp->rank ? $tamp->rank->name : '-',
                        'pv_left' => $tamp->pv_down ? $tamp->pv_down->pv_left : 0,
                        'pv_midle' => $tamp->pv_down ? $tamp->pv_down->pv_midle  : 0 ,
                        'pv_right' => $tamp->pv_down ? $tamp->pv_down->pv_right : 0,
                        'children' => $child ? $child : [],
                        'parent_id' => $tamp->parent_id,
                        'position' => $tamp->position
                    ];
                }else if ($user->children[$i]->position == 1) {
                    $data['children'][1] =  [
                        'id' => $tamp->id,
                        'username' => $tamp->username,
                        'rank' => $tamp->rank ? $tamp->rank->name : '-',
                        'pv_left' => $tamp->pv_down ? $tamp->pv_down->pv_left : 0,
                        'pv_midle' => $tamp->pv_down ? $tamp->pv_down->pv_midle  : 0 ,
                        'pv_right' => $tamp->pv_down ? $tamp->pv_down->pv_right : 0,
                        'children' => $child ? $child : [],
                        'parent_id' => $tamp->parent_id,
                        'position' => $tamp->position
                    ];
                }else{
                    $data['children'][2] =  [
                        'id' => $tamp->id,
                        'username' => $tamp->username,
                        'rank' => $tamp->rank ? $tamp->rank->name : '-',
                        'pv_left' => $tamp->pv_down ? $tamp->pv_down->pv_left : 0,
                        'pv_midle' => $tamp->pv_down ? $tamp->pv_down->pv_midle  : 0 ,
                        'pv_right' => $tamp->pv_down ? $tamp->pv_down->pv_right : 0,
                        'children' => $child ? $child : [],
                        'parent_id' => $tamp->parent_id,
                        'position' => $tamp->position
                    ];
                }
            }
        };

        for ($i=0; $i < 3; $i++) { 
            if (!isset($data['children'][$i])) {
                $data['children'][$i] =[
                    'available' => true,
                    'position' => $i,
                    'parent_id' => $data['id']
               ];
            }else{   
               for ($j=0; $j < 3 ; $j++) { 
                   if (!isset($data['children'][$i]['children'][$j]) || ($data['children'][$i]['children'][$j]['parent_id'] != $data['children'][$i]['id'] )) {
                      unset($data['children'][$i]['children'][$j]);
                      $data['children'][$i]['children'][$j] = [
                        'available' => true,
                        'position' => $j,
                        'parent_id' => $data['children'][$i]['id']
                      ];
                   }
               }
            }
        }

        $tree = [
            'id' => $user->id,
            'username' => $user->username,
            'rank' => $user->rank ? $user->rank->name : '-',
            'pv_left' => $user->pv_down ? $user->pv_down->pv_left : 0,
            'pv_midle' => $user->pv_down ? $user->pv_down->pv_midle : 0 ,
            'pv_right' => $user->pv_down ? $user->pv_down->pv_right : 0,
            'parent_id' => $user->parent_id,
            'children' => [],
        ];
        
        for ($i=0; $i < 3; $i++) { 
            $tree['children'][$i] = $data['children'][$i];
            unset($tree['children'][$i]['children']);
            if (isset($data['children'][$i]['children'])) {   
                for ($j=0; $j<3 ; $j++) {
                    $tree['children'][$i]['children'][$j] = $data['children'][$i]['children'][$j];
                }
            }
        }
 
        return response()->json($tree);
    }

    public function getChildTree($user){
        
        $user = Employeer::where('username',$user)->with('children','pv_down','rank')->first();
        $data = [];

        $child = [];
        $data = [
            'id' => $user->id,
            'username' => $user->username,
            'rank' => $user->rank ? $user->rank->name : '-',
            'pv_left' => $user->pv_down ? $user->pv_down->pv_left : 0,
            'pv_midle' => $user->pv_down ? $user->pv_down->pv_midle : 0 ,
            'pv_right' => $user->pv_down ? $user->pv_down->pv_right : 0,
            'parent_id' => $user->parent_id ? $user->parent_id : null,
            'children' => [],
        ];
        for ($i=0; $i < 3; $i++) {
            if(isset($user->children[$i])){
                $tamp = Employeer::where('id',$user->children[$i]->id)->with('children','pv_down','rank')->first();
                for ($j=0; $j<3; $j++){
                    if(isset($user->children[$i]->children[$j])){
                        $tamp2 = Employeer::where('id',$user->children[$i]->children[$j]->id)->with('pv_down','rank')->first();
                        if($user->children[$i]->children[$j]->position == 0){
                            $child[0] =  [
                                'id' => $tamp2->id,
                                'username' => $tamp2->username,
                                'rank' => $tamp2->rank ? $tamp2->rank->name : '-' ,
                                'pv_left' => $tamp2->pv_down ? $tamp2->pv_down->pv_left : 0,
                                'pv_midle' => $tamp2->pv_down ? $tamp2->pv_down->pv_midle  : 0 ,
                                'pv_right' => $tamp2->pv_down ? $tamp2->pv_down->pv_right : 0,
                                'parent_id' => $tamp2->parent_id,
                                'position' => $tamp2->position
                            ];   
                        }else if($user->children[$i]->children[$j]->position == 1){
                            $child[1] =  [
                                'id' => $tamp2->id,
                                'username' => $tamp2->username,
                                'rank' => $tamp2->rank ? $tamp2->rank->name : '-' ,
                                'pv_left' => $tamp2->pv_down ? $tamp2->pv_down->pv_left : 0,
                                'pv_midle' => $tamp2->pv_down ? $tamp2->pv_down->pv_midle  : 0 ,
                                'pv_right' => $tamp2->pv_down ? $tamp2->pv_down->pv_right : 0,
                                'parent_id' => $tamp2->parent_id,
                                'position' => $tamp2->position
                            ];   
                        }else{
                            $child[2] =  [
                                'id' => $tamp2->id,
                                'username' => $tamp2->username,
                                'rank' => $tamp2->rank ? $tamp2->rank->name : '-' ,
                                'pv_left' => $tamp2->pv_down ? $tamp2->pv_down->pv_left : 0,
                                'pv_midle' => $tamp2->pv_down ? $tamp2->pv_down->pv_midle  : 0 ,
                                'pv_right' => $tamp2->pv_down ? $tamp2->pv_down->pv_right : 0,
                                'parent_id' => $tamp2->parent_id,
                                'position' => $tamp2->position
                            ];   
                        }        
                   }
                }
                if ($user->children[$i]->position == 0) {
                    $data['children'][0] =  [
                        'id' => $tamp->id,
                        'username' => $tamp->username,
                        'rank' => $tamp->rank ? $tamp->rank->name : '-',
                        'pv_left' => $tamp->pv_down ? $tamp->pv_down->pv_left : 0,
                        'pv_midle' => $tamp->pv_down ? $tamp->pv_down->pv_midle  : 0 ,
                        'pv_right' => $tamp->pv_down ? $tamp->pv_down->pv_right : 0,
                        'children' => $child ? $child : [],
                        'parent_id' => $tamp->parent_id,
                        'position' => $tamp->position
                    ];
                }else if ($user->children[$i]->position == 1) {
                    $data['children'][1] =  [
                        'id' => $tamp->id,
                        'username' => $tamp->username,
                        'rank' => $tamp->rank ? $tamp->rank->name : '-',
                        'pv_left' => $tamp->pv_down ? $tamp->pv_down->pv_left : 0,
                        'pv_midle' => $tamp->pv_down ? $tamp->pv_down->pv_midle  : 0 ,
                        'pv_right' => $tamp->pv_down ? $tamp->pv_down->pv_right : 0,
                        'children' => $child ? $child : [],
                        'parent_id' => $tamp->parent_id,
                        'position' => $tamp->position
                    ];
                }else{
                    $data['children'][2] =  [
                        'id' => $tamp->id,
                        'username' => $tamp->username,
                        'rank' => $tamp->rank ? $tamp->rank->name : '-',
                        'pv_left' => $tamp->pv_down ? $tamp->pv_down->pv_left : 0,
                        'pv_midle' => $tamp->pv_down ? $tamp->pv_down->pv_midle  : 0 ,
                        'pv_right' => $tamp->pv_down ? $tamp->pv_down->pv_right : 0,
                        'children' => $child ? $child : [],
                        'parent_id' => $tamp->parent_id,
                        'position' => $tamp->position
                    ];
                }
            }
        };

        for ($i=0; $i < 3; $i++) { 
            if (!isset($data['children'][$i])) {
                $data['children'][$i] =[
                    'available' => true,
                    'position' => $i,
                    'parent_id' => $data['id']
               ];
            }else{   
               for ($j=0; $j < 3 ; $j++) { 
                   if (!isset($data['children'][$i]['children'][$j]) || ($data['children'][$i]['children'][$j]['parent_id'] != $data['children'][$i]['id'] )) {
                      unset($data['children'][$i]['children'][$j]);
                      $data['children'][$i]['children'][$j] = [
                        'available' => true,
                        'position' => $j,
                        'parent_id' => $data['children'][$i]['id']
                      ];
                   }
               }
            }
        }

        $tree = [
            'id' => $user->id,
            'username' => $user->username,
            'rank' => $user->rank ? $user->rank->name : '-',
            'pv_left' => $user->pv_down ? $user->pv_down->pv_left : 0,
            'pv_midle' => $user->pv_down ? $user->pv_down->pv_midle : 0 ,
            'pv_right' => $user->pv_down ? $user->pv_down->pv_right : 0,
            'parent_id' => $user->parent_id,
            'children' => [],
        ];
        
        for ($i=0; $i < 3; $i++) { 
            $tree['children'][$i] = $data['children'][$i];
            unset($tree['children'][$i]['children']);
            if (isset($data['children'][$i]['children'])) {   
                for ($j=0; $j<3 ; $j++) {
                    $tree['children'][$i]['children'][$j] = $data['children'][$i]['children'][$j];
                }
            }
        }
 
        return response()->json($tree);
    }
    
        
}
