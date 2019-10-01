<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employeer;
use App\HistoryBitrexCash;
use Carbon\Carbon;
use DataTables;
use Alert;
use App\Exports\EmployeerExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;


class WithdrawalBonusController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Employeer::where('status', 1)
                                ->where('bitrex_cash','>', 1000)
                                ->whereDate('expired_at', '>=', now())
                                ->select('id as check','id','id_member','username','no_rec','bank_name','npwp_number',
                                        'first_name','last_name','rank_id','verification',
                                        'created_at','status','bitrex_cash','bitrex_points','expired_at'
                    );

                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('fullname', function($row){
                            return $row->first_name .' '.$row->last_name;
                        })
                        ->addColumn('cash', function($row){
                            return currency($row->bitrex_cash);
                        })
                        ->addColumn('bonusSponsor', function($row){
                            return currency($row->bonus_sponsor);
                        })
                        ->addColumn('bonusPairing', function($row){
                            return currency($row->bonus_pairing);
                        })
                        ->addColumn('bonusProfit', function($row){
                            return currency($row->bonus_profit);
                        })
                        ->addColumn('bonusReward', function($row){
                            return currency($row->bonus_reward);
                        })
                        ->addColumn('bonusTotal', function($row){
                            return currency($row->total_bonus);
                        })
                        ->addColumn('verificationStatus', function($row){
                            return $this->getVerificationStatus($row);
                        })
                        ->addColumn('check', '<input type="checkbox" name="member_checkbox[]" class="member_checkbox" value="{{$id}}" />')
                        ->rawColumns(['action','check'])
                        ->make(true);
            }

        return view('admin.withdrawal-bonus.index');
    }

    public function paidIndex(Request $request)
    {
        if (request()->ajax()) {

            if($request->from_date)
            {
                $data = HistoryBitrexCash::where('type', 5)->where('info', 0)
                ->whereBetween('created_at', [$request->from_date, $request->to_date])
                ->with(['member'  => function($query) {
                        $query->select(['id','id_member','username']);
                      }
                  ])
                ->select('id','id_member','nominal','description','info','type','created_at','info','type');
            }
            else {
                $data = HistoryBitrexCash::where('type', 5)->where('info', 0)
                ->with(['member'  => function($query) {
                    $query->select(['id','id_member','username']);
                  }
              ])
            ->select('id','id_member','nominal','description','info','type','created_at','info','type');
            }

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('amount', function($row){
                        return currency($row->nominal);
                    })
                    ->make(true);
        }

        return view('admin.withdrawal-bonus.paid');
    }

    function massPaid(Request $request)
    {
        DB::beginTransaction();
        try{

            $member_id_array = $request->input('id');
            $employeers = Employeer::whereIn('id', $member_id_array)->get();

            // Type 5 di table history_bitrex_cash untuk type withdraw
            foreach ($employeers as $key => $data) {
                DB::table('history_bitrex_cash')->insert([
                    'id_member' => $data->id, 
                    'nominal' => $data->bitrex_cash,
                    'description' => 'Manual Withdraw',
                    'info' => 0,
                    'type' => 5,
                    'created_at' => now()
                ]);


                $data->update([
                    'bitrex_cash' => 0
                ]);
            }
            DB::commit();
            Alert::success('Sukses Update Data', 'Sukses')->persistent("Close");
        }catch(\Exception $e){
                // throw $e;
                DB::rollback();
                
                Alert::error('Gagal Melakukan Update Data', 'Gagal')->persistent("Close");
        }

    }

    public function export()
    {
        return Excel::download(new EmployeerExport, now() .' ' .'withdrawal.xlsx');
    }

    public function getVerificationStatus($row)
    {
        switch($row->verification) {
            case 0;
            return '3.0%';
            break;

            case 1;
            return '2,5%';
            break;
        }
    }

}
