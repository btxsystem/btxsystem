<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';
  
    protected $guarded = [];

    protected $appends = [
        'path_url'
    ];

    public function ebooks()
    {
        return $this->belongsToMany('\App\Models\Ebook', 'video_ebook', 'video_id', 'ebook_id');
    }

    public function videoEbook()
    {
      return $this->hasOne('\App\Models\VideoEbook', 'video_id');
    }

    public function category()
    {
      return $this->belongsTo('\App\Models\VideoCategory', 'id', 'category_id');
    }

    public function getPathUrlAttribute()
    {
        return url($this->path);
    }
}
