<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class TransactionController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        return view('frontend.transaction.my-transaction')->with('profile',$data);
    }

    public function myTransaction(){
        $data = DB::table('employeers')->join('transaction_member','employeers.id','=','transaction_member.member_id')
                                       ->join('ebooks','transaction_member.ebook_id','=','ebooks.id')
                                       ->where('employeers.id','=',Auth::id())
                                       ->select('ebooks.title','ebooks.price','transaction_member.created_at as date','ebooks.pv')
                                       ->paginate(3);
        return response()->json(['transaction'=>$data]);
    }

    public function transactionNonMember(){
        $data = Auth::user();
        return view('frontend.transaction.prospected-member-transaction')->with('profile',$data);
    }

    public function prospectedMemberHistory(){
        $data = DB::table('non_members')->join('transaction_non_members','non_members.id','=','transaction_non_members.non_member_id')
                                       ->join('ebooks','transaction_non_members.ebook_id','=','ebooks.id')
                                       ->where('transaction_non_members.non_member_id','=',Auth::id())
                                       ->select('ebooks.title','ebooks.price','ebooks.price_markup','transaction_non_members.created_at as date','non_members.username')->paginate(3);
        return response()->json(['transaction'=>$data]);
    }
}
