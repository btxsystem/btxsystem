<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
  
    protected $guarded = [];


    public function member()
    {
        return $this->hasOne( 'App\Employeer', 'id', 'user_id');
    }

    public function product()
    {
        return $this->hasOne( 'App\Product', 'id', 'product_id');
    }


}
