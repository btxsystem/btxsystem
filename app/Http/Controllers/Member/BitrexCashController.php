<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\HistoryBitrexCash;
use DataTables;
use DB;

class BitrexCashController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        return view('frontend.bitrex-money.bitrex-cash')->with('profile',$data);
    }

    public function getHistoryCash(){
        $data = Auth::user();
        $history = HistoryBitrexCash::where('id_member',$data->id)->orderBy('created_at','desc')->paginate(3);
        return response()->json(['cash'=>$history]); 
    }
}
