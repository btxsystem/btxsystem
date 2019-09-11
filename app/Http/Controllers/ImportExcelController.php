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
        $path = $request->file('file');
        $datas = $path->get();
        foreach ($datas->toArray() as $key => $data) {
            print($data->id_job_seeker.'</br>');
            if ($key==100) {
                return 0;
            }  
        }
        //dd($datas);
	}
}