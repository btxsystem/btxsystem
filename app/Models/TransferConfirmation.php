<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferConfirmation extends Model
{
    protected $table = 'transfer_confirmations';
  
    protected $guarded = [];

    public function user()
    {
        return $this->morphTo();
    }

    // public function member()
    // {
    //   if ($this->isMember() || $this->isNullMember()) {
    //     return $this->belongsTo('\App\Employeer','user_id')->select('id','username');
    //   } else {
    //     return false;
    //   }

    // }

    // public function nonmember()
    // {
    //   return $this->belongsTo('\App\Models\NonMember','user_id')->select('id','username');
    // }

    // public function scopeType($query)
    // {
    //     return $query
    //           ->when($this->user_type === 'member',function($q){
    //               return $q->with('member');
    //          })
    //          ->when($this->user_type === 'nonmember',function($q){
    //               return $q->with('nonmember');
    //          });
    // }
}
