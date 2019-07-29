<?php

namespace App;
use Nestable\NestableTrait;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use NestableTrait;
    protected $table = 'membership';
    protected $id = 'member_id';
    protected $parent = 'parent_id';
    protected $appends = ['id'];

    public function getIdAttribute()
    {
        return $this->member_id;
    }

}
