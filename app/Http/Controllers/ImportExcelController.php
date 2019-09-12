<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use App\Employeer;
 
use Session;

use App\Imports\EmployeerImport;
use App\Imports\TreeImport;
use Excel;
use App\Http\Controllers\Controller;
 
class ImportExcelController extends Controller
{
    public function index(){
        return view('admin.importExcel');
    }

	public function import_excel(Request $request) 
	{
        if ($request->hasFile('file')) {
            $file = $request->file('file'); //GET FILE
            Excel::import(new EmployeerImport, $file); //IMPORT FILE 
            return redirect()->back();
        } 
    }
    
    public function import_tree(Request $request){
        $datas = Excel::toArray(new TreeImport, request()->file('file'))[0];
        $val = [];
        foreach ($datas as $key => $data) {
            $user[$key] = Employeer::where('id_member',$data['userid'])->select('id')->first();
            $upline[$key] = Employeer::where('id_member',$data['uplineid'])->select('id','username')->first();
           // dd($user);
           if ($key==10) {
               break;
           }
        }
        dd($upline); 
    }
}