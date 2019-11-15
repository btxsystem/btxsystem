<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\BCA;



class BCAController extends Controller
{
    public function getBalance()
    {
        // return base64_encode('c3fd6d93-6aec-4ef1-be33-5e964f8eda16:bb03f953-5cc6-4a8d-a4a8-4384b20852cf');
        $bca = new BCA;
        return $bca->getTimestamp();
    }

    public function fundTransfer()
    {
        $date = "2019-10-23";
        $accountnumber = "0201245681";
        $amount = "100000.00";
        $remark1 = "Test Transfer";
        $remark2 = "Testing transfer";
        $transactionId = "0001".rand(1000,9999);
        $referenceId = '20191018/WD/'.date("Ymd/").$transactionId;

        $bca = new BCA;
        $response = $bca->transfer($date, $accountnumber, $amount, $remark1, $remark2, $transactionId, $referenceId);
        // if($response)

        $nganu = json_encode($response);
        return $nganu;        
    }

    public function domesticTransfer()
    {
        $date = "2019-10-21";
        $accountnumber = "0611105893";
        $accountname = "Tester";
        $bankcode = "BNINIDJA";
        $amount = "100000";
        $remark1 = "Test Transfer";
        $remark2 = "Testing transfer";
        $transactionId = "0001".rand(1000,9999);
        $referenceId = 'BITREXGO/WD/'.$transactionId;

        $bca = new BCA;
        $response = $bca->domesticTransfer($date, $accountnumber, $accountname, $bankcode, $amount, $remark1, $remark2, $transactionId, $referenceId);

        return $response;
    }

    public function rateforex()
    {
        $bca = new BCA;
        $response = $bca->rateforex();
        return $response;
    }
    
}
