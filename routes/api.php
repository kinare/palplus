<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
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
                Route::get('user', 'AuthController@user');
            });
        });
    });

    //Admin Routes
    Route::prefix('admin')->group(base_path('routes/admin.php'));

    Route::group(['middleware' => 'auth:api'], function () {

        Route::namespace('Investment')->group(function (){
            Route::group(['prefix' => 'investment-opportunity'], function () {
                Route::get('/', 'InvestmentOpportunityController@index');
                Route::post('/', 'InvestmentOpportunityController@store');
                Route::get('/{id}', 'InvestmentOpportunityController@show');
                Route::patch('/{id}', 'InvestmentOpportunityController@update');
                Route::delete('/{id}', 'InvestmentOpportunityController@destroy');
                Route::delete('/{id}/force', 'InvestmentOpportunityController@forceDestroy');
            });
        });

        Route::namespace('Currency')->group(function (){
            Route::group(['prefix' => 'currency'], function () {
                Route::get('/', 'CurrencyController@index');
                Route::post('/', 'CurrencyController@store');
                Route::get('/{id}', 'CurrencyController@show');
                Route::patch('/{id}', 'CurrencyController@update');
                Route::delete('/{id}', 'CurrencyController@destroy');
                Route::delete('/{id}/force', 'CurrencyController@forceDestroy');
            });
        });

        Route::namespace('Users')->group(function (){
            Route::group(['prefix' => 'gender'], function () {
                Route::get('/', 'GenderController@index');
            });

            Route::group(['prefix' => 'user'], function () {
                Route::get('/', 'UserController@index');
                Route::post('/', 'UserController@store');
                Route::get('/activate/{id}', 'UserController@activate');
                Route::get('/deactivate/{id}', 'UserController@deactivate');
                Route::get('/wallet', 'UserController@wallet');
                Route::get('/profile', 'UserController@profile');
                Route::get('/nok', 'UserController@nok');
                Route::get('/groups', 'UserController@groups');
                Route::get('/transactions/{type?}', 'UserController@transactions');
                Route::get('/accounts', 'UserController@accounts');
                Route::get('/payments', 'UserController@payments');
                Route::get('/loans', 'UserController@loans');
                Route::get('/contributions', 'UserController@contributions');
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
            Route::group(['prefix' => 'wallet'], function () {
                Route::get('/', 'WalletController@index');
                Route::get('/{id}', 'WalletController@show');
            });

            Route::group(['prefix' => 'supplier'], function () {
                Route::get('/', 'SuppliersController@index');
                Route::post('/', 'SuppliersController@store');
                Route::get('/{id}', 'SuppliersController@show');
                Route::patch('/{id}', 'SuppliersController@update');
                Route::delete('/{id}', 'SuppliersController@destroy');
                Route::delete('/{id}/force', 'SuppliersController@forceDestroy');
            });
        });

        Route::group(['prefix' => 'member'], function () {
            Route::get('/', 'MembersController@index');
            Route::post('/', 'MembersController@store');
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

            Route::group(['prefix' => 'group'], function () {
                Route::get('/', 'GroupController@index');
                Route::post('/', 'GroupController@store');
                Route::get('/{id}', 'GroupController@show');
                Route::patch('/{id}', 'GroupController@update');
                Route::delete('/{id}', 'GroupController@destroy');
                Route::delete('/{id}/force', 'GroupController@forceDestroy');
                Route::get('/me/{group_id}', 'GroupController@me');
                Route::get('/members/{group_id}', 'GroupController@members');
                Route::get('/admins/{group_id}', 'GroupController@admins');
                Route::get('/contriburions/{group_id}', 'GroupController@contriburions');
                Route::get('/wallet/{group_id}', 'GroupController@wallet');
                Route::get('/approvers/{group_id}/{approver_type}', 'GroupController@approvers');
                Route::post('/join', 'GroupController@join');
                Route::post('/leave', 'GroupController@leave');
                Route::post('/make-admin', 'GroupController@makeAdmin');
                Route::post('/revoke-admin', 'GroupController@revokeAdmin');
                Route::post('/make-approver', 'GroupController@makeApprover');
                Route::post('/revoke-approver', 'GroupController@revokeApprover');
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
                Route::get('/', 'GroupActivityController@index');
                Route::post('/', 'GroupActivityController@store');
                Route::get('/{id}', 'GroupActivityController@show');
                Route::get('/group/{id}', 'GroupActivityController@byGroup');
                Route::patch('/{id}', 'GroupActivityController@update');
                Route::delete('/{id}', 'GroupActivityController@destroy');
                Route::delete('/{id}/force', 'GroupActivityController@forceDestroy');
            });

            Route::group(['prefix' => 'activity-type'], function () {
                Route::get('/', 'ActivityTypeController@index');
                Route::post('/', 'ActivityTypeController@store');
                Route::get('/{id}', 'ActivityTypeController@show');
                Route::patch('/{id}', 'ActivityTypeController@update');
                Route::delete('/{id}', 'ActivityTypeController@destroy');
                Route::delete('/{id}/force', 'ActivityTypeController@forceDestroy');
            });

            Route::group(['prefix' => 'group-type'], function () {
                Route::get('/', 'GroupTypeController@index');
                Route::post('/', 'GroupTypeController@store');
                Route::get('/{id}', 'GroupTypeController@show');
                Route::patch('/{id}', 'GroupTypeController@update');
                Route::delete('/{id}', 'GroupTypeController@destroy');
                Route::delete('/{id}/force', 'GroupTypeController@forceDestroy');
            });
        });
    });
});
