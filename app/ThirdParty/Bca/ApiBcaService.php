<?php 
namespace App\ThirdParty\Bca;

use App\ThirdParty\Bca\ApiBca;

class ApiBcaService extends ApiBca
{
	public function getForexRate(){
    $this->getToken();
    
		$path = '/general/rate/forex';
		$method = 'GET';
    $data = array();
    
    $this->getSignature($path, $method, $data);
    
		$headers = array(
			'X-BCA-Key: '.static::$api_key,
			'X-BCA-Timestamp: '.static::$timestamp,
			'Authorization: Bearer '.static::$access_token,
			'X-BCA-Signature: '.static::$signature,
			'Content-Type: application/json',
			'Origin: '.$_SERVER['SERVER_NAME']
    );
    
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, static::$main_url.$path);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_HTTPHEADER => $headers,
    ));
    
		$output = curl_exec($ch);
    curl_close($ch);
    
		return json_decode($output, TRUE);
	}  
}