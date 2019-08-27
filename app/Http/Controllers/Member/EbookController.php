<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\TransactionMember;
use App\Models\Ebook;

class EbookController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        return view('frontend.ebook.index')->with('profile',$data);
    }

    public function getEbook(){
        $ebook = Ebook::select('id','title','price','description','src','pv','bv')->get();
        return response()->json($ebook);
    }

    public function store(Request $request){
        $data = [
            'member_id' => Auth::user()->id,
            'ebook_id' => $request->id,
            'status' => 1,
            'expired_at' => '2020-03-05'
        ];
        $cek = TransactionMember::create($data);
        return redirect()->route('member.ebook.index');
    }
}
