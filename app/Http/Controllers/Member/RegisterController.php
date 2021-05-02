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

use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMemberMail;

class RegisterController extends Controller
{

  public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!\Auth::user()) {
                return redirect('/');
            }
            return $next($request);
        });
    }

  public function registerMember(Request $request)
  {
    $method = $request->input('method') ?? 'transfer';
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

      $prefixRef = $ebooks != null ? 'BITREX03' : 'BITREX04';

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
          $trx->ebook_id = $ebook;
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

      // $idNewMember = findChild(
      //   $checkReferral->id,
      //   $checkReferral->id,
      //   $saved
      // );

      // if(count($ebooks) > 0) {
      //   $books = [];
      //   foreach ($ebooks as $ebook) {
      //     $books[] = [
      //       'transaction_ref' => $afterCheckRef,
      //       'ebook_id' => $ebook,
      //       'expired_at' => '2040-09-07 00:00:00',
      //       'member_id' => $idNewMember->id,
      //       'status' => 1
      //     ];
      //   }
      //   $trxMember = TransactionMember::insert($books);
      // }

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
          'postalFee' => $postalFee,
          'method' => $method
        ]);
      } else {
        return $this->paymentWithoutEbook($request, [
          'member' => $saved,
          'trx' => $trx,
          'shipping' => $shipping,
          'postalFee' => $postalFee,
          'method' => $method
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

    } catch (\Illuminate\Database\QueryException $e) {
      DB::rollback();
      return response()->json([
        'success' => false,
        'error' => $e
      ]);
    }
  }

  public function paymentWithEbook(Request $request, $params)
  {
    $priceProduct = 0;

    $ebookIds = [];
    foreach ($params['ebooks'] as $ebook) {
      $ebookIds[] = $ebook;
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
    $data['product_desc'] = "Starter Pack + Ebook";
    $data['user_name'] = $params['member']['username'];
    $data['user_email'] = $params['member']['email'];
    $data['ref_no'] = $params['trx']['transaction_ref'];
    $data['lang'] = 'UTF-8';
    // $data['code'] = $subs->created_at->format('dmYHi');
    $data['code'] = $params['trx']['transaction_ref'];
    $data['amount'] = (int) str_replace(".","",str_replace(",","",number_format($orderAmount, 2, ".", "")));
    $data['signature'] = $this->signature($data['code'], $data['amount']);
    $data['response_url'] = url('response-pay-member');
    $data['backend_url'] = url('backend-response-pay');

    if($params['method'] == 'transfer') {
      return view('payment.transfer')
        ->with([
        'data' => $data
    ]);
    } else {
      return view('payment.form')
        ->with([
        'data' => $data
      ]);
    }

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
    $orderAmount = 0;

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
    $data['response_url'] = url('response-pay-member');
    $data['backend_url'] = url('backend-response-pay');

    if($params['method'] == 'transfer') {
      return view('payment.transfer')
        ->with([
        'data' => $data
      ]);
    } else {
      return view('payment.form')
        ->with([
        'data' => $data
      ]);
    }

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
    $prodDesc = $req->get('ProdDesc');
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
        ->get();

      // $idNewMember = findChild(
      //     $temporaryTrx[0]->member->referral,
      //     $temporaryTrx[0]->member->referral,
      //     $temporaryTrx[0]->member
      //   );

      // return response()->json([
      //   'trx' => $temporaryTrx,
      //   'status' => $status,
      //   'member' => $idNewMember,
      //   'prodDesc' => $prodDesc
      // ]);

      $view = 'payment.failed';

      if($status == "1") {
        $idNewMember = findChild(
          $temporaryTrx[0]->member->referral,
          $temporaryTrx[0]->member->referral,
          $temporaryTrx[0]->member
        );

        if($orderType == 'BITREX03') { //with ebbook
          $books = [];
          foreach ($temporaryTrx as $trx) {
            // $books[] = [
            //   'transaction_ref' => $code,
            //   'ebook_id' => $trx->ebook_id,
            //   'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1),
            //   'member_id' => $idNewMember->id,
            //   'status' => 1
            // ];
            $trxMember = new TransactionMember();
            $trxMember->transaction_ref = $code;
            $trxMember->ebook_id = $trx->ebook_id;
            $trxMember->expired_at = Carbon::create(date('Y-m-d H:i:s'))->addYear(1);
            $trxMember->member_id = $idNewMember->id;
            $trxMember->status = 1;
            $trxMember->save();
          }
          //$trxMember = TransactionMember::insert($books);

          $password = strtolower(str_random(8));

          $dataEmail = (object) [
            'member' => $idNewMember,
            'password' => $password
          ];

          Employeer::where('id', $idNewMember->id)->update([
            'password' => password_hash($password, PASSWORD_BCRYPT)
          ]);

          // Mail::to($idNewMember->email)
          //   ->send(new RegisterMemberMail($dataEmail, null));

        } else if($orderType == 'BITREX04') { //witout ebbook
          $password = strtolower(str_random(8));

          $dataEmail = (object) [
            'member' => $idNewMember,
            'password' => $password
          ];

          Employeer::where('id', $idNewMember->id)->update([
            'password' => password_hash($password, PASSWORD_BCRYPT)
          ]);

          Mail::to($idNewMember->email)
            ->send(new RegisterMemberMail($dataEmail, null));
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
      return view($view)->with([
        'prodDesc' => $prodDesc,
        'code' => $code
      ]);

    } catch(\Illuminate\Database\QueryException $e) {
      DB::rollback();
      return response()->json([
        'success' => false,
        'error' => $e
      ]);
    }
  }
}
