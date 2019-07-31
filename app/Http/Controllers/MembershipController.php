<<<<<<< HEAD
<?php 

=======
<?php
>>>>>>> d5469acad6803f96e5a6e9d33d0db5ee3f9ee402
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employeer;
use DB;

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

    
    public function select(Request $request){
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('employeers')->select('id', 'first_name')->where('first_name', 'LIKE', '%$cari%')->get();
            return response()->json($data);
        }
    }
}
