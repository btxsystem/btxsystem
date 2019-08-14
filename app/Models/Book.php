<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
  protected $table = 'books';
  
  protected $fillable = [
    'title',
  ];

  public function chapters()
  {
      return $this->hasMany('\App\Models\BookChapter', 'book_id', 'id');
  }
}
