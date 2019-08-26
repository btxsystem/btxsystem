<?php

namespace App\Builder;

class TransactionNonMemberBuilder
{
  public $memberId = 0;

  public $nonMemberId = 0;

  public $income = 0;

  public $status = 1;

  public $ebookId = 0;

  public function getMemberId()
  {
    return $this->memberId;
  }

  public function setMemberId($value)
  {
    $this->memberId = $value;
    return $this;
  }

  public function getNonMemberId()
  {
    return $this->nonMemberId;
  }

  public function setNonMemberId($nonMemberId)
  {
    $this->nonMemberId = $nonMemberId;
    return $this;
  }

  public function getIncome()
  {
    return $this->income;
  }

  public function setIncome($income)
  {
    $this->income = $income;
    return $this;
  }
  
  public function getStatus()
  {
    return $this->status;
  }

  public function setStatus($status)
  {
    $this->status = $status;
    return $this;
  }

  public function getEbookId()
  {
    return $this->ebookId;
  }

  public function setEbookId($value)
  {
    $this->ebookId = $value;
    return $this;
  }
}