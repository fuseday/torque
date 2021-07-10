<?php

namespace Fuseday\Torque;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Fuseday\Torque\Torque
 */
class TorqueFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'torque';
    }
}
