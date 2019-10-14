<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\BCA;



class BCAController extends Controller
{
    public function getBalance()
    {
        $bca = new BCA;
        return $bca->balanceInformation();
    }

    public function fundTransfer()
    {
        $date = "2019-10-14";
        $accountnumber = "0201245681";
        $amount = "100000.00";
        $remark1 = "Test Transfer";
        $remark2 = "Testing transfer";

        $bca = new BCA;
        $response = $bca->transfer($date, $accountnumber, $amount, $remark1, $remark2);

        return $response;
    }

    public function rateforex()
    {
        $bca = new BCA;
        $response = $bca->rateforex();
        return $response;
    }
    
}
