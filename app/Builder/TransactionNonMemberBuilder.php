<?php

namespace App\Builder;

class TransactionNonMemberBuilder
{
  public $memberId = 0;

  public $nonMemberId = 0;

  public $income = 0;

  public $status = 1;

  public $expiredAt = null;

  public $ebookId = 0;

  public $identifiedBy = ['id' => 0];

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

  public function getExpiredAt()
  {
    return $this->expiredAt;
  }

  public function setExpiredAt($expiredAt)
  {
    $this->expiredAt = $expiredAt;
    return $this;
  }

  public function getEbookId()
  {
    return $this->ebookId;
  }

  public function setEbookId($ebookId)
  {
    $this->ebookId = $ebookId;
    return $this;
  }

  public function getIdentifiedBy()
  {
    return $this->identifiedBy;
  }

  public function setIdentifiedBy($identifiedBy)
  {
    $this->identifiedBy = $identifiedBy;
    return $this;
  }
}