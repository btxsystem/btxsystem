<?php

namespace App\Factory;
use App\Service\TransactionService;
use App\Service\TransactionServiceRegister;

interface TransactionFactory
{
  function call(): TransactionService;
}

class TransactionFactoryRegister implements TransactionFactory
{
  function call(): TransactionService
  {
    return new TransactionServiceRegister();
  }
}