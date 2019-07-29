<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Membership;

class MembershipController extends Controller
{
    public function index(){
        $child = Membership::nested()->renderAsJson();
        dd($child);
    } 

    public function tree(){
    	return view('admin.tree.index');
    }
}
