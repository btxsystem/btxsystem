<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Employeer;
use App\Models\Ebook;

class HistoryActivePeriodeEbook extends Model
{
    protected $table = 'history_active_periode_ebooks';
  
    protected $guarded = [];

    public function admin() {
      return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function member() {
      return $this->belongsTo(Employeer::class, 'member_id', 'id');
    }

    public function ebook() {
      return $this->belongsTo(Ebook::class, 'ebook_id', 'id');
    }
}
