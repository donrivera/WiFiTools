<?php

/*
|--------------------------------------------------------------------------
|  Module Routes
|--------------------------------------------------------------------------
*/

use Illuminate\Http\Request;

$app->get('/logs','LogController@index');
/*
Route::group([
    'middleware' => ['auth:api'],
    'namespace' => 'App\Modules\User\Controllers', 
    'prefix' => 'api'], 
function () 
{
    #Site Controller Routes#
	Route::resource('users', 'UserController');
	Route::get('/auth-check','UserController@authCheck');
	Route::get('/logout','UserController@logOut');
});
*/