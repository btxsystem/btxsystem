<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionMember extends Model
{
  protected $table = 'transaction_member';
  protected $fillable = [
    'id',
    'member_id',
    'ebook_id',
    'created_at',
    'updated_at',
    'status',
    'expired_at'
  ];

  public function ebook()
  {
      return $this->hasOne('\App\Models\Ebook', 'id', 'ebook_id');
  }
}
