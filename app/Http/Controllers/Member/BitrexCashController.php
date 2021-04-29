<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\HistoryBitrexCash;
use DataTables;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;
use App\Mail\Withdrawsuccess;
use Carbon\Carbon;
use App\Helpers\BCA;

class BitrexCashController extends Controller
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

    public function index()
    {
        $data = Auth::user();
        return view('frontend.bitrex-money.bitrex-cash')->with('profile',$data);
    }

    public function getHistoryCash(){
        $data = Auth::user();
        $history = HistoryBitrexCash::where('id_member',$data->id)->orderBy('created_at','desc')->paginate(4);
        return response()->json(['cash'=>$history]);
    }

    public function resendOTP(){
        $otp = rand(1000,9999);
        $min = Carbon::create(date('Y-m-d H:i:s'))->addMinutes(3);
        $is_available = DB::table('otp_withdrawal')->where('member_id',Auth::id())->select('id')->first();
        if ($is_available) {
            DB::table('otp_withdrawal')->where('member_id', Auth::id())->update(['otp' => $otp, 'expired_at' => $min, 'updated_at' => now()]);
        }
        $dataEmail = (object) [
            'otp' => $otp,
            'time' => '180 second',
            'description' => 'OTP Code for withdrawal'
        ];
        if (filter_var(Auth::user()->email, FILTER_VALIDATE_EMAIL)) {
            //Mail::to('dhadhang.efendi@gmail.com')->send(new OldMemberMail($dataEmail));
            Mail::to(Auth::user()->email)->send(new OTPMail($dataEmail));
        }
        $data = [
            'otp' => $otp,
            'minute' => 180,
            'description' => 'success',
        ];
        $status = 200;
        return response()->json($data, $status);
    }

    public function sendOTP(Request $request){
        $cek_otp = DB::table('otp_withdrawal')->where('member_id', Auth::id())->select('otp','expired_at')->first();
        $data_response = [];
        if ($cek_otp->otp == $request->otp && $cek_otp->expired_at >= now()) {
            if(Auth::user()->bank_name == 'BCA'){
                $date = date("Y-m-d");
                $accountnumber = "1112154440223";
                $amount = $request->nominal;
                $remark1 = "Auto withdraw";
                $remark2 = "Auto withdraw";
                $transactionId = substr(Auth::user()->id_member, -4).rand(1000,9999);
                $referenceId = 'BITREXGO/WD/'.date("Ymd/").$transactionId;

                $bca = new BCA;
                $response = $bca->transfer($date, $accountnumber, $amount, $remark1, $remark2, $transactionId, $referenceId);
                $data = json_encode($response);
                if($data == '"Success"') {
                    try {
                        DB::beginTransaction();
                        DB::table('history_bitrex_cash')->insert(['id_member' => Auth::user()->id, 'nominal' => $request->nominal, 'created_at' => now(), 'updated_at' => now(), 'description' => $remark1.' (Admin Charge IDR 5000)', 'info' => 0, 'type' => 5, 'transaction_id' => $transactionId,'reference_id' => $referenceId]);
                        DB::table('employeers')->where('id', Auth::user()->id)->update(['bitrex_cash' => Auth::user()->bitrex_cash -= $request->nominal + 5000, 'updated_at' => now()]);
                        DB::commit();
                        $data_response = [
                            'status' => $data,
                        ];
                        $dataEmail = (object) [
                            'amount' => $request->nominal,
                            'description' => 'Auto withdrawal (Admin Charge IDR 5000)',
                            'transaction_id' => $transactionId,
                            'reference_id' => $referenceId
                        ];
                        if (filter_var(Auth::user()->email, FILTER_VALIDATE_EMAIL)) {
                            //Mail::to('dhadhang.efendi@gmail.com')->send(new OldMemberMail($dataEmail));
                            Mail::to(Auth::user()->email)->send(new Withdrawsuccess($dataEmail));
                        }
                    }catch (\Exception $e) {
                        DB::rollback();
                        $data_response = [
                            'status' => 'Something wrong',
                        ];
                    }
                }else{
                    $data_response = [
                        'status' => $data,
                    ];
                }
            }else{
                $date = date("Y-m-d");
                $accountnumber = "0201245501";
                $accountname = Auth::user()->bank_account_name;
                $bankcode = Auth::user()->bank_name;
                $amount = $request->nominal;
                $remark1 = "Auto Withdraw";
                $remark2 = "Auto Withdraw";
                $transactionId = substr(Auth::user()->id_member, -4).rand(1000,9999);
                $referenceId = 'BITREXGO/WD/'.date("Ymd/").$transactionId;

                $bca = new BCA;
                $response = $bca->domesticTransfer($date, $accountnumber, $accountname, $bankcode, $amount, $remark1, $remark2, $transactionId, $referenceId);

                $data = json_encode($response);
                if($data == '"Success"') {
                    try {
                        DB::beginTransaction();
                        DB::table('history_bitrex_cash')->insert(['id_member' => Auth::user()->id, 'nominal' => $request->nominal, 'created_at' => now(), 'updated_at' => now(), 'description' => $remark1.' (Admin Charge IDR 5000)', 'info' => 0, 'type' => 5, 'transaction_id' => $transactionId,'reference_id' => $referenceId]);
                        DB::table('employeers')->where('id', Auth::user()->id)->update(['bitrex_cash' => Auth::user()->bitrex_cash -= $request->nominal + 5000, 'updated_at' => now()]);
                        DB::commit();
                        $data_response = [
                            'status' => $data,
                        ];
                        $dataEmail = (object) [
                            'amount' => $request->nominal,
                            'description' => 'Auto withdrawal (Admin Charge IDR 5000)',
                            'transaction_id' => $transactionId,
                            'reference_id' => $referenceId
                        ];
                        if (filter_var(Auth::user()->email, FILTER_VALIDATE_EMAIL)) {
                            //Mail::to('dhadhang.efendi@gmail.com')->send(new OldMemberMail($dataEmail));
                            Mail::to(Auth::user()->email)->send(new Withdrawsuccess($dataEmail));
                        }
                    }catch (\Exception $e) {
                        DB::rollback();
                        $data_response = [
                            'status' => 'Something wrong',
                        ];
                    }
                }else{
                    $data_response = [
                        'status' => $data,
                    ];
                }
            }
        }else{
            $data_response = [
                'status' => 'OTP is wrong',
            ];
        }
       return response()->json($data_response, 200);
    }

    public function withdrawal(Request $request){
        if ((Auth::user()->bitrex_cash+5000) >= $request->nominal) {
            $otp = rand(1000,9999);
            $min = Carbon::create(date('Y-m-d H:i:s'))->addMinutes(3);
            $is_available = DB::table('otp_withdrawal')->where('member_id',Auth::id())->select('id')->first();
            if (!$is_available) {
                DB::table('otp_withdrawal')->insert(['member_id' => Auth::id(), 'otp' => $otp, 'expired_at' => $min , 'created_at' => now(), 'updated_at' => now()]);
            }else{
                DB::table('otp_withdrawal')->where('member_id', Auth::id())->update(['otp' => $otp, 'expired_at' => $min, 'updated_at' => now()]);
            }
            $dataEmail = (object) [
                'otp' => $otp,
                'time' => '180 second',
                'description' => 'OTP Code for withdrawal'
            ];
            if (filter_var(Auth::user()->email, FILTER_VALIDATE_EMAIL)) {
                //Mail::to('dhadhang.efendi@gmail.com')->send(new OldMemberMail($dataEmail));
                Mail::to(Auth::user()->email)->send(new OTPMail($dataEmail));
            }
            $data = [
                'otp' => $otp,
                'minute' => 180,
                'nominal' => $request->nominal,
                'description' => 'success',
            ];
            $status = 200;
        }else{
            $data = [
                'description' => 'nominal value must be less than or equal to the bitrex value'
            ];
            $status = 500;
        }
        return response()->json($data, $status);
    }
}
