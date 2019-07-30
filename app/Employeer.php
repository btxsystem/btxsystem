<?php

namespace App;
use Nestable\NestableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Employeer extends Model
{
    use NestableTrait;
    
    protected $parent = 'parent_id';

    protected $fillable = [
        'id',
        'id_member',
        'first_name',
        'last_name',
        'password',
        'birthdate',
        'npwp_number',
        'is_married',
        'gender',
        'status',
        'phone_number',
        'no_rec',
        'rank_id',
    ];

    public function getName(){
        return $this->first_name.' '.$this->last_name;
    }

}
