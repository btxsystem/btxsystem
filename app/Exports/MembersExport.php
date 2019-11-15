<?php

namespace App\Exports;

use App\Employeer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class MembersExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        //return Employeer::query();
        return Employeer::all();
        // $datas = DB::table("employeers")->select("employeers.*",DB::raw("(SELECT employeers.`username` FROM employeers WHERE employeers.`id` IN (SELECT employeers.`parent_id` FROM employeers)) AS 'parent',(SELECT employeers.`username` FROM employeers WHERE employeers.`id` IN (SELECT employeers.`sponsor_id` FROM employeers)) AS 'sponsor'"))->get();
        // return $datas;

        // echo "<pre>";
        //     print_r($datas);
        // echo "</pre>";
        // die();
        // ->select('id_member','username','email','birthdate','npwp_number','is_married','gender','status','phone_number','no_rec','bank_account_name','bank_account_number','position','rank_id','created_at','updated_at','verification','bitrex_cash','bitrex_points','pv','src','is_update','nik','expired_at');
    }

    public function headings() : array
    {
        return [
            'ID Member',
            'Username',
            'Full Name',
            'Email',
            'Birthdate',
            'Npwp Number',
            'Is Married',
            'Gender',
            'Status',
            'Phone Number',
            'No Rek',
            'Bank Account Name',
            'Bank Account Number',
            'Position',
            'Parent',
            'Sponsor',
            'Rank Id',
            'Created Date',
            'Updated Date',
            'Verification',
            'Bitrex Cash',
            'Bitrex Points',
            'Pv',
            'Src',
            'Is Update',
            'Nik',
            'Expired Date'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */

    // public function view(): View
    // {
        // return view('admin.withdrawal-bonus.excel', [
        //     'datas' => Employeer::where('status', 1)
        //                         ->whereDate('expired_at', '>=', now())
        //                         ->select('id as check','id','id_member','username','no_rec','bank_name','bank_account_name','npwp_number',
        //                                 'first_name','last_name','rank_id','verification',
        //                                 'created_at','status','bitrex_cash','bitrex_points','expired_at'
        //                 )->get()->filter(function($data) {
        //                     return $data->total_bonus > 10000;
        //                 })
        // ]);
    // }

    // public function view(): View
    // {
    //     return view('admin.members.excel', [
    //         'datas' => DB::table("employeers")
    //       ->select("employeers.*",DB::raw("(SELECT employeers.`username` FROM employeers WHERE employeers.`id` IN (SELECT employeers.`parent_id` FROM employeers)) AS 'parent',(SELECT employeers.`username` FROM employeers WHERE employeers.`id` IN (SELECT employeers.`sponsor_id` FROM employeers)) AS 'sponsor'"))->paginate(1)
    //     ]);
    // }

}
