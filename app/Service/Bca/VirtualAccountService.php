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
    $additionaldata = $request->input('AdditionalData');

    $transactionBill = (new TransactionBillRepository())
      ->findByCustomerNumber($customerNumber ?? 0);

    
    $checkInquiryBills = (new TransactionBillEntity())
      ->setCompanyCode($companyCode ?? "")
      ->setCustomerNumber($customerNumber ?? "")
      ->setRequestID($requestID ?? "")
      ->setChannelType($channelType ?? "")
      ->setInquiryStatus(BcaStatusType::SUCCESS_FLAG)
      ->setCustomerName('Customer BCA Virtual Account')
      ->setCurrencyCode('IDR')
      ->setTotalAmount("0.00")
      ->setSubCompany('00000')
      ->setAdditionalData("")
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
        ->setTotalAmount($transactionBill->total_amount.".00")
        ->setPaidAmount($transactionBill->paid_amount.".00")
        ->setCustomerName($transactionBill->user_type == 'member' ? $transactionBill->member->username : $transactionBill->nonMember->username);
        
        if($this->validateIsPayment($checkInquiryBills, $transactionBill->payment_flag_status)) {
          return $this->responseBills($checkInquiryBills);
        }
      } else {
        $checkInquiryBills->setInquiryStatus(BcaStatusType::REJECT_FLAG)
        ->setInquiryReason(
          ((new LanguageEntity())
            ->setIndonesian('Gagal')
            ->setEnglish('Failed'))
        );
      }
      

      $this->validationBillPresentment($checkInquiryBills, $request);
      
    
    return $this->responseBills($checkInquiryBills);
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
   * responseBills function
   *
   * @param [type] $builder
   * @return void
   */
  public function responseBills($builder)
  {
    return [
      'CompanyCode' => $builder->getCompanyCode(),
      'CustomerNumber' => $builder->getCustomerNumber(),
      'RequestID' => $builder->getRequestID(),
      'InquiryStatus' => $builder->getInquiryStatus(),
      'InquiryReason' => $builder->getInquiryReason(),
      'CustomerName' => $builder->getCustomerName(),
      'CurrencyCode' => $builder->getCurrencyCode(),
      'TotalAmount' => $builder->getTotalAmount(),
      'SubCompany' => $builder->getSubCompany(),
      'DetailBills' => $builder->getDetailBills(),
      'FreeTexts' => $builder->getFreeTexts(),
      'AdditionalData' => $builder->getAdditionalData(),
    ];
  }

  /**
   * responsePayments function
   *
   * @param [type] $builder
   * @return void
   */
  public function responsePayments($builder)
  {
    return [
      'CompanyCode' => $builder->getCompanyCode(),
      'CustomerNumber' => $builder->getCustomerNumber(),
      'RequestID' => $builder->getRequestID(),
      'PaymentFlagStatus' => $builder->getPaymentFlagStatus(),
      'PaymentFlagReason' => $builder->getPaymentFlagReason(),
      'CustomerName' => $builder->getCustomerName(),
      'CurrencyCode' => $builder->getCurrencyCode(),
      'PaidAmount' => $builder->getPaidAmount(),
      'TotalAmount' => $builder->getTotalAmount(),
      'TransactionDate' => $builder->getTransactionDate(),
      'DetailBills' => $builder->getDetailBills(),
      'FreeTexts' => $builder->getFreeTexts(),
      'AdditionalData' => $builder->getAdditionalData(),
    ];
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
    $reference = $request->input('Reference');
    $additionaldata = $request->input('Additionaldata');

    $paymentBills = (new TransactionBillEntity())
      ->setCompanyCode($companyCode ?? "")
      ->setCustomerNumber($customerNumber ?? "")
      ->setRequestID($requestID ?? "")
      ->setChannelType($channelType)
      ->setCustomerName($customerName ?? "")
      ->setCurrencyCode($currencyCode ?? "")
      ->setTotalAmount($totalAmount ?? "")
      ->setPaidAmount($paidAmount ?? "")
      ->setSubCompany($subCompany)
      ->setTransactionDate($transactionDate)
      ->setAdditionaldata("")
      ->setFlagAdvice($flagAdvice)
      ->setReference($reference)
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
      
      // jika SIT tidakterpenuhi
      if(!$this->validateFlagPayment($paymentBills, $transactionBillRepo ?? null, $request)) {
        return $this->responsePayments($paymentBills);
      }
      
      // jika user sudah membayar
      if($this->validateIsPayment($paymentBills, $transactionBillRepo->payment_flag_status ?? null)) {
        return $this->responsePayments($paymentBills);
      } 
      
      
      $paymentBills->setPaymentFlagStatus(BcaStatusType::SUCCESS_FLAG)
        ->setPaymentFlagReason(
          (new LanguageEntity())
            ->setIndonesian("Sukses")
            ->setEnglish("Success")
        );
      
      // if failed payment or any problem
      if(!$transactionBillRepo) {
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

        return $this->responsePayments($paymentBills);
      }

      $paymentBillProduct = $this->paymentBillProduct($paymentBills, $transactionBillRepo);
      
      if($paymentBillProduct) {
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
        ->setTotalAmount($transactionBillRepo->total_amount.".00")
        ->setPaidAmount($transactionBillRepo->paid_amount.".00")
        ->setCustomerName($transactionBillRepo->user_type == 'member' ? $transactionBillRepo->member->username : $transactionBillRepo->nonMember->username);
        // ->setFreeTexts(function() {
        //   $freeTexts = [
        //     ((new LanguageEntity())
        //     ->setIndonesian('Sukses')
        //     ->setEnglish('Success'))
        //   ];
    
        //   return $freeTexts;
        // });
      }
        
    return $this->responsePayments($paymentBills);    
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
      $transactionBillRepo == null || 
      $request->input('CompanyCode') == '' || 
      $request->input('CustomerNumber') == '' || 
      $request->input('CustomerName') == '' || 
      $request->input('CurrencyCode') == '' || 
      $request->input('RequestID') == '' || 
      $request->input('ChannelType') == '' ||
      $request->input('TransactionDate') == '' || 
      $request->input('TotalAmount') == '' || 
      $request->input('PaidAmount') == '' || 
      $request->input('FlagAdvice') == '' || 
      $request->input('SubCompany') == '' || 
      $request->input('Reference') == '' || 
      $request->input('FlagAdvice') != 'Y' &&
      $request->input('FlagAdvice') != 'N' ||
      !$this->validateFormatDate($request->input('TransactionDate')) ||
      !$this->validateTotalAmount($request->input('TotalAmount'), $transactionBillRepo->total_amount.".00") ||
      !$this->validateTotalAmount($request->input('PaidAmount'), $transactionBillRepo->total_amount.".00")
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
      
      return false;
    } else {
      return true;
    }
  }

  public function validateTotalAmount($a, $b)
  {
    return $a != $b ? false : true;
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
            ->setIndonesian('Gagal')
            ->setEnglish('Failed'))
        )
        ->setInquiryReason(
          ((new LanguageEntity())
            ->setIndonesian('Gagal')
            ->setEnglish('Failed'))
        )
        ->setInquiryStatus("01");
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
          ->ebookNonMember($builder, $transactionBillRepo);
        break;
      case ProductType::TOPUP_BITREX_POINT:
        return $this->TransactionBillService
          ->topUpBitrexPoint($builder, $transactionBillRepo);
        break;
      case ProductType::REGISTER_MEMBER:
        return $this->TransactionBillService
          ->registerMember($builder, $transactionBillRepo);
        break;
    }

    return false;
  }

}