<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employeer;
use DataTables;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function index(){
        if (request()->ajax()) {
            $data = DB::table('employeers')->join('ranks','employeers.rank_id','=','ranks.id')
                                           ->select('employeers.id_member','employeers.first_name',
                                                    'employeers.last_name','employeers.status','employeers.phone_number',
                                                    'ranks.name as rank')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('name', function($data) {
                        return $data->first_name.' '.$data->last_name;
                    })
                    ->editColumn('status', function($data) {
                        return $data->status == 1 ? 'Active' : 'Nonactive' ;
                    })
                    ->editColumn('hp', function($data) {
                        return $data->phone_number;
                    })
                    ->editColumn('rank', function($data) {
                        return $data->rank;
                    })
                    ->addColumn('action', function($row) {
                        return '<a class="btn btn-warning fa fa-edit"></a>
                                <a class="btn btn-danger fa fa-trash"></a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.members.index');
    }

    public function create(){
        return view('admin.members.create');
    }
}
