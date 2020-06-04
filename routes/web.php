<?php
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/response', function (Request $request) {
	$body = $request->route()->parameter('response');
	// dd($body);
	$response = json_decode($body);

	return view('response', ['status' => $response->status]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');
