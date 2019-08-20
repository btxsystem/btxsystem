<?php

namespace App\Interfaces\Classes;

use App\Interfaces\Transaction;
use App\Builder\NonMemberBuilder;
use Illuminate\Http\Request;

class NonMember implements Transaction
{

  public function create($password = '', $referralId = 0)
  {
    $data = (new NonMemberBuilder())
      ->setFirstName(\Request::input('firstName') ?? '')
      ->setUsername(\Request::input('userName') ?? '')
      ->setLastName(\Request::input('lastName') ?? '')
      ->setEmail(\Request::input('email') ?? '')
      ->setPassword($password ?? 'asep')
      ->setReferredBy($referralId ?? 0)
      ->saved();
    
    return $data;
  }
}