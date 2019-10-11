<?php

namespace App\Service;

use App\Repositories\TransactionBillRepository;
use App\Repositories\TransactionBillDetailRepository;


class TransactionBillService
{

  /**
   * ebookMember function
   *
   * @param [type] $request
   * @return void
   */
  public function ebookMember($customerNumber)
  {
    return true;
  }

  /**
   * ebookNonMember function
   *
   * @param [type] $customerNumber
   * @return void
   */
  public function ebookNonMember($customerNumber)
  {
    return true;
  }

  /**
   * topupBitrexPoint function
   *
   * @param [type] $customerNumber
   * @return void
   */
  public function topupBitrexPoint($customerNumber)
  {
    return true;
  }

  /**
   * registerMember function
   *
   * @param [type] $customerNumber
   * @return void
   */
  public function registerMember($customerNumber)
  {
    return true;
  }

}