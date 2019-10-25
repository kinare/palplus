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
                Route::post('create', 'AuthController@create');
                Route::get('find/{token}', 'AuthController@find');
                Route::post('reset', 'AuthController@reset');
            });

            Route::group(['middleware' => 'auth:api'], function () {
                Route::get('logout', 'AuthController@logout');
                Route::get('user', 'AuthController@user');
            });
        });
    });

    //store Routes
    Route::prefix('admin')->group(base_path('routes/admin.php'));

    Route::group(['middleware' => 'auth:api'], function () {
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'UserController@index');
            Route::post('/', 'UserController@store');
            Route::get('/admins', 'UserController@admins');
            Route::get('/activate/{id}', 'UserController@activate');
            Route::get('/deactivate/{id}', 'UserController@deactivate');
            Route::get('/admin/make/{id}', 'UserController@makeAdmin');
            Route::get('/admin/loose/{id}', 'UserController@looseAdmin');
            Route::get('/{id}', 'UserController@show');
            Route::patch('/{id}', 'UserController@update');
            Route::delete('/{id}', 'UserController@destroy');
            Route::delete('/{id}/force', 'UserController@forceDestroy');
        });
    });

});
