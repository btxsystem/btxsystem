<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoEbook extends Model
{
    protected $table = 'video_ebook';
  
    protected $guarded = [];

    public function videos()
    {
      return $this->hasMany('\App\Models\Video', 'id', 'book_id');
    }
}
