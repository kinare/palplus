<?php

Route::group(['prefix' => 'auth'], function () {
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

        Route::group(['middleware' => 'auth:admin'], function () {
            Route::post('refresh', 'AdminAuthController@refresh');
            Route::get('logout', 'AdminAuthController@logout');
            Route::get('me', 'AdminAuthController@me');
        });
    });
});

//Admin
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::namespace('Admin')->group(function (){
            Route::get('/', 'AdminController@index');
            Route::get('/toggle-status/{id}', 'AdminController@toggleStatus');
            Route::get('/{id}', 'AdminController@show');
            Route::post('/{id}', 'AdminController@update');
            Route::delete('/{id}', 'AdminController@destroy');
            Route::delete('/{id}/force', 'AdminController@forceDestroy');
        });
    });
});

Route::group(['prefix' => ''], function () {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::namespace('Dashboard')->group(function (){
            Route::get('/currency', 'DashboardController@currency');
            Route::get('/admins', 'DashboardController@admins');
            Route::get('/groups', 'DashboardController@groups');
            Route::get('/group/{id}', 'DashboardController@group');
            Route::get('/my-groups/{id}', 'DashboardController@myGroups');
            Route::get('/members', 'DashboardController@members');
            Route::get('/member/{id}', 'DashboardController@member');
            Route::get('/nok', 'DashboardController@nok');
            Route::get('/membership-setting', 'DashboardController@membershipSettings');
            Route::get('/transactions', 'DashboardController@transactions');
            Route::get('/payments', 'DashboardController@payments');
            Route::get('/investments', 'DashboardController@investments');
            Route::get('/loans', 'DashboardController@loans');
            Route::get('/loan-setting', 'DashboardController@loanSettings');
            Route::get('/wallet', 'DashboardController@wallets');
            Route::get('/wallet/transactions', 'DashboardController@walletTransactions');
            Route::get('/withdrawal-requests', 'DashboardController@withdrawalRequests');
            Route::get('/activity', 'DashboardController@activity');
            Route::get('/member-activity/{id}', 'DashboardController@memberActivity');
            Route::get('/project', 'DashboardController@projects');
            Route::get('/setups', 'DashboardController@setups');
            Route::get('/paypal-withdrawals', 'DashboardController@paypalRequests');
            Route::get('/reportings', 'DashboardController@reportings');

            Route::post('/suspend-group', 'DashboardController@suspendGroup');
            Route::post('/suspend-member', 'DashboardController@suspendMember');
            Route::post('/toggle-group-active', 'DashboardController@toggleGroupActive');
            Route::post('/toggle-member-active', 'DashboardController@toggleMemberActive');
        });
    });
});


