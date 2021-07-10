<?php

namespace Fuseday\Torque\Services;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Str;

class AssetUrlResolver
{
    /**
     * The path for the internal manifest file
     */
    private const MANIFEST_FILE_PATH = 'vendor/fuseday/torque/public/mix-manifest.json';

    /**
     * @var \Illuminate\Contracts\Routing\UrlGenerator
     */
    private UrlGenerator $router;

    /**
     * PlugAssetResolver constructor.
     *
     * @param \Illuminate\Contracts\Routing\UrlGenerator $router
     *
     * @return void
     */
    public function __construct(UrlGenerator $router)
    {
        $this->router = $router;
    }

    /**
     * Get the asset route.
     *
     * @param string $path
     *
     * @return string
     * @throws \JsonException
     */
    public function get(string $path): string
    {
        $manifestPath = base_path(self::MANIFEST_FILE_PATH);

        $manifests = json_decode(file_get_contents($manifestPath), true, 512, JSON_THROW_ON_ERROR);

        if (array_key_exists($path, $manifests)) {
            $filePath = $manifests[$path];
        } else {
            $filePath = $path;
        }

        [$assetFolder, $assetFile] = explode('/', Str::after($filePath, '/'));

        $url = $this->router->route('torque.asset', [$assetFolder, $assetFile]);

        if (! Str::contains($assetFile, '?id=')) {
            $content = app()->make(AssetContentsResolver::class)
                ->resolve($assetFolder, $assetFile);
            $url .= '?'.http_build_query(['id' => md5($content)]);
        }

        return $url;
    }

    /**
     * Get the asset route, without cache-busting versioned suffix.
     *
     * @param string $path
     *
     * @return string
     * @throws \JsonException
     */
    public function getRaw(string $path): string
    {
        [$assetFolder, $assetFile] = explode('/', Str::after($path, '/'));

        return $this->router->route('torque.asset', [$assetFolder, $assetFile]);
    }
}
