<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TransactionMember;
use App\Employeer;
use Illuminate\Support\Facades\DB;
use DataTables;
use Alert;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function transactionMember()
    {
        if (request()->ajax()) {
            $data = TransactionMember::with('member','ebook')->select('transaction_member.*');
           
            return Datatables::of($data)
                    ->addColumn('product', function ($data){
                        return $data->ebook ? $data->ebook->title : 'No Data';
                    })
                    ->addColumn('username', function ($data) {
                        return $data->member ? $data->member->username : 'No Data';
                      })
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('admin.report.transaction-member');
    }

    public function membership()
    {
        if (request()->ajax()) {
            $data = Employeer::with('rank')
                             ->select('id','id_member','first_name','last_name','username','rank_id','phone_number','expired_at');

            return Datatables::of($data)
                    ->addColumn('rank', function($data) {
                        return $data->rank ? $data->rank->name : '-';
                    })
                    ->addColumn('expired', function($data) {
                        return $data->expired_at ? Carbon::parse($data->expired_at)->format('Y-m-d') : 'No Data';
                    })
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('admin.report.membership');
    }
}
