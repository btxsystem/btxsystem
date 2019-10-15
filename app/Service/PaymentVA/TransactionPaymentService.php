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
            dd('masuk');
        }elseif($method == "transactionNonMember"){
            dd('masuk');
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