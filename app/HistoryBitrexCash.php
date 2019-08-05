<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryBitrexCash extends Model
{


  	protected $table = 'history_bitrex_cash';
  
	protected $fillable = [

       'id_member',
       'nominal',
	   'description', 
	   'created_at',
    ];

	 protected $hidden = [
	     'updated_at'
	 ];

}
