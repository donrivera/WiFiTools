<?php

/*
|--------------------------------------------------------------------------
|  Module Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'middleware' => ['auth:api'],
    'namespace' => 'App\Modules\Site\Controllers', 
    'prefix' => 'api'], 
function () 
{
    #Site Controller Routes#
    Route::resource('sites', 'SiteController');
    

});