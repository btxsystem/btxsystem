<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleryVideo extends Model
{
    protected $table = 'galery_videos';

    protected $guarded = [];

    protected $appends = [
        'path_url'
    ];

    public function getPathUrlAttribute()
    {
        return url($this->path);
    }
}
