<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Training;
use DataTables;
use App\Employeer;
use DB;

class VerificarionNpwpController extends Controller
{
    public function index(){
         if (request()->ajax()) {
           // $data = Employeer::where('verification', 0);
            $data = DB::table('employeers')->where('verification', 0)->orderBy('id','DESC');
            return Datatables::of($data)
                    ->addColumn('name', function($data) {
                        return $data->first_name.' '.$data->first_name;
                    })
                    ->addColumn('action', function($row) {
                        return "<a href='#detail' data-toggle='modal' onclick='verif(`$row->username`)' id='verif-button' class='btn btn-success fa fa-check'></a>";
                    })
                    ->rawColumns(['action'])
                    ->make(true);
         }
         return view('admin.verif-npwp.index');
    }

    public function store(Request $request){
        $data = Employeer::where('username',$request->username)->select('id')->first();
        $npwp['verification'] = 1;
        Employeer::find($data->id)->update($npwp);
    }
}
