<?php

namespace Fuseday\Torque\Services;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Routing\Router;
use Illuminate\Support\Str;

class AssetContentsResolver
{
    /**
     * The assets directory.
     */
    private const ASSET_DIRECTORY = 'vendor/fuseday/torque/public';

    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    private Filesystem $files;

    /**
     * AssetController constructor.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }

    /**
     * Resolve the contents of the provided asset.
     *
     * @param string $kind
     * @param string $name
     *
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function resolve(string $vendor, string $package, string $distFile): string
    {
        $path = base_path(
            'vendor'.DIRECTORY_SEPARATOR.
            $vendor.DIRECTORY_SEPARATOR.
            $package.DIRECTORY_SEPARATOR.
            'dist'.DIRECTORY_SEPARATOR.
            $distFile);

        // TODO scan mix-manifest for safety!

        return $this->files->get($path);
    }
}
