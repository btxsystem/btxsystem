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

            return view('admin.members.excel', [
                'datas' => Employeer::whereBetween('created_at', [$this->from, $this->to])->get()
            ]);
        } else {
            return view('admin.members.excel', [
                'datas' => Employeer::cursor()
            ]);
        } 
        
    }



}
