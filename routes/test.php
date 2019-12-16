<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'rave'], function () {
    Route::get('/card', 'ApiTest@raveCardTest');
    Route::get('/validate-card', 'ApiTest@validateCard');
});
