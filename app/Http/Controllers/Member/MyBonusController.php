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
    public function index(){
        $data = Auth::user();
        return view('frontend.bonus.index')->with('profile',$data);
    }

    public function bonus(){
        $bonus = [];
        $bonus['sponsor'] = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('description', 'like', '%sponsor%')->where('info',1)->select(DB::raw('SUM(nominal) as nominal'))->first();
        $bonus['pairing'] = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('description', 'like', '%pairing%')->where('info',1)->select(DB::raw('SUM(nominal) as nominal'))->first();
        $bonus['profit'] = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('description', 'like', '%profit%')->where('info',1)->select(DB::raw('SUM(nominal) as nominal'))->first();
        return response()->json($bonus, 200);
    }

    public function sponsor(){
        $user = Auth::user();
        return view('frontend.bonus.sponsor.index')->with('profile',$user);
    }

    public function bonusSponsor(){
        $data = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('description', 'like', '%sponsor%')->select('nominal','created_at','description')->paginate(4);
        return response()->json($data, 200);
    }

    public function profit(){
        $user = Auth::user();
        return view('frontend.bonus.profit.index')->with('profile',$user);
    }

    public function bonusProfit(){
        $data = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('description', 'like', '%profit%')->select('nominal','created_at','description')->paginate(4);
        return response()->json($data, 200);
    }

    public function pairing(){
        $user = Auth::user();
        return view('frontend.bonus.pairing.index')->with('profile',$user);
    }

    public function bonusPairing(){
        $data = DB::table('history_bitrex_cash')->where('id_member',Auth::id())->where('description', 'like', '%pairing%')->select('nominal','created_at','description')->paginate(4);
        return response()->json($data, 200);
    }
}
