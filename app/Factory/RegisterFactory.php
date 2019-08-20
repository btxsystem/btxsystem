<?php

namespace App\Factory;
use App\Interfaces\Transaction;
use App\Interfaces\Classes\NonMember;

class RegisterFactory
{

  public static function run($type = 'nonmember'): Transaction
  {
    if($type == 'nonmember') {
      return new NonMember();
    }
  }

}