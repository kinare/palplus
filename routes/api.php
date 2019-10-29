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
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'UserController@index');
            Route::post('/', 'UserController@store');
            Route::get('/activate/{id}', 'UserController@activate');
            Route::get('/deactivate/{id}', 'UserController@deactivate');
            Route::get('/{id}', 'UserController@show');
            Route::patch('/{id}', 'UserController@update');
            Route::delete('/{id}', 'UserController@destroy');
            Route::delete('/{id}/force', 'UserController@forceDestroy');
        });

        Route::group(['prefix' => 'member'], function () {
            Route::get('/', 'MembersController@index');
            Route::post('/', 'MembersController@store');
            Route::get('/{id}', 'MembersController@show');
            Route::patch('/{id}', 'MembersController@update');
            Route::delete('/{id}', 'MembersController@destroy');
            Route::delete('/{id}/force', 'MembersController@forceDestroy');
        });

//        groups
        Route::namespace('Group')->group(function (){
            Route::group(['prefix' => 'group'], function () {
                Route::get('/', 'GroupController@index');
                Route::post('/', 'GroupController@store');
                Route::get('/{id}', 'GroupController@show');
                Route::patch('/{id}', 'GroupController@update');
                Route::delete('/{id}', 'GroupController@destroy');
                Route::delete('/{id}/force', 'GroupController@forceDestroy');
            });

            Route::group(['prefix' => 'activity'], function () {
                Route::get('/', 'GroupController@index');
                Route::post('/', 'GroupController@store');
                Route::get('/{id}', 'GroupController@show');
                Route::patch('/{id}', 'GroupController@update');
                Route::delete('/{id}', 'GroupController@destroy');
                Route::delete('/{id}/force', 'GroupController@forceDestroy');
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







//        Route::group(['prefix' => 'activity'], function () {
//            Route::get('/', 'GroupActivity@index');
//            Route::post('/', 'GroupActivity@store');
//            Route::post('/join', 'GroupActivity@join');
//            Route::post('/leave', 'GroupActivity@leave');
//            Route::get('/{id}', 'GroupActivity@show');
//            Route::patch('/{id}', 'GroupActivity@update');
//            Route::delete('/{id}', 'GroupActivity@destroy');
//            Route::delete('/{id}/force', 'GroupActivity@forceDestroy');
//        });
    });

});
