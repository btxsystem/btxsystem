<?php

namespace App\Service;

use App\Repositories\TransactionBillRepository;
use App\Repositories\TransactionBillDetailRepository;
use App\Employeer;
use App\Models\TransactionMember;

use DB;
use Carbon\Carbon;
class TransactionBillService
{

  /**
   * createEbookMember function
   *
   * @param [type] $id
   * @param [type] $user
   * @param [type] $customerNumber
   * @param integer $duration
   * @return void
   */
  public function createEbookMember($id, $user, $customerNumber, $duration = 1)
  {
    try {
      $affix = (int) ltrim($customerNumber, '1121') + (int) date('yhmdHis');

      $saveEbook = TransactionMember::insert([
        'member_id' => $user,
        'ebook_id' => $id,
        'status' => 1,
        'transaction_ref' => "BITREX".$affix,
        'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYears($duration)
      ]);

      if(!$saveEbook) return false;

      return true;
    } catch (\Exception $e) {
      return false;
    }
  }

  /**
   * ebookMember function
   *
   * @param [type] $request
   * @return void
   */
  public function ebookMember($builder, $transactionBillRepo)
  {
    try {
      DB::beginTransaction();
      $productDetail = json_decode($transactionBillRepo->detail->product_detail);

      $user = Employeer::where('id', $productDetail->user_id)->first();
  
      if(!$user) return false;

      $saveEbook = $this->createEbookMember(
        $productDetail->ebook_id,
        $user->id,
        $transactionBillRepo->customer_number
      );

      $updateTransaction = $transactionBillRepo->update([
        'payment_flag_status' => '00',
        'payment_flag_reason' => json_encode($builder->getPaymentFlagReason()),
        'customer_name' => $builder->getCustomerName(),
        'referrence' => $builder->getReferrence(),
        'flag_advice' => $builder->getFlagAdvice(),
        'paid_amount' => $builder->getPaidAmount(),
        'transaction_date' => $builder->getTransactionDate(),
        'request_id' => $builder->getRequestID(),
      ]);

      if(!$saveEbook || !$updateTransaction) {
        DB::rollback();
        return false;
      }

      DB::commit();
  
      return true;
    } catch (\Exception $e) {
      DB::rollback();
      return false;
    }
  }

  /**
   * ebookNonMember function
   *
   * @param [type] $customerNumber
   * @return void
   */
  public function ebookNonMember($transactionBillRepo)
  {
    return true;
  }

  /**
   * topupBitrexPoint function
   *
   * @param [type] $customerNumber
   * @return void
   */
  public function topupBitrexPoint($transactionBillRepo)
  {
    return true;
  }

  /**
   * registerMember function
   *
   * @param [type] $customerNumber
   * @return void
   */
  public function registerMember($transactionBillRepo)
  {
    return true;
  }

}