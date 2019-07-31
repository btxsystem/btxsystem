<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employeer;

class MembershipController extends Controller
{
    public function index(){
      $child = Employeer::nested()->get();
      // dd($child);
    	return response()->json($child);
    } 

    public function tree(){
    	$child = Employeer::nested()->get();
    	return view('admin.tree.index', compact('child'));
    }
}
