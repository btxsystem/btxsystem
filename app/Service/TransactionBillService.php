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

        // jika belum ada transaksi
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
        $transactionBillRepo->customer_number,
        $productDetail->renewal
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

      $totalPoints = (int) $productDetail->points;

      $saveTopupBitrexPoint = HistoryBitrexPoints::insert([
        'id_member' => $transactionBillRepo->user_id,
        'nominal' => $productDetail->nominal,
        'points' => $totalPoints,
        'description' => $productDetail->description,
        'info' => 1,
        'transaction_ref' => "BITREX".$affix,
        'status' => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);

      $user = Employeer::find($transactionBillRepo->user_id)->increment('bitrex_points', (int) $totalPoints);

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
  public function registerMember($builder, $transactionBillRepo)
  {
    try {
      DB::beginTransaction();

      $productDetail = json_decode($transactionBillRepo->detail->product_detail);

      $registerMember = $this->registerAuto($productDetail->member);

      if(!$registerMember) {
        DB::rollback();
        return false;
      }

      $ebooks = $productDetail->ebooks;

      foreach($ebooks as $ebook) {
        $this->createEbookMember(
          $ebook,
          $registerMember,
          $transactionBillRepo->customer_number
        );
      }

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

      if(!$updateTransaction) {
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

  public function findChild($id, $sponsor, $data){
    $cek_npwp = 0;
    if (isset($data->npwp_number)) {
        $cek_npwp = strlen($data->npwp_number) >= 15 ? 1 : 0;
    }
    $isHaveChild = Employeer::where('parent_id',$id)->select('position')->get();
    if (count($isHaveChild) == 3) {
        $pv = DB::table('pv_rank')->where('id_member',$id)->select('pv_left', 'pv_midle', 'pv_right')->first();
        if($pv != null){
            if ($pv->pv_left <= $pv->pv_midle and $pv->pv_left <= $pv->pv_right) {
                $child = Employeer::where('parent_id',$id)->where('position',0)->select('id')->first();
                $this->findChild($child->id, $sponsor, $data);
            }elseif ($pv->pv_midle < $pv->pv_left and $pv->pv_midle <= $pv->pv_right) {
                $child = Employeer::where('parent_id',$id)->where('position',1)->select('id')->first();
                $this->findChild($child->id, $sponsor, $data);
            }else {
                $child = Employeer::where('parent_id',$id)->where('position',2)->select('id')->first();
                $this->findChild($child->id, $sponsor, $data);
            }
        }else{
            $child = Employeer::where('parent_id',$id)->where('position',0)->select('id')->first();
            $this->findChild($child->id, $sponsor, $data);
        }
    }elseif (count($isHaveChild)==0) {
        $member = [
            'id_member' => invoiceNumbering(),
            'username' => $data->username,
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'email' => $data->email,
            "phone_number" => $data->phone_number,
            'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
            'birthdate' => $data->birthdate,
            'gender' => 0,
            'position' => 0,
            'parent_id' => $id,
            'sponsor_id' => $sponsor,
            'verification' => $cek_npwp,
            'bitrex_cash' => 0,
            'bitrex_points' => 0,
            'pv' => 0,
            'nik' => $data->passport ?? $data->nik,
            'no_rec' => $data->bank_account_number,
            'bank_account_name' => $data->bank_account_name,
            'bank_name' => $data->bank_name,
            'npwp_number' => $data->npwp_number ? $data->npwp_number : null,
            'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1)
        ];
        return Employeer::insertGetId($member);
    }else{
        $left = false;
        $midle = false;
        $right = false;
        foreach ($isHaveChild as $key => $child) {
            if ($child->position == 0) {
                $left = true;
            }elseif ($child->position == 1) {
                $midle = true;
            }elseif ($child->position == 2) {
                $right = true;
            }
        }
        if (!$left) {
            $member = [
                'id_member' => invoiceNumbering(),
                'username' => $data->username,
                'first_name' => $data->first_name,
                'last_name' => $data->last_name,
                'email' => $data->email,
                "phone_number" => $data->phone_number,
                'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
                'birthdate' => $data->birthdate,
                'gender' => 0,
                'position' => 0,
                'parent_id' => $id,
                'sponsor_id' => $sponsor,
                'verification' => $cek_npwp,
                'bitrex_cash' => 0,
                'bitrex_points' => 0,
                'pv' => 0,
                'nik' => $data->passport ?? $data->nik,
                'no_rec' => $data->bank_account_number,
                'bank_account_name' => $data->bank_account_name,
                'bank_name' => $data->bank_name,
                'npwp_number' => $data->npwp_number ? $data->npwp_number : null,
                'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1)
            ];
            return Employeer::insertGetId($member);
        }elseif (!$midle) {
            $member = [
                'id_member' => invoiceNumbering(),
                'username' => $data->username,
                'first_name' => $data->first_name,
                'last_name' => $data->last_name,
                'email' => $data->email,
                "phone_number" => $data->phone_number,
                'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
                'birthdate' => $data->birthdate,
                'gender' => 0,
                'position' => 1,
                'parent_id' => $id,
                'sponsor_id' => $sponsor,
                'verification' => $cek_npwp,
                'bitrex_cash' => 0,
                'bitrex_points' => 0,
                'pv' => 0,
                'nik' => $data->passport ?? $data->nik,
                'no_rec' => $data->bank_account_number,
                'bank_account_name' => $data->bank_account_name,
                'bank_name' => $data->bank_name,
                'npwp_number' => $data->npwp_number ? $data->npwp_number : null,
                'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1)
            ];
            return Employeer::insertGetId($member);
        }else {
            $member = [
                'id_member' => invoiceNumbering(),
                'username' => $data->username,
                'first_name' => $data->first_name,
                'last_name' => $data->last_name,
                'email' => $data->email,
                "phone_number" => $data->phone_number,
                'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
                'birthdate' => $data->birthdate,
                'gender' => 0,
                'position' => 2,
                'parent_id' => $id,
                'sponsor_id' => $sponsor,
                'verification' => $cek_npwp,
                'bitrex_cash' => 0,
                'bitrex_points' => 0,
                'pv' => 0,
                'nik' => $data->passport ?? $data->nik,
                'no_rec' => $data->bank_account_number,
                'bank_account_name' => $data->bank_account_name,
                'bank_name' => $data->bank_name,
                'npwp_number' => $data->npwp_number ? $data->npwp_number : null,
                'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1)
            ];
            return Employeer::insertGetId($member);
        }
    }
    return false;
}

  public function registerAuto($request){
    $sponsor = $request->referral ? Employeer::where('username',$request->referral)->select('id')->first() : 1 ;
    $isHaveChild = Employeer::where('parent_id',$sponsor->id)->select('position')->get();
    if (count($isHaveChild) == 3) {
        $pv = DB::table('pv_rank')->where('id_member',$sponsor->id)->select('pv_left', 'pv_midle', 'pv_right')->first();
        if($pv != null){
            if ($pv->pv_left <= $pv->pv_midle and $pv->pv_left <= $pv->pv_right) {
                $child = Employeer::where('parent_id',$sponsor->id)->where('position',0)->select('id')->first();
                $this->findChild($child->id, $sponsor->id, $request);
            }elseif ($pv->pv_midle < $pv->pv_left and $pv->pv_midle <= $pv->pv_right) {
                $child = Employeer::where('parent_id',$sponsor->id)->where('position',1)->select('id')->first();
                $this->findChild($child->id, $sponsor->id, $request);
            }else {
                $child = Employeer::where('parent_id',$sponsor->id)->where('position',2)->select('id')->first();
                $this->findChild($child->id, $sponsor->id, $request);
            }
        }else{
            $child = Employeer::where('parent_id',$sponsor->id)->where('position',0)->select('id')->first();
            $this->findChild($child->id, $sponsor->id, $request);
        }
    }elseif (count($isHaveChild)==0) {
        $member = [
            'id_member' => invoiceNumbering(),
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            "phone_number" => $request->phone_number,
            'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
            'birthdate' => $request->birthdate,
            'gender' => 0,
            'position' => 0,
            'parent_id' => $sponsor->id,
            'sponsor_id' => $sponsor->id,
            'bitrex_cash' => 0,
            'bitrex_points' => 0,
            'pv' => 0,
            'nik' => $request->nik,
            'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1),
            'bank_name' => $request->bank_name,
            'bank_account_name' => $request->bank_account_name,
            'no_rec' => $request->bank_account_number
        ];
        return Employeer::insertGetId($member);
    }else{
        $left = false;
        $midle = false;
        $right = false;
        foreach ($isHaveChild as $key => $child) {
            if ($child->position == 0) {
                $left = true;
            }elseif ($child->position == 1) {
                $midle = true;
            }elseif ($child->position == 2) {
                $right = true;
            }
        }
        if (!$left) {
            $member = [
                'id_member' => invoiceNumbering(),
                'username' => $request->username,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                "phone_number" => $request->phone_number,
                'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
                'birthdate' => $request->birthdate,
                'gender' => 0,
                'position' => 0,
                'parent_id' => $sponsor->id,
                'sponsor_id' => $sponsor->id,
                'bitrex_cash' => 0,
                'bitrex_points' => 0,
                'pv' => 0,
                'nik' => $request->nik,
                'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1),
                'bank_name' => $request->bank_name,
                'bank_account_name' => $request->bank_account_name,
                'no_rec' => $request->bank_account_number
            ];
            return Employeer::insertGetId($member);
        }elseif (!$midle) {
            $member = [
                'id_member' => invoiceNumbering(),
                'username' => $request->username,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                "phone_number" => $request->phone_number,
                'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
                'birthdate' => $request->birthdate,
                'gender' => 0,
                'position' => 1,
                'parent_id' => $sponsor->id,
                'sponsor_id' => $sponsor->id,
                'bitrex_cash' => 0,
                'bitrex_points' => 0,
                'pv' => 0,
                'nik' => $request->nik,
                'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1),
                'bank_name' => $request->bank_name,
                'bank_account_name' => $request->bank_account_name,
                'no_rec' => $request->bank_account_number
            ];
            return Employeer::insertGetId($member);
        }else {
            $member = [
                'id_member' => invoiceNumbering(),
                'username' => $request->username,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                "phone_number" => $request->phone_number,
                'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
                'birthdate' => $request->birthdate,
                'gender' => 0,
                'position' => 2,
                'parent_id' => $sponsor->id,
                'sponsor_id' => $sponsor->id,
                'bitrex_cash' => 0,
                'bitrex_points' => 0,
                'pv' => 0,
                'nik' => $request->nik,
                'expired_at' => Carbon::create(date('Y-m-d H:i:s'))->addYear(1),
                'bank_name' => $request->bank_name,
                'bank_account_name' => $request->bank_account_name,
                'no_rec' => $request->bank_account_number
            ];
            return Employeer::insertGetId($member);
        }
    }
    return false;
  }
}