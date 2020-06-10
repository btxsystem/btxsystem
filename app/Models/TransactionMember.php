<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\TransactionEbookExpired;
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

  public function member()
  {
      return $this->hasOne('\App\Employeer', 'id', 'member_id');
  }

  public function transaction_ebook_expired()
    {
        return $this->hasOne( TransactionEbookExpired::class, 'id', 'transaction_id');
    }
}
