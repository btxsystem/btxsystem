<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HallOfFame extends Model
{
    protected $table = 'hall_of_fame';

    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo('\App\Employeer');
    }
}
