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
        return $this->belongsToMany('\App\Models\Ebook', 'video_ebook', 'video_id', 'book_id');
    }

    public function getPathUrlAttribute()
    {
        return url($this->path);
    }
}
