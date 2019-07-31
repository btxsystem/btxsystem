<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Employeer;
use Illuminate\Http\Request;
use DataTables;
use Alert;

class BitrexPointController extends Controller
{
    public function index(){
        if (request()->ajax()) {
            $data = Employeer::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('name', function($data) {
                        return $data->first_name.' '.$data->last_name;
                    })
                    ->editColumn('points', function($data){
                        return $data->bitrex_points;
                    })
                    ->addColumn('action', function($row) {
                        return '<a class="btn btn-primary fa fa-eye"></a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.bitrex-money.bitrex-points.index');
    }

    public function topup(){
        return view('admin.bitrex-money.bitrex-points.index');
    }
}
