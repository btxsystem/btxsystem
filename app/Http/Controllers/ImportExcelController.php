<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use App\Employeer;
use App\HistoryBitrexCash;
use App\Models\GotReward;
 
use Session;

use App\Imports\EmployeerImport;
use App\Imports\AccountName;
use App\Imports\RewardsImport;
use App\Imports\RewardImport;
use App\Imports\TreeImport;
use App\Imports\SponsorImport;
use Excel;
use DB;
use App\Http\Controllers\Controller;
 
class ImportExcelController extends Controller
{
    public function index(){
        return view('admin.importExcel');
    }

	public function import_excel(Request $request) 
	{
        if ($request->hasFile('file')) {
            $file = $request->file('file'); //GET FILE
            Excel::import(new EmployeerImport, $file); //IMPORT FILE 
            return redirect()->back();
        } 
    }
    
    public function import_tree(Request $request){
        $datas = Excel::toArray(new TreeImport, request()->file('file'))[0];
        $val = [];
        foreach ($datas as $key => $data) {
            $user = Employeer::where('id_member',$data['userid'])->select('id')->first();
            $upline = Employeer::where('id_member',$data['uplineid'])->select('id')->first();
            $parent['parent_id'] = $upline['id'];
            if ($data['uplineside']=='M') {
                $parent['position'] = 1;
            }elseif ($data['uplineside']=='L') {
                $parent['position'] = 0;
            }else{
                $parent['position'] = 2;
            }
            Employeer::find($user['id'])->update($parent);
            //DB::table('transaction_member')->insert(['member_id' => $user->id, 'ebook_id' => 1, 'created_at' => now(), 'updated_at' => now(), 'status' => 1, 'expired_at' => now(), 'transaction_ref' => 1]);
        }
        return redirect()->back();
    }

    public function import_sponsor(Request $request){
        $datas = Excel::toArray(new SponsorImport, request()->file('file'))[0];
        foreach ($datas as $key => $data) {
            $user = Employeer::where('id_member',$data['userid'])->select('id')->first();
            $sponsor = Employeer::where('username',$data['sponsor'])->select('id')->first();
            $usr['sponsor_id'] = $sponsor['id'];
            Employeer::find($user['id'])->update($usr);
        }
        return redirect()->back();
    }

    public function import_bonus1(Request $request){
        $datas = Excel::toArray(new RewardsImport, request()->file('file'))[0];
        foreach ($datas as $key => $data) {
           $user = Employeer::where('id_member',$data['member_id'])->select('id')->first();
           $dt['member_id'] = $user['id'];
           $dt['reward_id'] = 1;
           $dt['status'] = 2;
           $dt['created_at'] = now();
           $dt['updated_at'] = now();
           GotReward::insert($dt);
        }
        $history_data = Excel::toArray(new RewardImport, request()->file('file'))[0];
        foreach ($history_data as $key => $data2) {
            $user = Employeer::where('id_member',$data2['member_id'])->select('id')->first();
            $dt2['id_member'] = $user['id'];
            $dt2['nominal'] = $data2['fix_amount'];
            $dt2['description'] = $data2['description'];
            $dt['created_at'] = now();
            $dt['updated_at'] = now();
            $dt2['info'] = 1;
            $dt2['type'] = 3;
            HistoryBitrexCash::insert($dt2);
         }
        return redirect()->back();
    }

    public function curse(Request $request){
        $datas = Excel::toArray(new RewardsImport, request()->file('file'))[0];
        foreach ($datas as $key => $data) {
           $member = Employeer::where('id_member',$data['mamber_id'])->select('id')->first(); 
           $reward = DB::table('got_rewards')->where('member_id',$member['id'])->where('reward_id',2)->select('id')->first();
           DB::update('update got_rewards set status = 2 where id = ?', $reward['id']);
        }
        /*$history_data = Excel::toArray(new RewardImport, request()->file('file'))[0];
        foreach ($history_data as $key => $data2) {
            $user = Employeer::where('id_member',$data2['mamber_id'])->select('id')->first();
            $dt2['id_member'] = $user['id'];
            $dt2['nominal'] = 5000000;
            $dt2['description'] = 'Cruise bonus *before tax';
            $dt['created_at'] = now();
            $dt['updated_at'] = now();
            $dt2['info'] = 1;
            $dt2['type'] = 3;
            HistoryBitrexCash::insert($dt2);
         }
        */
        return redirect()->back();
    }
    public function oldBonus(Request $request){
        $history_data = Excel::toArray(new RewardImport, request()->file('file'))[0];
        foreach ($history_data as $key => $data2) {
            $user = Employeer::where('id_member',$data2['member_id'])->select('id')->first();
            $dt2['id_member'] = $user['id'];
            $dt2['nominal'] = $data2['fix_amount'];
            $dt2['description'] = $data2['description'];
            $dt['created_at'] = now();
            $dt['updated_at'] = now();
            $dt2['info'] = 1;
            $dt2['type'] = 4;
            HistoryBitrexCash::insert($dt2);
         }
        return redirect()->back();
    }

    public function account_name(Request $request){
        $datas_ = Excel::toArray(new AccountName, request()->file('file'))[0];
        foreach ($datas_ as $key => $data3) {
            $user1 = Employeer::where('id_member',$data3['id_job_seeker'])->select('id')->first();
            $dt3['bank_name'] = $data3['bank_name'];
            $dt3['bank_account_name'] = $data3['account_name'];
            Employeer::find($user1['id'])->update($dt3);
         }
        return redirect()->back();
    }
}