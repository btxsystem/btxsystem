<?php

namespace App\Factory;
use App\Service\PaymentHistoryService;
use App\Service\PaymentHistoryServiceBuild;

interface PaymentHistoryFactory
{
  function call(): PaymentHistoryService;
}

class PaymentHistoryFactoryBuild implements PaymentHistoryFactory
{
  function call(): PaymentHistoryService
  {
    return new PaymentHistoryServiceBuild();
  }
}