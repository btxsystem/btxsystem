<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employeer;
use App\Customer\Customer;
use Illuminate\Support\Facades\DB;

class DashboardValuesController extends Controller
{
    public function data(){
        $active = DB::table('employeers')->select('id')
                            ->where('status',1)->get();
        $non_active = DB::table('employeers')->select('id')
                            ->where('status',0)->get();
        $sales = DB::table('transaction_member')->select('id')
                            ->where('status',1)->get();
        $bonus = DB::table('history_bitrex_cash')->select('id')
                            ->where('info',1)->sum('nominal');
        $datas['active'] = count($active);
        $datas['non_active'] = count($non_active);
        $datas['sales'] = count($sales);
        $datas['bonus'] = $bonus;
        return response()->json($datas, 200);
    }
}
