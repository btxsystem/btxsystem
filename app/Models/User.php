<?php

namespace App\Models;

use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;


class User extends Authenticatable
{
     use HasApiTokens, Notifiable;


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'email_verified_at',
    ];

    protected $fillable = [
        'username',
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'roles_id',
        'fcm_token',
        'created_at',
        'updated_at',
        'deleted_at'
    ];



    //------------------ api ---------------------

    /**
     * Authorize permission
     *
     * @param string $permission - accepted permission
     *
     * @return object
     */
    public function hasPermission($permission)
    {
        return (null !== DB::table('permission_role')
        ->join('permissions', 'permission_role.permission_id', '=', 'permissions.id')
        ->where('permissions.name', $permission)
        ->where('permission_role.role_id', $this->roles_id)
        ->first() || abort(401, 'This action is unauthorized.'));
    }

    public static function authAcessToken(){
        return $this->hasMany('\App\OauthAccessToken');
    }

        /**
     * Get the role record associated with the user.
     *
     * @return object
     */
    public function roles()
    {
        return $this->belongsTo('\App\Models\Roles', 'roles_id', 'id');
    }


    /**
     * Get the role record associated with the user.
     *
     * @return object
     */
    public function permissions()
    {
        return $this->belongsToMany('\App\Permissions', 'permission_role', 'role_id', 'permission_id');
    }
}
