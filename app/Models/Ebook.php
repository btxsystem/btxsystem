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

  public function bookEbooks()
  {
      return $this->hasMany('\App\Models\BookEbook', 'ebook_id', 'id');
  }
  
  public function videoEbooks()
  {
      return $this->hasMany('\App\Models\VideoEbook', 'ebook_id', 'id');
  }
}
