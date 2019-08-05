<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Employeer;
use App\HistoryBitraxCash;
use Illuminate\Http\Request;
use DataTables;
use Alert;
use DB;

class BitrexCashController extends Controller
{
    public function index(){
        if (request()->ajax()) {
            $data = DB::table('employeers')->select('id','id_member','username','bitrex_points');
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

    public function detail($id){
        if (request()->ajax()) {
            $data = DB::table('history_bitrex_cash')->select('id','id_member', 'nominal','description', 'created_at')->where('id_member',$id);
            return Datatables::of($data)
            ->addIndexColumn()         
            ->editColumn('nominal', function($data){
                return number_format($data->nominal, 0);
            })
            ->editColumn('created_at', function($data){
                return date('d-m-Y', strtotime($data->created_at));
            })  
            ->make(true);
        }
    }

   
}
