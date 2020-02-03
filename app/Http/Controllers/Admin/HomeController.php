<?php

namespace App\Http\Controllers\Admin;

use Auth;

class HomeController
{

    public function index()
    {
        return view('admin.home');
    }
}
