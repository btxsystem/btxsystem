<?php

namespace App\Models;

use App\Employeer;
use Illuminate\Database\Eloquent\Model;

class TransactionBill extends Model
{
    protected $table = 'transaction_biils';
  
    protected $guarded = [];

    public function member()
    {
      return $this->hasOne(Employeer::class, 'id', 'user_id');
    }

    public function nonMember()
    {
      return $this->hasOne(NonMember::class, 'id', 'user_id');
    }
}
