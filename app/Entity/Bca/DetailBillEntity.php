<?php

namespace App\Entities\Bca;
use App\Entities\Bca\VaBillEntity;
use App\Entities\Bca\LanguageEntity;
use Closure;

class DetailBillEntity
{
  public $BillDescription;

  public $BillAmount = 20;

  public $BillNumber;

  public $BillSubCompany;

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
}