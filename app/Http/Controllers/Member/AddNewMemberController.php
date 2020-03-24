<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\HistoryBitrexCash;
use DataTables;
use DB;

class AddNewMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!\Auth::user()) {
                return redirect('/');
            }
            return $next($request);
        });
    }
    
    public function index()
    {
        $data = Auth::user();
        return view('frontend.add-member.index')->with('profile',$data);
    }
}
