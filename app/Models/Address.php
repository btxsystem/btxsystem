<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
  
    protected $guarded = [];

    public function member()
    {
        return $this->hasOne( 'App\Employeer', 'id' );
    }
  
}
