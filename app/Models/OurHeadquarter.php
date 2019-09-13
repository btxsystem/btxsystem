<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AttachableImageTrait;

class OurHeadquarter extends Model
{
    use AttachableImageTrait;

    protected $table = 'our_headquarters';
  
    protected $guarded = [];
}
