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
    {$date = "2019-10-19";
        $accountnumber = "0201245681";
        $amount = "100000";
        $remark1 = "Test Transfer";
        $remark2 = "Testing transfer";
        $transactionId = "00000001";
        $referenceId = '20191018/WD/0001';

        $bca = new BCA;
        $response = $bca->transfer($date, $accountnumber, $amount, $remark1, $remark2, $transactionId, $referenceId);
        // if($response)

        $nganu = json_encode($response);
        return $nganu == "Seccess" ? 'Sukses' : 'Gagal';        
    }

    public function domesticTransfer()
    {
        $date = "2018-05-03";
        $accountnumber = "0201245501";
        $accountname = "Tester";
        $bankcode = "BRONINJA";
        $amount = "100000.00";
        $remark1 = "Test Transfer";
        $remark2 = "Testing transfer";

        $bca = new BCA;
        $response = $bca->domesticTransfer($date, $accountnumber, $accountname, $bankcode, $amount, $remark1, $remark2);

        return $response;
    }

    public function rateforex()
    {
        $bca = new BCA;
        $response = $bca->rateforex();
        return $response;
    }
    
}
