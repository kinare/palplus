<?php

//Admin
Route::namespace('Admin')->group(function (){
    Route::post('invite', 'AdminAuthController@invite');
    Route::post('validate', 'AdminAuthController@validateToken');
    Route::post('create', 'AdminAuthController@register');
    Route::post('login', 'AdminAuthController@login');

    //password reset
    Route::group(['prefix' => 'password'], function (){
        Route::post('create', 'AdminAuthController@create');
        Route::get('find/{token}', 'AdminAuthController@find');
        Route::post('reset', 'AdminAuthController@reset');
    });

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('logout', 'AdminAuthController@logout');
        Route::get('admin', 'AdminAuthController@user');
        Route::resource('/', 'AdminController');
    });



});


