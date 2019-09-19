<?php

Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function() {
  Route::post('/login', 'AuthController@login');
});