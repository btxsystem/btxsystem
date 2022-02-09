<?php

namespace App\Exports;

use App\Employeer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\TransactionMember;

class TrxMember implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
        return view('frontend.team-report.export_transaction', [
            'datas' => TransactionMember::where('status', 1)
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
            ->orderBy('transaction_member.created_at','desc')->get()
        ]);
    }
}
