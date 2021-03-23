<?php

namespace App\Http\Controllers\Member;

use Xendit\Xendit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use App\Employeer;

class XenditController extends Controller
{
    public function cardlessPayment(Request $request) {
        //try {
            $auth = base64_encode('xnd_development_zWyPvmtyAbmYJiLp7eaRodauA5U4UyGj5n2XhL7BZSIQFBE81bpdNV0K0h2tJR:');
            $post = [
                "token_id" => "6058a3635df54800209f47f4",
                "external_id" => "card_preAuth-".time(),
                "amount" => $request->nominal,
                "card_cvn" => $request->cvn,
                "capture" => "false"
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.xendit.co/credit_card_charges');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Basic '.$auth.''
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
            $response = json_decode(curl_exec($ch), true);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.xendit.co/credit_card_charges/'.$response['id'].'/capture');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Basic '.$auth.''
            ));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = json_decode(curl_exec($ch), true);

            if ($response['status'] == "CAPTURED") {
                $this->bitrxpoint($request, $post["external_id"]);
                return "success";
            }else{
                return "failed";
            }
        // } catch (\Throwable $th) {
        //     return "failed";
        // }
    }

    public function bitrxpoint(Request $request, $ref) {
        // try {

        //     DB::beginTransaction();

            DB::table('history_bitrex_point')->insert([
                'id_member' => Auth::user()->id,
                'nominal' => $request->nominal,
                'points' => $request->nominal/1000,
                'description' => 'Topup Bitrex Point',
                'info' => 1,
                'transaction_ref' => $ref,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            $member = Employeer::where('id', Auth::user()->id)->first();
            $member->update([
                'bitrex_points' => $member->bitrex_points + $request->nominal/1000
            ]);
            return $member;
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return redirect()->back();
        // }
    }

}
