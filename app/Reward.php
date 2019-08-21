<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{


  	protected $table = 'gift_rewards';
  
	protected $fillable = [
       'id',
       'description',
       'nominal',
	   'description', 
	   'created_at',
    ];

	 protected $hidden = [
	     'updated_at'
	 ];

}
