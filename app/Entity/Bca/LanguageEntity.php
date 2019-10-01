<?php

namespace App\Entities\Bca;

class LanguageEntity
{
  public $Indonesian;

  public $English;

  public function setIndonesian($Indonesian)
  {
    $this->Indonesian = $Indonesian;

    return $this;
  }

  public function setEnglish($English)
  {
    $this->English = $English;

    return $this;
  }
}