<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AttachableImageTrait;

class EventPromotion extends Model
{
    use AttachableImageTrait;
    
    protected $table = 'event_promotions';
  
    protected $guarded = [];
}
