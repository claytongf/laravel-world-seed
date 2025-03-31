<?php

namespace Claytongf\WorldSeed\Providers;

use Claytongf\WorldSeed\Commands\WorldAddCountryCommand;
use Claytongf\WorldSeed\Commands\WorldSeedCommand;
use Illuminate\Support\ServiceProvider;

class WorldSeedServiceProvider extends ServiceProvider
{
    /*
     * Register services.
     */
    public function register(): void
    {
        /* Merge Configurations */
        $this->mergeConfigFrom(
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'world.php',
            'world'
        );
    }

    /*
     * Bootstrap services.
     */
    public function boot(): void
    {
        /* Load migrations */
        $this->loadMigrationsFrom(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'migrations');

        /* Publish the configurations */
        $this->publishes([
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'world.php' => config_path('world.php'),
        ], 'config');

        /* Register the Commands */
        if ($this->app->runningInConsole()) {
            $this->commands([
                WorldSeedCommand::class,
                WorldAddCountryCommand::class
            ]);
        }
    }
}
