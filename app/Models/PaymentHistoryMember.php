<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentHistoryMember extends Model
{
  protected $table = 'payment_histories';

  protected $guarded = [];

  public function ebook()
  {
      return $this->hasOne('\App\Models\Ebook', 'id', 'ebook_id');
  }
  public function member()
  {
      return $this->hasOne('\App\Employeer', 'id', 'member_id');
  }  
}
