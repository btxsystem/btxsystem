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
                                           ->select('employeers.id','employeers.id_member','employeers.first_name',
                                                    'employeers.last_name','employeers.status','employeers.phone_number',
                                                    'ranks.name as rank')->where('status','=',1)->get();
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
                        return '<a class="btn btn-primary fa fa-eye" title="detail"></a>
                                <a href="active/'.$row->id.'/nonactive" class="btn btn-danger fa fa-power-off" title="nonactive"></a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.members.index');
    }

    public function create(){
        return view('admin.members.create');
    }

    public function nonactive($id){
        $data['status'] = 0;
        Employeer::findOrFail($id)->update($data);
        return redirect()->back(); 
    }
}
