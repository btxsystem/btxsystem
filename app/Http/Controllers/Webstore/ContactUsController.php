<?php

namespace App\Http\Controllers\Webstore;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ContactUsMail;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    /**
     * sendMessage function
     *
     * @param Request $request
     * @return void
     */
    public function sendMessage(Request $request)
    {
        try {
            $fields = ['name', 'email', 'message'];

            foreach($fields as $field) {
                $fieldRequest = $request->input($field);

                if($fieldRequest == '' || $fieldRequest == null) {
                    return redirect()->back()->with('message_failed', "Kolom " . ucwords($field) . " tidak boleh kosong.");
                }
            }

            $dataContactUs = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'message' => $request->input('message'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $contactUs = ContactUs::insert($dataContactUs);

            if(!$contactUs) return redirect()->back()->with('message_failed', 'Gagal Mengirim Pesan.');

            Mail::to('dhadhang.efendi@gmail.com')
                ->send(new ContactUsMail($dataContactUs, null));

            return redirect()->back()->with('message_success', 'Berhasil Mengirim Pesan.');
        } catch(\Exception $e) {
            return redirect()->back()->with('message_failed', 'Gagal Mengirim Pesan.');
        }
    }
}
