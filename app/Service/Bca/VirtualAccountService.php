<?php

namespace App\Service\Bca;

use App\Entities\Bca\TransactionBillEntity;
use App\Entities\Bca\LanguageEntity;
use App\Entities\Bca\DetailBillEntity;
use App\Repositories\TransactionBillDetailRepository;
use App\Repositories\TransactionBillRepository;
use App\Repositories\TransactionVirtualAccountRepository;
use App\Service\TransactionBillService;
use App\Types\BcaStatusType;
use App\Types\ProductType;

class VirtualAccountService
{

  /**
   * transactionVaRepo variable
   *
   * @var class
   */
  public $transactionVaRepo;

  /**
   * TransactionBillService variable
   *
   * @var class
   */
  public $TransactionBillService;

  /**
   * Undocumented function
   *
   * @param TransactionBillRepository $transactionVaRepo
   * @param TransactionBillService $TransactionBillService
   */
  public function __construct(
    TransactionBillRepository $transactionVaRepo,
    TransactionBillService $TransactionBillService
  )
  {
    $this->transactionVaRepo = $transactionVaRepo;
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
      // ->setDetailBiils(function() {
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
        ->setTotalAmount($transactionBill->total_amount."00")
        ->setPaidAmount($transactionBill->paid_amount."00")
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
    $flagAdvide = $request->input('FlagAdvide');
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
      ->setFlagAdvide($flagAdvide)
      ->setDetailBiils(function() use ($detailBills) {
        $detailBillLists = [];

        foreach($detailBills as $list) {
          $list = (object) $list;

          $detailBillLists[] = [
            (new DetailBillEntity())
            ->setBillAmount($list->BillAmount)
            ->setBillNumber($list->BillNumber)
            ->setBillSubCompany($list->BillSubCompany)
          ];
        }
  
        return $detailBillLists;
      });    

      //get transaction type
      $transactionVaRepo = $this->transactionVaRepo
        ->findByCustomerNumber($customerNumber);

        //assign to product type by customerNumber
      $paymentBillProduct = $this->paymentBillProduct($transactionVaRepo);
      
      // if failed payment or any problem
      if(!$paymentBillProduct) {
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
        ->setTotalAmount($transactionVaRepo->total_amount."00");
        // ->setFreeTexts(function() {
        //   $freeTexts = [
        //     ((new LanguageEntity())
        //     ->setIndonesian('Sukses')
        //     ->setEnglish('Success'))
        //   ];
    
        //   return $freeTexts;
        // });
        
      $this->validateFlagPayment($paymentBills, $request);
      $this->validateIsPayment($paymentBills, $transactionVaRepo->inquiry_status);
    return $paymentBills;    
  }

  public function validateFlagPayment($builder, $request)
  {
    if(
      $request->input('CompanyCode') == '' || 
      $request->input('CustomerNumber') == '' || 
      $request->input('RequestID') == '' || 
      $request->input('ChannelType') == '' ||
      $request->input('TransactionDate') == '' || 
      $request->input('TotalAmount') == '' || 
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

  public function validateIsPayment($builder, $status)
  {
    if($status == '00') {
      $builder->setPaymentFlagStatus('00')
        ->setPaymentFlagReason(
          ((new LanguageEntity())
            ->setIndonesian('Sukses')
            ->setEnglish('Success'))
        );
      return true;
    };

    return false;
  }

  /**
   * paymentBillProduct function
   *
   * @param [type] $customerNumber
   * @return void
   */
  public function paymentBillProduct($transactionVaRepo)
  { 
    if(!$transactionVaRepo) return false;

    switch($transactionVaRepo->product_type) {
      case ProductType::EBOOK_MEMBER:
        return $this->TransactionBillService
          ->ebookMember($transactionVaRepo->customer_number);
        break;
      case ProductType::EBOOK_NONMEMBER:
        return $this->TransactionBillService
          ->ebookNonMember($transactionVaRepo->customer_number);
        break;
      case ProductType::TOPUP_BITREX_POINT:
        return $this->TransactionBillService
          ->topUpBitrexPoint($transactionVaRepo->customer_number);
        break;
      case ProductType::REGISTER_MEMBER:
        return $this->TransactionBillService
          ->registerMember($transactionVaRepo->customer_number);
        break;
    }

    return false;
  }

}