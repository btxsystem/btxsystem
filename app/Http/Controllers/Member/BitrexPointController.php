<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\HistoryBitrexPoints;
use DataTables;
use DB;

class BitrexPointController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        return view('frontend.bitrex-money.bitrex-points')->with('profile',$data);
    }

    public function getHistoryPoints(){
        $data = Auth::user();
        $history = HistoryBitrexPoints::where('id_member',$data->id)->orderBy('created_at','desc')->paginate(3);
        return response()->json(['points'=>$history]); 
    }
}