<?php

//Admin
Route::namespace('Admin')->group(function (){
    Route::post('login', 'AdminAuthController@login');
    Route::post('register', 'AdminAuthController@register');
    Route::get('activate/{token}', 'AdminAuthController@activate');

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


