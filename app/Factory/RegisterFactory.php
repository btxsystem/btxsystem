<?php

namespace App\Factory;
use App\Interfaces\Classes\NonMember;

class RegisterFactory
{

  public static function run($type = 'nonmember')
  {
    if($type == 'nonmember') {
      return new NonMember();
    }
  }

}