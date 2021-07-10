<?php

namespace Fuseday\Torque\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Fuseday\Torque\Services\AssetContentsResolver;

class AssetController extends Controller
{
    /**
     * @var \Fuseday\Torque\Services\AssetContentsResolver
     */
    private $assetContentsResolver;

    /**
     * AssetController constructor.
     *
     * @param \Fuseday\Torque\Services\AssetContentsResolver $assetContentsResolver
     */
    public function __construct(AssetContentsResolver $assetContentsResolver)
    {
        $this->assetContentsResolver = $assetContentsResolver;
    }

    /**
     * @param string $assetFolder
     * @param string $assetFile
     */
    public function __invoke(string $assetFolder, string $assetFile)
    {
        $content = $this->assetContentsResolver->resolve($assetFolder, $assetFile);

        $headers = [];
        if ($assetFolder === 'js') {
            $headers['content-type'] = 'application/javascript';
        } elseif ($assetFolder === 'css') {
            $headers['content-type'] = 'text/css';
        } elseif ($assetFolder === 'img') {
            $imageType = Str::after($assetFile, '.');
            $imageType = $imageType === 'jpg' ?: 'jpeg';
            $headers['content-type'] = "image/{$imageType}";
        }

        return response()->make($content, 200, $headers);
    }
}
