<?php

namespace App\Exports;

use App\Employeer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class MembersExport implements FromView
{
  
    public function view(): View
    {

        return view('admin.members.excel', [
            'datas' => Employeer::cursor()
        ]);
    }



}
