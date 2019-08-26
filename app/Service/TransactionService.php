<?php

namespace App\Service;
use App\Models\TransactionMember;
use App\Models\TransactionNonMember;

interface TransactionService {
  function createNonMember($builder);
  function createMember($builder);
}

class TransactionServiceRegister implements TransactionService
{
  function createNonMember($builder) {
    
    $check = TransactionNonMember::where([
      'ebook_id' => $builder->getEbookId(),
      'non_member_id' => $builder->getNonMemberId(),
    ])->first();

    if($check) {
      return false;
    }

    $transaction = new TransactionNonMember();
    $transaction->member_id = $builder->getMemberId();
    $transaction->ebook_id = $builder->getEbookId();
    $transaction->non_member_id = $builder->getNonMemberId();
    $transaction->status = $builder->getStatus();
    $transaction->income = $builder->getIncome();
    $transaction->save();

    if(!$transaction) {
      return false;
    }

    return true;
  }

  function createMember($builder) {
    $check = TransactionMember::where([
      'member_id' => $builder->getMemberId(),
      'ebook_id' => $builder->getEbookId()
    ])->first();

    if($check) {
      return false;
    }

    $transaction = new TransactionMember();
    $transaction->member_id = $builder->getMemberId();
    $transaction->ebook_id = $builder->getEbookId();
    $transaction->status = $builder->getStatus();
    $transaction->save();

    if(!$transaction) {
      return false;
    }

    return true;
  }
}