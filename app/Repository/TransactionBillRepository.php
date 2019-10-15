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
  public function findByCustomerNumber($customerNumber)
  {
    $bill = Model::where('customer_number', $customerNumber);

    return $bill->first();
  }

}