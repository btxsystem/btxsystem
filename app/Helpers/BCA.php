<?php 

namespace App\Helpers;

use DateTime;
use Carbon\Carbon;
use Unirest\Request as UniRequest;
use Unirest\Request\Body as UniBody;

class BCA
{

    protected $main_url;
    protected $client_id;
    protected $client_secret;
    protected $api_key;
    protected $api_secret;
    protected $access_token;
    protected $signature;
    protected $timestamp;
    protected $corporate_id;
    protected $account_number; 


    public function __construct()
    {
        $this->main_url = 'https://sandbox.bca.co.id'; // Change When Your Apps is Live
        $this->client_id = 'c3fd6d93-6aec-4ef1-be33-5e964f8eda16'; // Fill With Your Client ID
        $this->client_secret = 'bb03f953-5cc6-4a8d-a4a8-4384b20852cf'; // Fill With Your Client Secret ID
        $this->api_key = 'bf034e29-c45f-4eac-bfcc-cec9c36296d4'; // Fill With Your API Key
        $this->api_secret = '5b3d2b59-b358-404b-a3b1-6c6ebcd9443a'; // Fill With Your API Secret Key
        $this->access_token = null;
        $this->signature = null;
        $this->timestamp = null;
        $this->corporate_id = 'BCAAPI2016'; // Fill With Your Corporate ID. BCAAPI2016 is Sandbox ID
        $this->account_number = '0201245680'; // Fill With Your Account Number. 0201245680 is Sandbox Account
	}
	
	public function getTimestamp()
    {
        $date = Carbon::now('Asia/Jakarta');
        date_default_timezone_set('Asia/Jakarta');
        $fmt = $date->format('Y-m-d\TH:i:s');
        $ISO8601 = sprintf("$fmt.%s%s", substr(microtime(), 2, 3), date('P'));
        return $ISO8601;
    }

    public function getLowerCaseHexEncode($bodyToHash = [])
    {
        $body = empty($bodyToHash) ? '' : $bodyToHash;
        $hash = hash("sha256", $body);
        return $hash;
    }

    public function getStringToSign(string $httpMethod, string $relativeUrl, string $accessToken, $lowerCaseStr, string $timestamp)
    {
        return $httpMethod . ":" . $relativeUrl . ":" . $accessToken . ":" . $lowerCaseStr . ":" . $timestamp;
    }

    public function getSignature(string $stringToSign)
    {
        $signature = hash_hmac('sha256', $stringToSign, $this->api_secret);
        return $signature;
    }
    
    public function getToken()
    {
		$path 	 = '/api/oauth/token';
		$headers = [
					 'Content-Type: application/x-www-form-urlencoded',
					 'Authorization: Basic '.base64_encode($this->client_id.':'.$this->client_secret)
					];
		$data 	 = ['grant_type' => 'client_credentials'];
		$ch 	 = curl_init();
					curl_setopt($ch, CURLOPT_URL, $this->main_url.$path);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Ignore Verify SSL Certificate
					curl_setopt_array($ch, array(
						CURLOPT_POST => TRUE,
						CURLOPT_RETURNTRANSFER => TRUE,
						CURLOPT_HTTPHEADER => $headers,
						CURLOPT_POSTFIELDS => http_build_query($data),
		));
		$output = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($output,true);
        return $this->access_token = $result['access_token'];
	}
    
    public function balanceInformation()
    {
        try {
            $httpMethod = 'GET';
            $relativeUrl = '/banking/v3/corporates/'.$this->corporate_id.'/accounts/'.$this->account_number;
            $accessToken = $this->getToken();
            $contentType = 'application/json';
            $timestamp = $this->getTimestamp();
            $stringToSign = $this->getStringToSign($httpMethod, $relativeUrl, $accessToken, $this->getLowerCaseHexEncode(), $timestamp);
            $headers = [
                'Authorization'     =>  'Bearer ' . $accessToken,
                'Content-Type'      =>  $contentType,
                'X-BCA-Key'         =>  $this->api_key,
                'X-BCA-Timestamp'   =>  $timestamp,
                'X-BCA-Signature'   =>  $this->getSignature($stringToSign)
            ];
            $response = UniRequest::get($this->main_url . $relativeUrl, $headers);
            return response()->json($response->body);
        } catch (\Exception $e) {
            $response = $e->getMessage();
            return $response;
        }
	}
	
    public function statementInformation($startDate, $endDate)
    {
        try {
            $httpMethod = 'GET';
			$relativeUrl = '/banking/v3/corporates/'.$this->corporate_id.'/accounts/'.$this->account_number.'/statements?StartDate='.$startDate.'&EndDate='.$endDate;
            $accessToken = $this->getToken();
            $contentType = 'application/json';
            $timestamp = $this->getTimestamp();
			$stringToSign = $this->getStringToSign($httpMethod, $relativeUrl, $accessToken, $this->getLowerCaseHexEncode(), $timestamp);
			
            $headers = [
                'Authorization'     =>  'Bearer ' . $accessToken,
                'Content-Type'      =>  $contentType,
                'X-BCA-Key'         =>  $this->api_key,
                'X-BCA-Timestamp'   =>  $timestamp,
                'X-BCA-Signature'   =>  $this->getSignature($stringToSign)
            ];
            $response = UniRequest::get($this->main_url . $relativeUrl, $headers);
            return response()->json($response->body);
        } catch (\Exception $e) {
            $response = $e->getMessage();
            return $response;
        }
    }

    public function transfer($date, $accountnumber, $amount, $remark1, $remark2)
    {
        try {
            $httpMethod = 'POST';
            $relativeUrl = '/banking/corporates/transfers';
            $accessToken = $this->getToken();
            $contentType = 'application/json';
            $timestamp = $this->getTimestamp();

            $body = [
                "CorporateID" => str_replace(' ', '', $this->corporate_id),
                "SourceAccountNumber" => str_replace(' ', '', $this->account_number),
                "TransactionID" => str_replace(' ', '', "00000001"),
                "TransactionDate" => $date, //Sample request 2019-10-14
                "ReferenceID" => str_replace(' ', '', "12345/PO/2016"),
                "CurrencyCode" => "IDR",
                "Amount" => $amount, //Sampel request 100000.00
                "BeneficiaryAccountNumber" => str_replace(' ', '', $accountnumber), //Sample request 0201245680
                "Remark1" => str_replace(' ', '', $remark1),//Sample request "Transfer Test"
                "Remark2" => str_replace(' ', '', $remark2) //Sample request "Online Transfer"
            ];

            $data = json_encode($body, JSON_UNESCAPED_SLASHES);

            $stringToSign = $this->getStringToSign($httpMethod, $relativeUrl, $accessToken, $this->getLowerCaseHexEncode($data), $timestamp);

            $headers = [
                'Authorization'     =>  'Bearer ' . $accessToken,
                'Content-Type'      =>  $contentType,
                'X-BCA-Key'         =>  $this->api_key,
                'X-BCA-Timestamp'   =>  $timestamp,
                'X-BCA-Signature'   =>  $this->getSignature($stringToSign)
            ];

            $response = UniRequest::post($this->main_url . $relativeUrl, $headers, $data);
            return response()->json($response->body);
        } catch (\Exception $e) {
            $response = $e->getMessage();
            return $response;
        }
    }
    
    public function rateforex()
    {
        try {
            $httpMethod = 'GET';
            $relativeUrl = '/general/rate/forex';
            $accessToken = $this->getToken();
            $contentType = 'application/json';
            $timestamp = $this->getTimestamp();
            $stringToSign = $this->getStringToSign($httpMethod, $relativeUrl, $accessToken, $this->getLowerCaseHexEncode(), $timestamp);
            $headers = [
                'Authorization'     =>  'Bearer ' . $accessToken,
                'Content-Type'      =>  $contentType,
                'X-BCA-Key'         =>  $this->api_key,
                'X-BCA-Timestamp'   =>  $timestamp,
                'X-BCA-Signature'   =>  $this->getSignature($stringToSign)
            ];
            $response = UniRequest::get($this->main_url . $relativeUrl, $headers);
            return response()->json($response->body);
        } catch (\Exception $e) {
            $response = $e->getMessage();;

            return $response;
        }
    }

}
