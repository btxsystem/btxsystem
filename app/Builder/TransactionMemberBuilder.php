<?php

namespace App\Builder;

class TransactionMemberBuilder
{
  public $transactionRef = null;

  public $memberId = 0;

  public $ebookId = 0;

  public $status = 1;

  public $identifiedBy = ['id' => 0];

  public $expiredAt = null;

  public function getTransactionRef()
  {
    return $this->transactionRef;
  }

  public function setTransactionRef($value)
  {
    $this->transactionRef = $value;
    return $this;
  }

  public function getMemberId()
  {
    return $this->memberId;
  }

  public function setMemberId($value)
  {
    $this->memberId = $value;
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

  public function getStatus()
  {
    return $this->status;
  }

  public function setStatus($value)
  {
    $this->status = $value;
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
  
  public function getExpiredAt()
  {
    return $this->expiredAt;
  }

  public function setExpiredAt($expiredAt)
  {
    $this->expiredAt = $expiredAt;
    return $this;
  }
}