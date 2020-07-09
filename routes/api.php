<?php

use Illuminate\Http\Request;

use App\Http\Controllers\ATController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
// Helpers
Route::get("/countries",function(){
	$countries = \App\Country::all(); 
	return response()->json($countries);
});
// End of Helpers


Route::namespace('Currency')->group(function (){
    Route::group(['prefix' => 'currency'], function () {
        Route::get('/', 'CurrencyController@index');
        Route::get('/{country_code}', 'CurrencyController@getCurrencyByCountryCode');
    });
});


Route::group(['middleware' => ['json.response']], function () {

    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
	});
	

    Route::group(['prefix' => 'auth'], function () {
        Route::namespace('Auth')->group(function (){
            Route::post('login', 'AuthController@login');
            Route::post('register', 'AuthController@register');
            Route::post('otp', 'AuthController@registerByPhone');
            Route::get('activate/{token}', 'AuthController@activate');

            //password reset
            Route::group(['prefix' => 'password'], function (){
                Route::post('request', 'UserPasswordResetController@create');
                Route::get('validate/{token}', 'UserPasswordResetController@find');
                Route::post('/', 'UserPasswordResetController@reset');
            });

            Route::group(['middleware' => 'auth:api'], function () {
                Route::post('refresh', 'AuthController@refresh');
                Route::get('logout', 'AuthController@logout');
				Route::post('confirm', 'AuthController@confirm_authenticate_user');
				Route::get('user', 'AuthController@user');
            });
        });
    });

    //Dashboard Routes
    Route::prefix('dashboard')->group(base_path('routes/dashboard.php'));

    //Gateway Routes
    Route::prefix('gateway')->group(base_path('routes/gateway.php'));



    Route::namespace('Currency')->group(function (){
        Route::group(['prefix' => 'currency'], function () {
            Route::post('/convert', 'CurrencyController@convert');
        });
	});

    Route::group(['middleware' => 'auth:api'], function () {

        Route::group(['prefix' => 'sms'], function () {
            Route::post('/', 'SmsController@send');
        });

        Route::group(['prefix' => 'feedback'], function () {
            Route::get('/', 'AppFeedbackController@index');
            Route::post('/', 'AppFeedbackController@store');
            Route::get('/{id}', 'AppFeedbackController@show');
        });

        Route::namespace('Loan')->group(function (){
            Route::group(['prefix' => 'loan'], function () {

				Route::group(['prefix' => ''], function () {
                    Route::get('/', 'LoanController@index');
                    Route::get('/limit/{group_id}', 'LoanController@limit');
                    Route::get('/group/{group_id}', 'LoanController@group');
                    Route::get('/overdue/{group_id?}', 'LoanController@overdue');
                    Route::post('/', 'LoanController@loan');
                    Route::post('/pay', 'LoanController@pay');
                    Route::post('/approve', 'LoanController@approve');
                    Route::post('/decline', 'LoanController@decline');
                });

                Route::group(['prefix' => 'settings'], function () {
                    Route::get('/', 'LoanSettingController@index');
                    Route::post('/', 'LoanSettingController@store');
                    Route::get('/{id}', 'LoanSettingController@show');
                    Route::patch('/{id}', 'LoanSettingController@update');
                    Route::delete('/{id}', 'LoanSettingController@destroy');
                    Route::delete('/{id}/force', 'LoanSettingController@forceDestroy');
                });

                Route::group(['prefix' => 'periods'], function () {
                    Route::get('/', 'LoanPeriodController@index');
                    Route::post('/', 'LoanPeriodController@store');
                    Route::get('/{id}', 'LoanPeriodController@show');
                    Route::patch('/{id}', 'LoanPeriodController@update');
                    Route::delete('/{id}', 'LoanPeriodController@destroy');
                    Route::delete('/{id}/force', 'LoanPeriodController@forceDestroy');
                });

               
            });
        });


		// Not Working
        Route::namespace('Contact')->group(function (){
            Route::group(['prefix' => 'contact'], function () {
                Route::post('/my-contacts', 'ContactsController@myContacts');
                Route::post('/search', 'ContactsController@search');
                Route::get('/contact-list', 'ContactsController@myContactList');
            });
        });

		// working
        Route::namespace('Investment')->group(function (){
            Route::group(['prefix' => 'investment-opportunity'], function () {
                Route::get('/', 'InvestmentOpportunityController@index');
                Route::get('/featured-rate', 'InvestmentOpportunityController@featuredRate');
                Route::post('/', 'InvestmentOpportunityController@store');
                Route::get('/{id}', 'InvestmentOpportunityController@show');
                Route::patch('/{id}', 'InvestmentOpportunityController@update');
                Route::delete('/{id}', 'InvestmentOpportunityController@destroy');
                Route::delete('/{id}/force', 'InvestmentOpportunityController@forceDestroy');
			});
			
			//
        });

        Route::namespace('Currency')->group(function (){
            Route::group(['prefix' => 'currency'], function () {
                Route::post('/', 'CurrencyController@store');
                Route::get('/{id}', 'CurrencyController@show');
                Route::patch('/{id}', 'CurrencyController@update');
                Route::delete('/{id}', 'CurrencyController@destroy');
                Route::delete('/{id}/force', 'CurrencyController@forceDestroy');
            });
        });

        Route::namespace('Notification')->group(function (){
            Route::group(['prefix' => 'notification'], function () {

                Route::group(['prefix' => 'types'], function () {
                    Route::get('/', 'NotificationTypesController@index');
                });

                Route::group(['prefix' => ''], function () {
					Route::get('/','NotificationController@index');
					Route::get('/read/{id}', 'NotificationController@read');
				});

            });
        });

        Route::namespace('Users')->group(function (){

            Route::group(['prefix' => 'gender'], function () {
                Route::get('/', 'GenderController@index');
            });

            Route::group(['prefix' => 'user'], function () {
                Route::get('/', 'UserController@index');
                Route::post('/', 'UserController@store');
                Route::get('/init-users', 'UserController@initUsers');
                Route::get('/activate/{id}', 'UserController@activate');
                Route::get('/deactivate/{id}', 'UserController@deactivate');
                Route::get('/wallet', 'UserController@wallet');
                Route::get('/profile', 'UserController@profile');
                Route::get('/nok', 'UserController@nok');
                Route::get('/groups', 'UserController@groups');
                Route::get('/transactions', 'UserController@transactions');
                Route::get('/accounts', 'UserController@accounts');
                Route::get('/payments', 'UserController@payments');
                Route::get('/loans', 'UserController@loans');
                Route::get('/notifications', 'UserController@notifications');
                Route::get('/contributions', 'UserController@contributions');
                Route::post('/transfer', 'UserController@transfer');
                Route::get('/contributions/group/{group_id}', 'UserController@contributionByGroup');
                Route::post('/deposit', 'UserController@deposit');
                Route::get('/{id}', 'UserController@show');
                Route::patch('/{id}', 'UserController@update');
                Route::delete('/{id}', 'UserController@destroy');
                Route::delete('/{id}/force', 'UserController@forceDestroy');
            });

            Route::group(['prefix' => 'profile'], function () {
                Route::get('/{id}', 'ProfileController@show');
                Route::post('/', 'ProfileController@store');
            });

            Route::group(['prefix' => 'nok'], function () {
                Route::get('/', 'NextOfKinController@index');
                Route::post('/', 'NextOfKinController@store');
                Route::get('/{id}', 'NextOfKinController@show');
                Route::patch('/{id}', 'NextOfKinController@update');
                Route::delete('/{id}', 'NextOfKinController@destroy');
                Route::delete('/{id}/force', 'NextOfKinController@forceDestroy');
            });
        });

        Route::namespace('Finance')->group(function (){

            Route::group(['prefix' => 'penalties'], function () {
                Route::get('/', 'PenaltyController@index');
                Route::post('/', 'PenaltyController@store');
            });

            Route::group(['prefix' => 'wallet'], function () {
                Route::get('/', 'WalletController@index');
                Route::get('/{id}', 'WalletController@show');
			});
			
			// money transfer start 
			Route::group(['prefix' => 'money'], function () {
                Route::post('/send', 'MoneyTransfer@send_money_another_app_user');
                Route::post('/contribute-group-admin', 'MoneyTransfer@contribute_group_admin');
            });
			// end of money transfer

            Route::group(['prefix' => 'transaction'], function () {
                Route::group(['prefix' => 'wallet'], function () {
                    Route::post('/deposit', 'TransactionController@deposit');
                    Route::post('/withdraw', 'TransactionController@withdraw');
                    Route::post('/request', 'TransactionController@transactionRequest');
                });
                Route::group(['prefix' => 'card'], function () {
                    Route::post('/pin', 'TransactionController@setCardPin');
                    Route::post('/otp', 'TransactionController@otp');
                });
            });

			// working
            Route::group(['prefix' => 'supplier'], function () {
                Route::get('/', 'SuppliersController@index');
                Route::post('/', 'SuppliersController@store');
                Route::get('/{id}', 'SuppliersController@show');
                Route::patch('/{id}', 'SuppliersController@update');
                Route::delete('/{id}', 'SuppliersController@destroy');
                Route::delete('/{id}/force', 'SuppliersController@forceDestroy');
            });

            Route::group(['prefix' => 'withdrawal'], function () {
                Route::group(['prefix' => 'settings'], function () {
                    Route::get('/', 'WithdrawalSettingController@index');
                    Route::post('/', 'WithdrawalSettingController@store');
                    Route::get('/{id}', 'WithdrawalSettingController@show');
                    Route::patch('/{id}', 'WithdrawalSettingController@update');
                    Route::delete('/{id}', 'WithdrawalSettingController@destroy');
                    Route::delete('/{id}/force', 'WithdrawalSettingController@forceDestroy');
                });

                Route::group(['prefix' => ''], function () {
                    Route::get('/limit/{type}/{group_id}', 'WithdrawalController@limit');
                    Route::post('/withdraw', 'WithdrawalController@withdraw');
                    Route::post('/project/withdraw', 'WithdrawalController@withdrawProject');
                    Route::post('/activity/withdraw', 'WithdrawalController@withdrawEvent');
                    Route::post('/approve', 'WithdrawalController@approve');
                    Route::post('/decline', 'WithdrawalController@decline');
                });

            });

            Route::group(['prefix' => 'payments'], function () {
                Route::get('/', 'PaymentController@index');
                Route::post('/pay', 'PaymentController@pay');
            });

            Route::group(['prefix' => 'accounts'], function () {

                Route::group(['prefix' => 'types'], function () {
                    Route::get('/', 'AccountTypeController@index');
                });

                Route::group(['prefix' => ''], function () {
                    Route::get('/', 'AccountController@index');
                    Route::post('/', 'AccountController@store');
                    Route::get('/{id}', 'AccountController@show');
                    Route::patch('/{id}', 'AccountController@update');
                    Route::delete('/{id}', 'AccountController@destroy');
                    Route::delete('/{id}/force', 'AccountController@forceDestroy');
                });
            });
        });

        Route::group(['prefix' => 'member'], function () {
            Route::get('/', 'MembersController@index');
            Route::post('/', 'MembersController@store');
            Route::get('/activate/{id}', 'MembersController@activate');
            Route::get('/deactivate/{id}', 'MembersController@deactivate');
            Route::get('/loans/{id}', 'MembersController@loans');
            Route::get('/contributions/{id}', 'MembersController@contributions');
            Route::get('/pending-payments/{id}', 'MembersController@payments');
            Route::get('/remove/{id}', 'MembersController@remove');
            Route::get('/{id}', 'MembersController@show');
            Route::patch('/{id}', 'MembersController@update');
            Route::delete('/{id}', 'MembersController@destroy');
            Route::delete('/{id}/force', 'MembersController@forceDestroy');
        });

        /*contributions*/
        Route::namespace('Contributions')->group(function (){
            Route::group(['prefix' => 'contribution'], function () {
                Route::group(['prefix' => 'categories'], function () {
                    Route::get('/', 'ContributionCategoryController@index');
                });

                Route::group(['prefix' => 'periods'], function () {
                    Route::get('/', 'ContributionPeriodController@index');
                });

                Route::group(['prefix' => 'types'], function () {
                    Route::get('/', 'ContributionTypeController@index');
                    Route::post('/', 'ContributionTypeController@store');
                    Route::get('/{id}', 'ContributionTypeController@show');
                    Route::get('/group/{group_id}', 'ContributionTypeController@byGroup');
                    Route::patch('/{id}', 'ContributionTypeController@update');
                    Route::delete('/{id}', 'ContributionTypeController@destroy');
                    Route::delete('/{id}/force', 'ContributionTypeController@forceDestroy');
                });
                Route::group(['prefix' => ''], function () {
                    Route::get('/', 'ContributionController@index');
                    Route::post('/', 'ContributionController@contribute');
                });
            });
        });

        /*Groups*/
        Route::namespace('Group')->group(function (){

            Route::group(['prefix' => 'reporting'], function () {
                Route::get('/', 'ReportingController@index');
                Route::post('/', 'ReportingController@store');
                Route::get('/{id}', 'ReportingController@show');
            });

            Route::group(['prefix' => 'project'], function () {
                Route::get('/', 'GroupProjectController@index');
                Route::post('/', 'GroupProjectController@store');
                Route::get('/contributions/types/{group_id}', 'GroupProjectController@types');
                Route::get('/contributions/{project_id}', 'GroupProjectController@contributions');
                Route::post('/contribute', 'GroupProjectController@contribute');
                Route::get('/{id}', 'GroupProjectController@show');
                Route::patch('/{id}', 'GroupProjectController@update');
                Route::delete('/{id}', 'GroupProjectController@destroy');
                Route::delete('/{id}/force', 'GroupProjectController@forceDestroy');
            });

            Route::group(['prefix' => 'invitation'], function () {
                Route::get('/', 'InvitationController@index');
                Route::post('/invite', 'InvitationController@invite');
                Route::post('/accept', 'InvitationController@accept');
                Route::post('/decline', 'InvitationController@decline');
            });

            Route::group(['prefix' => 'group-request'], function () {
                Route::get('/', 'GroupRequestsController@index');
                Route::post('/join', 'GroupRequestsController@request');
                Route::post('/approve', 'GroupRequestsController@approve');
                Route::post('/decline', 'GroupRequestsController@decline');
            });

            Route::group(['prefix' => 'group-setting'], function () {
                Route::get('/', 'GroupSettingController@index');
                Route::get('/{id}', 'GroupSettingController@show');
                Route::post('/{id}', 'GroupSettingController@update');
            });

            // Testing APIS 

            // Groups API
            Route::group(['prefix' => 'group'],function () {
					Route::get('/', 'GroupController@index');
					Route::post('/', 'GroupController@store');
                    Route::get('/{id}', 'GroupController@show');
					Route::patch('/{id}', 'GroupController@update');
					Route::delete('/{id}', 'GroupController@destroy');
					Route::delete('/{id}/force', 'GroupController@forceDestroy');
					Route::get('/me/{group_id}', 'GroupController@me');
					Route::get('/init-group/{currency}', 'GroupController@beforeCreate');
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
					Route::post('/{id}', 'GroupController@update');
				}
			);



            // Group Types
            Route::group(['prefix' => 'group-type'], function () {
                Route::get('/', 'GroupTypeController@index');
                Route::post('/', 'GroupTypeController@store');
                Route::get('/{id}', 'GroupTypeController@show');
                Route::patch('/{id}', 'GroupTypeController@update');
                Route::delete('/{id}', 'GroupTypeController@destroy');
                Route::delete('/{id}/force', 'GroupTypeController@forceDestroy');
            });

            Route::group(['prefix' => 'expense'], function () {
                Route::get('/', 'GroupExpenseController@index');
                Route::post('/', 'GroupExpenseController@store');
                Route::get('/{id}', 'GroupExpenseController@show');
                Route::get('/group/{group_id}/', 'GroupExpenseController@byGroup');
                Route::get('/activity/{activity_id}/', 'GroupExpenseController@byActivity');
                Route::patch('/{id}', 'GroupExpenseController@update');
                Route::delete('/{id}', 'GroupExpenseController@destroy');
                Route::delete('/{id}/force', 'GroupExpenseController@forceDestroy');
            });

            Route::group(['prefix' => 'activity'], function () {

                Route::group(['prefix' => 'contact'], function () {
                    Route::get('/', 'ActivityContactsController@index');
                    Route::post('/', 'ActivityContactsController@store');
                    Route::get('/{id}', 'ActivityContactsController@show');
                    Route::patch('/{id}', 'ActivityContactsController@update');
                    Route::delete('/{id}', 'ActivityContactsController@destroy');
                    Route::delete('/{id}/force', 'ActivityContactsController@forceDestroy');
                });

                Route::group(['prefix' => 'itinerary'], function () {
                    Route::get('/', 'ItineraryController@index');
                    Route::post('/', 'ItineraryController@store');
                    Route::get('/{id}', 'ItineraryController@show');
                    Route::patch('/{id}', 'ItineraryController@update');
                    Route::delete('/{id}', 'ItineraryController@destroy');
                    Route::delete('/{id}/force', 'ItineraryController@forceDestroy');
                });

                Route::group(['prefix' => ''], function () {
                    Route::get('/', 'GroupActivityController@index');
                    Route::post('/', 'GroupActivityController@store');
                    Route::get('/featured', 'GroupActivityController@featured');
                    Route::get('/featured-rate', 'GroupActivityController@featuredRate');
                    Route::get('/wallet/{activity_id}', 'GroupActivityController@wallet');
                    Route::get('/contributions/{activity_id}', 'GroupActivityController@contributions');
                    Route::get('/my-contributions/{activity_id}', 'GroupActivityController@myContributions');
                    Route::get('/contribution-types/{activity_id}', 'GroupActivityController@activityContributionTypes');
                    Route::get('/{id}', 'GroupActivityController@show');
                    Route::patch('/{id}', 'GroupActivityController@update');
                    Route::delete('/{id}', 'GroupActivityController@destroy');
                    Route::delete('/{id}/force', 'GroupActivityController@forceDestroy');
                    Route::post('/join', 'GroupActivityController@join');
                    Route::post('/leave', 'GroupActivityController@leave');
                    Route::post('/pay', 'GroupActivityController@pay');
                    Route::get('/members/{activity_id}', 'GroupActivityController@members');
                    Route::get('/itineraries/{activity_id}', 'GroupActivityController@itinerary');
                    Route::get('/contacts/{activity_id}', 'GroupActivityController@contact');
                    Route::get('/suppliers/{activity_id}', 'GroupActivityController@supplier');
                    Route::get('/expenses/{activity_id}', 'GroupActivityController@expenses');
                });
            });

            Route::group(['prefix' => 'activity-type'], function () {
                Route::get('/', 'ActivityTypeController@index');
                Route::post('/', 'ActivityTypeController@store');
                Route::get('/{id}', 'ActivityTypeController@show');
                Route::patch('/{id}', 'ActivityTypeController@update');
                Route::delete('/{id}', 'ActivityTypeController@destroy');
                Route::delete('/{id}/force', 'ActivityTypeController@forceDestroy');
            });


        });

        Route::namespace('Dashboard')->group(function (){
            Route::group(['prefix' => 'advert-setup'], function (){
                Route::get('/', 'DashboardController@advertSetups');
            });
        });
    });
});
