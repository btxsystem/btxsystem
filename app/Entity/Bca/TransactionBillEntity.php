<?php

namespace App\Entities\Bca;

use App\Entities\Bca\DetailBillEntity;
use App\Entities\Bca\LanguageEntity;

class TransactionBillEntity
{
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

  public $AdditionalData;

  public $FlagAdvide;

  /**
   * Setter function
   *
   * @param [type] $AdditionalData
   * @return void
   */
  public function setCompanyCode($CompanyCode)
  {
    $this->CompanyCode = $CompanyCode;

    return $this;
  }

  /**
   * Setter function
   *
   * @param [type] $AdditionalData
   * @return void
   */
  public function setCustomerNumber($CustomerNumber)
  {
    $this->CustomerNumber = $CustomerNumber;

    return $this;
  }

  /**
   * Setter function
   *
   * @param [type] $AdditionalData
   * @return void
   */
  public function setRequestID($RequestID)
  {
    $this->RequestID = $RequestID;

    return $this;
  }

  /**
   * Setter function
   *
   * @param [type] $PaymentFlagStatus
   * @return void
   */
  public function setPaymentFlagStatus($PaymentFlagStatus)
  {
    $this->PaymentFlagStatus = $PaymentFlagStatus;

    return $this;
  }

  /**
   * Setter function
   *
   * @param [type] $AdditionalData
   * @return void
   */
  public function setPaymentFlagReason($PaymentFlagReason)
  {
    $this->PaymentFlagReason = $PaymentFlagReason;

    return $this;
  }

  /**
   * Setter function
   *
   * @param [type] $AdditionalData
   * @return void
   */
  public function setChannelType($ChannelType)
  {
    $this->ChannelType = $ChannelType;

    return $this;
  }

  /**
   * Setter function
   *
   * @param [type] $AdditionalData
   * @return void
   */
  public function setInquiryStatus($InquiryStatus)
  {
    $this->InquiryStatus = $InquiryStatus;

    return $this;
  }

  /**
   * Setter function
   *
   * @param [type] $AdditionalData
   * @return void
   */
  public function setInquiryReason($class)
  {
    $this->InquiryReason = $class;

    return $this;
  }

  /**
   * Setter function
   *
   * @param [type] $AdditionalData
   * @return void
   */
  public function setCustomerName($CustomerName)
  {
    $this->CustomerName = $CustomerName;

    return $this;
  }

  /**
   * Setter function
   *
   * @param [type] $AdditionalData
   * @return void
   */
  public function setCurrencyCode($CurrencyCode)
  {
    $this->CurrencyCode = $CurrencyCode;

    return $this;
  }

  /**
   * Setter function
   *
   * @param [type] $AdditionalData
   * @return void
   */
  public function setTotalAmount($TotalAmount)
  {
    $this->TotalAmount = $TotalAmount;

    return $this;
  }

  /**
   * Setter function
   *
   * @param [type] $AdditionalData
   * @return void
   */
  public function setPaidAmount($PaidAmount)
  {
    $this->PaidAmount = $PaidAmount;

    return $this;
  }

  /**
   * Setter function
   *
   * @param [type] $AdditionalData
   * @return void
   */
  public function setSubCompany($SubCompany)
  {
    $this->SubCompany = $SubCompany;

    return $this;
  }

  /**
   * Setter function
   *
   * @param [type] $AdditionalData
   * @return void
   */
  public function setTransactionDate($TransactionDate)
  {
    $this->TransactionDate = $TransactionDate;

    return $this;
  }

  /**
   * Setter function
   *
   * @param [type] $AdditionalData
   * @return void
   */
  public function setFreeTexts($class)
  {
    $this->FreeTexts = call_user_func($class);

    return $this;
  }

  /**
   * Setter function
   *
   * @param [type] $AdditionalData
   * @return void
   */
  public function setDetailBiils($class)
  {
    $this->DetailBills = call_user_func($class);

    return $this;
  }

  /**
   * Setter function
   *
   * @param [type] $AdditionalData
   * @return void
   */
  public function setAdditionalData($AdditionalData)
  {
    $this->AdditionalData = $AdditionalData;

    return $this;
  }

  /**
   * Setter function
   *
   * @param [type] $FlagAdvide
   * @return void
   */
  public function setFlagAdvide($FlagAdvide)
  {
    $this->FlagAdvide = $FlagAdvide;

    return $this;
  }
}