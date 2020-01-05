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

    private $from;
    private $to;

    public function __construct($from, $to)
    {
         $this->from = $from;
         $this->to = $to;
    }

    public function view(): View
    {
        if(isset($this->from)) {
            return view('admin.report.excel', [
                'data' => TransactionMember::where('status', 1)
                        ->whereNotNull('transaction_ref')
                        ->whereBetween('created_at', [$this->from, $this->to])
                        ->with(['ebook' => function($data) {
                                            $data->select(['id','title','price']);
                                        },   
                                'member.address' => function($data) {
                                            $data->select(['id','province','city_name','subdistrict_name','decription','user_id', 'kurir', 'cost']);
                                        },  
                                'member' => function($data) {
                                            $data->select(['id','id_member','username','first_name','last_name','phone_number']);
                                        }
                            ])
                    ->select('transaction_member.*')
                    ->orderBy('transaction_member.created_at','desc')->get()
            ]);
        } else {
            return view('admin.report.excel', [
                'data' => TransactionMember::where('status', 1)
                        ->whereNotNull('transaction_ref')
                        ->with(['ebook' => function($data) {
                                            $data->select(['id','title','price']);
                                        },   
                                'member.address' => function($data) {
                                            $data->select(['id','province','city_name','subdistrict_name','decription','user_id', 'kurir', 'cost']);
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
}
