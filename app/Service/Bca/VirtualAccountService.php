<?php

namespace App\Service\Bca;

use App\Entities\Bca\VaBillEntity;
use App\Entities\Bca\LanguageEntity;
use App\Entities\Bca\DetailBillEntity;

class VirtualAccountService
{

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

    $checkInquiryBills = (new VaBillEntity())
      ->setCompanyCode($companyCode ?? '11210')
      ->setCustomerNumber($customerNumber ?? '008271822372')
      ->setRequestID($requestID ?? '201507131507262221400000001975')
      ->setChannelType('6014')
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

}