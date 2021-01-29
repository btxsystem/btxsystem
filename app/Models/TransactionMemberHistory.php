<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class TransactionMemberHistory extends Model
{
  protected $table = 'transaction_member_histories';
  protected $fillable = [
    'id',
    'transaction_id',
    'pv',
    'bv',
    'discount',
    'price_discount',
    'price',
  ];

  public function transaction()
  {
      return $this->belongsTo(TransactionMember::class, 'transaction_id');
  }
}