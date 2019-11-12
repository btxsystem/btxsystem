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
    public function __construct()
    {
        $this->middleware('backoffice');
    }
    public function index(){
        if (request()->ajax()) {
            $data = DB::table('employeers')->select('id','id_member','username','bitrex_points','bitrex_cash');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('username', function($data) {
                        return $data->username;
                    })
                    ->editColumn('saldo', function($data){
                        return currency($data->bitrex_cash);
                    })
                    ->addColumn('action', function($row) {
                        $detail = \Auth::guard('admin')->user()->hasPermission('Bitrex-money.bitrex-value.detail') ? '<a href="#detail" data-toggle="modal" class="btn btn-primary fa fa-eye" onclick="detail('.$row->id.')"></a>' : '';
                        return $detail;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.bitrex-money.bitrex-cash.index');
    }

    public function detail(Request $request, $id){
        if (request()->ajax()) {
            if($request->from_date)
            {
                $data = DB::table('history_bitrex_cash')->whereBetween('created_at', [$request->from_date, $request->to_date])->select('id','id_member', 'nominal','description', 'created_at')->where('id_member','=',$id);
            }
            else {
                $data = DB::table('history_bitrex_cash')->select('id','id_member', 'nominal','description', 'created_at')->where('id_member','=',$id);
            }
            // $data = DB::table('history_bitrex_cash')->select('id','id_member', 'nominal','description', 'created_at')->where('id_member',$id);
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
