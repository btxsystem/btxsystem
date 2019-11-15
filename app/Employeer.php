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

    // protected $appends = [
    //     'bonus_sponsor','tax_sponsor',
    //     'bonus_pairing','tax_pairing',
    //     'bonus_profit','tax_profit',
    //     'bonus_reward','tax_reward',
    //     'total_bonus'
    //   ];

    protected $guarded = [];

    public function getName()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function children()
    {
        return $this->hasMany( 'App\Employeer', 'parent_id', 'id');
    }
      
    public function parent()
    {
        return $this->hasOne( 'App\Employeer', 'id', 'parent_id');
    }

    public function sponsor()
    {
        return $this->hasOne( 'App\Employeer', 'id', 'sponsor_id');
    }
    
    public function address()
    {
        return $this->hasOne( 'App\Models\Address', 'user_id');
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

    public function history_pv_pairing()
    {
        return $this->hasMany('\App\Models\HistoryPVPairing','id_member');
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
        return $this->hasMany('App\Models\TransactionMember','member_id')->where('status', 1);
    }

    public function rank(){
        return $this->belongsTo('App\Rank','rank_id');
    }

    public function pv_down(){
        return $this->hasOne('App\PvRank','id_member');
    }

    public function transfer_confirmations()
    {
        return $this->morphMany('App\Models\TransferConfirmation', 'user');
    }

    public function getBonusSponsorAttribute()
    {
        // Wheredate untuk memisahkan data baru setelah migrasi data 2019-09-18 00:00:00'
        // Wheredate untuk memisahkan data baru setelah withdraw data 2019-09-25 00:00:00'
       return \DB::table('history_bitrex_cash')
                ->where('created_at', '>', $this->getWithdrawalTime()->last_withdrawal)
                ->where('created_at', '<', $this->getWithdrawalTime()->next_withdrawal)
                ->where('id_member', $this->id)
                ->where('type', 0)
                ->where('info', 1)
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
        // Wheredate untuk memisahkan data baru setelah migrasi data 2019-09-18 00:00:00'
        // Wheredate untuk memisahkan data baru setelah withdraw data 2019-09-25 00:00:00'

       return \DB::table('history_bitrex_cash')
                ->where('created_at', '>', $this->getWithdrawalTime()->last_withdrawal)
                ->where('created_at', '<', $this->getWithdrawalTime()->next_withdrawal)
                ->where('id_member', $this->id)
                ->where('type', 1)
                ->where('info', 1)
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
        // Wheredate untuk memisahkan data baru setelah migrasi data 2019-09-18 00:00:00'
        // Wheredate untuk memisahkan data baru setelah withdraw data 2019-09-25 00:00:00'
       return \DB::table('history_bitrex_cash')
                ->where('created_at', '>', $this->getWithdrawalTime()->last_withdrawal)
                ->where('created_at', '<', $this->getWithdrawalTime()->next_withdrawal)
                ->where('id_member', $this->id)
                ->where('type', 2)
                ->where('info', 1)
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
        // Wheredate untuk memisahkan data baru setelah migrasi data 2019-09-18 00:00:00'
        // Wheredate untuk memisahkan data baru setelah withdraw data 2019-09-25 02:00:00'
       return \DB::table('history_bitrex_cash')
                ->where('created_at', '>', $this->getWithdrawalTime()->last_withdrawal)
                ->where('created_at', '<', $this->getWithdrawalTime()->next_withdrawal)
                ->where('id_member', $this->id)
                ->where('type', 3)
                ->where('info', 1)
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
                ->where('created_at', '>', $this->getWithdrawalTime()->last_withdrawal)
                ->where('created_at', '<', $this->getWithdrawalTime()->next_withdrawal)
                ->where('id_member', $this->id)
                ->where('info', 1)
                ->sum('nominal');
    }

    public function getWithdrawalTime()
    {
        return \DB::table('withdrawal_time')
                ->where('id', 1)->first();
    }

    public function getTakeStarterpackAttribute()
    {
        return $this->address ? 'Shipping' : 'Take Away';
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

    public function getallMember()
    {
        return \DB::table('employeers');
    }

}
