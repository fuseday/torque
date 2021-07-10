<?php

namespace Fuseday\Torque;

use Illuminate\Support\ServiceProvider;

class TorqueServiceProvider extends ServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $this->app->singleton('torque', Torque::class);

        $this->mergeConfigFrom(__DIR__.'/../config/torque.php', 'torque');
    }

    public function registeringPackage()
    {
        $this->app->register(ComponentsServiceProvider::class);
    }
}
