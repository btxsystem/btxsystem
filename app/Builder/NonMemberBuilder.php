<?php

namespace App\Builder;
use App\Builder\Models\NonMember;
use App\Models\NonMember as NonMemberModel;

class NonMemberBuilder
{
  public $firstName = '';

  public $lastName = '';
  
  public $username = '';
  
  public $email = '';
  
  public $password = '';
  
  public $phone = 0;
  
  public $referredBy = '';

  public function setFirstname($value)
  {
    $this->firstName = $value;
    return $this;
  }

  public function setLastName($value)
  {
    $this->lastName = $value;
    return $this;
  }

  public function setUsername($value)
  {
    $this->username = $value;
    return $this;
  }

  public function setEmail($value)
  {
    $this->email = $value;
    return $this;
  }

  public function setPassword($value)
  {
    $this->password = $value;
    return $this;
  }

  public function setPhone($value)
  {
    $this->phone = $value;
    return $this;
  }

  public function setReferredBy($value)
  {
    $this->referredBy = $value;
    return $this;
  }

  public function build() : NonMember
  {
    return (object) (new NonMember(
      $this->firstName,
      $this->lastName,
      $this->username,
      $this->email,
      $this->password,
      $this->phone,
      $this->referredBy
    ));
  }

  public function saved()
  {
    $nonMember = new NonMemberModel();
    $nonMember->first_name = $this->firstName;
    $nonMember->last_name = $this->lastName;
    $nonMember->username = $this->username;
    $nonMember->email = $this->email;
    $nonMember->password = $this->password;
    $nonMember->referred_by = $this->referredBy;
    $nonMember->save();

    return $nonMember;
  }
}