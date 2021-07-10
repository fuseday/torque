<?php

namespace Fuseday\Torque;

use Illuminate\Support\ServiceProvider;

class ComponentsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerComponent('JCard');
    }

    protected function registerComponent(string $component)
    {
        $this->app->make('torque')->registerComponent($component);
    }
}
