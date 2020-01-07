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
            $to_date = date('Y-m-d',strtotime($request->to_date . "+1 days"));
            $data = TransactionMember::where('status', 1)
                                 ->whereNotNull('transaction_ref')
                                //  ->whereDate('created_at', '>=', '2019-09-19')
                                 ->whereBetween('created_at', [$request->from_date, $to_date])
                                 ->with(['ebook' => function($query) {
                                                        $query->select(['id','title','price']);
                                                    },
                                        'member.address' => function($query) {
                                                        $query->select(['id','province','city_name','subdistrict_name','decription','user_id', 'kurir', 'cost']);
                                                    },
                                        'member' => function($query) {
                                                        $query->select(['id','id_member','username','first_name','last_name']);
                                                    }
                                        ])
                                ->select('transaction_member.*')
                                ->orderBy('transaction_member.created_at','desc')->get();
            } else {
                $data = TransactionMember::where('status','=', 1)
                                // ->whereDate('created_at', '>=', '2019-09-19')
                                ->whereNotNull('transaction_ref')
                                ->with(['ebook' => function($query) {
                                                    $query->select(['id','title','price']);
                                                },
                                        'member.address' => function($query) {
                                                    $query->select(['id','province','city_name','subdistrict_name','decription','user_id', 'kurir', 'cost']);
                                                },
                                        'member' => function($query) {
                                                    $query->select(['id','id_member','username','first_name','last_name']);
                                                }
                                    ])
                            ->select('transaction_member.*')
                            ->orderBy('transaction_member.created_at','desc')->get();
            }

            return Datatables::of($data)
                                ->addIndexColumn()
                                ->editColumn('starterpackType', function($data){
                                    return $data->member->address ? 'Shipping' : 'Take Away';
                                })
                                ->editColumn('shippingCost', function($data){
                                    return $data->member->address ? $data->member->address->cost : 'Take Away';
                                })
                                ->make(true);
        }
            return view('admin.report.transaction');
    }

    public function export(Request $request)
    {
        $to_date = date('Y-m-d',strtotime($request->to_date . "+1 days"));
        return Excel::download(new TransactionExport($request->from, $to_date), now() .' ' .'transaction.xlsx');

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

    public function birthdate()
    {
            if (request()->ajax()) {
                $now = strtotime(now());
            $now = date('m-d',$now);
            $to_date = strtotime(now(). "+2 days");
            $to_date = date('m-d',$to_date);
            $datas = Employeer::all();
            $data = [];
            foreach ($datas as $key => $value) {
                $birth_date = strtotime($value->birthdate);
                $birth_date = date('m-d',$birth_date);
                if ( $birth_date >= $now and $birth_date<=$to_date) {
                    $data[$key]=$value;
                }
            }
            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('id_member', function($row){
                                return $row->id_member;
                            })
                            ->addColumn('username', function($row){
                                return $row->username;
                            })
                            ->addColumn('name', function($row){
                                return ucwords(strtolower($row->first_name.' '.$row->last_name));
                            })
                            ->addColumn('email', function($row){
                                return $row->email;
                            })
                            ->addColumn('birthdate', function($row){
                                return date('d-m-Y',strtotime($row->birthdate));
                            })
                            ->make(true);
        }
        return view('admin.report.birthdate');
    }
}
