<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\HistoryBitrexPoints;
use DataTables;
use DB;

class ListCcController extends Controller
{
    public function __construct()
    {
        $this->middleware('backoffice');
    }
    public function index()
    {
        if (request()->ajax()) {
            $data = HistoryBitrexPoints::with('member')
                                        ->where('description', 'Topup Bitrex Point Via Credit Card')
                                        ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('fullname', function($row) {
                        return  $row->member->first_name .' '.$row->member->last_name;
                    })
                    ->editColumn('username', function($row) {
                        return isset($row->member->username) ? $row->member->username : $row['member']['username'];
                    })
                    ->editColumn('status', function($row) {
                        $status = '';
                        if($row->status == 1){
                            $status = 'Success';
                        }else{
                            $status = 'Failed';
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
