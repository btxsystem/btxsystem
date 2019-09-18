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
	   'info',
	   'type'
    ];

	 protected $hidden = [
	     'updated_at'
	 ];

	 public function member()
	 {
	   return $this->belongsTo('\App\Employeer', 'id_member');
	 }

}
