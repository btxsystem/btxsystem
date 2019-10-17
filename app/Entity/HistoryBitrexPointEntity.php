<?php

namespace App\Entities;

class HistoryBitrexPointEntity
{
  public $id;

  public $idMember;

  public $nominal;

  public $points;

  public $description;

  public $info;

  public $status;

  public $transactionRef;

  /**
   * Get the value of id
   */ 
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set the value of id
   *
   * @return  self
   */ 
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of idMember
   */ 
  public function getIdMember()
  {
    return $this->idMember;
  }

  /**
   * Set the value of idMember
   *
   * @return  self
   */ 
  public function setIdMember($idMember)
  {
    $this->idMember = $idMember;

    return $this;
  }

  /**
   * Get the value of nominal
   */ 
  public function getNominal()
  {
    return $this->nominal;
  }

  /**
   * Set the value of nominal
   *
   * @return  self
   */ 
  public function setNominal($nominal)
  {
    $this->nominal = $nominal;

    return $this;
  }

  /**
   * Get the value of points
   */ 
  public function getPoints()
  {
    return $this->points;
  }

  /**
   * Set the value of points
   *
   * @return  self
   */ 
  public function setPoints($points)
  {
    $this->points = $points;

    return $this;
  }

  /**
   * Get the value of description
   */ 
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Set the value of description
   *
   * @return  self
   */ 
  public function setDescription($description)
  {
    $this->description = $description;

    return $this;
  }

  /**
   * Get the value of info
   */ 
  public function getInfo()
  {
    return $this->info;
  }

  /**
   * Set the value of info
   *
   * @return  self
   */ 
  public function setInfo($info)
  {
    $this->info = $info;

    return $this;
  }

  /**
   * Get the value of status
   */ 
  public function getStatus()
  {
    return $this->status;
  }

  /**
   * Set the value of status
   *
   * @return  self
   */ 
  public function setStatus($status)
  {
    $this->status = $status;

    return $this;
  }

  /**
   * Get the value of transactionRef
   */ 
  public function getTransactionRef()
  {
    return $this->transactionRef;
  }

  /**
   * Set the value of transactionRef
   *
   * @return  self
   */ 
  public function setTransactionRef($transactionRef)
  {
    $this->transactionRef = $transactionRef;

    return $this;
  }
}