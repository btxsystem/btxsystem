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

  public function books()
  {
    return $this->belongsToMany('\App\Models\Book', 'image_book','image_id', 'book_id');
  }


  public function getImageUrlAttribute()
  {
    return url($this->src);
  }
}
