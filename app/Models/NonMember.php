<?php

namespace App\Models;
use Nestable\NestableTrait;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class NonMember extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'non_members';

    protected $hidden = [
        'password',
    ];  
    
    public function transfer_confirmations()
    {
        return $this->morphMany('App\Models\TransferConfirmation', 'user_type');
    }
}
