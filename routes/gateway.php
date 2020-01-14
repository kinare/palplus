<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Gateway routes Routes
|--------------------------------------------------------------------------
|
| For External third party integrations
|
*/

Route::group(['prefix' => 'rave'], function () {
    Route::any('/hook', 'RaveHookDumpController@store');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/', 'RaveHookDumpController@index');
    });

});
