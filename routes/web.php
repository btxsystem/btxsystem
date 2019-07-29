<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin/dashboard');

Auth::routes(['register' => false]);


Route::name('admin.')->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/dashboard', 'HomeController@index')->name('home');
    });
    Route::get('/permissions', 'Admin\PermissionsController@index')->name('permissions');
    Route::get('/roles', 'Admin\RolesController@index')->name('roles');
    Route::get('/users', 'Admin\UsersController@index')->name('users');   
    Route::get('/members', 'Admin\MemberController@index')->name('members');
    Route::get('/membership', 'MembershipController@index')->name('membership');
});