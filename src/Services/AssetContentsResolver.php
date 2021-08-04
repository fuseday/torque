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
    public function resolve(string $kind, string $name): string
    {
        if(
            Str::contains(
                app()->make(Router::class)->getCurrentRoute()->uri(),
                'fonts/vendor'
            )
        ) {
            $assetDirectory = self::ASSET_DIRECTORY . '/fonts/vendor';
        }
        else {
            $assetDirectory = self::ASSET_DIRECTORY;
        }

        $path = base_path($assetDirectory.DIRECTORY_SEPARATOR.$kind.DIRECTORY_SEPARATOR.$name);
        return $this->files->get($path);
    }
}
