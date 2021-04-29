<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\HistoryBitrexPoints;
use DataTables;
use DB;
use App\Xendit;

class ListCcController extends Controller
{
    public function __construct()
    {
        $this->middleware('backoffice');
    }
    public function index()
    {
        if (request()->ajax()) {
            $data = Xendit::with('member')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('fullname', function($row) {
                        return  $row->member->first_name .' '.$row->member->last_name;
                    })
                    ->editColumn('username', function($row) {
                        return isset($row->member->username) ? $row->member->username : $row['member']['username'];
                    })
                    ->editColumn('nominal', function($row) {
                        return $row->status == 1 ? $row->nominal + $row->tax : $row->nominal;
                    })
                    ->editColumn('status', function($row) {
                        $status = '';
                        if($row->status == 1){
                            $status = 'Success';
                        }else if($row->status == 0){
                            $status = 'Failed';
                        }else{
                            $status = 'Pending';
                        }
                        return $status;
                    })
                    ->editColumn('date', function($row) {
                        return isset($row->created_at) ? $row->created_at : $row['created_at'];
                    })
                    ->make(true);
        }
        return view('admin.list-cc.index');
    }
}
