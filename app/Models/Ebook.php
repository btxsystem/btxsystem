<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
  protected $table = 'ebooks';
  
  protected $fillable = [
    'title',
    'price',
    'pv',
    'bv',
    'price_markup'
  ];

  protected $appends = [
    'access'
  ];

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

  public function getAccessAttribute()
  {
    $memberTransaction = $this->transaction()->where('non_member_id', \Auth::guard('nonmember')->user()->id);
    return $memberTransaction->count() > 0 ? $memberTransaction->first()->status == 1 ? true : false : false;
  }

}
