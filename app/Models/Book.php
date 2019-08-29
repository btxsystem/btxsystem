<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
  protected $table = 'books';
  
  protected $fillable = [
    'title',
    'slug',
  ];

  public function bookEbook()
  {
    return $this->hasOne('\App\Models\BookEbook', 'book_id', 'id');
  }

  public function ebooks()
  {
    return $this->belongsToMany('\App\Models\Ebook');
  }

  public function images()
  {
    return $this->belongsToMany('\App\Models\Image', 'image_book','book_id', 'image_id');
  }

  public function chapters()
  {
      return $this->hasMany('\App\Models\BookChapter', 'book_id', 'id');
  }

  public function lessons()
  {
      return $this->hasMany('\App\Models\BookChapterLesson', 'book_id', 'id');
  }

  public function imageBooks()
  {
      return $this->hasMany('\App\Models\ImageBook', 'book_id', 'id');
  }
}
