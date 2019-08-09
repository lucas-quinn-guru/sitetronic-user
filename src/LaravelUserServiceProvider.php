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
            'laravel-user'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->app['router']
            ->aliasMiddleware('isAdmin', \LucasQuinnGuru\LaravelUser\Middleware\AdminMiddleware::class);
        $this->app['router']
            ->aliasMiddleware('clearance', \LucasQuinnGuru\LaravelUser\Middleware\ClearanceMiddleware::class);


        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-user');



        $this->publishes([
            __DIR__ . '/../config/laravel_user.php' => config_path('laravel_user.php'),
        ], 'laravel-user-config');

        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('vendor/lucas-quinn-guru'),
        ], 'assets');
    }
}
