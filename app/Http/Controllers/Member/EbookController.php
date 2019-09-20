<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\TransactionMember;
use App\Models\Ebook;
use Carbon\Carbon;

class EbookController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        $basic = Ebook::select('src')->where('id', 1)->first();
        $advance = Ebook::select('src')->where('id', 2)->first();
        return view('frontend.ebook.index',['profile'=>$data, 'basic'=> $basic, 'advance'=>$advance]);
    }

    public function getEbook(){
        $isHaveBasic = TransactionMember::where('member_id',Auth::id())->where('ebook_id',1)->get();
        $isHaveAdvance = TransactionMember::where('member_id',Auth::id())->where('ebook_id',2)->get();
        if (count($isHaveBasic) > 0 and count($isHaveAdvance) > 0) {
            $ebook = Ebook::select('id','title','price','description','src','pv','bv')->where('id', '>', 2)->get();
        }else {
            if (count($isHaveBasic) > 0) {
                $ebook = Ebook::select('id','title','price','description','src','pv','bv')->where('id', 2)->orWhere('id',3)->get();
                $tmp = $ebook[0];
                $ebook[0] = $ebook[1];
                $ebook[1] = $tmp;
            }elseif (count($isHaveAdvance)> 0) {
                $ebook = Ebook::select('id','title','price','description','src','pv','bv')->where('id', 1)->orWhere('id',4)->get();
            }else{
                $ebook = Ebook::select('id','title','price','description','src','pv','bv')->where('id', '<', 3)->get();
            }
        }
        return response()->json($ebook);
    }

    public function getExpiredEbook(){
        $ebook['basic'] = DB::table('transaction_member')->where('member_id',Auth::id())->where('status',1)
                                                         ->whereIn('id', [1 , 3])
                                                         ->select('expired_at')
                                                         ->latest('id')
                                                         ->first();
        $ebook['advance'] = DB::table('transaction_member')->where('member_id',Auth::id())->where('status',1)
                                                         ->whereIn('id', [2 , 4])
                                                         ->select('expired_at')
                                                         ->latest('id')
                                                         ->first();
        return response()->json($ebook, 200);
    }
}
