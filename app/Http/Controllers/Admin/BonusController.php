<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HistoryBitrexCash;
use App\Employeer;
use DataTables;

class BonusController extends Controller
{
    public function bonusSponsor()
    {
        if (request()->ajax()) {
            $data = HistoryBitrexCash::with('member')->where('type', 0)->select('history_bitrex_cash.*');
           
            return Datatables::of($data)
                    ->addColumn('username', function($data) {
                        return $data->member ? $data->member->username : 'No Data';
                    })
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('admin.bonus.sponsor');
    }

    public function bonusPairing()
    {
        if (request()->ajax()) {
            $data = HistoryBitrexCash::with('member')->where('type', 1)->select('history_bitrex_cash.*');
           
            return Datatables::of($data)
                    ->addColumn('username', function($data) {
                        return $data->member ? $data->member->username : 'No Data';
                    })
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('admin.bonus.pairing');
    }

    public function bonusProfit()
    {
        if (request()->ajax()) {
            $data = HistoryBitrexCash::with('member')->where('type', 2)->select('history_bitrex_cash.*');
           
            return Datatables::of($data)
                    ->addColumn('username', function($data) {
                        return $data->member ? $data->member->username : 'No Data';
                    })
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('admin.bonus.profit');
    }

    public function bonusReward()
    {
        if (request()->ajax()) {
            $data = HistoryBitrexCash::with('member')->where('type', 3)->select('history_bitrex_cash.*');
           
            return Datatables::of($data)
                    ->addColumn('username', function($data) {
                        return $data->member ? $data->member->username : 'No Data';
                    })
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('admin.bonus.reward');
    }

    public function general()
    {
        if (request()->ajax()) {
                    $data = Employeer::orderBy('id','desc')->get();
                    return   Datatables::of($data)
                                ->addIndexColumn()
                                ->make(true);
            }
        return view('admin.bonus.general');
    }




}
