<?php

namespace etctech\OverallHelper\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;
use etctech\OverallHelper\Mixins\ShcemaMixins;
use etctech\OverallHelper\Mixins\RouteMixins;

class OverallHelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    { }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMixins();
    }

    public function registerMixins()
    {
        /**
         * Schema
         */
        Schema::mixin(ShcemaMixins::class);

        /**
         * Route
         */
        Route::mixin(RouteMixins::class);
    }
}
