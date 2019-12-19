<?php

namespace App\Models\V2;

use Illuminate\Database\Eloquent\Model;

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

}
