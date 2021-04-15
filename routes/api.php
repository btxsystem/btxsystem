<?php

Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function() {
  Route::post('/login', 'AuthController@login');
});

Route::post('/oauth/token', 'Api\OAuthController@token');

Route::middleware('bca')->post('/va/bills', 'Bca\VirtualAccountController@bills');
Route::middleware('bca')->post('/va/payments', 'Bca\VirtualAccountController@payments');

Route::post('/xendit-callback', 'Member\XenditController@callback');
