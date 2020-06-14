<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginThrottle extends Model
{
    protected $table = 'login_throttles';
  
    protected $guarded = [];
}
