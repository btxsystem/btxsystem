<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
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


    /**
     * Get the user record associated with the role.
     * 
     * @return object
     */
    public function user()
    {
        return $this->hasMany('\App\User');
    }

    /**
     * Get the permissions record associated with the role.
     * 
     * @return object
     */
    public function permissions()
    {
        return $this->belongsToMany('\App\RolesUser', 'permission_role', 'role_id', 'permission_id');
    }
 
}
