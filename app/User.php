<?php

namespace App;

use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

use App\Traits\PassportToken;

class User extends Authenticatable
{
     use HasApiTokens, Notifiable, PassportToken;

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

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function hasPermission($permission)
    {
        return (null !== DB::table('permission_role')
        ->join('permissions', 'permission_role.permission_id', '=', 'permissions.id')
        ->where('permissions.name', $permission)
        ->where('permission_role.role_id', $this->roles_id)
        ->first() || false);
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


    //------------------ api ---------------------

    /**
     * Authorize permission
     *
     * @param string $permission - accepted permission
     *
     * @return object
     */

    public static function authAcessToken(){
        return $this->hasMany('\App\OauthAccessToken');
    }

}
