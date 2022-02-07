<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Excel;
use App\Exports\ExportAllMember;

class ExportExcelController extends Controller
{
    public function index()
    {
        return Excel::download(new ExportAllMember, now() .' ' .'emplooyers.xlsx');
    }


}
