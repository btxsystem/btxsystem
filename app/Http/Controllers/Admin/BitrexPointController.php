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
            $data = Employeer::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('username', function($data) {
                        return $data->username;
                    })
                    ->editColumn('points', function($data){
                        return $data->bitrex_points;
                    })
                    ->addColumn('action', function($row) {
                        return '<a href="#detail" data-toggle="modal" class="btn btn-primary fa fa-eye" onclick="detail('.$row->id.')"></a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.bitrex-money.bitrex-points.index');
    }

    public function topup(Request $request){
        $points_member = DB::table('employeers')->select('bitrex_points')->where('id','=',$request['name'])->first();
        $points = $request['nominal'] / 1000;
        $add_points['bitrex_points'] = $points_member->bitrex_points + $points;
        $data = [
            'id_member' => $request['name'],
            'nominal' => $request['nominal'],
            'points' => $points,
            'description' => $request['description']
        ];
        HistoryBitrexPoints::create($data);
        Employeer::findOrFail($request['name'])->update($add_points);
        Alert::success('Success topup', 'Success');
        return redirect()->route('admin.bitrex-money.points');
    }
}
