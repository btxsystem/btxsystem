<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Employeer;
use App\BitraxCashHistory;
use Illuminate\Http\Request;
use DataTables;
use Alert;
use DB;

class BitrexCashController extends Controller
{
    public function index(){
        if (request()->ajax()) {
            $data = Employeer::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('username', function($data) {
                        return $data->username;
                    })
                    ->editColumn('points', function($data){
                        return $data->bitrex_points;
                    })
                    ->addColumn('action', function($row) {
                        return '<a href="#detail" data-toggle="modal" class="btn btn-primary fa fa-eye" onclick="detail('.$row->id.')"></a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.bitrex-money.bitrex-cash.index');
    }

   
}
