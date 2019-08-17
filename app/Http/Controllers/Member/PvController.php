<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\HistoryPv;
use DataTables;
use DB;

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
}
