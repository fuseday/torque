<?php

if (! function_exists('torque_asset')) {
    function torque_asset($path, $manifestDirectory = '')
    {
        return app(Fuseday\Torque\Services\AssetUrlResolver::class)->get($path);
    }
}
