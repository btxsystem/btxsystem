<?php

namespace App\Entities\Bca;

use App\Entities\Bca\DetailBillEntity;
use App\Entities\Bca\LanguageEntity;

class VaBillEntity
{
  public $CompanyCode;
  
  public $CustomerNumber;

  public $RequestID;

  public $ChannelType;

  public $InquiryStatus;

  public $InquiryReason;

  public $CustomerName;

  public $CurrencyCode;

  public $TotalAmount;

  public $SubCompany;

  public $DetailBills;

  public $FreeTexts;

  public $AdditionalData;

  public function setCompanyCode($CompanyCode)
  {
    $this->CompanyCode = $CompanyCode;

    return $this;
  }

  public function setCustomerNumber($CustomerNumber)
  {
    $this->CustomerNumber = $CustomerNumber;

    return $this;
  }

  public function setRequestID($RequestID)
  {
    $this->RequestID = $RequestID;

    return $this;
  }

  public function setChannelType($ChannelType)
  {
    $this->ChannelType = $ChannelType;

    return $this;
  }

  public function setInquiryStatus($InquiryStatus)
  {
    $this->InquiryStatus = $InquiryStatus;

    return $this;
  }

  public function setInquiryReason($class)
  {
    $this->InquiryReason = $class;

    return $this;
  }

  public function setCustomerName($CustomerName)
  {
    $this->CustomerName = $CustomerName;

    return $this;
  }

  public function setCurrencyCode($CurrencyCode)
  {
    $this->CurrencyCode = $CurrencyCode;

    return $this;
  }

  public function setTotalAmount($TotalAmount)
  {
    $this->TotalAmount = $TotalAmount;

    return $this;
  }

  public function setSubCompany($SubCompany)
  {
    $this->SubCompany = $SubCompany;

    return $this;
  }

  public function setFreeTexts($class)
  {
    $this->FreeTexts = call_user_func($class);

    return $this;
  }

  public function setDetailBiils($class)
  {
    $this->DetailBills = call_user_func($class);

    return $this;
  }

  public function setAdditionalData($AdditionalData)
  {
    $this->AdditionalData = $AdditionalData;

    return $this;
  }
}