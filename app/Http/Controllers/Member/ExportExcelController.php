<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Excel;
use App\Exports\ExportAllMember;
use App\Models\TransactionMember;

class ExportExcelController extends Controller
{
    public function index()
    {
        return Excel::download(new ExportAllMember, now() .' ' .'emplooyers.xlsx');
    }

    public function transaction()
    {
        $trx = TransactionMember::where('status', 1)
            ->whereNotNull('transaction_ref')
            ->whereYear('created_at', '=', 2021)
            ->with(['ebook' => function($data) {
                                $data->select(['id','title','price']);
                            },
                    'member' => function($data) {
                                $data->select(['id','id_member','username','first_name','last_name','phone_number']);
                            }
                ])
        ->select('transaction_member.*')
        ->orderBy('transaction_member.created_at','desc')->get();
        return Excel::download($trx, now() .' ' .'emplooyers.xlsx');
    }


}
