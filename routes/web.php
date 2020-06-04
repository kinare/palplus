<?php
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/response', function (Request $request) {
	$body = @file_get_contents("php://input");
	http_response_code(200);
	$response = json_decode($body);

	return view('response', ['status' => $response->status]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');
