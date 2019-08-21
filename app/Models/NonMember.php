<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class NonMember extends Authenticatable
{
  protected $table = 'non_members';
}
