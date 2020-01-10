<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\HistoryPv;
use DataTables;
use DB;
use Carbon\Carbon;
use App\Employeer;
use App\Downline;
use App\Models\GotReward;

class TeamReportController extends Controller
{
    public function mySponsor(){
        $data = Auth::user();
        if (request()->ajax()) {
            $data = DB::table('employeers')->where('sponsor_id',Auth::id())->select('username','first_name','last_name', 'phone_number')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('name', function($data) {
                        return $data->first_name.' '.$data->last_name;
                    })
                    ->editColumn('number_phone', function($data) {
                        return $data->phone_number;
                    })
                    ->make(true);
        }
        return view('frontend.team-report.my-sponsor.index')->with('profile',$data);
    }

    public function myAnalizer()
    {
        $ranks = DB::table('ranks')->select('id','name')->get();
        $profile = Auth::user();


        if (request()->ajax()) {
        $downline = Downline::select('downline')->where('member_id', Auth::user()->id)->first();


        $arrayDownnline = explode(",",$downline->downline);

        $data = DB::table('employeers')
                    ->where('status','=', 1)
                    ->whereIn('employeers.id', $arrayDownnline)
                    ->leftJoin('ranks','employeers.rank_id','=','ranks.id')
                    ->leftJoin('pv_rank','employeers.id','=','pv_rank.id_member')
                    ->select('employeers.id','employeers.parent_id','employeers.username',
                             'employeers.first_name','employeers.last_name', 'employeers.created_at',
                             'employeers.rank_id as rank_id','ranks.name as ranking',
                             'pv_rank.pv_left as pv_left','pv_rank.pv_midle as pv_middle',
                             'pv_rank.pv_right as pv_right')->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('ranking', function($data) {
                    return $data->rank_id ? $data->ranking : '-';
                })
                ->editColumn('pv_left', function($data) {
                    return $data->pv_left ? $data->pv_left : '0';
                })
                ->editColumn('full_name', function($data) {
                    return $data->first_name .' '. $data->last_name;
                })
                ->editColumn('created_at', function($data) {
                    $date=date_create($data->created_at);
                    return date_format($date,"d M Y");
                })
                ->editColumn('archive_rank', function($data) {
                    if ($data->rank_id=='' || !isset($data->rank_id) || $data->rank_id==null) {
                        return '-';
                    }else{
                        $archive = GotReward::where('member_id', $data->id)->orderByDesc('id')->first();
                        return date_format($archive->created_at,"d M Y");
                    }
                })
                ->editColumn('pv_middle', function($data) {
                    return $data->pv_middle ? $data->pv_middle : '0';
                })
                ->editColumn('pv_right', function($data) {
                    return $data->pv_right ? $data->pv_right : '0';
                })
                ->editColumn('username', function($data) {
                    return '<a href="#" data-id="'.$data->username.'" class="direct_tree"><p>'.$data->username.'</p></a>';
                })
                ->rawColumns(['username'])
                ->make(true);
        }

        return view('frontend.team-report.my-analizer.index', compact('profile', 'ranks'));

    }

    public function generateAnalyzer()
    {
        $datas = Employeer::with('allChildren')->get();

        foreach($datas as $data) {
           $this->recursiveLoop($data);
        }

        return 'Done';

    }

    public function recursiveLoop($data)
    {
        $dataArray = [];
        if (!$data->allChildren->isEmpty()) {
            foreach($data->allChildren as $children) {
                    $this->recursiveLoop($children);
                    $insert = $children->id .',';

                    \array_push($dataArray, $insert);

                $this->updateDownline($data->id, implode(" ", $dataArray));
            }


        }
    }

    public function updateDownline($parent_id, $idArray)
    {
        DB::table('downlines')
            ->updateOrInsert(
                ['member_id' => $parent_id],
                ['downline' => $idArray]
        );
    }



    public function teamAnalizer(){
        $datas = Employeer::parent(Auth::id())->renderAsArray();
        $position = (object) [
            'left' => [],
            'midle' => [],
            'right' => []
        ];
        foreach ($datas as $key => $data) {
            if ($data['position'] == 0) {
                $position->left = $data;
            }elseif($data['position'] == 1){
                $position->midle = $data;
            }elseif ($data['position'] == 2) {
                $position->right = $data;
            }
        }
        // dd($position);
        return $position->left;

    }
}
