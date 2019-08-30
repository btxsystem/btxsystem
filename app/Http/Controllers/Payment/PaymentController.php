<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\TransactionNonMember;
use App\Models\TransactionMember;

class PaymentController extends Controller
{
  public function payment(Request $request)
  {
    date_default_timezone_set('Asia/Jakarta');

    $transactionRef = $request->input('transactionRef') ?? '';	

    if($transactionRef == '') {
      redirect()->route('member.home');
    }

    $orderAmount = 0;
    $orderType = substr($transactionRef, 0, 8);

    if($orderType == 'BITREX01') {
      $transaction = TransactionNonMember::where('transaction_ref', $transactionRef)
        ->with([
          'ebook'
        ])
        ->first();

        $orderAmount = (int) $transaction->ebook->price + (int) ($transaction->ebook->price_markup);
    } else if($orderType == 'BITREX02') {
      $transaction = TransactionMember::where('transaction_ref', $transactionRef)
        ->with([
          'ebook'
        ])
        ->first();

        $orderAmount = (int) $transaction->ebook->price;
    }
      
    $data['merchant_key'] = "tbaoVEHjP7";
    $data['merchant_code'] = "ID01085";
    $data['currency'] = "IDR";
    $data['payment_id'] = 1;
    $data['product_desc'] = 'Ebook Bitrexgo Basic';
    $data['user_name'] = 'Asep Yayat';
    $data['user_email'] = 'asepmedia18@gmail.com';
    $data['ref_no'] = $transactionRef;
    $data['lang'] = 'UTF-8';
    // $data['code'] = $subs->created_at->format('dmYHi');
    $data['code'] = $transaction->id;
    $data['amount'] = (int) str_replace(".","",str_replace(",","",$orderAmount));
    $data['signature'] = $this->signature($data['code'], $data['amount']);
    $data['response_url'] = 'https://bitrexgo.id/response-pay';
    $data['backend_url'] = 'https://bitrexgo.id/backend-response-pay'; 
    
    // return response()->json([
    //   'data' => $data
    // ]);
    
    return view('payment.form')
      ->with([
        'data' => $data
      ]);
  }

  public function signature($code, $amount)
  {
    $MechantKey = "tbaoVEHjP7";
    $MerchantCode = "ID01085";
    $RefNo = $code;
    $amount = $amount; 
    $currency = "IDR";
    $ipaySignature 	= "";
    $encrypt		= sha1($MechantKey.$MerchantCode.$RefNo.$amount.$currency);		
      
    for ($i=0; $i<strlen($encrypt); $i=$i+2){
      $ipaySignature .= chr(hexdec(substr($encrypt,$i,2)));
    }
     
    $ipaySignature = base64_encode($ipaySignature);
    
    return $ipaySignature;
  }  

  public function responsePayment(Request $req)
  {
    $merchant_code = $req->get('MerchantCode');
    $payment_id = $req->get('PaymentId');
    $code = $req->get('RefNo');
    $amount = $req->get('Amount');
    $currency = $req->get('Currency');
    $remark = $req->get('Remark');
    $transid = $req->get('TransId');
    $authcode = $req->get('AuthCode');
    $status = $req->get('Status');
    $errdesc = $req->get('ErrDesc');
    $signature = $req->get('Signature');
    
    $merchant_key = "rMRMh6Qmcy";
    $signature_plaintext = $merchant_key . $merchant_code . $payment_id . $code . $amount . $currency . $status;
    $sinature_result = $this->signature($signature_plaintext, $amount);
    try {
      $orderType = substr($code, 0, 8);

      if($orderType == 'BITREX01') {
        $transaction = TransactionNonMember::where('transaction_ref', $code)
          ->update([
            'status' => $status
          ]);
      } else if($orderType == 'BITREX02') {
        $transaction = TransactionMember::where('transaction_ref', $code)
          ->update([
            'status' => $status
          ]);
      }
    } catch (\Illuminate\Database\QueryException $e) {
        return $e->getMessage();
    }
    return redirect()->route('member.home');
  }

  public function backendResponsePayment(Request $request)
  {
      echo "RECEIVEOK";
  }  
}