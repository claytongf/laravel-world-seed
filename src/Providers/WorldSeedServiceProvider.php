<?php

namespace Claytongf\Providers;

use Claytongf\Console\Commands\WorldAddCountryCommand;
use Claytongf\Console\Commands\WorldSeedCommand;
use Illuminate\Support\ServiceProvider;

class WorldSeedServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        /* Merge Configurations */
        $this->mergeConfigFrom(
            __DIR__ . '/config/world.php',
            'world'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        /* Load migrations */
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        /* Publish the configurations */
        $this->publishes([
            __DIR__ . '/config/world.php' => config_path('world.php'),
        ], 'config');

        /* Publish JSON files */
        $this->publishes([
            __DIR__ . '/database/json' => database_path('json'),
        ], 'json');

        /* Register the Commands */
        if ($this->app->runningInConsole()) {
            $this->commands([
                WorldSeedCommand::class,
                WorldAddCountryCommand::class
            ]);
        }
    }
}
