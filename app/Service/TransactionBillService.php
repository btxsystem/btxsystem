<?php

namespace App\Service;

use App\Repositories\TransactionBillRepository;
use App\Repositories\TransactionBillDetailRepository;
use App\Employeer;
use App\Models\TransactionMember;
use App\Models\TransactionNonMember;
use App\HistoryBitrexPoints;
use App\Models\Ebook;
use App\Models\NonMember;
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
  public function createEbookMember($id, $user, $customerNumber, $renewal = false, $duration = 1)
  {
    try {
      $affix = (int) ltrim($customerNumber, '1121') + (int) date('yhmdHis');

      $data = [
        'member_id' => $user,
        'ebook_id' => $id,
        'status' => 1,
        'transaction_ref' => "BITREX".$affix,
        'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYears($duration),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ];

      // jika renewal
      if($renewal) {
        $check = TransactionMember::where([
          'status' => 1,
          'member_id' => $user
        ])->latest('id')->first();

        // jika blm ada transaksi
        if(!$check) return false;

        $data['expired_at'] = Carbon::create($check->expired_at)->addYears($duration);
      }

      $saveEbook = TransactionMember::insert($data);

      if(!$saveEbook) return false;

      return true;
    } catch (\Exception $e) {
      return false;
    }
  }

  /**
   * createEbookNonMember function
   *
   * @param [type] $id
   * @param [type] $user
   * @param [type] $customerNumber
   * @param integer $duration
   * @return void
   */
  public function createEbookNonMember($productDetail, $customerNumber, $duration = 1)
  {
    try {
      $affix = (int) ltrim($customerNumber, '1121') + (int) date('yhmdHis');

      $ebook = Ebook::where('id', $productDetail->ebook_id)->first();

      if(!$ebook) return false;

      $data = [
        'income' => $ebook->price_markup,
        'non_member_id' => $productDetail->user_id,
        'member_id' => $productDetail->member_id,
        'ebook_id' => $productDetail->ebook_id,
        'status' => 1,
        'transaction_ref' => "BITREX".$affix,
        'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYears($duration),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ];

      // jika renewal
      if($productDetail->renewal) {
        $check = TransactionNonMember::where([
          'status' => 1,
          'non_member_id' => $productDetail->user_id
        ])->latest('id')->first();

        $ebookRenewal = Ebook::where('id', $productDetail->ebook_renewal_id)->first();

        // jika blm ada transaksi
        if(!$check || !$ebookRenewal) return false;
        
        $data['income'] = $ebookRenewal->price_markup;
        $data['expired_at'] = Carbon::create($check->expired_at)->addYears($duration);
      }

      $saveEbook = TransactionNonMember::insert($data);

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
        $productDetail->renewal,
        $transactionBillRepo->customer_number
      );

      $updateTransaction = $transactionBillRepo->update([
        'payment_flag_status' => '00',
        'payment_flag_reason' => json_encode($builder->getPaymentFlagReason()),
        'customer_name' => $builder->getCustomerName(),
        'referrence' => $builder->getReference(),
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
  public function ebookNonMember($builder, $transactionBillRepo)
  {
    try {
      DB::beginTransaction();
      $productDetail = json_decode($transactionBillRepo->detail->product_detail);

      $user = NonMember::where('id', $productDetail->user_id)->first();
      
      if(!$user) return false;
      
      $saveEbook = $this->createEbookNonMember(
        $productDetail,
        $transactionBillRepo->customer_number
      );
      

      $updateTransaction = $transactionBillRepo->update([
        'payment_flag_status' => '00',
        'payment_flag_reason' => json_encode($builder->getPaymentFlagReason()),
        'customer_name' => $builder->getCustomerName(),
        'referrence' => $builder->getReference(),
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
   * topupBitrexPoint function
   *
   * @param [type] $customerNumber
   * @return void
   */
  public function topupBitrexPoint($builder, $transactionBillRepo)
  {
    try {
      DB::beginTransaction();
      $productDetail = json_decode($transactionBillRepo->detail->product_detail);

      $affix = (int) ltrim($transactionBillRepo->customer_number, '1121') + (int) date('yhmdHis');

      $saveTopupBitrexPoint = HistoryBitrexPoints::insert([
        'id_member' => $transactionBillRepo->user_id,
        'nominal' => $productDetail->nominal,
        'points' => $productDetail->points,
        'description' => $productDetail->description,
        'info' => 1,
        'transaction_ref' => "BITREX".$affix,
        'status' => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);

      $user = Employeer::find($transactionBillRepo->user_id)->increment('bitrex_points', (int) $productDetail->points);

      $updateTransaction = $transactionBillRepo->update([
        'payment_flag_status' => '00',
        'payment_flag_reason' => json_encode($builder->getPaymentFlagReason()),
        'customer_name' => $builder->getCustomerName(),
        'referrence' => $builder->getReference(),
        'flag_advice' => $builder->getFlagAdvice(),
        'paid_amount' => substr($builder->getPaidAmount(), 0, strlen($builder->getPaidAmount()) - 3),
        'transaction_date' => $builder->getTransactionDate(),
        'request_id' => $builder->getRequestID(),
      ]);

      if(!$saveTopupBitrexPoint || !$updateTransaction || !$user) {
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