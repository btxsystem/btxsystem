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

  public function member()
  {
      return $this->hasOne('\App\Employeer', 'id', 'member_id');
  }

  public function nonMember()
  {
      return $this->hasOne('\App\Models\NonMember', 'id', 'non_member_id');
  }
}
