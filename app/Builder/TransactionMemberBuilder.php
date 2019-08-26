<?php

namespace App\Builder;

class TransactionMemberBuilder
{
  public $memberId = 0;

  public $ebookId = 0;

  public $status = 1;

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

}