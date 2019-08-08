<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class Trening extends Model
{


  protected $table = 'trainings';
  
	protected $fillable = [

       'location',
        'start_training',
        'price',
        'capacity',
        'note',
        'open',
        'created_by'
         
    ];

  protected $hidden = [
      'created_at', 'updated_at'
  ];

}
