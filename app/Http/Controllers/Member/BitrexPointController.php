<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\HistoryBitrexPoints;
use App\HistoryBitrexCash;
use App\Employeer;
use App\Service\PaymentVa\TransactionPaymentService as Va;
use DataTables;
use DB;
use Alert;

class BitrexPointController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        return view('frontend.bitrex-money.bitrex-points')->with('profile',$data);
    }

    public function store(Request $request){

        $date = now();

        do {
            $no_invoice = date_format($date,"ymdh").rand(100,999);
            $cek = DB::table('transaction_bills')->where('customer_number',$no_invoice)->select('id')->get();
        } while (count($cek)>0);

        $data = [
            'user_id' => Auth::user()->id,
            'product_type' => 'topup',
            'user_type' => 'member',
            'total_amount' => $request->nominal+2750,
            'customer_number' => '11210'.$no_invoice
        ];

        $va = new Va;
        $va->topup(Auth::user()->id, $request->nominal+2750, $no_invoice);

        return response()->json($data, 200);
    }

    public function getHistoryPoints(){
        $data = Auth::user();
        $history = HistoryBitrexPoints::where('id_member',$data->id)->orderBy('created_at','desc')->where('status',1)->paginate(4);
        return response()->json(['points'=>$history]);
    }

    public function getBitrexPoints(){
        $data = DB::table('employeers')->where('id',Auth::id())->select('bitrex_points')->first();
        return response()->json($data, 200);
    }

    public function convertBitrexPoints(Request $request){
        if (Auth::user()->bitrex_points >= $request['points-convert']) {
            $data['bitrex_points'] = Auth::user()->bitrex_points - $request['points-convert'];
            $data['bitrex_cash'] = Auth::user()->bitrex_cash + $request['bitrex-val'];
            try {
                DB::beginTransaction();
                Employeer::find(Auth::id())->update($data);
                HistoryBitrexCash::create(['id_member' => Auth::id(), 'nominal' => $request['bitrex-val'], 'description' => "Conver from bitrex points", 'info' => 1, 'type' => 6 ]);
                HistoryBitrexPoints::create(['id_member' => Auth::id(), 'nominal' => $request['bitrex-val'], 'points' => $request['points-convert'], 'description' => "Conver to bitrex value", 'info' => 0, 'status' => 1 ]);
                DB::commit();
                Alert::success('Please convert bitrex points to bitrex value', 'Success')->persistent("OK");
            } catch (\Throwable $th) {
                DB::rollback();
                Alert::error('Something Error', 'Error')->persistent("OK");
            }
        } else {
            Alert::error('Your bitrex points less', 'Error')->persistent("OK");
        }
       return redirect()->route('member.bitrex-money.bitrex-points');
    }
}
