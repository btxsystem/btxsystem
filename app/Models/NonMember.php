<?php

namespace App\Models;
use Nestable\NestableTrait;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class NonMember extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'non_members';

    protected $hidden = [
        'password',
    ];  

    protected $appends = [
        'total_product'
    ];
    
    public function transfer_confirmations()
    {
        return $this->morphMany('App\Models\TransferConfirmation', 'user_type');
    }

    public function getTotalProductAttribute()
    {
        // raw query
        // $totalProducts = DB::select(DB::raw('
        //     SELECT 
        //        COUNT(transaction_member.id) as total_product
        //     FROM `transaction_member` 
        //     LEFT JOIN transaction_ebook_expired ON transaction_member.id = transaction_ebook_expired.transaction_id
        //     WHERE transaction_member.member_id = 3 
        //     AND transaction_member.status = 1 
        //     AND (
        //         CASE
        //             WHEN transaction_ebook_expired.expired_at IS NULL THEN transaction_member.expired_at > NOW()
        //             ELSE transaction_ebook_expired.expired_at > NOW()
        //         END
        //     )
        // '));

        // return $totalProducts[0]->total_product;

        // versi query builder
        $totalProducts = DB::table('transaction_non_members')
            ->select([
                'transaction_non_members.id',
                'transaction_non_members.expired_at',
            ])
            ->where('transaction_non_members.non_member_id', $this->id)
            ->where('transaction_non_members.status', 1)
            ->whereRaw('transaction_non_members.expired_at > NOW()')
            ->count();

        return (int) $totalProducts + 1;
    }
}
