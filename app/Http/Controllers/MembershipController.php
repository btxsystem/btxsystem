<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employeer;
use DB;
use Alert;

class MembershipController extends Controller
{
    public function index(){
        $child = Employeer::nested()->get();
        return response()->json($child[0]);
    } 

    public function tree(){
    	return view('admin.tree.index');
    }

    
    public function select(Request $request){
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('employeers')->select('id', 'first_name')->where('first_name', 'LIKE', '%$cari%')->get();
            return response()->json($data);
        }
    }
}
