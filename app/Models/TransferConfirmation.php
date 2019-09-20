<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferConfirmation extends Model
{
    protected $table = 'transfer_confirmations';
  
    protected $guarded = [];

    public function member()
    {
      return $this->belongsTo('\App\Employeer','user_id')->select('id','username');
    }
}
