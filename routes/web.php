<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'select', 'as'=> 'select.'], function () {
    Route::get('sponsor', ['as' => 'sponsor', 'uses' => 'MembershipController@select']);
    Route::get('permissions', ['as' => 'permissions', 'uses' => 'Admin\RolesController@select']);
});

Route::group(['prefix'=>'admin','as'=>'admin.'], function(){

    Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);
    Route::get('membership', ['as' => 'membership', 'uses' => 'MembershipController@index']);
    Route::get('tree', 'MembershipController@tree');

    Route::group(['prefix'=>'admin-management','as'=>'admin-management.'], function(){
        Route::get('permissions', ['as' => 'permissions', 'uses' => 'Admin\PermissionsController@index']);    
        Route::get('users', ['as' => 'users', 'uses' => 'Admin\UsersController@index']);

        Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
            Route::get('', ['as' => 'index', 'uses' => 'Admin\RolesController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'Admin\RolesController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'Admin\RolesController@store']);
            Route::get('/{id}',['as' => 'delete', 'uses' => 'Admin\RolesController@destroy']);
        });
    });

    
    Route::group(['prefix'=>'members','as'=>'members.'], function(){
        Route::group(['prefix'=>'active','as'=>'active.'], function(){
            Route::get('', ['as' => 'index', 'uses' => 'Admin\MemberController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'Admin\MemberController@create']);
            Route::get('/{id}/nonactive', ['as' => 'nonactive', 'uses' => 'Admin\MemberController@nonactive']);
        });

        Route::group(['prefix' => 'nonactive','as'=>'nonactive.'], function () {
            Route::get('', ['as' => 'index', 'uses' => 'Admin\MemberController@member_nonactive']);
            Route::get('/{id}/active', ['as' => 'active', 'uses' => 'Admin\MemberController@active']);
        });
    });

    Route::group(['prefix'=>'bitrex-money','as'=>'bitrex-money.'], function(){
        Route::get('points', ['as' => 'points', 'uses' => 'Admin\BitrexPointController@index']);
        Route::get('topup', ['as' => 'topup', 'uses' => 'Admin\BitrexPointController@topup']);
    });

});