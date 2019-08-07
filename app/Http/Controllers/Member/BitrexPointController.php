<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BitrexPointController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        dd('aaa');
        return view('frontend.bitrex-money.bitrex-points')->with('profile',$data);
    }
}
