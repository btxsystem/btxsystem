<?php

namespace App\Http\Controllers\MemberV2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;

use App\Employeer;
use App\Builder\NonMemberBuilder;
use App\Builder\PaymentHistoryBuilder;
use App\Builder\TransactionMemberBuilder;
use App\Builder\TransactionNonMemberBuilder;

use App\Factory\RegisterFactoryMake;
use App\Factory\PaymentHistoryFactoryBuild;
use App\Factory\TransactionFactoryRegister;
use App\Models\Ebook;
use App\Models\TransactionMember;
use App\Models\TransactionNonMember;
use Illuminate\Support\Carbon;

use App\Service\PaymentVa\TransactionPaymentService as Va;


class EbookController extends Controller
{
    public function store(Request $request){
        $ebook = Ebook::where('id',$request->ebook_id)
            ->select('id','price', 'price_markup', 'parent_id', 'price_discount', 'minimum_product', 'started_at', 'ended_at', 'maximum_product', 'register_promotion')
            ->first();

        $ebookIdDiscount = 0;

        if (\Auth::guard('user')->user()) {

            $date = now();

            do {
                $no_invoice = date_format($date,"ymdh").rand(100,999);
                $cek = DB::table('transaction_bills')->where('customer_number',$no_invoice)->select('id')->get();
            } while (count($cek)>0);
            $price = $ebook->price+2750;
            $user = Auth::user();
            $haveExistEbook = TransactionMember::where('member_id', $user->id)->where('expired_at', '>', Carbon::now())->where('ebook_id',$ebook->id)->first();

            if($user->total_product >= $ebook->minimum_product && $user->total_product <= $ebook->maximum_product && $ebook->is_promotion == 1 && $haveExistEbook && $user->status!=0) {
                if($ebook->price_discount > 0) {
                    $price -= (int) $ebook->total_price_discount;
                    $ebookIdDiscount = $ebook->id;
                }
            }

            $data = [
                'user_id' => Auth::user()->id,
                'ebook' => $ebook,
                'product_type' => 'ebook',
                'user_type' => 'member',
                'total_amount' => number_format($price,0,",","."),
                'customer_number' => '11210'.$no_invoice,
                'time_expired' => Carbon::create(date('Y-m-d H:i:s'))->addDay(1),
            ];

            // $renewal = $request->ebook_id == 3 || $request->ebook_id == 4 ? $request->ebook_id : null;
            $renewal = $ebook->parent_id == 0 ? null : $ebook->id;

            $va = new Va;
            $va->transactionMember(Auth::user()->id, $request->ebook_id, $renewal, 'member', $price, $no_invoice, $ebookIdDiscount);

            return response()->json($data, 200);
        }else if(\Auth::guard('nonmember')->user()){
            $referral = Employeer::select('id')->where('username', $request->input('referral'))->first()->id;
            $id = \Auth::guard('nonmember')->id();
            $date = now();

            do {
                $no_invoice = date_format($date,"ymdh").rand(100,999);
                $cek = DB::table('transaction_bills')->where('customer_number',$no_invoice)->select('id')->get();
            } while (count($cek)>0);

            $price = $ebook->price+2750;
            $user = Auth::guard('nonmember')->user();

            if(($user->total_product >= $ebook->minimum_product && $user->total_product <= $ebook->maximum_product) && $ebook->is_promotion == 1) {
                if($ebook->price_discount > 0) {
                    $price -= (int) ($ebook->price * $ebook->price_discount) / 100;
                    $ebookIdDiscount = $ebook->id;
                }
            }

            $data = [
                'user_id' => $id,
                'product_type' => 'ebook_nonmember',
                'user_type' => 'nonmember',
                'total_amount' => number_format($price+$ebook->price_markup,0,",","."),
                'customer_number' => '11210'.$no_invoice,
                'time_expired' => Carbon::create(date('Y-m-d H:i:s'))->addDay(1),
            ];

            // $renewal = $request->ebook_id == 3 || $request->ebook_id == 4 ? $request->ebook_id : null;
            $renewal = $ebook->parent_id == 0 ? null : $ebook->id;

            $va = new Va;
            $va->transactionNonMember($id, $request->ebook_id, $renewal, 'nonmember', $price, $no_invoice, $ebookIdDiscount, $referral);

            return response()->json($data, 200);
        } else {
            $referral = Employeer::select('id')->where('username', $request->input('referral'))->first()->id;
            $id = $request->non_member_id;
            $date = now();

            do {
                $no_invoice = date_format($date,"ymdh").rand(100,999);
                $cek = DB::table('transaction_bills')->where('customer_number',$no_invoice)->select('id')->get();
            } while (count($cek)>0);

            $price = $ebook->price+2750;

            if($ebook->minimum_product == 0 && $ebook->is_promotion == 1) {
                if($ebook->price_discount > 0) {
                    $price -= (int) ($ebook->price * $ebook->price_discount) / 100;
                    $ebookIdDiscount = $ebook->id;
                }
            }

            $data = [
                'user_id' => $id,
                'product_type' => 'ebook_nonmember',
                'user_type' => 'nonmember',
                'total_amount' => number_format($price+$ebook->price_markup,0,",","."),
                'customer_number' => '11210'.$no_invoice,
                'time_expired' => Carbon::create(date('Y-m-d H:i:s'))->addDay(1),
            ];

            // $renewal = $request->ebook_id == 3 || $request->ebook_id == 4 ? $request->ebook_id : null;
            $renewal = $ebook->parent_id == 0 ? null : $ebook->id;

            $va = new Va;
            $va->transactionNonMember($id, $request->ebook_id, $renewal, 'nonmember', $price, $no_invoice, $ebookIdDiscount, $referral);

            return response()->json($data, 200);
        }
    }
}
