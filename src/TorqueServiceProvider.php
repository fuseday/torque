<?php

namespace Fuseday\Torque;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class TorqueServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('torque', Torque::class);

        $this->mergeConfigFrom(__DIR__.'/../config/torque.php', 'torque');

        Route::middleware('web')
            ->group(__DIR__ . DIRECTORY_SEPARATOR.'..'
                .DIRECTORY_SEPARATOR.'routes'
                .DIRECTORY_SEPARATOR.'web.php');
    }

    public function boot()
    {
        //
    }
}
