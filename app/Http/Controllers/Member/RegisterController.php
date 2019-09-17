<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employeer;
use App\Models\Ebook;
use App\Models\TransactionMember;
use App\Models\TemporaryRegisterMember;
use App\Models\TemporaryTransactionMember;

use Carbon\Carbon;

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
    $nik = $request->input('passport') ?? '';
    $birthdate = $request->input('birthdate') ?? null;

    //shipping
    $shipping = $request->input('shipping') ?? 0;
    $postalFee = $request->input('postalFee') ?? 0;
    $description = $request->input('description') ?? '';
    $cityId = $request->input('cityId') ?? '';
    $cityName = $request->input('cityName') ?? '';
    $provinceId = $request->input('provinceId') ?? '';
    $provinceName = $request->input('provinceName') ?? '';
    $subdistrictId = $request->input('subdistrictId') ?? '';
    $subdistrictName = $request->input('subdistrictName') ?? '';
    $type = $request->input('type') ?? '';
    $userId = $request->input('userId') ?? '';
    $ebooks = $request->input('ebooks') ?? [];

    try {
      DB::beginTransaction();

      $checkReferral = Employeer::where('username', $referral)->first();

      if(!$checkReferral) {
        return response()->json([
          'success' => false,
          'message' => 'gaada referral'
        ]);
      }

      if(count($ebooks) > 0) {
        $checkEbook = Ebook::where('id', 1)->whereIn('title', ['basic', 'advanced'])->first();
        if(!$checkEbook) {
          return response()->json([
            'success' => false,
            'message' => 'gaada ebooks'
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
      $saved->type = $shipping;
      $saved->save();



      if(!$saved) {
        DB::rollback();
        return response()->json([
          'success' => false,
          'message' => 'gabisa saved tmp'
        ]);
      }

      $prefixRef = $ebooks != null ? 'BITREX003' : 'BITREX004';

      $checkRef = DB::table('temporary_transaction_members')->where('transaction_ref', $prefixRef . (time() + rand(100, 500)))->first();

      $afterCheckRef = $prefixRef . (time() + rand(100, 500));

      while($checkRef) {
        $afterCheckRef = $prefixRef . (time() + rand(100, 500));
        if(!$checkRef) {
          break;
        }
      }

      if(count($ebooks) > 0) {
        foreach ($ebooks as $ebook) {
          $trx = new TemporaryTransactionMember();
          $trx->ebook_id = $ebook['id'];
          $trx->member_Id = $saved->id;
          $trx->transaction_ref = $afterCheckRef;
          $trx->save();
        }
      } else {
        $trx = new TemporaryTransactionMember();
        $trx->ebook_id = null;
        $trx->member_Id = $saved->id;
        $trx->transaction_ref = $afterCheckRef;
        $trx->save();
      }

      if(!$saved || !$trx) {
        DB::rollback();
        return response()->json([
          'success' => false,
          'message' => 'gabisa save duaduanya'
        ]);
      }

      DB::commit();

      if(count($ebooks) > 0) {
        // $createMember = findChild(
        //   $saved->referral,
        //   $saved->referral,
        //   $saved
        // );

        // $createEbook = TransactionMember::insert([
        //   'ebook_id' => 1,
        //   'member_id' => 36,
        //   'expired_at' => Carbon::now()->addYear(1),
        //   'status' => 1
        // ]);
        // return response()->json([
        //   'data' => $createMember,
        //   'ebook' => $createEbook
        // ]);
        return $this->paymentWithEbook($request, [
          'member' => $saved,
          'trx' => $trx,
          'ebooks' => $ebooks,
          'shipping' => $shipping,
          'postalFee' => $postalFee
        ]);
      } else {
        return $this->paymentWithoutEbook($request, [
          'member' => $saved,
          'trx' => $trx,
          'shipping' => $shipping,
          'postalFee' => $postalFee
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

    $ebookIds = [];
    foreach ($params['ebooks'] as $ebook) {
      $ebookIds[] = $ebook['id'];
    }

    $ebookPrice = Ebook::whereIn('id', $ebookIds)
        ->sum('price');

    $orderAmount = $ebookPrice + $priceProduct;

    if($params['shipping'] != 0) {
      $orderAmount = $orderAmount + (int) $params['postalFee'];
    }

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

    // return view('payment.form')
    //   ->with([
    //     'data' => $data
    // ]);
    return response()->json([
      'success' => true,
      'message' => '',
      'data' => [
        'member' => $params['member'],
        'trx' => $params['trx'],
        'data' => $data,
        'shipping' => $params['shipping']
      ]
    ]);
  }

  public function paymentWithoutEbook(Request $request, $params)
  {
    $orderAmount = 280000;

    $data['merchant_key'] = env('IPAY_MERCHANT_KEY');
    $data['merchant_code'] = env('IPAY_MERCHANT_CODE');
    $data['currency'] = "IDR";
    $data['payment_id'] = 1;
    $data['product_desc'] = "Starter Pack";
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

    // return view('payment.form')
    //   ->with([
    //     'data' => $data
    // ]);
    return response()->json([
      'success' => true,
      'message' => '',
      'data' => [
        'member' => $params['member'],
        'trx' => $params['trx'],
        'shipping' => $params['shipping']
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

      $orderType = substr($code, 0, 8);

      $temporaryTrx = TemporaryTransactionMember::where('transaction_ref', $code)
        ->with('member')
        ->first();

      $view = 'payment.failed';

      if($status == "1") {
        findChild(
          $temporaryTrx->member->referral,
          $temporaryTrx->member->referral,
          $temporaryTrx->member
        );

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

    } catch(\Illuminate\Database\QueryException $e) {
      DB::rollback();
      return response()->json([
        'success' => false,
        'error' => $e
      ]);
    }
  }
}
