<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function boot() {
        parent::boot();
    
        static::deleting(function($comment) { 
            $comment->permissions()->delete();
        });
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
