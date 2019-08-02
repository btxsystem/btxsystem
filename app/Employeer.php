<?php

namespace App;
use Nestable\NestableTrait;
use Illuminate\Database\Eloquent\Model;

class Employeer extends Model
{
    use NestableTrait;
    
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
        'rank_id',
        'bitrex_cash',
        'bitrex_points',
        'pv'
    ];

    public function getName(){
        return $this->first_name.' '.$this->last_name;
    }

}
