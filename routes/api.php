<?php

Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function() {
  Route::post('/login', 'AuthController@login');
});

// Route::post('/xendit-callback', ['as' => 'xendit-callback', 'uses' => 'Member\XenditController@callback']);

Route::post('/oauth/token', 'Api\OAuthController@token');

Route::middleware('bca')->post('/va/bills', 'Bca\VirtualAccountController@bills');
Route::middleware('bca')->post('/va/payments', 'Bca\VirtualAccountController@payments');
