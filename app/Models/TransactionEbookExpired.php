<?php

namespace App;
use Nestable\NestableTrait;
use Illuminate\Database\Eloquent\Model;
use App\models\GotReward;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use App\Models\TransactionMember;

class TransactionEbookExpired extends Model
{
    protected $guarded = [];
    protected $table = 'transaction_ebook_expired';

    public function transaction()
    {
        return $this->belongsTo( TransactionMember::class, 'transaction_id');
    }

}
