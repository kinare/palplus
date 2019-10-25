<?php

//Admin
Route::namespace('Admin')->group(function (){
    Route::post('invite', 'AdminAuthController@invite');
    Route::post('validate', 'AdminAuthController@validateToken');
    Route::post('create', 'AdminAuthController@register');
    Route::post('login', 'AdminAuthController@login');

    //password reset
    Route::group(['prefix' => 'password'], function (){
        Route::post('request', 'AdminPasswordResetController@create');
        Route::get('validate/{token}', 'AdminPasswordResetController@find');
        Route::post('/', 'AdminPasswordResetController@reset');
    });

    Route::group(['middleware' => 'multiauth:admin'], function () {
        Route::get('logout', 'AdminAuthController@logout');
        Route::get('me', 'AdminAuthController@me');
    });

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/', 'AdminController@index');
        Route::get('/activate/{id}', 'AdminController@activate');
        Route::get('/deactivate/{id}', 'AdminController@deactivate');
        Route::get('/{id}', 'AdminController@show');
        Route::patch('/{id}', 'AdminController@update');
        Route::delete('/{id}', 'AdminController@destroy');
        Route::delete('/{id}/force', 'AdminController@forceDestroy');

    });



});


