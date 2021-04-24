<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Xendit extends Model
{
    protected $table = "xendit_payment";
    protected $guarded = [];

    public function member(){
        return $this->hasOne(Employeer::class, 'id', 'user_id');
    }
}
