<?php

namespace Fuseday\Torque;

class Torque
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected $components;

    public function __construct()
    {
        $this->components = collect();
    }

    public function registerComponent($vendorPackage, $files)
    {
        $this->components->put($vendorPackage, $files);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getComponents(): \Illuminate\Support\Collection
    {
        return $this->components;
    }

    public function renderComponents(): string
    {
        return $this->components->map(function ($files, $vendorPackage) {
            return implode("\n", $files);
        })->implode("\n");
    }
}
