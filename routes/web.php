<?php
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/response', function (Request $request) {
	$body = $request->get('response');
	$response = json_decode($body);
	// dd($response->status);
	$status  = "";

	if($response->status === 'successful'){
		$status = $response->status;
	}else{
		$status = $response->status;
	}
	// dd($status);
	return view('response')->with('status', $response->status);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');
