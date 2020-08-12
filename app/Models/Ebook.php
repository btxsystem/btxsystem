<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ebook extends Model
{
  protected $table = 'ebooks';
  
  protected $guarded = [];

  protected $appends = [
    'expired',
    'access',
    'countdown_days',
    'expired_at',
    'status',
    'expired_timestamp',
    'access_ebook'
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

  public function children()
  {
    return $this->belongsTo('\App\Models\Ebook', 'id', 'parent_id');
  }

  public function getAccessEbookAttribute()
  {
    $expired = null;

    if($user = \Auth::guard('nonmember')->user()) {
      $expired = TransactionNonMember::where('non_member_id', $user->id)
        ->where('status', 1)
        ->whereIn('ebook_id', [$this->id, $this->children ? $this->children->id : 0])
        ->select('expired_at')
        ->latest('id')
        ->first();

    } else if($user = \Auth::guard('user')->user()) {
      $expired = TransactionMember::with('transaction_ebook_expired')->where('member_id', $user->id)
        ->where('status', 1)
        ->where('ebook_id',  [$this->id, $this->children ? $this->children->id : 0])
        ->select([
          'id',
          'expired_at'
        ])
        ->latest('id')
        ->first();
    }

    if($expired) {
      if($expired->transaction_ebook_expired) {
        if($expired->expired_at < $expired->transaction_ebook_expired->expired_at) {
          $expired = $expired->transaction_ebook_expired;
        }
      }

      $currentTimestamp = strtotime(date('Y-m-d H:i:s'));
      $expiredTimestamp = strtotime($expired['expired_at']);

      if($currentTimestamp > $expiredTimestamp) return null;
    }

    return $expired;
  }

  public function getExpiredAttribute()
  {
    // if(!$this->access) {
    //   return false;
    // }

    if(\Auth::guard('nonmember')->user()) {
      $memberTransaction = $this->transaction()
        ->where('non_member_id', \Auth::guard('nonmember')
        ->user()->id)
        ->latest('id')
        ->first();

      if(!$memberTransaction) {
        return false;
      }
      
      $expired = $memberTransaction->expired_at < date('Y-m-d');

      return $expired;
    } else if(\Auth::guard('user')->user()){
      $userTransaction = $this->transactionMember()
        ->where('member_id', \Auth::guard('user')
        ->user()->id)
        ->latest('id')
        ->first();

      if(!$userTransaction) {
        return false;
      }
      
      $expired = $userTransaction->expired_at < date('Y-m-d');
      

      return $expired;
    } else {
      return false;
    }
  }

  public function getAccessAttribute()
  {
    if(\Auth::guard('nonmember')->user()) {
      $memberTransaction = $this->transaction()
        ->where('non_member_id', \Auth::guard('nonmember')
        ->user()->id)
        ->latest('id')
        ->first();

      if($memberTransaction) {
        return $memberTransaction->status == 1 && !$this->expired ? true : false;
      } else {
        return false;
      }

    } else if(\Auth::guard('user')->user()){
      $userTransaction = $this->transactionMember()
        ->where('member_id', \Auth::guard('user')
        ->user()->id)
        ->latest('id')
        ->first();
      // return $userTransaction->count() > 0 ? $userTransaction->first()->status == 1 ? true : false : false;
      if($userTransaction) {
        return $userTransaction->status == 1 && !$this->expired ? true : false;
      } else {
        return false;
      }
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
        ->latest('id')
        ->first();

      return $memberTransaction ? $memberTransaction->expired_at : 0;
    } else if(\Auth::guard('user')->user()){
      $userTransaction = $this->transactionMember()
        ->where('member_id', \Auth::guard('user')
        ->user()->id)
        ->latest('id')
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
        ->latest('id')
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
        ->latest('id')
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
  
  public function getStatusAttribute()
  {
    if(\Auth::guard('nonmember')->user()) {
      $memberTransaction = $this->transaction()
        ->where('non_member_id', \Auth::guard('nonmember')
        ->user()->id)
        ->latest('id')
        ->first();

      return $memberTransaction ? $memberTransaction->status : null;
    } else if(\Auth::guard('user')->user()){
      $userTransaction = $this->transactionMember()
        ->where('member_id', \Auth::guard('user')
        ->user()->id)
        ->latest('id')
        ->first();

      return $userTransaction ? $userTransaction->status : null;
    } else {
      return null;
    }
  }

  public function getExpiredTimestampAttribute()
  {
    return strtotime($this->expired_at);
  }

}
