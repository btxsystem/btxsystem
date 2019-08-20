<?php

namespace App\Builder\Models;

class TransactionNonMember
{
  public $income;

  public $memberId;

  public $nonMemberId;

  public $ebookId;

  public $status;
  
  public function __construct(
    $income, 
    $memberId, 
    $nonMemberId, 
    $ebookId, 
    $status
  )
  {
    $this->income = $income;
    $this->memberId = $memberId;
    $this->nonMemberId = $nonMemberId;
    $this->ebookId = $ebookId;
    $this->status = $password;
  }
}