<?php

namespace App\Entities\Bca;

use App\Entities\Bca\DetailBillEntity;
use App\Entities\Bca\LanguageEntity;

class TransactionBillEntity
{
  public $ID;
  
  public $UserID;
  
  public $ProductType;

  public $UserType;
  
  public $CompanyCode;
  
  public $CustomerNumber;

  public $RequestID;

  public $PaymentFlagStatus;

  public $PaymentFlagReason;

  public $ChannelType;

  public $InquiryStatus;

  public $InquiryReason;

  public $CustomerName;

  public $CurrencyCode;

  public $TotalAmount;

  public $PaidAmount;

  public $SubCompany;

  public $TransactionDate;

  public $DetailBills;

  public $FreeTexts;

  public $Referrence;

  public $AdditionalData;

  public $FlagAdvice;


  /**
   * Get the value of ID
   */ 
  public function getID()
  {
    return $this->ID;
  }

  /**
   * Set the value of ID
   *
   * @return  self
   */ 
  public function setID($ID)
  {
    $this->ID = $ID;

    return $this;
  }

  /**
   * Get the value of UserID
   */ 
  public function getUserID()
  {
    return $this->UserID;
  }

  /**
   * Set the value of UserID
   *
   * @return  self
   */ 
  public function setUserID($UserID)
  {
    $this->UserID = $UserID;

    return $this;
  }

  /**
   * Get the value of ProductType
   */ 
  public function getProductType()
  {
    return $this->ProductType;
  }

  /**
   * Set the value of ProductType
   *
   * @return  self
   */ 
  public function setProductType($ProductType)
  {
    $this->ProductType = $ProductType;

    return $this;
  }

  /**
   * Get the value of UserType
   */ 
  public function getUserType()
  {
    return $this->UserType;
  }

  /**
   * Set the value of UserType
   *
   * @return  self
   */ 
  public function setUserType($UserType)
  {
    $this->UserType = $UserType;

    return $this;
  }

  /**
   * Get the value of CompanyCode
   */ 
  public function getCompanyCode()
  {
    return $this->CompanyCode;
  }

  /**
   * Set the value of CompanyCode
   *
   * @return  self
   */ 
  public function setCompanyCode($CompanyCode)
  {
    $this->CompanyCode = $CompanyCode;

    return $this;
  }

  /**
   * Get the value of CustomerNumber
   */ 
  public function getCustomerNumber()
  {
    return $this->CustomerNumber;
  }

  /**
   * Set the value of CustomerNumber
   *
   * @return  self
   */ 
  public function setCustomerNumber($CustomerNumber)
  {
    $this->CustomerNumber = $CustomerNumber;

    return $this;
  }

  /**
   * Get the value of RequestID
   */ 
  public function getRequestID()
  {
    return $this->RequestID;
  }

  /**
   * Set the value of RequestID
   *
   * @return  self
   */ 
  public function setRequestID($RequestID)
  {
    $this->RequestID = $RequestID;

    return $this;
  }

  /**
   * Get the value of PaymentFlagStatus
   */ 
  public function getPaymentFlagStatus()
  {
    return $this->PaymentFlagStatus;
  }

  /**
   * Set the value of PaymentFlagStatus
   *
   * @return  self
   */ 
  public function setPaymentFlagStatus($PaymentFlagStatus)
  {
    $this->PaymentFlagStatus = $PaymentFlagStatus;

    return $this;
  }

  /**
   * Get the value of PaymentFlagReason
   */ 
  public function getPaymentFlagReason()
  {
    return $this->PaymentFlagReason;
  }

  /**
   * Set the value of PaymentFlagReason
   *
   * @return  self
   */ 
  public function setPaymentFlagReason($PaymentFlagReason)
  {
    $this->PaymentFlagReason = $PaymentFlagReason;

    return $this;
  }

  /**
   * Get the value of ChannelType
   */ 
  public function getChannelType()
  {
    return $this->ChannelType;
  }

  /**
   * Set the value of ChannelType
   *
   * @return  self
   */ 
  public function setChannelType($ChannelType)
  {
    $this->ChannelType = $ChannelType;

    return $this;
  }

  /**
   * Get the value of InquiryStatus
   */ 
  public function getInquiryStatus()
  {
    return $this->InquiryStatus;
  }

  /**
   * Set the value of InquiryStatus
   *
   * @return  self
   */ 
  public function setInquiryStatus($InquiryStatus)
  {
    $this->InquiryStatus = $InquiryStatus;

    return $this;
  }

  /**
   * Get the value of InquiryReason
   */ 
  public function getInquiryReason()
  {
    return $this->InquiryReason;
  }

  /**
   * Set the value of InquiryReason
   *
   * @return  self
   */ 
  public function setInquiryReason($InquiryReason)
  {
    $this->InquiryReason = $InquiryReason;

    return $this;
  }

  /**
   * Get the value of CustomerName
   */ 
  public function getCustomerName()
  {
    return $this->CustomerName;
  }

  /**
   * Set the value of CustomerName
   *
   * @return  self
   */ 
  public function setCustomerName($CustomerName)
  {
    $this->CustomerName = $CustomerName;

    return $this;
  }

  /**
   * Get the value of CurrencyCode
   */ 
  public function getCurrencyCode()
  {
    return $this->CurrencyCode;
  }

  /**
   * Set the value of CurrencyCode
   *
   * @return  self
   */ 
  public function setCurrencyCode($CurrencyCode)
  {
    $this->CurrencyCode = $CurrencyCode;

    return $this;
  }

  /**
   * Get the value of TotalAmount
   */ 
  public function getTotalAmount()
  {
    return $this->TotalAmount;
  }

  /**
   * Set the value of TotalAmount
   *
   * @return  self
   */ 
  public function setTotalAmount($TotalAmount)
  {
    $this->TotalAmount = $TotalAmount;

    return $this;
  }

  /**
   * Get the value of PaidAmount
   */ 
  public function getPaidAmount()
  {
    return $this->PaidAmount;
  }

  /**
   * Set the value of PaidAmount
   *
   * @return  self
   */ 
  public function setPaidAmount($PaidAmount)
  {
    $this->PaidAmount = $PaidAmount;

    return $this;
  }

  /**
   * Get the value of SubCompany
   */ 
  public function getSubCompany()
  {
    return $this->SubCompany;
  }

  /**
   * Set the value of SubCompany
   *
   * @return  self
   */ 
  public function setSubCompany($SubCompany)
  {
    $this->SubCompany = $SubCompany;

    return $this;
  }

  /**
   * Get the value of TransactionDate
   */ 
  public function getTransactionDate()
  {
    return $this->TransactionDate;
  }

  /**
   * Set the value of TransactionDate
   *
   * @return  self
   */ 
  public function setTransactionDate($TransactionDate)
  {
    $this->TransactionDate = $TransactionDate;

    return $this;
  }

  /**
   * Get the value of DetailBills
   */ 
  public function getDetailBills()
  {
    return $this->DetailBills;
  }

  /**
   * Set the value of DetailBills
   *
   * @return  self
   */ 
  public function setDetailBills($DetailBills)
  {
    $this->DetailBills = call_user_func($DetailBills);

    return $this;
  }

  /**
   * Get the value of FreeTexts
   */ 
  public function getFreeTexts()
  {
    return $this->FreeTexts;
  }

  /**
   * Set the value of FreeTexts
   *
   * @return  self
   */ 
  public function setFreeTexts($FreeTexts)
  {
    $this->FreeTexts = call_user_func($FreeTexts);

    return $this;
  }

  /**
   * Get the value of Referrence
   */ 
  public function getReferrence()
  {
    return $this->Referrence;
  }

  /**
   * Set the value of Referrence
   *
   * @return  self
   */ 
  public function setReferrence($Referrence)
  {
    $this->Referrence = $Referrence;

    return $this;
  }

  /**
   * Get the value of AdditionalData
   */ 
  public function getAdditionalData()
  {
    return $this->AdditionalData;
  }

  /**
   * Set the value of AdditionalData
   *
   * @return  self
   */ 
  public function setAdditionalData($AdditionalData)
  {
    $this->AdditionalData = $AdditionalData;

    return $this;
  }

  /**
   * Get the value of FlagAdvice
   */ 
  public function getFlagAdvice()
  {
    return $this->FlagAdvice;
  }

  /**
   * Set the value of FlagAdvice
   *
   * @return  self
   */ 
  public function setFlagAdvice($FlagAdvice)
  {
    $this->FlagAdvice = $FlagAdvice;

    return $this;
  }
}