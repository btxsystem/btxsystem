<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rank extends Model
{
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'pv_needed_left',
        'pv_needed_midle',
        'pv_needed_right',
        'needed_sponsor',
    ];

    // public function employeers()
    // {
    //     return $this->hasMany(Employeer::class);
    // }
}
