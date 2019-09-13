<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentHistoryNonMember extends Model
{
  protected $table = 'payment_histories_non_members';
  
  protected $guarded = [];
}
