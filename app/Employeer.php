<?php

namespace App;
use Nestable\NestableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employeer extends Authenticatable
{
    use NestableTrait;
    use Notifiable;

    protected $hidden = [
        'password',
    ];
    
    protected $parent = 'parent_id';

    protected $fillable = [
        'id',
        'id_member',
        'username',
        'first_name',
        'last_name',
        'email',
        'password',
        'birthdate',
        'npwp_number',
        'is_married',
        'gender',
        'status',
        'phone_number',
        'no_rec',
        'position',
        'parent_id',
        'sponsor_id',
        'rank_id',
        'bitrex_cash',
        'bitrex_points',
        'pv'
    ];

    public function getName(){
        return $this->first_name.' '.$this->last_name;
    }

    public function children(){
        return $this->hasMany( 'App\Employeer', 'parent_id', 'id' );
    }
      
    public function parent(){
        return $this->hasOne( 'App\Employeer', 'id', 'parent_id' );
    }

}
