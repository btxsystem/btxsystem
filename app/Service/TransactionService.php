<?php

namespace App\Service;
use App\Models\TransactionMember;
use App\Models\TransactionNonMember;

interface TransactionService {
  function createNonMember($builder);
  function createMember($builder);
  function updateNonMember($builder);
  function updateMember($builder);
}

class TransactionServiceRegister implements TransactionService
{
  /**
   * 
   */
  function createNonMember($builder) {
    
    $check = TransactionNonMember::where([
      'ebook_id' => $builder->getEbookId(),
      'non_member_id' => $builder->getNonMemberId(),
    ])->first();

    if($check) {
      return false;
    }

    $prefixRef = 'BITREX01';

    $checkRef = TransactionNonMember::where('transaction_ref', $prefixRef . (time() + rand(100, 500)))->first();

    $afterCheckRef = $prefixRef . (time() + rand(100, 500));

    while($checkRef) {
      $afterCheckRef = $prefixRef . (time() + rand(100, 500));
      if(!$checkRef) {
        break;
      }
    }

    $transaction = new TransactionNonMember();
    $transaction->transaction_ref = $builder->getTransactionRef() ?? $afterCheckRef;
    $transaction->member_id = $builder->getMemberId();
    $transaction->ebook_id = $builder->getEbookId();
    $transaction->non_member_id = $builder->getNonMemberId();
    $transaction->status = $builder->getStatus();
    $transaction->income = $builder->getIncome();
    $transaction->expired_at = $builder->getExpiredAt();
    $transaction->save();

    if(!$transaction) {
      return false;
    }

    return $transaction;
  }

  /**
   * 
   */
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
    $transaction->expired_at = $builder->getExpiredAt();
    $transaction->save();

    if(!$transaction) {
      return false;
    }

    return $transaction;
  }

  /**
   * 
   */
  function updateNonMember($builder) {
    
    $check = TransactionNonMember::where([
      'ebook_id' => $builder->getEbookId(),
      'non_member_id' => $builder->getNonMemberId(),
    ])->first();

    if(!$check) {
      return false;
    }

    $params = [
      'status' => $builder->getStatus() ?? $check->status,
      'expired_at' => $builder->getExpiredAt() ?? $check->expired_at,
    ];

    $transaction = TransactionNonMember::where($builder->getIdentifiedBy())->update($params);

    if(!$transaction) {
      return false;
    }

    return true;
  }

  /**
   * 
   */
  function updateMember($builder) {
    
    $check = TransactionMember::where([
      'ebook_id' => $builder->getEbookId(),
      'member_id' => $builder->getMemberId(),
    ])->first();

    if(!$check) {
      return false;
    }

    $params = [
      'status' => $builder->getStatus() ?? $check->status,
      'expired_at' => $builder->getExpiredAt() ?? $check->expired_at,
    ];

    $transaction = TransactionMember::where($builder->getIdentifiedBy())->update($params);

    if(!$transaction) {
      return false;
    }

    return true;
  }

}