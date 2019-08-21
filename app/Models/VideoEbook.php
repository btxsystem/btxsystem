<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoEbook extends Model
{
  protected $table = 'video_ebook';
  
  protected $fillable = [
    'video_id',
    'ebook_id'
  ];
  
  public function videos()
  {
    return $this->hasMany('\App\Models\Video', 'id', 'video_id');
  }

  public function video()
  {
    return $this->hasOne('\App\Models\Video', 'id', 'video_id');
  }
}
