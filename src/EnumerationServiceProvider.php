<?php

namespace Jundayw\LaravelEnumeration;

use Illuminate\Support\ServiceProvider;
use Jundayw\LaravelEnumeration\Console\Enumeration;

class EnumerationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->commands([
            Enumeration::class,
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/stubs', 'enumeration');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/stubs' => $this->app->resourcePath('views/vendor/enumeration'),
            ], 'enumeration');
        }
    }
}
