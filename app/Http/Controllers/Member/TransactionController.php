<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\HistoryBitrexPoints;
use App\Models\TransactionMember;
use App\Models\TransactionNonMember;
use App\Models\PaymentHistoryMember;
use App\Models\PaymentHistoryNonMember;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use App\Mail\PurchaseBitrexPointMail;
use App\Mail\PurchaseBitrexPointTransferMail;

class TransactionController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        return view('frontend.transaction.my-transaction')->with('profile',$data);
    }

    public function myTransaction(){
        $data = DB::table('employeers')->join('transaction_member','employeers.id','=','transaction_member.member_id')
                                       ->join('ebooks','transaction_member.ebook_id','=','ebooks.id')
                                       ->where('employeers.id','=',Auth::id())
                                       ->select('ebooks.title','ebooks.price','transaction_member.created_at as date','ebooks.pv')
                                       ->orderBy('transaction_member.created_at','desc')
                                       ->paginate(4);
        return response()->json(['transaction'=>$data]);
    }

    public function transactionNonMember(){
        $data = Auth::user();
        return view('frontend.transaction.prospected-member-transaction')->with('profile',$data);
    }

    public function prospectedMemberHistory(){
        $data = DB::table('non_members')->join('transaction_non_members','non_members.id','=','transaction_non_members.non_member_id')
                                       ->join('ebooks','transaction_non_members.ebook_id','=','ebooks.id')
                                       ->where('transaction_non_members.member_id','=',Auth::id())
                                       ->select('ebooks.title','ebooks.price','ebooks.price_markup','transaction_non_members.created_at as date','non_members.username')->paginate(4);
        return response()->json(['transaction'=>$data]);
    }

    // public function topup(Request $request){

    //     return $request->all();
    //     $method = $request->input('method') ?? 'transfer';
    //     //points
    //     //nominal
    //     try {
    //         if($method == 'transfer') {
    //             return $this->paymentWithTransfer($request);
    //         } else {
    //             return $this->paymentWithIpay($request);
    //         }
    //         // DB::beginTransaction();
    //         // $data = DB::table('employeers')->where('id',Auth::id())->select('bitrex_points')->first();
    //         // DB::table('employeers')->where('id', Auth::id())->update(['bitrex_points' => $data->bitrex_points + $request->points, 'updated_at' => Carbon::now()]);
    //         // DB::table('history_bitrex_point')->insert(['id_member' => Auth::id(), 'nominal' => $request->nominal, 'points' => $request->points, 'description' => 'Topup', 'info' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
    //         // DB::commit();
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return 'gagal';
    //     }
    //     //return redirect()->route('member.bitrex-money.bitrex-points');
    // }

    public function topup(Request $request){

    
        $method = $request->input('method') ?? 'bca';

        try {
            switch($method) {
                case 'bca';
                return $this->paymentWithTransfer($request);
            break;
                case 'transfer';
                return $this->paymentWithTransfer($request);
            break;
                case 'ovo';
                return $this->paymentWithIpay($request, 63);
            break;
                case 'mandiri';
                return $this->paymentWithIpay($request, 17);
            break;
                case 'bni';
                return $this->paymentWithIpay($request, 26);
            break;
                case 'maybank';
                return $this->paymentWithIpay($request, 9);
            break;
                case 'permata';
                return $this->paymentWithIpay($request, 31);
            break;

            }

        } catch (\Exception $e) {
            DB::rollback();
            return 'gagal';
        }
    
    }

    public function paymentWithTransfer($request)
    {
        try {

            DB::beginTransaction();
            $prefixRef = 'BITREX05';

            $checkRef = DB::table('history_bitrex_point')->where('transaction_ref', $prefixRef . (time() + rand(100, 500)))->first();

            $afterCheckRef = $prefixRef . (time() + rand(100, 500));

            while($checkRef) {
                $afterCheckRef = $prefixRef . (time() + rand(100, 500));
                if(!$checkRef) {
                    break;
                }
            }

            $save = DB::table('history_bitrex_point')->insert([
                'id_member' => Auth::id(),
                'nominal' => $request->nominal,
                'points' => $request->points,
                'description' => 'Topup Bitrex Point',
                'info' => 1,
                'transaction_ref' => $afterCheckRef,
                'status' => 6,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $dataOrder = (object) [
                'amount' =>   $request->nominal,
                'ref_no' => $afterCheckRef
            ];

            Mail::to( Auth::user()->email)
            ->send(new PurchaseBitrexPointTransferMail($dataOrder, null));

            DB::commit();

            return view('payment.transfer')->with([
                'transactionRef' => $afterCheckRef,
                'prodDesc' => "Topup {$request->points} Point",
                'code' => $afterCheckRef,
                'total' => number_format($request->nominal, 2)
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back();
        }
    }

    public function paymentWithIpay($request, $payment_method = null)
    {   

        try {
            DB::beginTransaction();
            $prefixRef = 'BITREX05';

            $checkRef = DB::table('history_bitrex_point')->where('transaction_ref', $prefixRef . (time() + rand(100, 500)))->first();

            $afterCheckRef = $prefixRef . (time() + rand(100, 500));

            while($checkRef) {
                $afterCheckRef = $prefixRef . (time() + rand(100, 500));
                if(!$checkRef) {
                    break;
                }
            }

            $save = DB::table('history_bitrex_point')->insert([
                'id_member' => Auth::id(),
                'nominal' => $request->nominal,
                'points' => $request->points,
                'description' => 'Topup',
                'info' => 1,
                'transaction_ref' => $afterCheckRef,
                'status' => 6,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $orderAmount = (int) $request->nominal;

            

            $data['merchant_key'] = env('IPAY_MERCHANT_KEY');
            $data['merchant_code'] = env('IPAY_MERCHANT_CODE');
            $data['currency'] = "IDR";
            $data['payment_id'] = $payment_method == null ? 1 : $payment_method ;
            $data['product_desc'] = "Topup {$request->points} Bitrex Point";
            $data['user_name'] = Auth::user()->username;
            $data['user_email'] = Auth::user()->email;
            $data['ref_no'] = $afterCheckRef;
            $data['lang'] = 'UTF-8';
            // $data['code'] = $subs->created_at->format('dmYHi');
            $data['code'] = $afterCheckRef;
            $data['amount'] = (int) str_replace(".","",str_replace(",","",number_format($orderAmount, 2, ".", "")));
            $data['signature'] = $this->signature($data['code'], $data['amount']);
            $data['response_url'] = url('response-pay-topup');
            $data['backend_url'] = url('backend-response-pay');

            DB::commit();

            return view('payment.form')
                ->with([
                'data' => $data
            ]);
        } catch(\Illuminate\Database\QueryException $e) {
            DB::rollback();
            return response()->json([
                'data' => $e
            ]);
        }
    }

    public function paymentConfirmation(Request $request)
    {
        try {
            DB::beginTransaction();
            $type = $request->input('type');
            $status = $request->input('status');
            $invoice_number = $request->input('invoice_number');
            $account_name = $request->input('account_name');
            $account_number = $request->input('account_number');
            $bank_name = $request->input('bank_name');
            $amount = $request->input('amount');
            $user_id = null;
            $username = '';
            $userType = 'unknown';

            $imageName = null;

            if($invoice_number != '') {
              $orderType = substr($invoice_number, 0, 8);

              if($orderType == 'BITREX05') {
                $messageError = 'Topup Bitrex Point';
                $type = 'topup_bitrex_point';
                $userType = 'member';
              } else if($orderType == 'BITREX02') {
                $type = 'ebook';
                $messageError = 'Ebook Member';
                $userType = 'member';
              } else if($orderType == 'BITREX01') {
                $messageError = 'Ebook Non Member';
                $type = 'ebook_non_member';
                $userType = 'nonmember';
              } else {
                return response()->json([
                    'message' => 'Transaction not found or invalid billing type. Please try again.',
                    'success' => false
                ]);
              }

              if($selectType = $request->input('type')) {
                  if($selectType != $type) {
                    return redirect()->back()->with([
                        'message' => "Transaction Type Should be {$messageError}. Please try again.",
                        'success' => false
                    ]);
                  }
              }
            }

            // $hasConfirmation = DB::table('transfer_confirmations')
            //     ->where('invoice_number', $invoice_number)->count();
            //
            // if($hasConfirmation > 0) {
            //     return redirect()->back()->with([
            //         'error' => 'Transfer Confirmation Already Exists.'
            //     ]);
            // }

            if($type == 'topup_bitrex_point') {
                $check  = HistoryBitrexPoints::where('transaction_ref', $invoice_number)->where('status', '=', 1)->first();

                if($check) {
                    // return redirect()->back()->with([
                    //     'error' => 'Transaction not found or invalid billing type. Please try again.'
                    // ]);
                    return response()->json([
                        'message' => 'Transaction not found or invalid billing type. Please try again.',
                        'success' => false
                    ]);
                }

                $username  = HistoryBitrexPoints::where('transaction_ref', $invoice_number)->first()->member->username;

                $user_id = HistoryBitrexPoints::where('transaction_ref', $invoice_number)->first()->member->id;

            } else if($type == 'ebook') {
                $orderType = substr($invoice_number, 0, 8);

                if($orderType == 'BITREX01') {
                    $check = TransactionNonMember::where('transaction_ref', $invoice_number)->where('status', '=', 1)->first();

                    if($check) {
                        // return redirect()->back()->with([
                        //     'error' => 'Transaction not found or invalid billing type. Please try again.'
                        // ]);
                        return response()->json([
                            'message' => 'Transaction not found or invalid billing type. Please try again.',
                            'success' => false
                        ]);
                    }

                    $username  = TransactionNonMember::where('transaction_ref', $invoice_number)->first()->nonMember->username;

                    $user_id = TransactionNonMember::where('transaction_ref', $invoice_number)->first()->nonMember->id;

                } else if($orderType == 'BITREX02') {
                    $check = TransactionMember::where('transaction_ref', $invoice_number)->where('status', '=', 1)->first();

                    if($check) {
                        // return redirect()->back()->with([
                        //     'error' => 'Transaction not found or invalid billing type. Please try again.'
                        // ]);
                        return response()->json([
                            'message' => 'Transaction not found or invalid billing type. Please try again.',
                            'success' => false
                        ]);
                    }

                    $username  = TransactionMember::where('transaction_ref', $invoice_number)->first()->member->username;
                    $user_id = TransactionMember::where('transaction_ref', $invoice_number)->first()->member->id;
                } else {
                    // return redirect()->back()->with([
                    //     'error' => 'Transaction not found. Please try again.'
                    // ]);
                    return response()->json([
                        'message' => 'Transaction not found. Please try again.',
                        'success' => false
                    ]);
                }
            } else if($type == 'ebook_non_member') {
              $check = PaymentHistoryNonMember::where('ref_no', $invoice_number)->where('status', '=', 1)->first();

              if($check) {
                //   return redirect()->back()->with([
                //       'error' => 'Transaction not found or invalid billing type. Please try again.'
                //   ]);
                return response()->json([
                    'message' => 'Transaction not found or invalid billing type. Please try again.',
                    'success' => false
                ]);
              }

              $username = PaymentHistoryNonMember::where('ref_no', $invoice_number)->first()->nonMember->username;
              $user_id = PaymentHistoryNonMember::where('ref_no', $invoice_number)->first()->nonMember->id;
            } else {
                // return redirect()->back()->with([
                //     'error' => 'Transaction not found. Please try again.'
                // ]);
                return response()->json([
                    'message' => 'Transaction not found. Please try again.',
                    'success' => false
                ]);
            }

            if($request->hasFile('image')) {
                $this->validate($request, [
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:25360',
                ]);
                $imageName = time().'.'.request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/transfer-confirmation/'), $imageName);
            }

            DB::table('transfer_confirmations')->insert([
                'type' => $type,
                'username' => $username,
                'user_type' => $userType,
                'user_id' => $user_id,
                'status' => 0,
                'invoice_number' => $invoice_number,
                'account_name' => $account_name,
                'account_number' => $account_number,
                'bank_name' => $bank_name,
                'amount' => $amount,
                'image' => $imageName != null ? "upload/transfer-confirmation/" . $imageName : '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            DB::commit();

            // return redirect()->back()->with([
            //     'message' => 'Transfer Confirmation Success. Please wait for our verification.'
            // ]);
            return response()->json([
                'message' => 'Transfer Confirmation Success. Please wait for our verification',
                'success' => true
            ]);
        } catch (\Exception $e){
            // return redirect()->back()->with([
            //     'error' => $e
            // ]);
            return response()->json([
                'message' => $e,
                'success' => false
            ]);
        }

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
            if($status == "1") {
                DB::beginTransaction();
                $checkRef = HistoryBitrexPoints::where('transaction_ref', $code);

                $data = DB::table('employeers')->where('id',$checkRef->first()->id_member)->select('bitrex_points', 'email')->first();


                DB::table('employeers')->where('id', $checkRef->first()->id_member)->update(['bitrex_points' => $data->bitrex_points + $checkRef->first()->points, 'updated_at' => Carbon::now()]);

                $checkRef->update([
                    'status' => 1
                ]);

                $dataOrder = (object) [
                    'amount' =>   $amount,
                    'point' => $data->bitrex_points
                ];

                Mail::to($data->email ?? 'asepmedia18@gmail.com')
                ->send(new PurchaseBitrexPointMail($dataOrder, null));


                DB::commit();

                return view('payment.success-topup')->with([
                    'prodDesc' => $prodDesc,
                    'code' => $code
                ]);
            } else {
                DB::rollback();
                return view('payment.failed-topup');
            }

        } catch(\Illuminate\Database\QueryException $e) {
            DB::rollback();
            return response()->json([
              'success' => false,
              'error' => $e
            ]);
          }
    }
}
