<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use App\Employeer;
use App\HistoryBitrexCash;
use App\Models\GotReward;
 
use Session;

use App\Imports\EmployeerImport;
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
           GotReward::insert($dt);
        }
        $history_data = Excel::toArray(new RewardImport, request()->file('file'))[0];
        foreach ($history_data as $key => $data) {
            $user = Employeer::where('id_member',$data['member_id'])->select('id')->first();
            $dt['id_member'] = $user['id'];
            $dt['nominal'] = $data['fix_amount'];
            $dt['description'] = $data['description'];
            $dt['info'] = 1;
            $dt['type'] = 3;
            HistoryBitrexCash::insert($dt);
         }
        return redirect()->back();
    }
}