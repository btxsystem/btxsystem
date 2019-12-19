<?php

namespace App\Http\Controllers\Payment\Midtrans;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\V2\PaymentMidtrans as Donation;
use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PaymentMindtransController extends Controller
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        // Set midtrans configuration
        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function submitDonation()
    {
        DB::transaction(function(){
            // Save donasi ke database
            $data = Auth::user();
            $donation = Donation::create([
                'donor_username' => $data->username,
                'donor_email' => $data->email,
                'donation_type' => 'Topup',
                'amount' => floatval($this->request->amount),
                'note' => 'Topup Bitrex points from midtrans',
            ]);

            // Buat transaksi ke midtrans kemudian save snap tokennya.
            $payload = [
                'transaction_details' => [
                    'order_id'      => $donation->id,
                    'gross_amount'  => $donation->amount,
                ],
                'customer_details' => [
                    'first_name'    => $donation->donor_username,
                    'email'         => $donation->donor_email,
                    // 'phone'         => '08888888888',
                    // 'address'       => '',
                ],
                'item_details' => [
                    [
                        'id'       => $donation->donation_type,
                        'price'    => $donation->amount,
                        'quantity' => 1,
                        'name'     => ucwords(str_replace('_', ' ', $donation->donation_type))
                    ]
                ]
            ];
            $snapToken = Veritrans_Snap::getSnapToken($payload);
            $donation->snap_token = $snapToken;
            $donation->save();

            // Beri response snap token
            $this->response['snap_token'] = $snapToken;
        });

        return response()->json($this->response, 200);
    }

    public function notificationHandler(Request $request)
    {
        $notif = new Veritrans_Notification();
        DB::transaction(function() use($notif) {

          $transaction = $notif->transaction_status;
          $type = $notif->payment_type;
          $orderId = $notif->order_id;
          $va_number = isset($notif->account_number) ? $notif->account_number : null;
          $fraud = $notif->fraud_status;
          $donation = Donation::findOrFail($orderId);
          $donation->setPaymentType($type);
          $donation->setVa($va_number);
          if ($transaction == 'capture') {

            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {

              if($fraud == 'challenge') {
                // TODO set payment status in merchant's database to 'Challenge by FDS'
                // TODO merchant should decide whether this transaction is authorized or not in MAP
                // $donation->addUpdate("Transaction order_id: " . $orderId ." is challenged by FDS");
                $donation->setPending();
              } else {
                // TODO set payment status in merchant's database to 'Success'
                // $donation->addUpdate("Transaction order_id: " . $orderId ." successfully captured using " . $type);
                $donation->setSuccess();
                $donation->setPoints();
              }

            }

          } elseif ($transaction == 'settlement') {

            // TODO set payment status in merchant's database to 'Settlement'
            // $donation->addUpdate("Transaction order_id: " . $orderId ." successfully transfered using " . $type);
            $donation->setSuccess();

          } elseif($transaction == 'pending'){

            // TODO set payment status in merchant's database to 'Pending'
            // $donation->addUpdate("Waiting customer to finish transaction order_id: " . $orderId . " using " . $type);
            $donation->setPending();

          } elseif ($transaction == 'deny') {

            // TODO set payment status in merchant's database to 'Failed'
            // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is Failed.");
            $donation->setFailed();

          } elseif ($transaction == 'expire') {

            // TODO set payment status in merchant's database to 'expire'
            // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is expired.");
            $donation->setExpired();

          } elseif ($transaction == 'cancel') {

            // TODO set payment status in merchant's database to 'Failed'
            // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is canceled.");
            $donation->setFailed();

          }

        });

        return;
    }
}
