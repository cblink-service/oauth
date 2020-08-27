<?php

/*
 * This file is part of the cblink-service/oauth.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Cblink\Service\OAuth;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Laravel\Passport\Passport;
use Overtrue\LaravelPassportCacheToken\CacheTokenServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        Passport::ignoreMigrations();
        $this->app->register(CacheTokenServiceProvider::class);
        $this->publishes([__DIR__ . '/../config/' => config_path()]);
    }
}
