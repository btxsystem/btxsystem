<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionNonMember extends Model
{
  protected $table = 'transaction_non_members';

  public function ebook()
  {
      return $this->hasOne('\App\Models\Ebook', 'id', 'ebook_id');
  }
}
