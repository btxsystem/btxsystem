<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GotReward;
use DataTables;
use Auth;
use Alert;
use DB;
use App\Service\NotificationService;
use App\Rank;

class RewardClaimController extends Controller
{
    protected $service;

    public function __construct(NotificationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        if (request()->ajax()) {
            $data = GotReward::with(
                                    [
                                        'reward' => function($q){
                                            $q->select(['*']);
                                        },
                                        'member' => function($q){
                                            $q->select(['id','id_member','username','first_name','last_name']);
                                        }
                                    ])
                                ->orderBy('got_rewards.status','asc')
                                ->whereIn('got_rewards.status', [1, 2])
                                ->select('got_rewards.*');

            return Datatables::of($data)
                    ->editColumn('fullname', function($row) {
                        return $row->member ? $row->member->first_name .' '.$row->member->last_name  : 'No Data';
                    })
                    ->addColumn('status_approve', function($row) {
                        return $this->getStatus($row);
                    })
                    ->editColumn('created_at', function($row) {
                        return $row->created_at ? $row->created_at : 'No Data';
                    })
                    ->editColumn('updated_at', function($row) {
                        return $row->updated_at ? $row->updated_at : 'No Data';
                    })
                    ->editColumn('approve_at', function($row) {
                        return $row->status ? $row->status == 2 ? $row->updated_at : '' : null;
                    })
                    ->addColumn('action', function($row) {
                        return $this->htmlAction($row);
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('admin.claim-reward.index');
   }

   public function approve($id)
   {
        //If Type *Register Member* update table transaction member
       DB::beginTransaction();
       try {
           $data = GotReward::findOrFail($id);
           $reward = GotReward::with('reward','member')->orderBy('id','desc')->where('id',$id)->first();
           $this->service->sendEmail($reward);
           $data->update([
               'status' => 2
           ]);
           DB::commit();
           Alert::success('Success Update Data', 'Success');
       } catch (Exception $e) {
           DB::rollback();
           Alert::error('Gagal Update Data', 'Gagal');
           return redirect()->back();
       }
   }


   public function getStatus($row)
   {
       switch($row->status) {
           case 0;
           return 'Can Claim';
           break;
           case 1;
           return 'Waiting Approval';
           break;
           case 2;
           return 'Given';
           break;
       }
   }

   public function htmlAction($row)
   {
    //    $view = \Auth::guard('admin')->user()->hasPermission('Claim_rewards.detail') ? '<a data-id="'.$row->id.'"  class="btn btn-success fa fa-eye show-reward" title="Show Reward"></a>' : '';
       $view = \Auth::guard('admin')->user()->hasPermission('Claim_rewards.detail') ? '<a href="'.route('members.show',$row->member_id).'" target="_blank" class="btn btn-success fa fa-eye show-reward" title="Show Reward"></a>' : '';
       $approve = \Auth::guard('admin')->user()->hasPermission('Claim_rewards.confirm') ? '<a data-id="'.$row->id.' "class="btn btn-default fa fa-check approve-reward" style="background-color: #b85ebd; color: #ffffff;" title="Approve Reward"></a>' : '';
       switch($row->status) {
           case 0;
           return $view;
           break;

           case 1;
           return $view.' '.$approve ;
           break;

           case 2;
           return $view;

       }

   }
}
