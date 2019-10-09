<?php

namespace App\Exports;

use App\Models\TransactionMember;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransactionExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return ModelsTransactionMember::all();
    // }

    public function view(): View
    {
        return view('admin.report.excel', [
            'data' => TransactionMember::where('status', 1)
                    ->whereNotNull('transaction_ref')
                    ->with(['ebook' => function($query) {
                                        $query->select(['id','title','price']);
                                    },   
                            'member.address' => function($query) {
                                        $query->select(['id','province','city_name','subdistrict_name','decription','user_id', 'kurir', 'cost']);
                                    },  
                            'member' => function($query) {
                                        $query->select(['id','id_member','username','first_name','last_name','phone_number']);
                                    }
                        ])
                ->select('transaction_member.*')
                ->orderBy('transaction_member.created_at','desc')->get()
        ]);
    }
}
