<?php

namespace App\Builder\Models;

class NonMember
{
  public $firstName;

  public $lastName;

  public $username;

  public $email;

  public $password;

  public $phone;

  public $referredBy;
  
  public function __construct(
    $firstName, 
    $lastName, 
    $username, 
    $email, 
    $password, 
    $phone,
    $referredBy
  )
  {
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
    $this->phone = $phone;
    $this->referredBy = $referredBy;
  }
}