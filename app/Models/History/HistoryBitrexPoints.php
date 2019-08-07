<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryBitrexPoints extends Model
{
    protected $table = 'history_bitrex_point';

    protected $fillable = [
        'id',
        'id_member',
        'nominal',
        'points',
        'description',
    ];
}
