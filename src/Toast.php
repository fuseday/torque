<?php

namespace Fuseday\Torque;

use JsonSerializable;

/**
 * Class Toast
 * Following V-Alert guidelines.
 * @see https://vuetifyjs.com/en/components/alerts/
 *
 */
class Toast
{
    public string $type;
    public string $color;
    public string $icon;
    public string $message;

    public static function info($message)
    {
        $toast = new static;
        $toast->type = 'info';
        $toast->message = $message;
        $toast->color = 'blue';
        $toast->icon = '';
        return $toast;
    }

    public static function success($message)
    {
        $toast = new static;
        $toast->type = 'success';
        $toast->color = 'green';
        $toast->message = $message;
        $toast->icon = 'mdi-apps';
        return $toast;
    }

    public static function error($message)
    {
        $toast = new static;
        $toast->type = 'error';
        $toast->color = 'red';
        $toast->message = $message;
        $toast->icon = '';
        return $toast;
    }

    public static function warning($message)
    {
        $toast = new static;
        $toast->message = $message;
        $toast->color = 'orange';
        $toast->icon = '';
        return $toast;
    }
}
