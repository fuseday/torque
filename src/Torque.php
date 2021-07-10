<?php

namespace Fuseday\Torque;

class Torque
{
    protected $components;

    public function __construct()
    {
        $this->components = collect();
    }

    public function registerComponent($string)
    {
        $this->components->push($string);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getComponents(): \Illuminate\Support\Collection
    {
        return $this->components;
    }
}
