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

Route::group(['prefix' => 'setup'], function () {
    Route::namespace('Gateway')->group(function (){
        Route::group(['middleware' => ['auth:admin', 'auth:api']], function () {
            Route::get('/', 'GatewaySetupController@index');
            Route::post('/', 'GatewaySetupController@store');
            Route::get('/{id}', 'GatewaySetupController@show');
            Route::patch('/{id}', 'GatewaySetupController@update');
            Route::delete('/{id}', 'GatewaySetupController@destroy');
        });
    });
});


Route::group(['prefix' => 'rave'], function () {
    Route::namespace('Gateway')->group(function (){
        Route::any('/hook', 'RaveHookDumpController@store');

        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('/transfer-countries', 'RaveController@getRaveTransferCountries');
            Route::get('/transfer-banks/{countryCode}', 'RaveController@getBanksForTransfer');
        });

        Route::group(['middleware' => 'auth:admin'], function () {
            Route::get('/', 'RaveHookDumpController@index');
            Route::get('/process', 'RaveHookDumpController@process');
            Route::post('/test', 'RaveHookDumpController@test');
        });
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
