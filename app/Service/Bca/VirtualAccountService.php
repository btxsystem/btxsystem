<?php

namespace App\Service\Bca;

use App\Entities\Bca\TransactionBillEntity;
use App\Entities\Bca\LanguageEntity;
use App\Repositories\TransactionBillRepository;
use App\Service\TransactionBillService;
use App\Types\BcaStatusType;
use App\Types\ProductType;

class VirtualAccountService
{

  /**
   * transactionBillRepo variable
   *
   * @var class
   */
  public $transactionBillRepo;

  /**
   * TransactionBillService variable
   *
   * @var class
   */
  public $TransactionBillService;

  /**
   * Undocumented function
   *
   * @param TransactionBillRepository $transactionBillRepo
   * @param TransactionBillService $TransactionBillService
   */
  public function __construct(
    TransactionBillRepository $transactionBillRepo,
    TransactionBillService $TransactionBillService
  )
  {
    $this->transactionBillRepo = $transactionBillRepo;
    $this->TransactionBillService = $TransactionBillService;
  }
  /**
   * checkInquiryBills function
   *
   * @param [type] $request
   * @return void
   */
  public function checkInquiryBills($request)
  {
    $companyCode = $request->input('CompanyCode');
    $customerNumber = $request->input('CustomerNumber');
    $requestID = $request->input('RequestID');
    $channelType = $request->input('ChannelType');

    $transactionBill = (new TransactionBillRepository())
      ->findByCustomerNumber($customerNumber ?? 0);

    
    $checkInquiryBills = (new TransactionBillEntity())
      ->setCompanyCode($companyCode ?? '11210')
      ->setCustomerNumber($customerNumber)
      ->setRequestID($requestID)
      ->setChannelType($channelType ?? '6014')
      ->setInquiryStatus(BcaStatusType::SUCCESS_FLAG)
      ->setCustomerName('Customer BCA Virtual Account')
      ->setCurrencyCode('IDR')
      ->setTotalAmount("150000.00")
      ->setSubCompany('11210')
      // ->setDetailBills(function() {
      //   $detailBills = [
      //     (new DetailBillEntity())
      //     ->setBillDescription(
      //       ((new LanguageEntity())
      //         ->setIndonesian('Maintenance')
      //         ->setEnglish('Maintenance'))
      //     )
      //     ->setBillAmount("150000.00")
      //     ->setBillNumber("008271822372")
      //     ->setBillSubCompany("00001")
      //   ];
  
      //   return $detailBills;
      // })
      ->setInquiryReason(
        ((new LanguageEntity())
          ->setIndonesian('Sukses')
          ->setEnglish('Success'))
      );    

      //check transaction bills
      if($transactionBill) {
        $checkInquiryBills->setCurrencyCode($transactionBill->currency_code)
        ->setTotalAmount($transactionBill->total_amount)
        ->setPaidAmount($transactionBill->paid_amount)
        ->setCustomerName($transactionBill->user_type == 'member' ? $transactionBill->member->username : $transactionBill->nonMember->username);
      } else {
        $checkInquiryBills->setInquiryStatus(BcaStatusType::REJECT_FLAG)
        ->setInquiryReason(
          ((new LanguageEntity())
            ->setIndonesian('Gagal')
            ->setEnglish('Failed'))
        );
      }
      

      $this->validationBillPresentment($checkInquiryBills, $request);
      
    
    return $checkInquiryBills;
  }

  /**
   * Check Inquiry function
   *
   * @param [type] $builder
   * @param [type] $request
   * @return void
   */
  public function validationBillPresentment($builder, $request){
    if(
      $request->input('CompanyCode') == '' || 
      $request->input('CustomerNumber') == '' || 
      $request->input('RequestID') == '' || 
      $request->input('ChannelType') == '' ||
      $request->input('TransactionDate') == '' || 
      !$this->validateFormatDate($request->input('TransactionDate'))
    ) {
      $builder->setInquiryStatus(BcaStatusType::REJECT_FLAG)
        ->setInquiryReason(
          ((new LanguageEntity())
            ->setIndonesian('Gagal')
            ->setEnglish('Failed'))
        );
      
    }
  }

  /**
   * Validate Format Date function
   *
   * @param [type] $date
   * @param string $format
   * @return void
   */
  public function validateFormatDate($date, $format = 'd/m/Y H:i:s')
  {
    $d = \DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
  }

  /**
   * paymentBills function
   *
   * @param [type] $request
   * @return void
   */
  public function paymentBills($request)
  {
    $companyCode = $request->input('CompanyCode');
    $customerNumber = $request->input('CustomerNumber');
    $requestID = $request->input('RequestID');
    $channelType = $request->input('ChannelType');
    $customerName = $request->input('CustomerName');
    $currencyCode = $request->input('CurrencyCode');
    $paidAmount = $request->input('PaidAmount');
    $totalAmount = $request->input('TotalAmount');
    $subCompany = $request->input('SubCompany');
    $transactionDate = $request->input('TransactionDate');
    $detailBills = $request->input('DetailBills') ?? [];
    $flagAdvice = $request->input('FlagAdvice');
    $referrence = $request->input('Referrence');
    $additionaldata = $request->input('Additionaldata');

    $paymentBills = (new TransactionBillEntity())
      ->setCompanyCode($companyCode ?? '11210')
      ->setCustomerNumber($customerNumber ?? '008271822372')
      ->setRequestID($requestID ?? '201507131507262221400000001975')
      ->setChannelType($channelType ?? '6014')
      ->setCustomerName($customerName)
      ->setCurrencyCode($currencyCode)
      ->setTotalAmount($totalAmount)
      ->setPaidAmount($paidAmount)
      ->setSubCompany($subCompany)
      ->setTransactionDate($transactionDate)
      ->setAdditionaldata($additionaldata)
      ->setFlagAdvice($flagAdvice)
      ->setReferrence($referrence)
      ->setCurrencyCode('IDR');
      // ->setDetailBills(function() use ($detailBills) {
      //   $detailBillLists = [];

      //   foreach($detailBills as $list) {
      //     $list = (object) $list;

      //     $detailBillLists[] = [
      //       (new DetailBillEntity())
      //       ->setBillAmount($list->BillAmount)
      //       ->setBillNumber($list->BillNumber)
      //       ->setBillSubCompany($list->BillSubCompany)
      //     ];
      //   }
  
      //   return $detailBillLists;
      // });    

      //get transaction type
      $transactionBillRepo = $this->transactionBillRepo
        ->findByCustomerNumber($customerNumber);

      // jika user sudah membayar
      if($this->validateIsPayment($paymentBills, $transactionBillRepo->payment_flag_status ?? null)) {
        return $paymentBills;
      } 
      
      $paymentBills->setPaymentFlagStatus(BcaStatusType::SUCCESS_FLAG)
        ->setPaymentFlagReason(
          (new LanguageEntity())
            ->setIndonesian("Sukses")
            ->setEnglish("Success")
        );
        //assign to product type by customerNumber
      $paymentBillProduct = $this->paymentBillProduct($paymentBills, $transactionBillRepo);
      
      // if failed payment or any problem
      if(!$paymentBillProduct || !$transactionBillRepo) {
        $paymentBills->setPaymentFlagStatus(BcaStatusType::REJECT_FLAG)
          ->setPaymentFlagReason(
            (new LanguageEntity())
              ->setIndonesian("Gagal")
              ->setEnglish("Failed")
          )
          ->setInquiryReason(
            ((new LanguageEntity())
              ->setIndonesian('Gagal')
              ->setEnglish('Failed'))
          )
          ->setFreeTexts(function() {
            $freeTexts = [
              ((new LanguageEntity())
              ->setIndonesian('Gagal')
              ->setEnglish('Failed'))
            ];
      
            return $freeTexts;
          });

        return $paymentBills;
      }

      $paymentBills->setPaymentFlagStatus(BcaStatusType::SUCCESS_FLAG)
        ->setPaymentFlagReason(
          (new LanguageEntity())
            ->setIndonesian("Sukses")
            ->setEnglish("Success")
        )
        ->setInquiryReason(
          ((new LanguageEntity())
            ->setIndonesian('Sukses')
            ->setEnglish('Success'))
        )
        ->setTotalAmount($transactionBillRepo->total_amount)
        ->setPaidAmount($transactionBillRepo->paid_amount)
        ->setCustomerName($transactionBillRepo->user_type == 'member' ? $transactionBillRepo->member->username : $transactionBillRepo->nonMember->username);
        // ->setFreeTexts(function() {
        //   $freeTexts = [
        //     ((new LanguageEntity())
        //     ->setIndonesian('Sukses')
        //     ->setEnglish('Success'))
        //   ];
    
        //   return $freeTexts;
        // });
        
      $this->validateFlagPayment($paymentBills, $transactionBillRepo, $request);
      
    return $paymentBills;    
  }

  /**
   * validateFlagPayment function
   *
   * @param [type] $builder
   * @param [type] $request
   * @return void
   */
  public function validateFlagPayment($builder, $transactionBillRepo, $request)
  {
    if(
      $request->input('CompanyCode') == '' || 
      $request->input('CustomerNumber') == '' || 
      $request->input('RequestID') == '' || 
      $request->input('ChannelType') == '' ||
      $request->input('TransactionDate') == '' || 
      $request->input('TotalAmount') == '' || 
      $request->input('TotalAmount') != $transactionBillRepo->total_amount ||  
      $request->input('PaidAmount') == '' || 
      $request->input('FlagAdvice') == '' || 
      $request->input('SubCompany') == '' || 
      $request->input('Referrence') == '' || 
      $request->input('FlagAdvice') != 'Y' &&
      $request->input('FlagAdvice') != 'N' ||
      !$this->validateFormatDate($request->input('TransactionDate'))
    ) {
      $builder->setInquiryStatus(BcaStatusType::REJECT_FLAG)
        ->setInquiryReason(
          ((new LanguageEntity())
            ->setIndonesian('Gagal')
            ->setEnglish('Failed'))
        )
        ->setPaymentFlagStatus(BcaStatusType::REJECT_FLAG)
        ->setPaymentFlagReason(
          ((new LanguageEntity())
            ->setIndonesian('Gagal')
            ->setEnglish('Failed'))
        );
      
    }
  }

  /**
   * validateIsPayment function
   *
   * @param [type] $builder
   * @param [type] $status
   * @return void
   */
  public function validateIsPayment($builder, $status)
  {
    if($status == '00') {
      $builder->setPaymentFlagStatus('01')
        ->setPaymentFlagReason(
          ((new LanguageEntity())
            ->setIndonesian('Sukses')
            ->setEnglish('Success'))
        );
      return true;
    } else {
      return false;
    }
  }

  /**
   * paymentBillProduct function
   *
   * @param [type] $customerNumber
   * @return void
   */
  public function paymentBillProduct($builder, $transactionBillRepo)
  { 
    if(!$transactionBillRepo) return false;

    switch($transactionBillRepo->product_type) {
      case ProductType::EBOOK_MEMBER:
        return $this->TransactionBillService
          ->ebookMember($builder, $transactionBillRepo);
        break;
      case ProductType::EBOOK_NONMEMBER:
        return $this->TransactionBillService
          ->ebookNonMember($transactionBillRepo);
        break;
      case ProductType::TOPUP_BITREX_POINT:
        return $this->TransactionBillService
          ->topUpBitrexPoint($transactionBillRepo);
        break;
      case ProductType::REGISTER_MEMBER:
        return $this->TransactionBillService
          ->registerMember($transactionBillRepo);
        break;
    }

    return false;
  }

}