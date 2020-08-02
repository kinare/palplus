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
            Route::get('/', 'DashboardController@index');
            Route::get('/currency', 'DashboardController@currency');
            Route::get('/admins', 'DashboardController@admins');
            // groups
            Route::get('/groups', 'DashboardController@groups');
            Route::post('/groups', 'DashboardController@store');
            Route::get('/group/{id}', 'DashboardController@group');
            Route::get('/my-groups/{id}', 'DashboardController@myGroups');


            Route::get('/users', 'DashboardController@users');
            Route::get('/user/{id}', 'DashboardController@user');
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
            Route::post('/setups', 'DashboardController@setupsStore');
            Route::get('/setup/{id}', 'DashboardController@setup');
            Route::get('/paypal-withdrawals', 'DashboardController@paypalRequests');
            Route::get('/reportings', 'DashboardController@reportings');
            Route::post('/suspend-group', 'DashboardController@suspendGroup');
            Route::post('/suspend-member', 'DashboardController@suspendMember');
            Route::post('/send-sms', 'DashboardController@sendMessage');
            Route::post('/toggle-group-active', 'DashboardController@toggleGroupActive');
            Route::post('/toggle-member-active', 'DashboardController@toggleMemberActive');

            Route::group(['prefix' => 'group-setup'], function (){
                Route::get('/', 'DashboardController@groupSetups');
                Route::post('/', 'DashboardController@saveGroupSetup');
                Route::get('/{id}', 'DashboardController@groupSetup');
            });

            Route::group(['prefix' => 'advert-setup'], function (){
                Route::get('/', 'DashboardController@advertSetups');
                Route::post('/', 'DashboardController@saveAdvertSetup');
                Route::patch('/{id}', 'DashboardController@saveAdvertSetup');
                Route::get('/{id}', 'DashboardController@advertSetup');
			});
			

			// More ON Groups
			

		});
		

	Route::namespace('Currency')->group(function (){
		Route::group(['prefix' => 'currency'], function () {
			Route::get('/', 'CurrencyController@index');
		});
	});	
		// Groups API
	Route::namespace('Group')->group(function (){
		Route::group(['prefix' => 'group'],function () {
			Route::get('/members/{group_id}', 'GroupController@members');
			Route::get('/admins/{group_id}', 'GroupController@admins');
			Route::get('/contriburions/{group_id}', 'GroupController@contriburions');
			Route::get('/wallet/{group_id}', 'GroupController@wallet');
			Route::get('/approvers/{group_id}/{approver_type}', 'GroupController@approvers');
			Route::post('/join', 'GroupController@join');
			Route::get('/validate/{member_id}', 'GroupController@validateMember');
			Route::get('/leave-request/{group_id}', 'GroupController@leaveRequest');
			Route::post('/leave', 'GroupController@leave');
			Route::post('/make-admin', 'GroupController@makeAdmin');
			Route::post('/revoke-admin', 'GroupController@revokeAdmin');
			Route::post('/make-approver', 'GroupController@makeApprover');
			Route::post('/revoke-approver', 'GroupController@revokeApprover');
			Route::get('/settings/{group_id}', 'GroupController@settings');
			Route::get('/projects/{group_id}', 'GroupController@projects');
			Route::get('/activities/{group_id}', 'GroupController@activities');
			Route::get('/loan-settings/{group_id}', 'GroupController@loanSettings');
			Route::get('/withdrawals/{group_id}', 'GroupController@withdrawals');
			Route::get('/accept-leave', 'GroupController@adminsAcceptLeave');
			Route::get('/withdrawal-settings/{group_id}', 'GroupController@withdrawalSettings');
			Route::get('/type/{type_id}', 'GroupController@byType');
			Route::get('/pending-payments/{group_id}', 'GroupController@pendingPayments');
			Route::get('/my-payments/{group_id}', 'GroupController@myPendingPayments');
		}
	);
	});

    });
});


