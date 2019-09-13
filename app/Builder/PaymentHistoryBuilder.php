<?php

namespace App\Builder;

class PaymentHistoryBuilder
{
  public $id;

  public $ebookId;

  public $memberId;

  public $nonMemberId;

  public $refNo;

  public $paymentId = null;

  public $amount = null;

  public $currency = null;

  public $transId = null;

  public $remark = null;

  public $authCode = null;

  public $errDesc = null;

  public $status = null;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEbookId()
    {
        return $this->ebookId;
    }

    /**
     * @param mixed $ebookId
     */
    public function setEbookId($ebookId)
    {
        $this->ebookId = $ebookId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMemberId()
    {
        return $this->memberId;
    }

    /**
     * @param mixed $memberId
     */
    public function setMemberId($memberId)
    {
        $this->memberId = $memberId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNonMemberId()
    {
        return $this->nonMemberId;
    }

    /**
     * @param mixed $nonMemberId
     */
    public function setNonMemberId($nonMemberId)
    {
        $this->nonMemberId = $nonMemberId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRefNo()
    {
        return $this->refNo;
    }

    /**
     * @param mixed $refNo
     */
    public function setRefNo($refNo)
    {
        $this->refNo = $refNo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentId()
    {
        return $this->paymentId;
    }

    /**
     * @param mixed $paymentId
     */
    public function setPaymentId($paymentId)
    {
        $this->paymentId = $paymentId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransId()
    {
        return $this->transId;
    }

    /**
     * @param mixed $transId
     */
    public function setTransId($transId)
    {
        $this->transId = $transId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * @param mixed $remark
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthCode()
    {
        return $this->authCode;
    }

    /**
     * @param mixed $authCode
     */
    public function setAuthCode($authCode)
    {
        $this->authCode = $authCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrDesc()
    {
        return $this->errDesc;
    }

    /**
     * @param mixed $errDesc
     */
    public function setErrDesc($errDesc)
    {
        $this->errDesc = $errDesc;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

}
