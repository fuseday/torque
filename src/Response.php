<?php

namespace Fuseday\Torque;

use Illuminate\Support\Collection;

class Response
{
    /** @var Collection */
    protected $state = [];

    /** @var Collection */
    protected $store = [];

    /** @var Collection */
    protected $storeGlobal = [];

    /** @var Collection */
    protected $events = [];

    /** @var Collection */
    protected $eventsGlobal = [];

    /** @var Collection */
    protected $callbacks = [];

    /** @var Collection */
    protected $toasts = [];

    /** @var Collection */
    protected $extra = [];


    public function __construct()
    {
        $this->state = collect();
        $this->store = collect();
        $this->storeGlobal = collect();
        $this->events = collect();
        $this->eventsGlobal = collect();
        $this->callbacks = collect();
        $this->toasts = collect();
        $this->validator = collect();
        $this->extra = collect();
    }

    public static function make()
    {
        return new self();
    }

    public function toastSuccess($message)
    {
        $this->toasts[] = Toast::success($message);
        return $this;
    }

    public function toastInfo($message)
    {
        $this->toasts[] = Toast::info($message);
        return $this;
    }

    public function toastWarning($message)
    {
        $this->toasts[] = Toast::warning($message);
        return $this;
    }

    public function toastError($message)
    {
        $this->toasts[] = Toast::error($message);
        return $this;
    }

    public function state($state)
    {
        collect($state)->each(fn($item, $key) => $this->state->put($key, $item));
        return $this;
    }

    public function validator($data)
    {
        collect($data)->each(fn($item, $key) => $this->validator->put($key, $item));
        return $this;
    }

    public function event($name, $payload)
    {
        $this->events->push(['name' => $name, 'payload' => $payload, 'type' => 'BusEvent']);
        return $this;
    }

    public function __toString(): string
    {
        $data = collect();
        $data->put('state', $this->state);
        $data->put('toasts', $this->toasts);
        $data->put('validator', $this->validator);
        $data->put('events', $this->events);
        // TODO
//        $data->put('vueState', $this->vueState);
//        $data->put('vuex', $this->vuex);
//        $data->put('redirects', json_encode($this->redirects));
        return $data->toJson();
    }
}
