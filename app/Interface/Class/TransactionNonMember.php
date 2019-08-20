<?php

namespace App\Interfaces\Classes;

use App\Interfaces\Transaction;
use App\Builder\TransactionNonMemberBuilder;
use Illuminate\Http\Request;

class TransactionNonMember implements Transaction
{

  public function create($referralId = 0, $nonMemberId = 0, $ebookId = 1)
  {
    $transaction = (new TransactionNonMemberBuilder())
    ->setMemberId($referralId)
    ->setNonMemberId($nonMemberId)
    ->setEbookId($ebookId)
    ->saved();

    return $transaction;
  }
}