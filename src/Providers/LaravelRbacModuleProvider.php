<?php
namespace Tommyprmbd\LaravelRbacModule\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

final class LaravelRbacModuleProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        
    }

    public function boot(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            \Tommyprmbd\LaravelRbacModule\Console\InstallCommand::class,
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [\Tommyprmbd\LaravelRbacModule\Console\InstallCommand::class];
    }
}