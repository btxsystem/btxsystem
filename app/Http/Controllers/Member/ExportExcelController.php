<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Excel;
use App\Exports\ExportAllMember;
use App\Exports\TrxMember;

class ExportExcelController extends Controller
{
    public function index()
    {
        return Excel::download(new ExportAllMember, now() .' ' .'emplooyers.xlsx');
    }

    public function transaction()
    {
        return Excel::download(new TrxMember, now() .' ' .'transaction-emplooyers.xlsx');
    }


}
