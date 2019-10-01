<?php

namespace App\Exports;

use App\Employeer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EmployeerExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
        return view('admin.withdrawal-bonus.excel', [
            'datas' => Employeer::where('status', 1)
                                ->whereDate('expired_at', '>=', now())
                                ->select('id as check','id','id_member','username','no_rec','bank_name','bank_account_name','npwp_number',
                                        'first_name','last_name','rank_id','verification',
                                        'created_at','status','bitrex_cash','bitrex_points','expired_at'
                        )->get()->filter(function($data) {
                            return $data->total_bonus > 10000;
                        })
        ]);
    }


    // public function collection()
    // {
    //     return Employeer::where('status', 1)
    //             ->whereDate('expired_at', '>=', now())
    //             ->select('id as check','id','id_member','username','no_rec','bank_name','npwp_number',
    //                     'first_name','last_name','rank_id','verification',
    //                     'created_at','status','bitrex_cash','bitrex_points','expired_at','total_bonus'
    //     )->get()->filter(function($data) {
    //         return $data->total_bonus > 10000;
    //     });
    // }

    // public function headings(): array
    // {
    //     return [
    //         'ID Member',
    //         'First Name',
    //         'Last Name',
    //         'Username',
    //         'Rek',
    //         'Acount Bank Name',
    //         'Bank Name',
    //         'NPWP',
    //         'Amount'
    //     ];
    // }
}
