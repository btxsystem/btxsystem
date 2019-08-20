<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use DB;

class ProspectedMemberController extends Controller
{
    public function index()
    {
        $profile = Auth::user();
        if (request()->ajax()) {
            $data = DB::table('non_members')->join('transaction_non_members','non_members.id','=','transaction_non_members.non_member_id')
                                            ->where('transaction_non_members.member_id','=',Auth::id())
                                            ->select('username','first_name','last_name', 'email','number_phone')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('name', function($data) {
                        return $data->first_name.' '.$data->last_name;
                    })
                    ->make(true);
        }
        return view('frontend.prospected-member.index')->with('profile',$profile);
    }
}
