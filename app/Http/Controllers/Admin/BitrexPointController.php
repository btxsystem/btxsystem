<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Employeer;
use App\HistoryBitrexPoints;
use Illuminate\Http\Request;
use DataTables;
use Alert;
use DB;

class BitrexPointController extends Controller
{
    public function index(){
        if (request()->ajax()) {
            $data = DB::table('employeers')->select('id','id_member','username','bitrex_points');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('username', function($data) {
                        return $data->username;
                    })
                    ->editColumn('points', function($data){
                        return $data->bitrex_points;
                    })
                    ->addColumn('action', function($row) {
                        $detail = \Auth::guard('admin')->user()->hasPermission('Bitrex-money.bitrex-points.detail') ? '<a href="#detail" data-toggle="modal" class="btn btn-primary fa fa-eye" onclick="detail('.$row->id.')"></a>' : '';
                        return $detail;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.bitrex-money.bitrex-points.index');
    }

    // public function topup(Request $request)
    // {
    //     $points_member = DB::table('employeers')->select('bitrex_points')->where('id','=',$request['name'])->first();

    //     $points = $request['nominal'] / 1000;
    //     $add_points['bitrex_points'] = $points_member->bitrex_points + $points;
    //     $data = [
    //         'id_member' => $request['name'],
    //         'nominal' => $request['nominal'],
    //         'points' => $points,
    //         'description' => $request['description'],
    //         'info' => 1
    //     ];

    //     HistoryBitrexPoints::create($data);
    //     Employeer::findOrFail($request['name'])->update($add_points);
    //     Alert::success('Success topup', 'Success');
    //     return redirect()->route('admin.bitrex-money.points');
    // }

    public function topup(Request $request)
    {
        DB::beginTransaction();
        try{
            $point = $request->nominal / 1000;
            $member = Employeer::where('id', $request->name)->first();
            $member->update([
                'bitrex_points' => $member->bitrex_points + $point
            ]);

            $topup = new HistoryBitrexPoints;
            $topup->id_member = $request->name;
            $topup->nominal = $request->nominal;
            $topup->points = $point;
            $topup->description = $request->description;
            $topup->info = 1;
            $topup->save();


            DB::commit();

            Alert::success('Sukses Melakukan Topup', 'Sukses');
            return redirect()->route('bitrex-money.points');

        }catch(\Exception $e){
            throw $e;
            DB::rollback();

            Alert::error('Gagal Melakukan Topup', 'Gagal');
            // return \redirect()->back();
        }
    }

    public function detail($id){
        if (request()->ajax()) {
            $data = DB::table('history_bitrex_point')->select('id','nominal','points','description','created_at')->where('id_member','=',$id)->where('status',1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('transaction_date', function($data){
                        return $data->created_at;
                    })
                    ->make(true);
        }
    }

    public function getUsername($id){
        $tags = DB::table('employeers')->select('id_member','username')->where('id','=',$id)->get()->first();
        $formatted_tags[] = ['id' => $tags->id_member, 'text' => $tags->username];
        return \Response::json($formatted_tags[0]);
    }
}
