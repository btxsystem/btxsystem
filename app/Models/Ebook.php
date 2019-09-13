<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ebook extends Model
{
  protected $table = 'ebooks';
  
  protected $fillable = [
    'title',
    'slug',
    'price',
    'pv',
    'bv',
    'price_markup',
    'src',
    'description'
  ];

  protected $appends = [
    'access',
    'expired',
    'countdown_days',
    'expired_at'
  ];


  public function books()
  {
      return $this->belongsToMany('\App\Models\Book');
  }

  public function videos()
  {
    return $this->belongsToMany('\App\Models\Video', 'video_ebook', 'ebook_id', 'video_id');
  }

  public function bookEbooks()
  {
      return $this->hasMany('\App\Models\BookEbook', 'ebook_id', 'id');
  }
  
  public function videoEbooks()
  {
      return $this->hasMany('\App\Models\VideoEbook', 'ebook_id', 'id');
  }

  public function transaction()
  {
      return $this->hasOne('\App\Models\TransactionNonMember', 'ebook_id', 'id');
  }

  public function transactionMember()
  {
      return $this->hasOne('\App\Models\TransactionMember', 'ebook_id', 'id');
  }

  public function getAccessAttribute()
  {
    if(\Auth::guard('nonmember')->user()) {
      $memberTransaction = $this->transaction()->where('non_member_id', \Auth::guard('nonmember')->user()->id);
      return $memberTransaction->count() > 0 ? $memberTransaction->first()->status == 1 ? true : false : false;
    } else if(\Auth::guard('user')->user()){
      $userTransaction = $this->transactionMember()->where('member_id', \Auth::guard('user')->user()->id);
      return $userTransaction->count() > 0 ? $userTransaction->first()->status == 1 ? true : false : false;
    } else {
      return false;
    }
  }

  public function getExpiredAttribute()
  {
    if(!$this->access) {
      return false;
    }

    if(\Auth::guard('nonmember')->user()) {
      $memberTransaction = $this->transaction()->where('non_member_id', \Auth::guard('nonmember')->user()->id)->first();
      
      $expired = $memberTransaction->expired_at < date('Y-m-d');

      return $expired;
    } else if(\Auth::guard('user')->user()){
      $userTransaction = $this->transactionMember()->where('member_id', \Auth::guard('user')->user()->id)->first();
      
      $expired = $userTransaction->expired_at < date('Y-m-d');

      return $expired;
    } else {
      return false;
    }
  }

  public function getExpiredAtAttribute() {
    if(!$this->access) {
      return 0;
    }
    
    if(\Auth::guard('nonmember')->user()) {
      $memberTransaction = $this->transaction()
        ->where('non_member_id', \Auth::guard('nonmember')
        ->user()->id)
        ->first();

      return $memberTransaction ? $memberTransaction->expired_at : 0;
    } else if(\Auth::guard('user')->user()){
      $userTransaction = $this->transactionMember()
        ->where('member_id', \Auth::guard('user')
        ->user()->id)
        ->first();
      
      return $userTransaction ? $userTransaction->expired_at : 0;
    } else {
      return 0;
    }    
  }

  public function getCountdownDaysAttribute()
  {
    if(!$this->access) {
      return 0;
    }

    if(\Auth::guard('nonmember')->user()) {
      $memberTransaction = $this->transaction()
        ->where('non_member_id', \Auth::guard('nonmember')
        ->user()->id)
        ->first();

      $created = new Carbon(date('Y-m-d'));
      $now = Carbon::create($memberTransaction->expired_at);
      $difference = ($created->diff($now)->days < 1)
          ? '1 Hari'
          : $created->diff($now)->days . ' Hari';  
      return $difference;
    } else if(\Auth::guard('user')->user()){
      $userTransaction = $this->transactionMember()
        ->where('member_id', \Auth::guard('user')
        ->user()->id)
        ->first();

      $created = new Carbon(date('Y-m-d'));
      $now = Carbon::create($userTransaction->expired_at);
      $difference = ($created->diff($now)->days < 1)
          ? '1 Hari'
          : $created->diff($now)->days . ' Hari';  
      return $difference;      
    } else {
      return 0;
    }
  }

}
