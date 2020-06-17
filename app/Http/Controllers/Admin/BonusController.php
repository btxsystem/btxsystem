<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HistoryBitrexCash;
use App\Employeer;
use DataTables;
use DB;
use Alert;
use App\Service\NotificationService;
use App\Models\HistoryActivePeriodeEbook;

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

    public function timeReward(Request $request)
    {
        if (request()->ajax()) {
            $data = HistoryActivePeriodeEbook::with([
                'member',
                'admin',
                'ebook'
            ]);

            if($request->input('member')) {
                $data->where('member_id', $request->input('member'));
            }

            return Datatables::of($data->get())
                    ->addColumn('username', function($data) {
                        return $data->member ? $data->member->username : 'No Data';
                    })
                    ->editColumn('total_duration', function($data) {
                        return $data->total_duration . ' days';
                    })
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('admin.bonus.time-reward');
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
        foreach ($request->member as $key => $member) {
            $data = [
                'id_member' => $member,
                'nominal' => $request->nominal,
                'description' => $request->description,
                'info' => 1,
                'type' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ];
            $bitrex_cash = DB::table('employeers')->where('id', $member)->select('bitrex_cash')->first();
            $bitrex['bitrex_cash'] = $bitrex_cash->bitrex_cash+$request->nominal;
            if ($request->type == 0) {
                try {
                    DB::beginTransaction();
                    HistoryBitrexCash::insert($data);
                    Employeer::find($member)->update($bitrex);
                    DB::commit();
                    Alert::success('Gift Event and promotion success', 'Success')->persistent("OK");
                } catch (\Exception $e) {
                    DB::rollback();
                    Alert::error('Something wrong', 'Error')->persistent("OK");
                }
            }else {
                HistoryBitrexCash::insert($data);
                Alert::success('Gift Event and promotion success', 'Success')->persistent("OK");
            }
        }
        return redirect()->route('bonus.event-and-promotion.index');
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
