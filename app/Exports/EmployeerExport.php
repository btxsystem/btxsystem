<?php

namespace App\Exports;

use App\Employeer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeerExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employeer::where('status', 1)
        ->where('bitrex_cash','>', 1000)
        ->whereDate('expired_at', '>=', now())
        ->select('id_member','first_name','last_name','username','no_rec','bank_account_name','bank_name','npwp_number','bitrex_cash')->get();
    }

    public function headings(): array
    {
        return [
            'ID Member',
            'First Name',
            'Last Name',
            'Username',
            'Rek',
            'Acount Bank Name',
            'Bank Name',
            'NPWP',
            'Amount'
        ];
    }
}
