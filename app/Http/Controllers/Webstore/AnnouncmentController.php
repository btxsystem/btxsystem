<?php

namespace App\Http\Controllers\Webstore;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnnouncmentController extends Controller
{

    public function index() {
        return view('frontend.announcment');
    }
}
