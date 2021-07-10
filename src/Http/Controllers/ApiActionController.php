<?php

namespace Fuseday\Torque\Http\Controllers;

use Illuminate\Http\Request;

class ApiActionController
{
    public function __invoke(Request $request, string $entrypoint)
    {
        $entrypointNamespace = config('torque.entrypointNamespace');
        [$class, $method] = explode('@', $entrypoint);
        $class = str_replace('.', '\\', $class);
        //@TODO check if `$entrypoint` needs sanitization (checking for vulnerabilities)
        return app("{$entrypointNamespace}\\{$class}")->{$method}($request);
    }
}
