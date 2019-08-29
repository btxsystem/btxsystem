<?php

namespace App\Service;
use App\Models\NonMember;
use Illuminate\Support\Facades\Hash;

interface RegisterService {
  function createNonMember($builder);
}

class RegisterServiceMake implements RegisterService
{
  /**
   * 
   */
  function createNonMember($builder) {
    $check = NonMember::where('username', $builder->getUsername())->first();

    if($check) {
      return false;
    }

    $save = new NonMember();
    $save->first_name = $builder->getFirstname();
    $save->last_name = $builder->getLastName();
    $save->username = $builder->getUsername();
    $save->email = $builder->getEmail();
    $save->password = Hash::make($builder->getPassword());
    $save->save();

    if(!$save) {
      return false;
    }

    return $save;
  }
}