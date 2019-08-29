<?php

namespace App\Factory;
use App\Service\PaymentService;
use App\Service\PaymenServiceIpay;

interface PaymentFactory
{
  function call(): PaymentService;
}

class PaymentFactoryIpay implements PaymentFactory
{
  function call(): PaymentService
  {
    return new PaymenServiceIpay();
  }
}