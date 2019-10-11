<?php

namespace App\Repositories;

use App\Models\TransactionBill as Model;

class TransactionBillRepository
{

  /**
   * findByCustomerNumber function
   *
   * @param string $customerNumber
   * @return void
   */
  public function findByCustomerNumber($customerNumber = 0)
  {
    $bill = Model::where('customer_number', $customerNumber);

    return $bill->first();
  }

  /**
   * saveEbookMember function
   *
   * @param [type] $builder
   * @return void
   */
  public function saveEbookMember($builder)
  {
    $save = Model::insertGetId([
      'user_id' => $builder->getUserID(),
      'product_type' => 'ebook',
      'user_type' => 'member',
      'customer_number' => $builder->getCustomerNumber(),
      'total_amount' => $builder->getTotalAmount(),
      'paid_amount' => $builder->getPaidAmount(),
    ]);

    if(!$save) return false;

    return true;
  }

  /**
   * updateEbookMember function
   *
   * @param [type] $builder
   * @return void
   */
  public function updateEbookMember($builder)
  {
    $update = Model::where([
      'id' => $builder->getID(),
      'type' => 'ebook'
    ])->update([
      'paid_amount' => $builder->getPaidAmount(),
      'request_id' => $builder->getRequestId(),
      'inqury_status' => $builder->getInquiryStatus(),
      'inqury_reason' => $builder->getInquiryReason(),
      'flag_advide' => $builder->getFlagAdvide(),
      'referrence' => $builder->getReferrence(),
      'transaction_date' => $builder->getTransactionDate(),
    ]);

    if(!$update) return false;

    return true;
  }

  /**
   * updateEbookNonMember function
   *
   * @param [type] $builder
   * @return void
   */
  public function updateEbookNonMember($builder)
  {
    $update = Model::where([
      'id' => $builder->getID(),
      'type' => 'ebook_nonmember'
    ])->update([
      'paid_amount' => $builder->getPaidAmount(),
      'request_id' => $builder->getRequestId(),
      'inqury_status' => $builder->getInquiryStatus(),
      'inqury_reason' => $builder->getInquiryReason(),
      'flag_advide' => $builder->getFlagAdvide(),
      'referrence' => $builder->getReferrence(),
      'transaction_date' => $builder->getTransactionDate(),
    ]);

    if(!$update) return false;

    return true;
  }

  /**
   * updateTopupBitrexPoint function
   *
   * @param [type] $builder
   * @return void
   */
  public function updateTopupBitrexPoint($builder)
  {
    $update = Model::where([
      'id' => $builder->getID(),
      'type' => 'topup_bitrex_point'
    ])->update([
      'paid_amount' => $builder->getPaidAmount(),
      'request_id' => $builder->getRequestId(),
      'inqury_status' => $builder->getInquiryStatus(),
      'inqury_reason' => $builder->getInquiryReason(),
      'flag_advide' => $builder->getFlagAdvide(),
      'referrence' => $builder->getReferrence(),
      'transaction_date' => $builder->getTransactionDate(),
    ]);

    if(!$update) return false;

    return true;
  }  
}