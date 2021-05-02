<?php

namespace App\Service\PaymentVa;
use App\Models\NonMember;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\VirtualAccountMail as VaMail;
use App\Models\Ebook;

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
                    'renewal' => $parameter[2] != null ? true : false,
                    'discount' => $parameter[6]
                ];
                $arr_tojson = json_encode($product_detail);
                DB::beginTransaction();
                $trx = DB::table('transaction_bills')->insertGetId(['user_id' => $parameter[0], 'product_type' => 'ebook', 'user_type' => $parameter[3],'customer_number' => $parameter[5], 'total_amount' => $parameter[4], 'created_at' => now(), 'updated_at' => now()]);
                DB::table('transaction_bills_details')->insert(['transaction_bill_id'=>$trx, 'bill_number'=>$parameter[4],  'product_detail'=>$arr_tojson, 'created_at' => now(), 'updated_at' => now()]);
                $dataEmail = (object) [
                    'amount' => $parameter[4].' Include fee',
                    'description' => $type_ebook,
                    'no_invoice' => '11210'.$parameter[5],
                    'time_expired' => date_format(Carbon::create(date('Y-m-d H:i:s'))->addDay(1), 'Y-m-d H:i:s'),
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
                    'member_id' => $parameter[7],
                    'renewal' => $parameter[2] != null ? true : false,
                    'discount' => $parameter[6]
                ];
                $arr_tojson = json_encode($product_detail);
                DB::beginTransaction();
                $trx = DB::table('transaction_bills')->insertGetId(['user_id' => $parameter[0], 'product_type' => 'ebook_nonmember', 'user_type' => $parameter[3],'customer_number' => $parameter[5], 'total_amount' => $parameter[4], 'created_at' => now(), 'updated_at' => now()]);
                DB::table('transaction_bills_details')->insert(['transaction_bill_id'=>$trx, 'bill_number'=>$parameter[4],  'product_detail'=>$arr_tojson, 'created_at' => now(), 'updated_at' => now()]);
                $dataEmail = (object) [
                    'amount' => $parameter[4].' Include fee',
                    'description' => $type_ebook,
                    'no_invoice' => '11210'.$parameter[5],
                    'time_expired' => Carbon::create(date('Y-m-d H:i:s'))->addDay(1),
                ];

                if (filter_var(Auth::guard('nonmember')->user()->email, FILTER_VALIDATE_EMAIL)) {
                    //Mail::to('dhadhang.efendi@gmail.com')->send(new OldMemberMail($dataEmail));
                    Mail::to(Auth::guard('nonmember')->user()->email)->send(new VaMail($dataEmail));
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
            }
        }elseif($method == "topup"){
            try {
                $product_detail = [
                    'nominal' => $parameter[1],
                    'points' => ($parameter[1]-2750)/1000,
                    'description' => 'Topup Bitrex Point From Virtual Account'
                ];
                $arr_tojson = json_encode($product_detail);
                DB::beginTransaction();
                $trx = DB::table('transaction_bills')->insertGetId(['user_id' => $parameter[0], 'product_type' => 'topup', 'user_type' => 'member','customer_number' => $parameter[2], 'total_amount' => $parameter[1], 'created_at' => now(), 'updated_at' => now()]);
                DB::table('transaction_bills_details')->insert(['transaction_bill_id'=>$trx, 'bill_number'=>$parameter[2],  'product_detail'=>$arr_tojson, 'created_at' => now(), 'updated_at' => now()]);
                $dataEmail = (object) [
                    'amount' => $parameter[1].' (Include fee 2750)',
                    'description' => 'Topup Bitrex Points',
                    'no_invoice' => '11210'.$parameter[2],
                    'time_expired' => Carbon::create(date('Y-m-d H:i:s'))->addDay(1),
                ];
                if (filter_var(Auth::user()->email, FILTER_VALIDATE_EMAIL)) {
                  //Mail::to('dhadhang.efendi@gmail.com')->send(new OldMemberMail($dataEmail));
                  Mail::to(Auth::user()->email)->send(new VaMail($dataEmail));
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
            }
        }elseif($method == "register"){
            $calculateEbookPrice = calculateEbookPriceWithPromotion($parameter[1], $parameter[1]->ebooks, 0);

            $product_detail = [
                'member' => [
                    'username' => $parameter[1]->username,
                    'first_name' => $parameter[1]->first_name,
                    'last_name' => $parameter[1]->last_name ? $parameter[1]->last_name : null,
                    'email' => $parameter[1]->email,
                    'phone_number' => $parameter[1]->phone_number,
                    'nik' => $parameter[1]->nik,
                    'npwp_number' => $parameter[1]->npwp_number ? $parameter[1]->npwp_number : null,
                    'bank_account_name' => $parameter[1]->bank_account_name,
                    'bank_account_number' => $parameter[1]->bank_account_number,
                    'bank_name' => $parameter[1]->bank_name,
                    'birthdate' => $parameter[1]->birthdate,
                    'gender' => $parameter[1]->gender,
                    'referral' => Auth::user()->username,
                ],
                'ebooks' => $parameter[1]->ebooks,
                'promotions' => $calculateEbookPrice['promotions'],
                'shipping_method' => $parameter[1]->shipping_method,
                'address' => [
                    'province_name' => $parameter[1]->province_name,
                    'city_name' => $parameter[1]->province_name,
                    'district_name' => $parameter[1]->district_name,
                    'address' => $parameter[1]->address,
                    'kurir_name' => $parameter[1]->kurir_name,
                    'cost' => $parameter[1]->cost,
                ],
                'term_one' => $parameter[1]->term_one,
                'term_two' => $parameter[1]->term_two
            ];
            $arr_tojson = json_encode($product_detail);

            $cost = 2750;
            $cost += isset($parameter[1]->kurir) ? $parameter[1]->kurir : 0;

            // foreach ($parameter[1]->ebooks as $key => $ebook) {
            //     $price_ebook = DB::table('ebooks')->where('id',$ebook)->select('price')->first();
            //     $cost += $price_ebook->price;
            // }

            $totalPriceEbook = $calculateEbookPrice['total_price'];

            $cost += $totalPriceEbook;

            $trx = DB::table('transaction_bills')
                ->insertGetId(
                    [
                        'user_id' => $parameter[0],
                        'product_type' => 'register',
                        'user_type' => 'member',
                        'customer_number' => $parameter[2],
                        'total_amount' => $cost,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                );

            DB::table('transaction_bills_details')
                ->insert(
                    [
                        'transaction_bill_id' => $trx,
                        'bill_number' => $parameter[2],
                        'product_detail' => $arr_tojson,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                );

            $dataEmail = (object) [
                'amount' => $cost.' (Include fee)',
                'description' => 'Register Member from Autoplacement',
                'no_invoice' => '11210'.$parameter[2],
                'time_expired' => Carbon::create(date('Y-m-d H:i:s'))->addDay(1),
            ];

            if (filter_var(Auth::user()->email, FILTER_VALIDATE_EMAIL)) {
                //Mail::to('dhadhang.efendi@gmail.com')->send(new OldMemberMail($dataEmail));
                Mail::to(Auth::user()->email)->send(new VaMail($dataEmail));
            }
        }elseif($method == "registerWebstore"){
            $product_detail = [
                'member' => [
                    'username' => $parameter[1]->username,
                    'first_name' => $parameter[1]->firstName,
                    'last_name' => $parameter[1]->lastName ? $parameter[1]->lastName : null,
                    'email' => $parameter[1]->email,
                    'phone_number' => $parameter[1]->phone_number,
                    'nik' => $parameter[1]->nik ? $parameter[1]->nik : null,
                    'npwp_number' => $parameter[1]->npwp_number ? $parameter[1]->npwp_number : null,
                    'bank_account_name' => $parameter[1]->bank_account_name,
                    'bank_account_number' => $parameter[1]->bank_account_number,
                    'bank_name' => $parameter[1]->bank_name,
                    'birthdate' => date('Y-m-d', strtotime(str_replace(" ", "-", $parameter[1]->birthdate))),
                    'gender' => $parameter[1]->gender,
                    'referral' => $parameter[1]->referral,
                ],
                'ebooks' => $parameter[1]->ebooks,
                'shipping_method' => $parameter[1]->shipping,
                'address' => [
                    'province_name' => $parameter[1]->province_name,
                    'city_name' => $parameter[1]->province_name,
                    'district_name' => $parameter[1]->district_name,
                    'address' => $parameter[1]->address,
                    'kurir_name' => $parameter[1]->kurir_name,
                    'cost' => $parameter[1]->postalFee,
                ],
                'term_one' => $parameter[1]->term_one,
                'term_two' => $parameter[1]->term_two
            ];
            $arr_tojson = json_encode($product_detail);

            $cost = 2750;
            $cost += isset($parameter[1]->postalFee) ? (int) $parameter[1]->postalFee : 0;

            foreach ($parameter[1]->ebooks as $key => $ebook) {
                $price_ebook = DB::table('ebooks')->where('id',$ebook)->select('price')->first();
                $cost += (int) $price_ebook->price;
            }

            DB::beginTransaction();

            $trx = DB::table('transaction_bills')
                ->insertGetId(
                    [
                        'user_id' => $parameter[0],
                        'product_type' => 'register',
                        'user_type' => 'member',
                        'customer_number' => $parameter[2],
                        'total_amount' => $cost,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                );

            DB::table('transaction_bills_details')
                ->insert(
                    [
                        'transaction_bill_id' => $trx,
                        'bill_number' => $parameter[2],
                        'product_detail' => $arr_tojson,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                );

            DB::commit();

            $dataEmail = (object) [
                'amount' => $cost.' (Include fee)',
                'description' => 'Register Member from Autoplacement',
                'no_invoice' => "11210{$parameter[2]}",
                'time_expired' => Carbon::create(date('Y-m-d H:i:s'))->addDay(1),
            ];

            if (filter_var($parameter[1]->email, FILTER_VALIDATE_EMAIL)) {
                //Mail::to('dhadhang.efendi@gmail.com')->send(new OldMemberMail($dataEmail));
                Mail::to($parameter[1]->email)->send(new VaMail($dataEmail));
            }

            return [
                'amount' => (int) $cost,
                'no_invoice' => "11210{$parameter[2]}",
                'time_expired' => Carbon::create(date('Y-m-d H:i:s'))->addDay(1),
            ];
        }else{
            throw new exception("Function $method does not exists ");
        }
    }
}
