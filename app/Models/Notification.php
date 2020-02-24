<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notification';

    protected $guarded = [];

    public function user(){
        return $this->belongsTo('\App\Employeer', 'member_id');
    }
}
