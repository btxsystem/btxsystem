<?php

namespace App\Builder;
use App\Builder\Models\TransactionNonMember;
use App\Models\TransactionNonMember as TransactionNonMemberModel;

class TransactionNonMemberBuilder
{
  public $income = 0.2;

  public $memberId = 0;

  public $nonMemberId = 0;

  public $ebookId = 0;

  public $status = 0;

  public function setIncome($value)
  {
    $this->income = $value;
    return $this;
  }

  public function setMemberId($value)
  {
    $this->memberId = $value;
    return $this;
  }

  public function setNonMemberId($value)
  {
    $this->nonMemberId = $value;
    return $this;
  }

  public function setEbookId($value)
  {
    $this->ebookId = $value;
    return $this;
  }

  public function setStatus($value)
  {
    $this->status = $value;
    return $this;
  }

  public function build() : TransactionNonMember
  {
    return (object) (new TransactionNonMember(
      $this->income,
      $this->memberId,
      $this->nonMemberId,
      $this->ebookId,
      $this->status
    ));
  }

  public function saved()
  {
    $data = new TransactionNonMemberModel();
    $data->income = $this->income;
    $data->member_id = $this->memberId;
    $data->non_member_id = $this->nonMemberId;
    $data->ebook_id = $this->ebookId;
    $data->status = $this->status;
    $data->save();

    return $data;
  }
}