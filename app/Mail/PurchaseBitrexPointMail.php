<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PurchaseBitrexPointMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public $additional;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $additional = null)
    {
        //
        $this->data = $data;
        $this->additional = $additional;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.purchase-topup')
                    ->from('mailbitrexgo@bitrexgo.id', 'Bitrexgo')
                    ->subject('Topup Bitrex Point');
    }
}
