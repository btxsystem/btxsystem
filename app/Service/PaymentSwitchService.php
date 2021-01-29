<?php

namespace App\Service;
use DB;
use App\Models\PaymentMethod;

class PaymentSwitchService
{
  public static function getCurrentPaymentMethod()
  {
    $payment = PaymentMethod::first();

    if(!$payment) return 'va';

    return $payment->payment_method_name ?? 'va';
  }
}