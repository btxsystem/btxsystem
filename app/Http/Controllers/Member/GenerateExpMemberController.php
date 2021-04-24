<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Employeer;

class GenerateExpMemberController extends Controller
{
    public function store()
    {
        $employ = Employeer::with('transaction_member')->get();
        foreach ($employ as $employe) {
            $lastTrx = $employe->transaction_member[count($employe->transaction_member)-1]->created_at;
            $expmember = date('Y-m-d H:i:s', strtotime($lastTrx . " +1 year"));
            $employe->expired_at = $expmember;
            $employe->save();
        }
        return 'success';
    }
}
