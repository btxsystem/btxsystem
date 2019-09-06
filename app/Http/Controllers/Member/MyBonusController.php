<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\TransactionMember;
use App\Models\Ebook;

class MyBonusController extends Controller
{
    public function index(Request $request){
        $data = Auth::user();
        if($request->ajax()){
            $bonus = [];
            $bonus['sponsor'] = DB::table('history_bitrex_cash')->where('id_member',$data->id)->where('description', 'like', '%sponsor%')->where('info',1)->select(DB::raw('SUM(nominal) as nominal'))->first();
            $bonus['pairing'] = DB::table('history_bitrex_cash')->where('id_member',$data->id)->where('description', 'like', '%pairing%')->where('info',1)->select(DB::raw('SUM(nominal) as nominal'))->first();
            $bonus['profit'] = DB::table('history_bitrex_cash')->where('id_member',$data->id)->where('description', 'like', '%profit%')->where('info',1)->select(DB::raw('SUM(nominal) as nominal'))->first();
            return response()->json($bonus, 200);
        }
        return view('frontend.bonus.index')->with('profile',$data);
    }

    public function sponsor(Request $request){
        $user = Auth::user();
        if($request->ajax()){
            $data = DB::table('history_bitrex_cash')->where('id_member',$user->id)->where('description', 'like', '%sponsor%')->select('nominal','created_at','description')->get();
            return response()->json($data, 200);
        }
        return view('frontend.bonus.sponsor.index')->with('profile',$user);
    }

    public function profit(Request $request){
        $user = Auth::user();
        if($request->ajax()){
            $data = DB::table('history_bitrex_cash')->where('id_member',$user->id)->where('description', 'like', '%profit%')->select('nominal','created_at','description')->get();
            return response()->json($data, 200);
        }
        return view('frontend.bonus.profit.index')->with('profile',$user);
    }
}
