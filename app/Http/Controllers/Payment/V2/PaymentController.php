<?php

namespace App\Http\Controllers\Payment\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\TransactionNonMember;
use App\Models\TransactionMember;
use App\Models\Ebook;

use App\Builder\PaymentHistoryBuilder;

use App\Factory\RegisterFactoryMake;
use App\Factory\PaymentHistoryFactoryBuild;

use App\Models\PaymentHistoryMember;
use App\Models\PaymentHistoryNonMember;

class PaymentController extends Controller
{
  // public function payment(Request $request)
  // {
  //   date_default_timezone_set('Asia/Jakarta');

  //   $transactionRef = $request->input('transactionRef') ?? '';	
  //   $ebook = $request->input('ebook') ?? '';
  //   $productDesc = '';
  //   $user = null;
    
  //   return view('payment.form')
  //     ->with([
  //       'data' => $data
  //   ]);
  // }

  public function payment(Request $request)
  {
    try {
      DB::beginTransaction();
      $repeat = $request->input('repeat');
      $transactionRef = $request->input('transactionRef') ?? '';	
      $ebook = Ebook::where('id', $request->input('ebook'))->first();
      $orderAmount = 0;
      $productDesc = '';
    
      if($user = Auth::guard('nonmember')->user()) {
        $builderPayment = (new PaymentHistoryBuilder())
          ->setEbookId($ebook->id)
          ->setNonMemberId($user->id);

        $payment = (new PaymentHistoryFactoryBuild())->call()->nonMember($builderPayment);

        $transactionNonMember = TransactionNonMember::where([
          'non_member_id' => $user->id,
          'ebook_id' => $ebook->id
        ])->update([
          'transaction_ref' => $payment->ref_no
        ]);

        //repeat
        if($repeat) {
          $renewalEbookId = 0;

          if($ebook->id == 1) {
            $renewalEbookId = 3;
          } else if($ebook->id == 2) {
            $renewalEbookId = 4;
          }

          $renewalEbook = Ebook::where('id', $renewalEbookId)->first();

          $orderAmount = (int) $renewalEbook->price + (int) ($renewalEbook->price_markup);
          $productDesc = ucwords(str_replace("_", " ", $renewalEbook->title));
        } else {
          $orderAmount = (int) $ebook->price + (int) ($ebook->price_markup);
          $productDesc = ucwords($ebook->title);
        }

      } else if($user = Auth::guard('user')->user()) {
        //users
      } else {
        $orderAmount = (int) $ebook->price + (int) ($ebook->price_markup);
        $productDesc = ucwords($ebook->title);

        $payment = (object) [
          'ref_no' => $transactionRef
        ];
      }

      if(!$payment) {
        DB::rollback();

        return response()->json([
          'success' => false
        ]);
      }

      $data['merchant_key'] = "tbaoVEHjP7";
      $data['merchant_code'] = "ID01085";
      $data['currency'] = "IDR";
      $data['payment_id'] = 1;
      $data['product_desc'] = "Ebook Bitrexgo {$productDesc}";
      $data['user_name'] = 'asep';
      $data['user_email'] = 'aseppmedia18@gmail.com';
      $data['ref_no'] = $payment->ref_no;
      $data['lang'] = 'UTF-8';
      // $data['code'] = $subs->created_at->format('dmYHi');
      $data['code'] = $payment->ref_no;
      $data['amount'] = (int) str_replace(".","",str_replace(",","",number_format($orderAmount, 2, ".", "")));
      $data['signature'] = $this->signature($data['code'], $data['amount']);
      $data['response_url'] = 'https://bitrexgo.id/response-pay';
      $data['backend_url'] = 'https://bitrexgo.id/backend-response-pay'; 

      // return response()->json([
      //   'data' => $data
      // ]);

      DB::commit();

      return view('payment.form')
        ->with([
          'data' => $data
      ]);

    } catch (\Exception $e) {
      DB::rollback();

      return response()->json([
        'message' => $transactionRef
      ]);
    }
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
        //
        $paymentHistory = PaymentHistoryNonMember::where('ref_no', $code)->update([
          'payment_id' => $payment_id,
          'amount' => $amount,
          'currency' => $currency,
          'trans_id' => $transid,
          'remark' => $remark,
          'auth_code' => $authcode,
          'err_desc' => $errdesc,  
        ]);

        $transaction = TransactionNonMember::where('transaction_ref', $code)
        ->update([
          'status' => $status,        
        ]);
      } else if($orderType == 'BITREX02') {
        $paymentHistory = PaymentHistoryMember::where('ref_no', $code)->update([
          'status' => $status,
          'payment_id' => $payment_id,
          'amount' => $amount,
          'currency' => $currency,
          'trans_id' => $transid,
          'remark' => $remark,
          'auth_code' => $authcode,
          'err_desc' => $errdesc,            
        ]);
        
        $transaction = TransactionMember::where('transaction_ref', $code)
          ->update([
            'status' => $status
        ]);
      } else {
        $paymentHistory = false;
        $transaction = false;
      }

      if(!$paymentHistory || !$transaction) {
        DB::rollback();
        return view('payment.failed');
      }

      DB::commit();
      
      if($status == "1") {
        // echo $status;
        return view('payment.success');
      } else if($status == "0") {
        // echo $tatus;
        return view('payment.failed');
      } else if($status == "6") {
        // echo $tatus;
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