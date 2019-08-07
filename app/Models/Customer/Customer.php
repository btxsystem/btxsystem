<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{


  protected $table = 'non_members';
  
	protected $fillable = [

       'first_name',
       'last_name',
       'username', 
       'email',	
       'password',
       'created_at',
       'updated_at'
         
    ];

  protected $hidden = [
      'created_at', 'updated_at'
  ];

}
