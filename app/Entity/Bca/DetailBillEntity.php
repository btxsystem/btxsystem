<?php

namespace App\Entities\Bca;
use App\Entities\Bca\VaBillEntity;
use App\Entities\Bca\LanguageEntity;
use Closure;

class DetailBillEntity
{
  public $ID;
  
  public $BillDescription;

  public $BillAmount = 20;

  public $BillNumber;

  public $BillSubCompany;

  public $BillReferrence;

  public $ProductDetail;

  public function setBillDescription($class)
  {
    $this->BillDescription = $class;

    return $this;
  }

  public function setBillAmount($BillAmount)
  {
    $this->BillAmount = $BillAmount;
    return $this;
  }

  public function setBillNumber($BillNumber)
  {
    $this->BillNumber = $BillNumber;
    return $this;
  }

  public function setBillSubCompany($BillSubCompany)
  {
    $this->BillSubCompany = $BillSubCompany;
    return $this;
  }

  /**
   * Get the value of BillReferrence
   */ 
  public function getBillReferrence()
  {
    return $this->BillReferrence;
  }

  /**
   * Set the value of BillReferrence
   *
   * @return  self
   */ 
  public function setBillReferrence($BillReferrence)
  {
    $this->BillReferrence = $BillReferrence;

    return $this;
  }

  /**
   * Get the value of ProductDetail
   */ 
  public function getProductDetail()
  {
    return $this->ProductDetail;
  }

  /**
   * Set the value of ProductDetail
   *
   * @return  self
   */ 
  public function setProductDetail($ProductDetail)
  {
    $this->ProductDetail = $ProductDetail;

    return $this;
  }

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
}