<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookEbook extends Model
{
  protected $table = 'book_ebook';
  
  protected $fillable = [
    'book_id',
    'ebook_id'
  ];
  
  protected $guarded = [];

  protected $appends = [
    'ebook_title'
  ];
  
  public function books()
  {
    return $this->hasMany('\App\Models\Book', 'id', 'book_id');
  }

  public function book()
  {
    return $this->hasOne('\App\Models\Book', 'id', 'book_id');
  }

  public function ebook()
  {
    return $this->hasOne('\App\Models\Ebook', 'id', 'ebook_id');
  }

  public function getEbookTitleAttribute()
  {
    return $this->ebook ? $this->ebook->title : '';
  }
}
