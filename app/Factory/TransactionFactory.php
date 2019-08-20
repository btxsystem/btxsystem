<?php

namespace App\Factory;
use App\Interfaces\Transaction;
use App\Interfaces\Classes\TransactionMember;
use App\Interfaces\Classes\TransactionNonMember;

class TransactionFactory
{

  public static function run($type = 'nonmember'): Transaction
  {
    if($type == 'member') {
      return new TransactionMember();
    } else {
      return new TransactionNonMember();
    }
  }

}