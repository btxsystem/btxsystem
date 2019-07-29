<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes(['register' => false]);

Route::group(['prefix'=>'admin','as'=>'admin.'], function(){

    Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);
    Route::get('roles', ['as' => 'roles', 'uses' => 'Admin\RolesController@index']);
    Route::get('users', ['as' => 'users', 'uses' => 'Admin\UsersController@index']);
    Route::get('members', ['as' => 'members', 'uses' => 'Admin\MemberController@index']);
    Route::get('membership', ['as' => 'membership', 'uses' => 'MembershipController@index']);
    Route::get('tree', 'MembershipController@tree');

    Route::group(['prefix'=>'admin-management','as'=>'admin-management.'], function(){
        Route::get('permissions', ['as' => 'permissions', 'uses' => 'Admin\PermissionsController@index']);
    });

});