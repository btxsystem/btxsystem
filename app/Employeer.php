<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Employeer extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
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

    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }
}
