<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryPv extends Model
{
    protected $table = 'history_pv';
    protected $fillable = [
        'id',
        'pv',
        'pv_today',
        'id_member',
        'created_at',
        'updated_at',
    ];
}
