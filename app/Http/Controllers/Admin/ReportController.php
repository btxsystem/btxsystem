<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TransactionMember;
use App\Exports\TransactionExport;
use App\Employeer;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;
use Alert;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function transactionMember()
    {
        if (request()->ajax()) {
            $data = TransactionMember::with('member','ebook')->where('status', 1)->select('transaction_member.*');
           
            return Datatables::of($data)
                    ->addColumn('product', function ($data){
                        return $data->ebook ? $data->ebook->title : 'No Data';
                    })
                    ->addColumn('username', function ($data) {
                        return $data->member ? $data->member->username : 'No Data';
                      })
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('admin.report.transaction-member');
    }

    public function membership()
    {
        if (request()->ajax()) {
            $data = Employeer::with('rank')
                             ->select('id','id_member','first_name','last_name','username','rank_id','phone_number','expired_at');

            return Datatables::of($data)
                    ->addColumn('rank', function($data) {
                        return $data->rank ? $data->rank->name : '-';
                    })
                    ->addColumn('expired', function($data) {
                        return $data->expired_at ? Carbon::parse($data->expired_at)->format('Y-m-d') : 'No Data';
                    })
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('admin.report.membership');
    }

    public function transaction(Request $request)
    {
        if (request()->ajax()) {
            if($request->from_date) {
            $data = TransactionMember::where('status', 1)
                                 ->whereNotNull('transaction_ref')                                                                  
                                 ->whereBetween('created_at', [$request->from_date, $request->to_date])
                                 ->with(['ebook' => function($query) {
                                                        $query->select(['id','title','price']);
                                                    },   
                                        'member.address' => function($query) {
                                                        $query->select(['id','province','city_name','subdistrict_name','user_id']);
                                                    },  
                                        'member' => function($query) {
                                                        $query->select(['id','id_member','username']);
                                                    }
                                        ])
                                ->select('transaction_member.*')
                                ->orderBy('transaction_member.created_at','desc');
            } else {
                $data = TransactionMember::where('status', 1)
                                ->whereNotNull('transaction_ref')
                                ->with(['ebook' => function($query) {
                                                    $query->select(['id','title','price']);
                                                },   
                                    'member.address' => function($query) {
                                                    $query->select(['id','province','city_name','subdistrict_name','user_id']);
                                                },  
                                    'member' => function($query) {
                                                    $query->select(['id','id_member','username']);
                                                }
                                    ])
                            ->select('transaction_member.*')
                            ->orderBy('transaction_member.created_at','desc');
            }

            return Datatables::of($data)
                                ->addIndexColumn()
                                ->addColumn('starterpackType', function($data){
                                    return $data->member->address ? 'Shipping' : 'Take Away';
                                })
                                ->make(true);
        }
            return view('admin.report.transaction');
    }

    public function export()
    {   
        return Excel::download(new TransactionExport, now() .' ' .'transaction.xlsx');

    }
    // public function transaction()
    // {
    //     $data = Employeer::with(['address' => function ($query) {
    //                             $query->select('user_id','province','city_name','subdistrict_name','decription');
    //                 },
    //     'ebooks' => function ($query) {
    //         $query->select('ebooks.id','title');
    //     }])->whereHas('ebooks')->select('id','username','id_member')->limit(20)->get();

    //     return $data;
    // }
}
