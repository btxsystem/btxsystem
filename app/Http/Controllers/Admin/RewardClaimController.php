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
            $data = GotReward::with('reward','member')->orderBy('id','desc')->whereIn('status', [1, 2])->get();

            return Datatables::of($data)
                    ->addColumn('id_member', function($row) {
                        return $row->member ? $row->member->id_member : 'No Data';
                    })
                    ->addColumn('fullname', function($row) {
                        return $row->member ? $row->member->first_name .' '.$row->member->last_name  : 'No Data';
                    })
                    ->addColumn('username', function($row) {
                        return $row->member ? $row->member->username : 'No Data';
                    })
                    ->addColumn('reward', function($row) {
                        return $row->reward ? $row->reward->description : 'No Data';
                    })
                    ->addColumn('status', function($row) {
                        return $this->getStatus($row);
                    })
                    ->addColumn('archive', function($row) {
                        return $row->created_at ? $row->created_at : 'No Data';
                    })
                    ->addColumn('claim', function($row) {
                        return $row->updated_at ? $row->updated_at : 'No Data';
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
