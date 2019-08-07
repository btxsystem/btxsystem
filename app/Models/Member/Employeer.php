<?php

namespace App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\System\BaseModel;

class Employeer extends BaseModel
{

    protected $table = 'employeers';

    protected $dates = ['deleted_at'];

    protected $fillable = [
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
        'created_at',
        'updated_at',
        'bitrex_cash',
        'bitrex_points',
        'pv',        
    ];


    public function rank()
    {
        return $this->belongsTo('App\Models\Member\Rank', 'rank_id', 'id');
    }

}
