<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolesUser extends Model
{


  protected $table = 'permission_role';
  
  protected $fillable = [

       'role_id',
       'permission_id',
         
    ];


}
