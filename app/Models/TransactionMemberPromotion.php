<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class TransactionMemberPromotion extends Model
{
  protected $table = 'transaction_members_promotion';
  protected $fillable = [
    'id',
    'member_id',
    'ebook_id',
    'created_at',
    'updated_at',
    'type',
  ];
}