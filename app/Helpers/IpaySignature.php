<?php

namespace App\Helpers;

class IpaySignature
{
  public static function generate($code, $amount)
  {
    $MechantKey = "rMRMh6Qmcy";
		$MerchantCode = "ID00913";
		$RefNo = $code;
		$amount = $amount; 
    $currency = "IDR";
    $ipaySignature 	= "";
    $encrypt		= sha1($MechantKey.$MerchantCode.$RefNo.$amount.$currency);		
        
    for ($i=0; $i<strlen($encrypt); $i=$i+2)
		{
			$ipaySignature .= chr(hexdec(substr($encrypt,$i,2)));
		}
     	
    $ipaySignature = base64_encode($ipaySignature);
    
    return $ipaySignature;
  }
}