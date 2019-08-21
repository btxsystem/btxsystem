<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PvRank extends Model
{
    protected $table = 'pv_rank';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'id',
        'pv_left',
        'pv_midle',
        'pv_right',
        'id_member',
    ];
}
