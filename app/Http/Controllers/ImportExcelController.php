<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use App\Employeer;
 
use Session;

use App\Imports\EmployeerImport;
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
}