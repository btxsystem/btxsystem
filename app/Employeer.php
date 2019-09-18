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

    protected $appends = [
        'bonus_sponsor','tax_sponsor',
        'bonus_pairing','tax_pairing',
        'bonus_profit','tax_profit',
        'bonus_reward','tax_reward',
        'total_bonus'
      ];

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

    public function pv_histories()
    {
        return $this->hasMany('App\HistoryPv','id_member');
    }

    public function transaction(){
        return $this->hasOne( 'App\Models\Transaction', 'user_id');
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

    public function getBonusSponsorAttribute()
    {
       return \DB::table('history_bitrex_cash')
                ->where('id_member', $this->id)
                ->where('type', 0)
                ->sum('nominal');
    }

    public function getTaxSponsorAttribute()
    {
       return \DB::table('history_pajak')
                ->where('id_member', $this->id)
                ->where('id_bonus', 0)
                ->sum('nominal');
    }

    public function getBonusPairingAttribute()
    {
       return \DB::table('history_bitrex_cash')
                ->where('id_member', $this->id)
                ->where('type', 1)
                ->sum('nominal');
    }

    public function getTaxPairingAttribute()
    {
       return \DB::table('history_pajak')
                ->where('id_member', $this->id)
                ->where('id_bonus', 1)
                ->sum('nominal');
    }

    public function getBonusProfitAttribute()
    {
       return \DB::table('history_bitrex_cash')
                ->where('id_member', $this->id)
                ->where('type', 2)
                ->sum('nominal');
    }

    public function getTaxProfitAttribute()
    {
       return \DB::table('history_pajak')
                ->where('id_member', $this->id)
                ->where('id_bonus', 2)
                ->sum('nominal');
    }

    public function getBonusRewardAttribute()
    {
       return \DB::table('history_bitrex_cash')
                ->where('id_member', $this->id)
                ->where('type', 3)
                ->sum('nominal');
    }

    public function getTaxRewardAttribute()
    {
       return \DB::table('history_pajak')
                ->where('id_member', $this->id)
                ->where('id_bonus', 2)
                ->sum('nominal');
    }

    public function getTotalBonusAttribute()
    {
       return \DB::table('history_bitrex_cash')
                ->where('id_member', $this->id)
                ->sum('nominal');
    }

    public function scopeFilter($query, $request)
    {
        if ($request->has('search') && $request->search['value'] !== null) {
            $query->where('id_member', 'like', '%'.$request->search['value'].'%');
            $query->OrWhere('username', 'like', '%'.$request->search['value'].'%');
            $query->OrWhere('first_name', 'like', '%'.$request->search['value'].'%');
            $query->OrWhere('last_name', 'like', '%'.$request->search['value'].'%');
            $query->OrWhere('npwp_number', 'like', '%'.$request->search['value'].'%');
            $query->OrWhere('no_rec', 'like', '%'.$request->search['value'].'%');
        }
    }

}
