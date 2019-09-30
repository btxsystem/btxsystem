<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WithdrawalTime;
use Alert;

class WithdrawalTimeController extends Controller
{
    public function index()
    {
        $times = WithdrawalTime::all();  
        return view('admin.withdrawal-time.index', compact('times'));
    }

    public function update(Request $request, $id)
    {
       
        $data = WithdrawalTime::findOrFail($id);

        $lastdate = $request->last_withdrawal ? $request->last_withdrawal : $data->last_withdrawal;

        if($lastdate > $request->next_withdrawal) {
            Alert::error('Withdrawal selanjutnya tidak boleh kurang dari withdrawal terakhir', 'Gagal')->persistent("Close");
            return redirect()->back();
        }

        $data->last_withdrawal =  $request->last_withdrawal ? $request->last_withdrawal : $data->last_withdrawal;
        $data->next_withdrawal = $request->next_withdrawal;
        $data->save();
        

        Alert::success('Sukses Update Data', 'Sukses')->persistent("Close");
        return redirect()->back();
    }
}
