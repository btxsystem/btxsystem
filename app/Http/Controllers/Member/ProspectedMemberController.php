<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use DB;

class ProspectedMemberController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        return view('frontend.prospected-member.index')->with('profile',$data);
    }
}
