<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employeer;
use DB;
use Alert;

class MembershipController extends Controller
{
    public function index(){
        $child = Employeer::parent(1)->renderAsArray();
        return $child[0];
    } 

    public function tree(){
    	return view('admin.tree.index');
    }

    
    public function select(Request $request){
        $term = trim($request->q);
        $formatted_tags = [];
        if (empty($term)) {
            $datas = DB::table('employeers')->select('id','username')->limit(5)->get();
            foreach ($datas as $tag) {
                $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->username];
            }
        }else{
            $tags = DB::table('employeers')->select('id','username')->where('username', 'LIKE', '%'.$term.'%')->limit(5)->get();
            foreach ($tags as $tag) {
                $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->username];
            }
        }
        return \Response::json($formatted_tags);
    }

    public function select_upline(Request $request, $id){
        $data = new Employeer;
        return \Response::json($data->children());
    }
}
