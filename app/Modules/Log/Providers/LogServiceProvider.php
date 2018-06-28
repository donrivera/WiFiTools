<?php

namespace App\Modules\Log\Providers;

use App\Modules\Log\Services\LogService;
use Illuminate\Support\ServiceProvider;
use App\Modules\Log\Contracts\LogServiceInterface;

class LogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        //parent::boot();
        //Route::model('user', App\User::class);
        #\App\Modules\Site\Models\Site::observe(\App\Modules\Site\SiteObserver::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /*
        $this->app->bind('App\Modules\Site\Services\DemoOne', function ($app)
        {
            return new DemoOne();
        });
        */
        $this->app->bind('App\Modules\Log\Contracts\LogServiceInterface', function ($app) {
            return new LogService();
          });
    }
}
