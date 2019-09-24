<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employeer;
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
                        ->addColumn('verificationStatus', function($row){
                            return $this->getVerificationStatus($row);
                        })
                        ->addColumn('check', '<input type="checkbox" name="member_checkbox[]" class="member_checkbox" value="{{$id}}" />')
                        ->addColumn('action', function($row) {
                            return $this->htmlAction($row);
                        })
                        ->rawColumns(['action','check'])
                        ->make(true);
            }

        return view('admin.withdrawal-bonus.index');
    }

    public function htmlAction($row)
    {
            return '<a data-id="'.$row->id.'"  class="btn btn-success fa fa-eye show-testimonial" title="Show Payment"></a>
                    <a data-id="'.$row->id.' "class="btn btn-default fa fa-check approve-payment" style="background-color: #b85ebd; color: #ffffff;" title="Approve Payment"></a>';

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

    // public function export()
    // {
    //     return Excel::create('products_' . date('d_m_Y'), function($excel) {
    //         $excel->sheet('Sheet 1', function($sheet) {

    //             ini_set('max_execution_time', 1800);
    //             $data = Employeer::where('status', 1)
    //                     ->where('bitrex_cash','>', 1000)
    //                     ->whereDate('expired_at', '>=', now())
    //                     ->select('id as check','id','id_member','username','no_rec','bank_name','npwp_number',
    //                             'first_name','last_name','rank_id',
    //                             'created_at','status','bitrex_cash','bitrex_points','expired_at')->get();

    //             // $model = $models->map(function ($model){
    //             //     return $model->only(['id','name','code','unit_name','quantity_available','stocks']);
    //             // });

    //             $sheet->loadView('admin.withdrawal-bonus.excel', [
    //                 'data' => $data
    //             ]);

    //         });
    //     })->export('xls');
    // }
    public function export()
    {
        return Excel::download(new EmployeerExport, 'employeers.xlsx');
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
