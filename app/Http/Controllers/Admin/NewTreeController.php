<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Employeer;
use DB;
use Alert;

class NewTreeController extends Controller
{
    public function index(){
        $data = Auth::user();
    } 

    public function tree(){
        $data = Auth::user();

        // return $data;
    	return view('admin.tree-new.index')->with('profile',$data);
    }

    public function getTree(){
        $user = Employeer::where('id',1)->with('children')->first();
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

}
