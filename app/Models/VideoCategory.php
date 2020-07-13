<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoCategory extends Model
{
    protected $table = 'video_categories';
  
    protected $guarded = [];

    public function ebook()
    {
      return $this->belongsTo('\App\Models\Ebook');
    }

    public function videos()
    {
      return $this->hasMany('\App\Models\Video', 'category_id', 'id');
    }
}
