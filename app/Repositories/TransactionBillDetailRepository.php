<?php

namespace App\Repositories;

use App\Models\TransactionBillDetail as Model;

class TransactionBillDetailRepository
{

  /**
   * findByCustomerNumber function
   *
   * @param string $customerNumber
   * @return void
   */
  public function findByBill($bill)
  {
    $detailBill = Model::where('transaction_bill_id', $bill);

    return $detailBill->first();
  }

}