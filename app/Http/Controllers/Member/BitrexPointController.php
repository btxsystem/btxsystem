<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\HistoryBitraxPoint;
use DataTables;
use DB;

class BitrexPointController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        $history = DB::table('history_bitrex_point')->select('nominal','points','description','created_at as date','info')
                                                    ->where('id_member',$data->id);
        if (request()->ajax()) {
            return Datatables::of($history)
                    ->addIndexColumn()
                    ->editColumn('date', function($history) {
                        return date('F j, Y',strtotime($history->date));
                    })
                    ->editColumn('info', function($history) {
                        return $history->info ? '<button type="button" class="btn btn-success btn-xs">Income</button>' : '<button class="btn btn-danger btn-xs">Spending</button>';
                    })
                    ->rawColumns(['info'])
                    ->make(true);
        }
        return view('frontend.bitrex-money.bitrex-points')->with('profile',$data);
    }

    public function getHistoryPoints(){
        
    }
}
