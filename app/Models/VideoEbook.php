<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoEbook extends Model
{

    protected $table = 'video_ebook';
  
    protected $guarded = [];

    protected $appends = [
        'ebook_title'
      ];
  
    public function videos()
    {
        return $this->hasMany('\App\Models\Video', 'id', 'video_id');
    }

    public function video()
    {
        return $this->hasOne('\App\Models\Video', 'id', 'video_id');
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
