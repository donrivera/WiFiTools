<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Dusterio\LumenPassport\LumenPassport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.
        //$token="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImRjN2RlZDQ4ZmVhYTc5MDU5ZjFhNDMzMDg4MjBiYTNmMjY1NjVmYjQ3ZDk2ZjcxYjcxMDQxY2VmM2QxNzgwMDM3ZWZmZGE3NTllMWU4MjExIn0.eyJhdWQiOiI3IiwianRpIjoiZGM3ZGVkNDhmZWFhNzkwNTlmMWE0MzMwODgyMGJhM2YyNjU2NWZiNDdkOTZmNzFiNzEwNDFjZWYzZDE3ODAwMzdlZmZkYTc1OWUxZTgyMTEiLCJpYXQiOjE1MjM0OTA2NzcsIm5iZiI6MTUyMzQ5MDY3NywiZXhwIjoxNTIzNDk0Mjc3LCJzdWIiOiI0Iiwic2NvcGVzIjpbIioiXX0.AJiFklOKQvdxZIXxjQMT7muKOlZ3UsmNjlIxDInZludK7e20E0J54sRzFn5HbQ_-sQnh7FOeb4HHUVIr6xPgZ_KcfwrjcdtM6YVHBHfZCw4zQP4gPl-tbrb8lMMItB9edE-cRRxePV-iBzcyZlbJ3yKHmK9FE6bwoSF0Yb4kLIGqAgVJLQLVeW0qIzSEYfLAYAJrAZVxeWOeMGWkLfElwHvqVi6lBGhvvt1HLM_ApJgdAL0XyeXUtBrGLu0LwQP6SKcCUFRzo-Nj0arEkD3Ol9ew2FeQv9vihHAcXTH2RoeQUd8zhsmCV2FVblPmQA-TTA-n31_2ZbEeJzIb7uzUUNxhGrdyjWCa2JWDN1cWLg2gASiZ9WdT-5qvqBSdxuNT_qyEzfomEB7I-lf5E6B02Etv2r7Yx0slpurmddmCP9a0s5nCy4V1vJfvckJ8JCX2u8vjGB_lGEcuOIBEV4suy_-ohtLqBvph1uTlBM3KYq2rkuLG_F0nh0iane-6ak6FtBjjWFZ8ib2ECBK9rf6-o8ZB040dEcG5ByiLVGBv8eQ7lvrjA4cCU7owK_ICt6vkfwn5Vtnn5TC2P5sFdNffCl2pJRqBb5s2CFGYbIREw8aLH_mequ2NEFoG2wO0bLIhBuCkEYQTq6Uz7LAG-2NadT3CYKTP8E2V1nyR-WbICtc";
        $this->app['auth']->viaRequest('api', function ($request) {
            if ($request->input('api_token')) {
                return User::where('api_token', $request->input('api_token'))->first();
            }
        });
        //LumenPassport::tokensExpireIn(Carbon::now()->addYears(10),6);
        //LumenPassport::refreshTokensExpireIn(Carbon::now()->addDays(10));
       // LumenPassport::allowMultipleTokens();
    }
}
