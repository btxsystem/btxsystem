<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Role;
use App\User;
use DataTables;
use DB;
use Alert;

class ListVaController extends Controller
{
    public function __construct()
    {
        $this->middleware('backoffice');
    }
    public function index()
    {
        if (request()->ajax()) {
            $data = DB::table('transaction_bills')->join('employeers','employeers.id','=','transaction_bills.user_id')
                                                  ->select('employeers.username','transaction_bills.created_at','transaction_bills.inquiry_status','transaction_bills.id','transaction_bills.product_type','transaction_bills.customer_number','transaction_bills.total_amount')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('username', function($row) {
                        return isset($row->username) ? $row->username : $row['username'];
                    })
                    ->editColumn('description', function($row) {
                        return isset($row->product_type) ? $row->product_type : $row['product_type'];
                    })
                    ->editColumn('nominal', function($row) {
                        return isset($row->total_amount) ? $row->total_amount : $row['total_amount'];
                    })
                    ->editColumn('no_va', function($row) {
                        return isset($row->customer_number) ? 11210..$row->customer_number : $row['customer_number'];
                    })
                    ->editColumn('status', function($row) {
                        $status = '';
                        $day = isset($row->created_at) ? $row->created_at : $row['created_at'];
                        $date1 = str_replace('-', '/', $day);
                        $tomorrow = date('Y-m-d H:i:s',strtotime($date1 . "+1 days"));
                        if(isset($row['inquiry_status'])){
                            if ($row['inquiry_status'] == 00) {
                                $status = 'Success';
                            }elseif ($row['inquiry_status'] == 01) {
                                $status = 'Failed';
                            }elseif ($row['inquiry_status'] == 02) {
                                $status = 'Timeout';
                            }
                        }else{
                            if (now() >= $tomorrow) {
                                $status = 'Expired';
                            }else{
                                $status = 'Waiting transfer';
                            }
                        }
                        return $status;
                    })
                    ->editColumn('date', function($row) {
                        return isset($row->created_at) ? $row->created_at : $row['created_at'];
                    })
                    ->make(true);
        }
        return view('admin.list-va.index');
    }
}
