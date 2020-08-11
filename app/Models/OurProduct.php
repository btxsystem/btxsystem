<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OurProduct extends Model
{
    use SoftDeletes;
    
    protected $table = 'our_products';
  
    protected $guarded = [];

    protected $dates = ['deleted_at'];
}
