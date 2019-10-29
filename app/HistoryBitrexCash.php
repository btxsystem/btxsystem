<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryBitrexCash extends Model
{


  	protected $table = 'history_bitrex_cash';
  
	protected $guarded = [];

	 protected $hidden = [
	     'updated_at'
	 ];

	 public function member()
	 {
	   return $this->belongsTo('\App\Employeer', 'id_member');
	 }

}
