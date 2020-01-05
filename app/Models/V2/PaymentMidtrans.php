<?php

namespace App\Models\V2;

use Illuminate\Database\Eloquent\Model;
use App\HistoryBitrexPoints;
use App\Employeer;

class PaymentMidtrans extends Model
{
    protected $table = 'payment_midtrans';

    protected $guarded = [];

    public function setPending()
    {
        $this->attributes['status'] = 'pending';
        self::save();
    }

    public function setSuccess()
    {
        $this->attributes['status'] = 'success';
        self::save();
    }

    public function setFailed()
    {
        $this->attributes['status'] = 'failed';
        self::save();
    }

    public function setExpired()
    {
        $this->attributes['status'] = 'expired';
        self::save();
    }

    public function setPaymentType($type)
    {
        $this->attributes['type_transfer'] = $type;
        self::save();
    }

    public function setVa($va)
    {
        $this->attributes['va_account'] = $va;
        self::save();
    }

    public function setPoints()
    {
        $member = Employeer::where('username', $this->attributes['donor_username'])->first();
        $point = (int)($this->attributes['amount'] / 1000);
        $member->update([
            'bitrex_points' => $member->bitrex_points + $point
        ]);
        HistoryBitrexPoints::create([
            'id_member' => $member->id,
            'nominal'   => $this->attributes['amount'],
            'points'    => $point,
            'description' => $this->attributes['note'],
            'info'  => 1,
            'transaction_ref' => $this->attributes['va_account'],
            'status' => 1
        ]);
    }

}
