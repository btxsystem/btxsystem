<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageBook extends Model
{
  protected $table = 'image_book';
  
  protected $fillable = [
    'book_id',
    'image_id'
  ];
}
