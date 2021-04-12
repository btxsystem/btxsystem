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
            $auth = base64_encode('xnd_production_q7IQLscxs5kuVcauRwSoXc0awxll7zunJXP4XaI7uulO23od2vmYHezRW9MkWDA:');
            dd($auth);
            $adminFee = (int) $request->nominal * (3.5 / 100) + 2000;
            $ppn = $adminFee * 0.1;
            $post = [
                "token_id" => $request->token,
                "external_id" => "card_preAuth-".time(),
                "amount" => $request->nominal + $adminFee + $ppn,
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
                $this->bitrxpoint($request, $post["external_id"], $request->nominal + $adminFee + $ppn);
                return "success";
            }else{
                return "failed";
            }
        // } catch (\Throwable $th) {
        //     return "failed";
        // }
    }

    public function bitrxpoint(Request $request, $ref, $total) {
        // try {

        //     DB::beginTransaction();

            DB::table('history_bitrex_point')->insert([
                'id_member' => Auth::user()->id,
                'nominal' => $total,
                'points' => $request->nominal/1000,
                'description' => 'Topup Bitrex Point Via Credit Card',
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
