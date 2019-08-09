<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes 
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('tes', function () {
//    return 'Belajar latihan, Laravel API';
// });


Route::post('login', 'Api\AuthController@login');

Route::group(['middleware' => 'auth:api'], function() {

    // member

    Route::resource('member', 'Api\Member\MemberController',
    array('only' => array('index', 'store', 'update', 'destroy')));

    Route::resource('rank', 'Api\Member\RankController',
    array('only' => array('index', 'store', 'update', 'destroy')));

    // customer

    Route::resource('customer', 'Api\Customer\CustomerController',
    array('only' => array('index', 'store', 'update', 'destroy')));


    // Training

    Route::resource('training', 'Api\Training\TrainingController',
    array('only' => array('index', 'store', 'update', 'destroy')));


    /////////////////////user akses/////////////////////////

    Route::post('fcm/token', 'Api\AuthController@setFCMToken');

    Route::resource('setting', 'Api\System\SettingController',
    array('only' => array('index', 'store', 'update', 'destroy')));

    Route::post('users/password', 'Api\UserController@password');
    Route::put('users/password', 'Api\UserController@password');
    Route::get('users', 'Api\UserController@index');
    Route::get('users/{user}', 'Api\UserController@show');
    Route::post('users', 'Api\UserController@create');
    Route::put('users/{user}', 'Api\UserController@update');
    Route::delete('users/{user}', 'Api\UserController@delete');

    Route::get('roles', 'Api\RolesController@index');
    Route::get('roles/{roles}', 'Api\RolesController@show');
    Route::post('roles', 'Api\RolesController@create');
    Route::put('roles/{roles}', 'Api\RolesController@update');
    Route::delete('roles/{roles}', 'Api\RolesController@delete');

    Route::get('permissions', 'Api\PermissionsController@index');
    Route::get('permissions/{permissions}', 'Api\PermissionsController@show');
    Route::post('permissions', 'Api\PermissionsController@create');
    Route::put('permissions/{id}', 'Api\PermissionsController@update');
    Route::delete('permissions/{id}', 'Api\PermissionsController@delete');

    //laporan
    Route::post('laporan/laporan', 'Api\Reports\LaporanController@index');
    Route::post('logout', 'Api\AuthController@logout');


});