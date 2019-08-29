<?php

namespace App\Service;
use App\Models\NonMember;
use Illuminate\Support\Facades\Hash;

interface PaymentService {
  function paymentNonMember($builder);
}

class PaymentServiceIpay implements PaymentService
{
  function paymentNonMember($builder) {
    //
  }
}