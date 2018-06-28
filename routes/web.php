<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});
//$app->group(['namespace' => 'App\Modules\Site\Controllers','prefix' => 'api'], function() use ($app)
$app->group(['prefix' => 'api'], function() use ($app)
{
    // Using The "App\Http\Controllers\Admin" Namespace...
    $app->get('sites','SiteController@index');
    //$app->get('sites','SiteController@index');
    
});
$app->get('/foo', function () {
    return 'Hello World';
});


