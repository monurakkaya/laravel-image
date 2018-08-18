<?php

namespace Monurakkaya\LaravelImage\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseProvider;
use Monurakkaya\LaravelImage\Models\Image;
use Monurakkaya\LaravelImage\Observers\ImageObserver;

class ServiceProvider extends BaseProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Route::group([
            'middleware' => ['bindings'],
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../../routes/laravel-image.php');
        });

        $this->publishes([
            __DIR__.'/../../database/migrations' => base_path('/database/migrations'),
            __DIR__.'/../../lang' => resource_path('lang')
        ], 'laravel-image');

        $this->loadViewsFrom(__DIR__.'/../../views/laravel-image', 'laravel-image');

        Blade::component('laravel-image::master', 'laravelImage');

        Image::observe(ImageObserver::class);

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }
}
