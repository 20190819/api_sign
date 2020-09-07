<?php

namespace Young\ApiSign;

use Illuminate\Support\ServiceProvider;
use Young\ApiSign\Service\ApiSignService;

class ApiSignServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ApiSignService::class, function ($app) {
            return new ApiSignService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.('/../config/sign.php') => config_path('sign.php'),
        ]);
    }
}
