<?php

namespace App\Modules\Site\Providers;

use App\Modules\Site\Services\SiteService;
use Illuminate\Support\ServiceProvider;
use App\Modules\Site\Contracts\SiteServiceInterface;

class SiteServiceProvider extends ServiceProvider
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
        \App\Modules\Site\Models\Site::observe(\App\Modules\Site\SiteObserver::class);
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
        $this->app->bind('App\Modules\Site\Contracts\SiteServiceInterface', function ($app) {
            return new SiteService();
          });
    }
}
