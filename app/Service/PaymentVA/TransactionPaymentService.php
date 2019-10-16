<?php

namespace App\Service\PaymentVa;
use App\Models\NonMember;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\VirtualAccountMail as VaMail;

class TransactionPaymentService
{
    public function __construct(){}
    
    public function __call($method , $parameter){
        if($method == "transactionMember"){
            $type_ebook = '';
            switch ($parameter[1]) {
                case 1:
                    $type_ebook = 'Buy Ebook (Basic)';
                    break;
                case 2:
                    $type_ebook = 'Buy Ebook (Advance)';
                    break;
                case 3:
                    $type_ebook = 'Buy Ebook (Renewal Basic)';
                    break;
                case 4:
                    $type_ebook = 'Buy Ebook (Renewal Advance)';
                    break;
            }
            try {
                $product_detail = [
                    'user_id' => $parameter[0],
                    'ebook_id' => $parameter[1],
                    'ebook_renewal_id' => $parameter[2],
                    'member_id' => $parameter[0],
                    'renewal' => $parameter[2] != null ? true : false
                ];
                $arr_tojson = json_encode($product_detail);
                DB::beginTransaction();
                $trx = DB::table('transaction_bills')->insertGetId(['user_id' => $parameter[0], 'product_type' => 'ebook', 'user_type' => $parameter[3],'customer_number' => $parameter[5], 'total_amount' => $parameter[4], 'created_at' => now(), 'updated_at' => now()]);
                DB::table('transaction_bills_details')->insert(['transaction_bill_id'=>$trx, 'bill_number'=>$parameter[4],  'product_detail'=>$arr_tojson, 'created_at' => now(), 'updated_at' => now()]);
                $dataEmail = (object) [
                    'amount' => $parameter[4],
                    'description' => $type_ebook,
                    'no_invoice' => '11210'.$parameter[5]
                ];
                
                if (filter_var(Auth::user()->email, FILTER_VALIDATE_EMAIL)) {
                    //Mail::to('dhadhang.efendi@gmail.com')->send(new OldMemberMail($dataEmail));
                    Mail::to(Auth::user()->email)->send(new VaMail($dataEmail));
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
        }elseif($method == "transactionNonMember"){
            $type_ebook = '';
            switch ($parameter[1]) {
                case 1:
                    $type_ebook = 'Buy Ebook (Basic)';
                    break;
                case 2:
                    $type_ebook = 'Buy Ebook (Advance)';
                    break;
                case 3:
                    $type_ebook = 'Buy Ebook (Renewal Basic)';
                    break;
                case 4:
                    $type_ebook = 'Buy Ebook (Renewal Advance)';
                    break;
            }
            try {
                $product_detail = [
                    'user_id' => $parameter[0],
                    'ebook_id' => $parameter[1],
                    'ebook_renewal_id' => $parameter[2],
                    'member_id' => $parameter[0],
                    'renewal' => $parameter[2] != null ? true : false
                ];
                $arr_tojson = json_encode($product_detail);
                DB::beginTransaction();
                $trx = DB::table('transaction_bills')->insertGetId(['user_id' => $parameter[0], 'product_type' => 'ebook', 'user_type' => $parameter[3],'customer_number' => $parameter[5], 'total_amount' => $parameter[4], 'created_at' => now(), 'updated_at' => now()]);
                DB::table('transaction_bills_details')->insert(['transaction_bill_id'=>$trx, 'bill_number'=>$parameter[4],  'product_detail'=>$arr_tojson, 'created_at' => now(), 'updated_at' => now()]);
                $dataEmail = (object) [
                    'amount' => $parameter[4],
                    'description' => $type_ebook,
                    'no_invoice' => '11210'.$parameter[5]
                ];
                
                if (filter_var(Auth::user()->email, FILTER_VALIDATE_EMAIL)) {
                    //Mail::to('dhadhang.efendi@gmail.com')->send(new OldMemberMail($dataEmail));
                    Mail::to(Auth::user()->email)->send(new VaMail($dataEmail));
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
        }elseif($method == "topup"){
            try {
                $product_detail = [
                    'nominal' => $parameter[1],
                    'points' => $parameter[1]/1000,
                    'description' => 'Topup Bitrex Point From Virtual Account'
                ];
                $arr_tojson = json_encode($product_detail);
                DB::beginTransaction();
                $trx = DB::table('transaction_bills')->insertGetId(['user_id' => $parameter[0], 'product_type' => 'topup', 'user_type' => 'member','customer_number' => $parameter[2], 'total_amount' => $parameter[1], 'created_at' => now(), 'updated_at' => now()]);
                DB::table('transaction_bills_details')->insert(['transaction_bill_id'=>$trx, 'bill_number'=>$parameter[2],  'product_detail'=>$arr_tojson, 'created_at' => now(), 'updated_at' => now()]);
                $dataEmail = (object) [
                    'amount' => $parameter[1],
                    'description' => 'Topup Bitrex Points',
                    'no_invoice' => '11210'.$parameter[2]
                ];
                if (filter_var(Auth::user()->email, FILTER_VALIDATE_EMAIL)) {
                  //Mail::to('dhadhang.efendi@gmail.com')->send(new OldMemberMail($dataEmail));
                  Mail::to(Auth::user()->email)->send(new VaMail($dataEmail));
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
        }elseif($method == "register"){
            dd('masuk');
        }
        else{
            throw new exception("Function $method does not exists ");
        }
    }
}