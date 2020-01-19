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
        Route::get('/process', 'RaveHookDumpController@process');
        Route::post('/test', 'RaveHookDumpController@test');
    });

});

Route::namespace('Finance')->group(function (){

    Route::group(['prefix' => 'paypal'], function () {
        Route::get('withdrawal-requests', 'PaypalWithdrawalRequestController@index');
        Route::get('ec-checkout-success', 'TransactionController@paypalToken');
        Route::get('ec-payout-success', function (){
            return 'Payout successfull';
        });
    });

});
