<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PvHistory extends Model
{
    protected $table = 'history_pv';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'id',
        'pv',
        'pv_today',
        'id_member',
    ];
}
