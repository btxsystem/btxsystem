<?php

namespace App\Service\Bca;

use App\Entities\Bca\VaBillEntity;
use App\Entities\Bca\LanguageEntity;
use App\Entities\Bca\DetailBillEntity;
use App\Repositories\TransactionVirtualAccountRepository;
use App\Service\TransactionProductService;
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
   * transactionProductService variable
   *
   * @var class
   */
  public $transactionProductService;

  /**
   * Undocumented function
   *
   * @param TransactionVirtualAccountRepository $transactionVaRepo
   * @param TransactionProductService $transactionProductService
   */
  public function __construct(
    TransactionVirtualAccountRepository $transactionVaRepo,
    TransactionProductService $transactionProductService
  )
  {
    $this->transactionVaRepo = $transactionVaRepo;
    $this->transactionProductService = $transactionProductService;
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

    $checkInquiryBills = (new VaBillEntity())
      ->setCompanyCode($companyCode ?? '11210')
      ->setCustomerNumber($customerNumber ?? '008271822372')
      ->setRequestID($requestID ?? '201507131507262221400000001975')
      ->setChannelType($channelType ?? '6014')
      ->setInquiryStatus("00")
      ->setCustomerName('Customer BCA Virtual Account')
      ->setCurrencyCode('IDR')
      ->setTotalAmount("150000.00")
      ->setSubCompany('00001')
      ->setDetailBiils(function() {
        $detailBills = [
          (new DetailBillEntity())
          ->setBillDescription(
            ((new LanguageEntity())
              ->setIndonesian('Maintenance')
              ->setEnglish('Maintenance'))
          )
          ->setBillAmount("150000.00")
          ->setBillNumber("008271822372")
          ->setBillSubCompany("00001")
        ];
  
        return $detailBills;
      })
      ->setInquiryReason(
        ((new LanguageEntity())
          ->setIndonesian('Sukses')
          ->setEnglish('Success'))
      )
      ->setFreeTexts(function() {
        $freeTexts = [
          ((new LanguageEntity())
          ->setIndonesian('Sukses')
          ->setEnglish('Success'))
        ];
  
        return $freeTexts;
      });    
    
    return $checkInquiryBills;
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

    $paymentBills = (new VaBillEntity())
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

      //assign to product type by customerNumber
      $paymentBillProduct = $this->paymentBillProduct($customerNumber);

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
        ->setFreeTexts(function() {
          $freeTexts = [
            ((new LanguageEntity())
            ->setIndonesian('Sukses')
            ->setEnglish('Success'))
          ];
    
          return $freeTexts;
        });
    
    return $paymentBills;    
  }

  /**
   * paymentBillProduct function
   *
   * @param [type] $customerNumber
   * @return void
   */
  public function paymentBillProduct($customerNumber)
  {
    //get transaction type
    $transactionVaRepo = $this->transactionVaRepo
      ->findByCustomerNumber($customerNumber);

    switch($transactionVaRepo) {
      case ProductType::EBOOK_MEMBER:
        return $this->transactionProductService
          ->ebookMember($customerNumber);
        break;
      case ProductType::EBOOK_NONMEMBER:
        return $this->transactionProductService
          ->ebookMember($customerNumber);
        break;
      case ProductType::TOPUP_BITREX_POINT:
        return $this->transactionProductService
          ->ebookMember($customerNumber);
        break;
      case ProductType::REGISTER_MEMBER:
        return $this->transactionProductService
          ->ebookMember($customerNumber);
        break;
    }

    return false;
  }

}