<?php

namespace App\Http\Controllers\Payment\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\TransactionNonMember;
use App\Models\TransactionMember;
use App\Models\Ebook;

class PaymentController extends Controller
{
  public function payment(Request $request)
  {
    date_default_timezone_set('Asia/Jakarta');

    $transactionRef = $request->input('transactionRef') ?? '';	
    $ebook = $request->input('ebook') ?? '';
    $productDesc = '';
    $user = null;
    
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

    if($code == '') {
      return redirect()->route('member.home');
    }
    
    $merchant_key = "rMRMh6Qmcy";
    $signature_plaintext = $merchant_key . $merchant_code . $payment_id . $code . $amount . $currency . $status;
    $sinature_result = $this->signature($signature_plaintext, $amount);
    try {
      DB::beginTransaction();
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
      } else {
        $transaction = false;
      }

      $paymentHistory = PaymentHistories::insert([
        'ebook_id' => TransactionMember::where('transaction_ref', $code)->first()->ebook_id,
        'ref_no' => $code,
        'payment_id' => $payment_id,
        'amount' => $amount,
        'currency' => $currency,
        'trans_id' => $transid,
        'remark' => $remark,
        'auth_code' => $authcode,
        'err_desc' => $errdesc,
        'status' => $status
      ]);

      if(!$transaction || $paymentHistory) {
        DB::rollback();
        return redirect()->route('payment.failed');
      }

      DB::commit();
      
      if($status == 1) {
        return view('payment.success');
      } else if($status == 0) {
        return view('payment.failed');
      } else if($status == 6) {
        return view('payment.waiting-transfer');
      }

    } catch (\Illuminate\Database\QueryException $e) {
        DB::rollback();
        return view('payment.failed');
        //return $e->getMessage();
    }
  }

  public function backendResponsePayment(Request $request)
  {
      echo "RECEIVEOK";
  }  

  public function waitingTransfer()
  {
    return view('payment.waiting-transfer');
  }

  public function success()
  {
    return view('payment.success');
  }

  public function failed()
  {
    return view('payment.failed');
  }
}