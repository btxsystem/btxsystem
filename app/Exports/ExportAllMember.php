<?php

namespace App\Exports;

use App\Employeer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportAllMember implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
        return view('frontend.team-report.export_member', [
            'datas' => Employeer::all()
        ]);
    }
}
