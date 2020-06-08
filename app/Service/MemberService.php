<?php
namespace App\Service;

use App\Service\PaymentVa\TransactionPaymentService;

class MemberService
{

  public function validateRegisterMemberAutoPlacement($request)
  {
    if(!$request->input('referral')) return false;
  }

  public function registerMemberAutoPlacement($request)
  {
    $date = now();

    do {
        $no_invoice = date_format($date,"ymdh").rand(100,999);
        $cek = DB::table('transaction_bills')->where('customer_number',$no_invoice)->select('id')->get();
    } while (count($cek)>0);   

    $register = new TransactionPaymentService;
    $register->register($request->referral, $request, $no_invoice);
  }
  
}