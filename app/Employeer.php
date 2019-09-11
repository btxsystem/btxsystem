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
        'verification',
        'bitrex_cash',
        'bitrex_points',
        'pv',
        'src',
        'is_update',
        'nik',
        'expired_at'
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

    public function sponsor(){
        return $this->hasOne( 'App\Employeer', 'id', 'sponsor_id' );
    }

    public function ebooks()
    {
      return $this->belongsToMany('\App\Models\Ebook', 'transaction_member', 'member_id', 'ebook_id');
    }

    public function point_histories()
    {
        return $this->hasMany('App\HistoryBitrexPoints','id_member');
    }

    public function cash_histories()
    {
        return $this->hasMany('App\HistoryBitrexCash','id_member');
    }

    public function transaction_member()
    {
        return $this->hasMany('App\Models\TransactionMember','member_id');
    }

    public function rank(){
        return $this->belongsTo('App\Rank','rank_id');
    }

    public function pv_down(){
        return $this->hasOne('App\PvRank','id_member');
    }

}
