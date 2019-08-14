<?php

namespace LucasQuinnGuru\SitetronicUser;

use Illuminate\Support\ServiceProvider;

class SitetronicUserServiceProvider extends ServiceProvider
{

    protected $commands = [
        'LucasQuinnGuru\SitetronicUser\Commands\SeedRolesAndPermissionsCommand'
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/sitetronic-user.php',
            'sitetronic-user'
        );

        $this->commands($this->commands);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'sitetronic-user');

        $this->app['router']
            ->aliasMiddleware('isAdmin', \LucasQuinnGuru\SitetronicUser\Middleware\AdminMiddleware::class);
        $this->app['router']
            ->aliasMiddleware('clearance', \LucasQuinnGuru\SitetronicUser\Middleware\ClearanceMiddleware::class);


        $this->publishes([
            __DIR__ . '/../config/sitetronic_user.php' => config_path('sitetronic_user.php'),
        ], 'sitetronic-user-config');

        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('vendor/lucas-quinn-guru'),
        ], 'assets');
    }
}
