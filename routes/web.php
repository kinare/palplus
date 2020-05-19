<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// start of rave callback
// Route::group(['prefix' => 'rave'], function () {
//     Route::namespace('Gateway')->group(function (){
//         Route::post('/callback/hook', 'RaveHookDumpController@store');
//     });
// });
// end of rave callback hook

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');
