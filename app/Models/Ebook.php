<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
  protected $table = 'ebooks';
  
  protected $fillable = [
    'title',
    'price',
    'pv',
    'bv',
    'price_markup'
  ];


  public function books()
  {
      return $this->belongsToMany('\App\Models\Book');
  }

  public function videos()
  {
    return $this->belongsToMany('\App\Models\Video', 'video_ebook', 'book_id', 'video_id');
  }


  public function bookEbooks()
  {
      return $this->hasMany('\App\Models\BookEbook', 'ebook_id', 'id');
  }
}
