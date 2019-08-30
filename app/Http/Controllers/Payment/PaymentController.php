<?php

namespace App\Http\Controllers\Payment;

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

    if($transactionRef == '') {
      redirect()->route('member.home');
    }

    if($ebook ) {
      if($user = Auth::guard('nonmember')->user()) {
        $check = TransactionNonMember::where([
          'ebook_id' => $ebook,
          'non_member_id' => $user->id
        ])->first();

        $updatePrice = Ebook::where([
          'id' => $ebook == 1 ? 3 : 4,
        ])->first();

        $transactionRef = $check->transaction_ref;
        $orderAmount = (int) $updatePrice->price + (int) $updatePrice->price_markup;
        $productDesc = ucwords($check->ebook->name);
        
      } else if($user = Auth::guard('user')->user()) {
        $check = TransactionMember::where([
          'ebook_id' => $ebook,
          'member_id' => $user->id
        ])->first();

        $updatePrice = Ebook::where([
          'id' => $ebook == 1 ? 3 : 4,
        ])->first();

        $transactionRef = $check->transaction_ref;
        $orderAmount = (int) $updatePrice->price;  
        $productDesc = ucwords($check->ebook->name);
      }
    } else {
      $check = TransactionNonMember::where([
        'transaction_ref' => $transactionRef
      ])->first();

      if(!$check) {
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
          $productDesc = ucwords($transaction->ebook->name);
      } else if($orderType == 'BITREX02') {
        $transaction = TransactionMember::where('transaction_ref', $transactionRef)
          ->with([
            'ebook'
          ])
          ->first();
  
          $orderAmount = (int) $transaction->ebook->price;
          $productDesc = ucwords($transaction->ebook->name);
      }
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
    $data['code'] = $transactionRef;
    $data['amount'] = (int) str_replace(".","",str_replace(",","",number_format($orderAmount, 2, ".", "")));
    $data['signature'] = $this->signature($data['code'], $data['amount']);
    $data['response_url'] = 'https://bitrexgo.id/response-pay';
    $data['backend_url'] = 'https://bitrexgo.id/backend-response-pay'; 
    
    // return response()->json([
    //   'data' => $data
    // ]);

    // $form = "
    //   <form method=\"post\" id=\"payment\" name=\"ePayment\" action=\"https://sandbox.ipay88.co.id/epayment/entry.asp\">        
    //     <input type=\"hidden\" name=\"MerchantCode\" value=\"$data[merchant_code]\">
    //     <input type=\"hidden\" name=\"RefNo\" value=\"$data[code]\">
    //     <input type=\"hidden\" name=\"Amount\" value=\"$data[amount]\">
    //     <input type=\"hidden\" name=\"Currency\" value=\"IDR\">
    //     <input type=\"hidden\" name=\"ProdDesc\" value=\"$data[product_desc]\">
    //     <input type=\"hidden\" name=\"UserName\" value=\"Asep Yayat\">
    //     <input type=\"hidden\" name=\"UserEmail\" value=\"asepmedia18@gmail.com\">
    //     <input type=\"hidden\" name=\"UserContact\" value=\"0126500100\">
    //     <input type=\"hidden\" name=\"Remark\" value=\"\">
    //     <input type=\"hidden\" name=\"Lang\" value=\"UTF-8\">
    //     <input type=\"hidden\" name=\"Signature\" value=\"$data[signature]=\">
    //     <input type=\"hidden\" name=\"ResponseURL\" value=\"$data[response_url]\"> 
    //     <input type=\"hidden\" name=\"BackendURL\" value=\"$data[backend_url]\"> 
    //     <input type=\"submit\" value=\"Proceed with Payment\" name=\"Submit\"> 
    //     </form> 
    //     <script language=\"JavaScript\" type=\"text/javascript\">
    //     document.getElementById('payment').submit();
    //     </script
    // ";

    // echo $form;
    
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