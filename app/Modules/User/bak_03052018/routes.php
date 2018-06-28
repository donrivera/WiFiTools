<?php

/*
|--------------------------------------------------------------------------
|  Module Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function (){return "test";});
Route::get('hello', function() {
	return "John Doe";
 });
Route::group(['module'=>'User','namespace' => 'App\Modules\User\Controllers', 'prefix' => 'api'], function () 
{
	
	Route::get('/login', 'UserController@login');
	Route::get('/hello', function() {
		return "John Doe";
	 });
	Route::get('/details', 'UserController@details')->middleware('auth:api');
	Route::get('/user', function(Request $request) 
	{
		//return Auth::user();
		return Auth::check();
	})->middleware('auth:api');
	Route::get('/auth-check', function(Request $request) 
	{
		//return Auth::user();
		return (Auth::check()==1?"true":"false");
	})->middleware('auth:api');
	Route::get('/logout', function(Request $request)
	{
		return Auth::logout();
	})->middleware('auth:api');
	#Route::get('user', 'UserController@showAll');
	//Route::get('user-all', 'AuthController@showAll');
});