<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  protected $table = 'images';
  
  protected $fillable = [
    'src',
    'name'
  ];

  protected $appends = [
    'image_url'
  ];

  public function getImageUrlAttribute()
  {
    return url($this->src);
  }
}
