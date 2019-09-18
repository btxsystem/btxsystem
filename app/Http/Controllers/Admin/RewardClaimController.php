<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GotReward;
use DataTables;
use Auth;
use Alert;
use DB;

class RewardClaimController extends Controller
{
    public function index()
    {
        // if (request()->ajax()) {
            $data = GotReward::orderBy('id','desc');

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
        // }

        // return view('admin.transfer-confirmations.index');
   }
}
