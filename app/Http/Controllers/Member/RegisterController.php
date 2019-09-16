<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employeer;
use App\Models\Ebook;
use App\Models\TransactionMember;
use App\Models\TemporaryRegisterMember;
use App\Models\TemporaryTransactionMember;

use DB;

class RegisterController extends Controller
{
  public function registerMember(Request $request)
  {
    $referral = $request->input('referral') ?? '';
    $firstName = $request->input('firstName') ?? '';
    $lastName = $request->input('lastName') ?? '';
    $username = $request->input('username') ?? '';
    $email = $request->input('email') ?? '';
    $nik = $request->input('nik') ?? '';
    $birthdate = $request->input('birth_date') ?? null;

    //shipping
    $description = $request->input('description') ?? '';
    $cityId = $request->input('cityId') ?? '';
    $cityName = $request->input('cityName') ?? '';
    $provinceId = $request->input('provinceId') ?? '';
    $provinceName = $request->input('provinceName') ?? '';
    $subdistrictId = $request->input('subdistrictId') ?? '';
    $subdistrictName = $request->input('subdistrictName') ?? '';
    $type = $request->input('type') ?? '';
    $userId = $request->input('userId') ?? '';
    $ebook = $request->input('ebook') ?? null;

    try {
      DB::beginTransaction();

      $checkReferral = Employeer::where('username', $referral)->first();

      if(!$checkReferral) {
        return response()->json([
          'success' => false,
          'message' => ''
        ]);
      }

      if($ebook != null) {
        $checkEbook = Ebook::where('id', $ebook)->whereIn('title', ['basic', 'advanced'])->first();
        if(!$checkEbook) {
          return response()->json([
            'success' => false,
            'message' => ''
          ]);
        }
      }
      
      // $saved = TemporaryRegisterMember::insert([
      //   'referral' => $checkReferral->id,
      //   'first_name' => $firstName,
      //   'last_name' => $lastName,
      //   'email' => $email,
      //   'username' => $username,
      //   'nik' => $nik,
      //   'birth_date' => $birthdate,
      //   'description' => $description,
      //   'city_id' => $cityId,
      //   'city_name' => $cityName,
      //   'province_id' => $provinceId,
      //   'province_name' => $provinceName,
      //   'subdistrict_id' => $subdistrictId,
      //   'subdistrict_name' => $subdistrictName,
      //   'type' => $type,
      //   'user_id' => $type,
      // ]);

      $saved = new TemporaryRegisterMember();
      $saved->referral = $checkReferral->id;
      $saved->first_name = $firstName;
      $saved->last_name = $lastName;
      $saved->email = $email;
      $saved->username = $username;
      $saved->nik = $nik;
      $saved->birth_date = $birthdate;
      $saved->description = $description;
      $saved->city_id = $cityId;
      $saved->city_name = $cityName;
      $saved->province_id = $provinceId;
      // $saved->province_name = $provinceName;
      $saved->subdistrict_id = $subdistrictId;
      $saved->subdistrict_name = $subdistrictName;
      $saved->type = $type;
      $saved->save();

      if(!$saved) {
        DB::rollback();
        return response()->json([
          'success' => false,
          'message' => ''
        ]);
      }

      $prefixRef = $ebook != null ? 'BITREX003' : 'BITREX004';

      $checkRef = DB::table('temporary_transaction_members')->where('transaction_ref', $prefixRef . (time() + rand(100, 500)))->first();

      $afterCheckRef = $prefixRef . (time() + rand(100, 500));

      while($checkRef) {
        $afterCheckRef = $prefixRef . (time() + rand(100, 500));
        if(!$checkRef) {
          break;
        }
      }

      $trx = new TemporaryTransactionMember();
      $trx->ebook_id = $ebook;
      $trx->member_Id = $saved->id;
      $trx->transaction_ref = $afterCheckRef;
      $trx->save();

      if(!$saved || !$trx) {
        DB::rollback();
        return response()->json([
          'success' => false,
          'message' => ''
        ]);
      }

      DB::commit();

      if($ebook != null) {
        return $this->paymentWithEbook($request, [
          'member' => $saved,
          'trx' => $trx
        ]);
      } else {
        return $this->paymentWithoutEbook($request, [
          'member' => $saved,
          'trx' => $trx
        ]);
      }
      
      // return response()->json([
      //   'success' => true,
      //   'message' => '',
      //   'data' => [
      //     'member' => $saved,
      //     'trx' => $trx
      //   ]
      // ]);

    } catch (\Exception $e) {
      DB::rollback();
      return response()->json([
        'success' => false,
        'error' => $e
      ]);
    }
  }

  public function paymentWithEbook(Request $request, $params)
  {
    $priceProduct = 280000;
    $ebook = Ebook::where('id', $params['trx']['ebook_id'])->first();
    $orderAmount = $ebook->price + $priceProduct;

    $data['merchant_key'] = env('IPAY_MERCHANT_KEY');
    $data['merchant_code'] = env('IPAY_MERCHANT_CODE');
    $data['currency'] = "IDR";
    $data['payment_id'] = 1;
    $data['product_desc'] = "Staterpack + Ebook";
    $data['user_name'] = $params['member']['username'];
    $data['user_email'] = $params['member']['email'];
    $data['ref_no'] = $params['trx']['transaction_ref'];
    $data['lang'] = 'UTF-8';
    // $data['code'] = $subs->created_at->format('dmYHi');
    $data['code'] = $params['trx']['transaction_ref'];
    $data['amount'] = (int) str_replace(".","",str_replace(",","",number_format($orderAmount, 2, ".", "")));
    $data['signature'] = $this->signature($data['code'], $data['amount']);
    $data['response_url'] = 'https://bitrexgo.id/response-pay-member';
    $data['backend_url'] = 'https://bitrexgo.id/backend-response-pay'; 

    return view('payment.form')
      ->with([
        'data' => $data
    ]);
  }

  public function paymentWithoutEbook(Request $request, $params)
  {
    return response()->json([
      'success' => true,
      'message' => '',
      'data' => [
        'member' => $params['member'],
        'trx' => $params['trx']
      ]
    ]);
  }

  public function signature($code, $amount)
  {
    $MechantKey = env('IPAY_MERCHANT_KEY');
    $MerchantCode = env('IPAY_MERCHANT_CODE');
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
    
    $merchant_key = env('IPAY_MERCHANT_KEY');
    $signature_plaintext = $merchant_key . $merchant_code . $payment_id . $code . $amount . $currency . $status;
    $sinature_result = $this->signature($signature_plaintext, $amount);

    try {
      DB::beginTransaction();

      $temporaryTrx = TemporaryTransactionMember::where('transaction_ref', $code)->first();

      $view = 'payment.failed';

      if($status == "1") {
        if($orderType == 'BITREX003') { //with ebbook
          //
        } else if($orderType == 'BITREX004') { //witout ebbook
          // $trxMember = TransactionMember::where('transaction_ref', $code);
          // $trxMember->update([
          //   'expired_at' => Carbon::create($trxMember->first()->expired_at)->addYear(1)
          // ]);
        }
        $view = 'payment.success';
      } else if($status == "0") {
        // echo $tatus;
        $view = 'payment.failed';
      } else if($status == "6") {
        // echo $tatus;
        $view = 'payment.waiting-transfer';
      }

      DB::commit();
      return view($view);

    } catch(\Exception $e) {
      DB::rollback();
    }
  }  
}
