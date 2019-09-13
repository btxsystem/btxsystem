<?php

namespace App\Service;
use App\Models\PaymentHistoryMember;
use App\Models\PaymentHistoryNonMember;
use Illuminate\Support\Facades\Hash;

interface PaymentHistoryService {
  function nonMember($builder);
}

class PaymentHistoryServiceBuild implements PaymentHistoryService
{
  function nonMember($builder) {
    $prefixRef = 'BITREX01';

    $checkRef = PaymentHistoryNonMember::where('ref_no', $prefixRef . (time() + rand(100, 500)))->first();

    $afterCheckRef = $prefixRef . (time() + rand(100, 500));

    while($checkRef) {
      $afterCheckRef = $prefixRef . (time() + rand(100, 500));
      if(!$checkRef) {
        break;
      }
    }

    $payment = new PaymentHistoryNonMember();
    $payment->ebook_id = $builder->getEbookId();
    $payment->non_member_id = $builder->getNonMemberId();
    $payment->ref_no = $afterCheckRef;
    $payment->payment_id = $builder->getPaymentId();
    $payment->amount = $builder->getAmount();
    $payment->currency = $builder->getCurrency();
    $payment->trans_id = $builder->getTransId();
    $payment->remark = $builder->getRemark();
    $payment->auth_code = $builder->getAuthCode();
    $payment->err_desc = $builder->getErrDesc();
    $payment->status = $builder->getStatus();
    $payment->save();

    if(!$payment) {
      return false;
    }

    return $payment;
  }
}