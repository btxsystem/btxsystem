<?php

namespace App\Http\Controllers\Admin;

use Auth;

class HomeController
{
    public function index()
    {
        // dd(Auth::guard('admin')->check());
        return view('admin.home');
    }
}
