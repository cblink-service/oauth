<?php

namespace Cblink\Service\OAuth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    public function boot()
    {
        Auth::extend('service', function($app){
            return new Guard(
                $app->request,
                new ApiService(
                    config('services.service-oauth.base_url', ''),
                    config('services.service-oauth.token', '')
                )
            );
        });
    }

}