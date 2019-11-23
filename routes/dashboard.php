<?php

//Admin
Route::namespace('Dashboard')->group(function (){

    Route::group(['middleware' => 'auth:admin'], function () {

        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', 'DashboardController@index');
        });
    });



});


