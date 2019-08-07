<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = [
        'location',
        'start_training',
        'price',
        'capacity',
        'note',
        'open',
    ];
}
