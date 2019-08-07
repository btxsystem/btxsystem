<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitraxCashHistory extends Model
{


  	protected $table = 'bitrax_cash_history';
  
	protected $fillable = [

       'id_member',
       'nominal',
       'description', 
        
    ];

	 protected $hidden = [
	      'created_at', 'updated_at'
	 ];

}
