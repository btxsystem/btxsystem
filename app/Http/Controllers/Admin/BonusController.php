<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HistoryBitrexCash;
use App\Employeer;
use DataTables;
use DB;

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

    public function event(){
        if (request()->ajax()) {
            $data = DB::table('history_bitrex_cash')->join('employeers','employeers.id','=','history_bitrex_cash.id_member')
                                                ->where('type',4)->select('employeers.username as username','history_bitrex_cash.description','history_bitrex_cash.nominal','history_bitrex_cash.created_at')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('admin.bonus.event-and-promotion.index');
    }

    public function giftEvent(){
        return view('admin.bonus.event-and-promotion.gift-event');
    }

    public function postEvent(Request $request){
        dd($request);
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
                    // $data = HistoryBitrexCash::orderBy('id','desc')->select('history_bitrex_cash.*');
                    $data = Employeer::query();


                    return   Datatables::of($data)
                                ->addIndexColumn()
                                ->make(true);
            }
        return view('admin.bonus.general');
    }
    // public function general(Request $request)
    // {
    //     if (request()->ajax()) {

    //         $page = ($request->start > 0) ? (($request->start+$request->length)/$request->length) : 1;

    //         $model = Employeer::orderBy('id','desc');
    //         $filter = $model->filter($request);
    //         $object = $filter->paginate($request->length, ['*'], 'page', $page);
    //         $datas = $object->toArray();
            
    //         $datas['req'] = $request->all();
    //         $datas['draw'] = (int)$request->draw;
    //         $datas['recordsTotal'] = $model->count();
    //         $datas['recordsFiltered'] = $object->total();
            
    //         $datas['data'] = $object->map(function($item, $index) use($object) {
    //             $item->iteration = ($index + 1) + ($object->perPage() * ($object->currentPage() - 1));
    //             return $item;
    //         });

    //         return $datas;

    //     }
    //     return view('admin.bonus.general');
    // }




}
