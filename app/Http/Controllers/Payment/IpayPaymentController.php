<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class IpayPaymentontroller extends Controller
{
  public function payment(Request $requet)
  {
		  date_default_timezone_set('Asia/Jakarta');	
        
    	$data['merchant_key'] = "rMRMh6Qmcy";
      $data['merchant_code'] = "ID00913";
      $data['currency'] = "IDR";
      $data['payment_id'] = 1;
      $data['product_desc'] = 0;
      $data['user_name'] = 0;
      $data['user_email'] = 0;
      $data['lang'] = 'UTF-8';
      // $data['code'] = $subs->created_at->format('dmYHi');
      $data['code'] = 0;
      $data['amount'] = str_replace(".","",str_replace(",","",$orderAmount));	;
      $data['signature'] = $this->signature($data['code'], $data['amount']);
      $data['response_url'] = 'https://staging.connect.bitlabs.id/api/response-pay';
      $data['backend_url'] = 'https://staging.connect.bitlabs.id/api/backend-response-pay';    
  }
}