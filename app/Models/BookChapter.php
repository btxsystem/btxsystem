<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookChapter extends Model
{
  protected $table = 'book_chapters';
  
  protected $fillable = [
    'title',
    'book_id'
  ];

  public function lessons()
  {
      return $this->hasMany('\App\Models\BookChapterLesson', 'chapter_id', 'id');
  }

  public function book()
  {
      return $this->hasOne('\App\Models\Book', 'id', 'book_id');
  }
}
