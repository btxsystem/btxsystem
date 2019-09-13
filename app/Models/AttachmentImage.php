<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttachmentImage extends Model
{
    protected $table = "attachment_images";

    protected $guarded=[];

    protected $appends = [
        'image_url'
      ];
  
    public function attachable()
    {
        return $this->morphTo();
    }

    public function getImageUrlAttribute()
    {
      return $this->path ? url($this->path) : 'No Image';
    }
}
