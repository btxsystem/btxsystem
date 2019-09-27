<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\HistoryPv;
use DataTables;
use DB;
use Carbon\Carbon;

class TeamReportController extends Controller
{
    public function mySponsor(){
        $data = Auth::user();
        if (request()->ajax()) {
            $data = DB::table('employeers')->where('sponsor_id',Auth::id())->select('username','first_name','last_name', 'phone_number')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('name', function($data) {
                        return $data->first_name.' '.$data->last_name;
                    })
                    ->editColumn('number_phone', function($data) {
                        return $data->phone_number;
                    })
                    ->make(true);
        }
        return view('frontend.team-report.my-sponsor.index')->with('profile',$data);
    }
}
