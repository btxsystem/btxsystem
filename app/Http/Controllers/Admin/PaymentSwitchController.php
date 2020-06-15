<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;

class PaymentSwitchController extends Controller
{
    //

    public function switchPayment(Request $request)
    {
        try {
            $update = PaymentMethod::where('id', 1)->update([
                'payment_method_name' => $request->input('payment_method')
            ]);

            if(!$update) {
                Alert::error('Gagal Mengubah Data', 'Gagal');
                return \redirect()->back();
            }

            Alert::error('Berhasil Mengubah Data', 'Berhasil');
            return \redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Gagal Mengubah Data', 'Gagal');
            return \redirect()->back();
        }
    }
}
