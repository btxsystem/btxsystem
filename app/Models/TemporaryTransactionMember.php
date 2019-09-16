<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemporaryTransactionMember extends Model
{
  protected $table = 'temporary_transaction_members';
  
  protected $guarded = [];

  public function member()
  {
      return $this->hasOne('\App\Models\TemporaryRegisterMember', 'id', 'member_id');
  }
}
