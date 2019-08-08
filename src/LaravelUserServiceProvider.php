<?php

namespace LucasQuinnGuru\LaravelUser;

use Illuminate\Support\ServiceProvider;

class LaravelUserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/laravel_user.php',
            'laravel_user'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom( __DIR__ . '../routes/web.php' );

        $this->publishes([
            __DIR__ . '/../config/laravel_user.php' => config_path('laravel_user.php'),
        ], 'laravel-user-config');

        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('vendor/lucas-quinn-guru'),
        ], 'assets');
    }
}
