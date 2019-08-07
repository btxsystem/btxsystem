<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{

    protected $table = 'trainings';
	
    protected $fillable = [
        'location',
        'start_training',
        'price',
        'capacity',
        'note',
        'open',
    ];
}
