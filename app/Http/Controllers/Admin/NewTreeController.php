<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Employeer;
use DB;
use Alert;
use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\PvController;

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

    public function getTree(Request $request)
    {
        return (new DashboardController)->getTree($request);
    }

    public function getParentTree($id)
    {
        return (new DashboardController)->getParentTree($id);
    }

    public function getChildTree($user)
    {
        return (new DashboardController)->getChildTree($user, 'backoffice');
    }

    public function getSummary($id) {
        return (new PvController())->getSummary($id);
    }

    // public function getTree(){
    //     $user = Employeer::where('id',1)->with('children')->first();
    //     for ($i=0; $i < 3; $i++) {
    //         if(isset($user->children[$i])){
    //             $user->children[$i] = Employeer::where('id',$user->children[$i]->id)->with('children')->first(); 
    //             for ($j=0; $j<3; $j++){
    //                 if(!(isset($user->children[$i]->children[$j]))){
    //                     $user->children[$i]->children[$j] = [
    //                         'available' => true,
    //                         'position' => $j
    //                     ];        
    //                 }
    //             }
    //         }else{
    //             $user->children[$i] = [
    //                 'available' => true,
    //                 'position' => $i
    //             ];
    //         }
    //     };
    //     return response()->json($user);
    // }  

}
