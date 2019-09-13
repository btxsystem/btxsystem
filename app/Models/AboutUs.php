<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us';
  
    protected $guarded = [];

    protected $appends = [
        'image_url'
      ];

    public function getImageUrlAttribute()
    {
      return $this->img ? url($this->img) : 'No Image';
    }
}
