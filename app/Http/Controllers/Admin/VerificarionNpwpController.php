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
            $data = DB::table('employeers')->orderBy('id','DESC');
            return Datatables::of($data)
                    ->addColumn('name', function($data) {
                        return $data->first_name.' '.$data->first_name;
                    })
                    ->addColumn('status_verification', function($data) {
                        return $data->verification == 0 ? '<span class="label label-danger">Unvefified</span>' : '<span class="label label-success">Vefified</span>';
                    })
                    ->addColumn('action', function($row) {
                        if($row->verification == 0) {
                            $action = \Auth::guard('admin')->user()->hasPermission('Verification_npwp.verification') ? "<a href='#detail' data-toggle='modal' onclick='verif(`$row->username`)' id='verif-button' class='btn btn-success fa fa-check'></a>" : "";
                        } else {
                            $action = \Auth::guard('admin')->user()->hasPermission('Verification_npwp.verification') ? "<a href='#detail-unvefification' data-toggle='modal' onclick='unverif(`$row->username`)' id='verif-button' class='btn btn-danger fa fa-close'></a>" : "";
                        }
                        return $action;
                    })
                    ->rawColumns(['action', 'status_verification'])
                    ->make(true);
         }
         return view('admin.verif-npwp.index');
    }

    public function store(Request $request){
        $data = Employeer::where('username',$request->username)->select('id')->first();
        $npwp['verification'] = 1;
        Employeer::find($data->id)->update($npwp);
    }

    public function unverified(Request $request){
        $data = Employeer::where('username',$request->username)->select('id')->first();
        $npwp['verification'] = 0;
        Employeer::find($data->id)->update($npwp);
    }
}
