<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Excel;
use App\Exports\ExportAllMember;
use App\Employeer;

class ExportExcelController extends Controller
{
    public function index()
    {
        return Excel::download(new ExportAllMember, now() .' ' .'emplooyers.xlsx');
    }


}
