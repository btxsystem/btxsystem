<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DB;

class OAuthController extends Controller
{

  /**
   * token function
   *
   * @param Request $request
   * @return void
   */
  public function token(Request $request)
  {
    try {
      $basicAuth = str_replace("Basic ", "", $request->header("Authorization"));
      $basicAuthDecode = base64_decode($basicAuth);
      $basicAuthDecodeSplit = explode(":", $basicAuthDecode);
      
      //client
      $grantType = $request->input('grant_type') ?? '';
      $clientId = $basicAuthDecodeSplit[0] ?? 0;
      $clientSecret = $basicAuthDecodeSplit[1] ?? '';

      $checkClientCredential = DB::table('oauth_clients')
        ->where('id', $clientId)
        ->where('secret', $clientSecret)
        ->count();

      $token = new User();
      $result =  $token->checkToken(1);

      if($checkClientCredential < 1 || !$result || $grantType == '' || $grantType != 'client_credentials') {
        return response()->json([
          'ErrorCode' => 'ESB-14-008',
          'ErrorMessage' => [
            'Indonesian' => 'client_id/client_secret/grant_type tidak valid',
            'English' => 'Invalid client_id/client_secret/grant_type'
          ]
        ], 400);
      } 

      return response()->json([
        'access_token' => $result['access_token'],
        'token_type' => $result['token_type'],
        'expires_in' => $result['expires_in'],
        'scrope' => 'resource.WRITE resource.READ',
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'ErrorCode' => 'ESB-14-008',
        'ErrorMessage' => [
          'Indonesian' => 'client_id/client_secret/grant_type tidak valid',
          'English' => 'Invalid client_id/client_secret/grant_type'
        ]
      ], 400);
    }
  }

}
