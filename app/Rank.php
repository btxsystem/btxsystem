<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'id',
        'name',
        'pv_needed_left',
        'pv_needed_midle',
        'pv_needed_right',
        'needed_sponsor',
    ];

    public function employeers()
    {
        return $this->hasMany(Employeer::class);
    }
}
