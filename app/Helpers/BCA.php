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
        $this->main_url = 'https://devapi.klikbca.com'; // Change When Your Apps is Live
        $this->client_id = 'b095ac9d-2d21-42a3-a70c-4781f4570704'; // Fill With Your Client ID
        $this->client_secret = 'bedd1f8d-3bd6-4d4a-8cb4-e61db41691c9'; // Fill With Your Client Secret ID
        $this->api_key = 'dcc99ba6-3b2f-479b-9f85-86a09ccaaacf'; // Fill With Your API Key
        $this->api_secret = '5e636b16-df7f-4a53-afbe-497e6fe07edc'; // Fill With Your API Secret Key
        $this->access_token = null;
        $this->signature = null;
        $this->timestamp = null;
        $this->corporate_id = 'h2hauto008'; // Fill With Your Corporate ID. BCAAPI2016 is Sandbox ID
        $this->account_number = '0613005908'; // Fill With Your Account Number. 0201245680 is Sandbox Account
        $this->channel_id = '95051';
        $this->credential_id = 'BCAAPI';

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

    public function transfer($date, $accountnumber, $amount, $remark1, $remark2, $transactionId, $referenceId)
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
                "TransactionID" => str_replace(' ', '', $transactionId),
                "TransactionDate" => $date, //Sample request 2019-10-14
                "ReferenceID" => str_replace(' ', '', $referenceId),
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
            $data = isset($response->body->Status) ? $response->body->Status : $response->body->ErrorMessage->English;
            return($data);
        } catch (\Exception $e) {
            $response = $e->getMessage();
            return $response;
        }
    }

    public function domesticTransfer($date, $accountnumber, $accountname, $bankcode, $amount, $remark1, $remark2, $transactionId, $referenceId)
    {
        try {
            $httpMethod = 'POST';
            $relativeUrl = '/banking/corporates/transfers/domestic';
            $accessToken = $this->getToken();
            $contentType = 'application/json';
            $timestamp = $this->getTimestamp();

            $body = [
                "TransactionID" => str_replace(' ', '', $transactionId),
                "TransactionDate" => $date, //Sample request 2019-10-14
                "ReferenceID" => str_replace(' ', '', $referenceId),
                "SourceAccountNumber" => str_replace(' ', '', $this->account_number),
                "BeneficiaryAccountNumber" => str_replace(' ', '', $accountnumber), //Sample request 0201245680
                "BeneficiaryBankCode" => str_replace(' ', '', $bankcode), //Sample request BRONINJA
                "BeneficiaryName" => str_replace(' ', '', $accountname), //Sample request BRONINJA
                "CorporateID" => str_replace(' ', '', $this->corporate_id),
                "Amount" => $amount, //Sampel request 100000.00
                "TransferType" => str_replace(' ', '', 'LLG'),
                "BeneficiaryCustType" => "1", //Sampel request 1
                "BeneficiaryCustResidence" => "1", //Sampel request 1
                "CurrencyCode" => "IDR",
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
                'X-BCA-Signature'   =>  $this->getSignature($stringToSign),
                'ChannelID'   =>  $this->channel_id,
                'CredentialID'   =>  $this->credential_id,

            ];

            $response = UniRequest::post($this->main_url . $relativeUrl, $headers, $data);
            $data = isset($response->body->Status) ? $response->body->Status : $response->body->ErrorMessage->English;
            return($data);
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
