<?php

namespace App\Http\Controllers\Member;

use Xendit\Xendit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use App\Employeer;
use App\Xendit as Exend;
class XenditController extends Controller
{
    public function store(Request $request) {
        Xendit::setApiKey('xnd_production_kcKbrLbDXDZSBBd2apU2mKdqXarAzSZ6QmckAnueM4JSQ70uFDoyNZsZGmQuvBh');
        $params = [
            'external_id' => 'exend_'.time(),
            'payer_email' => Auth::user()->email,
            'description' => 'Pay bitrex points',
            'amount' => (int) $request->nominal + $request->tax
        ];
        $createInvoice = \Xendit\Invoice::create($params);
        Exend::create([
            'external_id' => $params["external_id"],
            'xendit_id' => $createInvoice["id"],
            'user_id' => Auth::user()->id,
            'nominal' => $params["amount"],
            'bank' => '0',
            'tax' => $request->tax,
            'status' => 6
        ]);
        return $createInvoice;
    }

    public function callback(Request $request) {
        $request->headers->set('Content-Type:application/json', 'x-callback-token: 8682835e2a23bcbc0f9d4a05a2bbdeac75a0e428583bf5563d54b4f411c62ef5');
        // header("Content-Type:application/json", 'x-callback-token: 8682835e2a23bcbc0f9d4a05a2bbdeac75a0e428583bf5563d54b4f411c62ef5');
        // dd($data);
        // $data = json_decode(file_get_contents('php://input'), true);
        dd(response()->json($request->all()));
        $findData = Exend::where('external_id', $data['external_id'])->first();
        $statusTrx = 6;
        if($data['status'] == 'PAID') {
            $statusTrx = 1;
            $req = [
                "user_id" => $findData->user_id,
                "total" => $findData->nominal,
                "bank" => $findData->bank
            ];
            $this->bitrxpoint($req);
        }else if($data['status'] == 'EXPIRED') {
            $statusTrx = 0;
        }
        $findData->update([
            'status' => $statusTrx,
            'bank' => $data['bank_code'],
        ]);
        return redirect('/');
    }

    public function cardlessPayment(Request $request) {
        //try {
            $auth = base64_encode('xnd_production_q7IQLscxs5kuVcauRwSoXc0awxll7zunJXP4XaI7uulO23od2vmYHezRW9MkWDA:');
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

    public function bitrxpoint(Request $request) {
        DB::table('history_bitrex_point')->insert([
            'id_member' => $request->user_id,
            'nominal' => $request->total,
            'points' => $request->total/1000,
            'description' => 'Topup Bitrex Point Via Xendit '. $request->bank,
            'info' => 1,
            'transaction_ref' => $request->ref,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        $member = Employeer::where('id', $request->user_id)->first();
        $member->update([
            'bitrex_points' => $member->bitrex_points + $request->total/1000
        ]);
        return $member;
    }

}
