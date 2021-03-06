<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class GotReward extends Model
{
    protected $table = 'got_rewards';

    protected $guarded = [];

    public function reward()
    {
        return $this->belongsTo('\App\Models\GiftReward', 'reward_id');
    }

    public function member()
    {
        return $this->belongsTo('\App\Employeer', 'member_id');
    }
}
