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

use App\Models\TransactionMember;
use App\Models\TransactionNonMember;
use Illuminate\Support\Carbon;

use App\Service\PaymentVa\TransactionPaymentService as Va;


class EbookController extends Controller
{
    public function store(Request $request){
        $ebook = DB::table('ebooks')->where('id',$request->ebook_id)->select('price', 'price_markup')->first();
        if (\Auth::guard('user')->user()) {

            $date = now();

            do {
                $no_invoice = date_format($date,"ymdh").rand(100,999);
                $cek = DB::table('transaction_bills')->where('customer_number',$no_invoice)->select('id')->get();
            } while (count($cek)>0);

            $data = [
                'user_id' => Auth::user()->id,
                'product_type' => 'ebook',
                'user_type' => 'member',
                'total_amount' => number_format($ebook->price+2750,0,",","."),
                'customer_number' => '11210'.$no_invoice,
                'time_expired' => Carbon::create(date('Y-m-d H:i:s'))->addDay(1),
            ];

            $renewal = $request->ebook_id == 3 || $request->ebook_id == 4 ? $request->ebook_id : null;

            $va = new Va;
            $va->transactionMember(Auth::user()->id, $request->ebook_id, $renewal, 'member', $ebook->price+2750, $no_invoice);

            return response()->json($data, 200);
        }else if(\Auth::guard('nonmember')->user()){
            $id = \Auth::guard('nonmember')->id();
            $date = now();

            do {
                $no_invoice = date_format($date,"ymdh").rand(100,999);
                $cek = DB::table('transaction_bills')->where('customer_number',$no_invoice)->select('id')->get();
            } while (count($cek)>0);

            $data = [
                'user_id' => $id,
                'product_type' => 'ebook',
                'user_type' => 'nonmember',
                'total_amount' => number_format($ebook->price+$ebook->price_markup+2750,0,",","."),
                'customer_number' => '11210'.$no_invoice,
                'time_expired' => Carbon::create(date('Y-m-d H:i:s'))->addDay(1),
            ];

            $renewal = $request->ebook_id == 3 || $request->ebook_id == 4 ? $request->ebook_id : null;

            $va = new Va;
            $va->transactionNonMember($id, $request->ebook_id, $renewal, 'nonmember', $ebook->price+2750, $no_invoice);

            return response()->json($data, 200);
        } else {
            $id = $request->non_member_id;
            $date = now();

            do {
                $no_invoice = date_format($date,"ymdh").rand(100,999);
                $cek = DB::table('transaction_bills')->where('customer_number',$no_invoice)->select('id')->get();
            } while (count($cek)>0);

            $data = [
                'user_id' => $id,
                'product_type' => 'ebook',
                'user_type' => 'nonmember',
                'total_amount' => number_format($ebook->price+$ebook->price_markup+2750,0,",","."),
                'customer_number' => '11210'.$no_invoice,
                'time_expired' => Carbon::create(date('Y-m-d H:i:s'))->addDay(1),
            ];

            $renewal = $request->ebook_id == 3 || $request->ebook_id == 4 ? $request->ebook_id : null;

            $va = new Va;
            $va->transactionNonMember($id, $request->ebook_id, $renewal, 'nonmember', $ebook->price+2750, $no_invoice);

            return response()->json($data, 200);
        }
    }
}
