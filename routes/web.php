<?php
\Cache::flush();

/*Route::redirect('/', '/login');
Route::redirect('/home', '/admin');
Auth::routes(['register' => false]);

Route::group(['prefix' => 'select', 'as'=> 'select.'], function () {
    Route::get('sponsor', ['as' => 'sponsor', 'uses' => 'MembershipController@select']);
    Route::get('permissions', ['as' => 'permissions', 'uses' => 'Admin\RolesController@select']);
    Route::get('username', ['as' => 'username', 'uses' => 'Admin\MemberController@select']);
    Route::get('/{id}/upline', ['as' => 'upline', 'uses' => 'MembershipController@select_upline']);
});

Route::group(['prefix'=>'admin','as'=>'admin.'], function(){
    Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);
    Route::get('roles', ['as' => 'roles', 'uses' => 'Admin\RolesController@index']);
    Route::get('membership', ['as' => 'membership', 'uses' => 'MembershipController@index']);
    Route::get('tree', 'MembershipController@tree');

    Route::group(['prefix'=>'admin-management','as'=>'admin-management.'], function(){
        Route::get('permissions', ['as' => 'permissions', 'uses' => 'Admin\PermissionsController@index']);

        Route::group(['prefix'=>'users','as'=>'users.'],function(){
            Route::get('', ['as' => 'index', 'uses' => 'Admin\UsersController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'Admin\UsersController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'Admin\UsersController@store']);
            Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'Admin\UsersController@edit']);
            Route::put('{id}', ['as' => 'update', 'uses' => 'Admin\UsersController@update']);
            Route::delete('{id}', ['as' => 'delete', 'uses' => 'Admin\UsersController@destroy']);
        });
        
        Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
            Route::get('', ['as' => 'index', 'uses' => 'Admin\RolesController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'Admin\RolesController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'Admin\RolesController@store']);
            Route::get('/{id}',['as' => 'delete', 'uses' => 'Admin\RolesController@destroy']);
        });

    });

    Route::resource('customer', 'Admin\CustomerController');
    Route::get('customer/data/{id}', 'Admin\CustomerController@delete');

    Route::group(['prefix'=>'trainings','as'=>'trainings.'],function(){
        Route::get('', ['as' => 'index', 'uses' => 'Admin\TrainingController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'Admin\TrainingController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'Admin\TrainingController@store']);
        Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'Admin\TrainingController@edit']);
        Route::put('{id}', ['as' => 'update', 'uses' => 'Admin\TrainingController@update']);
        Route::delete('{id}', ['as' => 'delete', 'uses' => 'Admin\TrainingController@destroy']);
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

        Route::get('cash', ['as' => 'cash', 'uses' => 'Admin\BitrexCashController@index']);
        Route::get('/{id}/cash/detail', ['as' => 'detail', 'uses' => 'Admin\BitrexCashController@detail']);

        Route::get('/{id}/detail', ['as' => 'detail', 'uses' => 'Admin\BitrexPointController@detail']);
        Route::get('/{id}/detail/username', ['as' => 'username', 'uses' => 'Admin\BitrexPointController@getUsername']);
    });
    
});

Route::group(['prefix'=>'member','as'=>'member.'], function(){
    Route::get('/login', 'AuthEmployeer\LoginController@showLoginAdmin')->name('login');
    Route::post('/login/cek', 'AuthEmployeer\LoginController@login')->name('login.cek');
    Route::get('/dashboard', 'Member\DashboardController@index')->name('dashboard');
    Route::group(['prefix'=>'profile','as'=>'profile.'], function(){
        Route::get('', ['as' => 'index', 'uses' => 'Member\ProfileMemberController@index']);
    });
});
*/

Route::redirect('/', '/login');
Route::get('/login', 'Auth\LoginController@getLogin')->middleware('guest');
Route::post('/login', 'Auth\LoginController@postLogin');
Route::get('/logout', 'Auth\LoginController@logout');

Route::group(['prefix' => 'member', 'as'=> 'member.'], function () {

    Route::get('', ['as' => 'dashboard', 'uses' => 'Member\DashboardController@index']);
    Route::get('tree', ['as' => 'tree', 'uses' => 'Member\DashboardController@tree']);

    Route::group(['prefix' => 'select', 'as'=> 'select.'], function () {
        Route::get('daily-retail', ['as' => 'daily-retail', 'uses' => 'Member\DashboardController@getAutoRetailDaily']);
        Route::get('training', ['as' => 'training', 'uses' => 'Member\DashboardController@getTraining']);
        Route::get('tree', ['as' => 'tree', 'uses' => 'Member\DashboardController@getTree']);
        Route::get('daily-bonus-sponsor', ['as' => 'daily-bonus-sponsor', 'uses' => 'Member\DashboardController@getBonusSponsorDaily']);
    });

    Route::group(['prefix' => 'profile', 'as'=> 'profile.'], function () {
        Route::get('', ['as' => 'index', 'uses' => 'Member\ProfileMemberController@index']);
        Route::post('reset-password', ['as' => 'reset-password', 'uses' => 'Member\ProfileMemberController@resetPassword']);
    });

    Route::group(['prefix' => 'income-and-expenses', 'as'=> 'bitrex-money.'], function () {
        Route::get('bitrex-points', ['as' => 'bitrex-points', 'uses' => 'Member\BitrexPointController@index']);
        Route::get('bitrex-cash', ['as' => 'bitrex-cash', 'uses' => 'Member\BitrexCashController@index']);
        Route::get('pv', ['as' => 'pv', 'uses' => 'Member\PvController@index']);
    });
    
});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');