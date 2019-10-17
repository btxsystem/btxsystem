<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryBitrexPoints extends Model
{
    protected $table = 'history_bitrex_point';

    protected $guarded = [];
    
    public function member()
    {
        return $this->hasOne(Employeer::class, 'id', 'id_member');
    }
}
