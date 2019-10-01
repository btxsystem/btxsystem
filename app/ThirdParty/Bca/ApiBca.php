<?php 
namespace App\ThirdParty\Bca;
/*
 * 2017 - API BCA Simple PHP Class
 * Using Account Statements for Sample Request
 * 
 * Contact : rie.projects25@gmail.com
 */
class ApiBca
{
	private static $main_url = 'https://sandbox.bca.co.id'; // Change When Your Apps is Live
	private static $client_id = ''; // Fill With Your Client ID
	private static $client_secret = ''; // Fill With Your Client Secret ID
	private static $api_key = ''; // Fill With Your API Key
	private static $api_secret = ''; // Fill With Your API Secret Key
	private static $access_token = null;
	private static $signature = null;
	private static $timestamp = null;
	private static $corporate_id = 'BCAAPI2016'; // Fill With Your Corporate ID. BCAAPI2016 is Sandbox ID
	private static $account_number = '0063001004'; // Fill With Your Account Number. 0201245680 is Sandbox Account

	public function setClientId($clientId)
	{
		self::$client_id = $clientId;

		return $this;
	}

	public function setClientSecret($clientSecret)
	{
		self::$client_secret = $clientSecret;

		return $this;
	}

	public function setApiKey($apiKey)
	{
		self::$api_key = $apiKey;

		return $this;
	}

	public function setApiSecret($apiSecret)
	{
		self::$api_secret = $apiSecret;

		return $this;
	}

	public function setAccessToken($accessToken)
	{
		self::$access_token = $accessToken;

		return $this;
	}

	public function getToken(){
		$path = '/api/oauth/token';
		$headers = array(
			'Content-Type: application/x-www-form-urlencoded',
			'Authorization: Basic '.base64_encode(self::$client_id.':'.self::$client_secret));

		$data = array(
			'grant_type' => 'client_credentials'
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::$main_url.$path);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt_array($ch, array(
			CURLOPT_POST => TRUE,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_POSTFIELDS => http_build_query($data),
		));

		$output = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($output,true);
		self::$access_token = $result['access_token'];
  }
  
	public function parseSignature($res){
		$explode_response = explode(',', $res);
		$explode_response_1 = explode(':', $explode_response[8]);
		self::$signature = trim($explode_response_1[1]);
  }
  
	public function parseTimestamp($res){
		$explode_response = explode(',', $res);
		$explode_response_1 = explode('Timestamp: ', $explode_response[3]);
		self::$timestamp = trim($explode_response_1[1]);
  }
  
	public function getSignature($url,$method,$data){
		$path = '/utilities/signature';
		$timestamp = date(DateTime::ISO8601);
		$timestamp = str_replace('+','.000+', $timestamp);
		$timestamp = substr($timestamp, 0,(strlen($timestamp) - 2));
		$timestamp .= ':00';
		$url_encode = $url;

		$headers = array(
			'Timestamp: '.$timestamp,
			'URI: '.$url_encode,
			'AccessToken: '.self::$access_token,
			'APISecret: '.self::$api_secret,
			'HTTPMethod: '.$method,
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::$main_url.$path);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt_array($ch, array(
			CURLOPT_POST => TRUE,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_POSTFIELDS => http_build_query($data),
		));

		$output = curl_exec($ch);
		curl_close($ch);

		$this->parseSignature($output);
		$this->parseTimestamp($output);
  }

}
?>