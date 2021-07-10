<?php

namespace Fuseday\Torque;

use Fuseday\Torque\Commands\TorqueCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class TorqueServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('torque')
            ->hasMigration('create_torque_table')
            ->hasRoutes('web')
            ->hasCommand(TorqueCommand::class);

        $this->app->singleton('torque', Torque::class);

        $this->loadViewsFrom($package->basePath('/../resources/views'), $package->name);
        $this->mergeConfigFrom(__DIR__.'/../config/torque.php', 'torque');
    }

    public function registeringPackage()
    {
        $this->app->register(ComponentsServiceProvider::class);
    }
}
