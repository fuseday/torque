<?php

namespace Fuseday\Torque\Http\Controllers;

use DateTime;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Fuseday\Torque\Services\AssetContentsResolver;

class LegoController extends Controller
{
    /**
     * @var AssetContentsResolver
     */
    private $assetContentsResolver;

    /**
     * AssetController constructor.
     *
     * @param AssetContentsResolver $assetContentsResolver
     */
    public function __construct(AssetContentsResolver $assetContentsResolver)
    {
        $this->assetContentsResolver = $assetContentsResolver;
    }

    /**
     * @param string $assetFolder
     * @param string $assetFile
     * @return Response|mixed
     * @throws BindingResolutionException
     * @throws FileNotFoundException
     */
    public function __invoke(string $vendor, string $package, string $distFile)
    {
        $content = $this->assetContentsResolver->resolve($vendor, $package, $distFile);

        $ext = Str::afterLast($distFile, '.');

        $contentType = match ($ext) {
            'js' => 'application/javascript',
            'map' => 'application/javascript',
            'css' => 'text/css',
            'svg' => 'image/svg+xml',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'woff' => 'application/font-woff',
            'woff2' => 'application/font-woff2',
            'ttf' => 'application/font-ttf',
            'eot' => 'application/vnd.ms-fontobject',
            'otf' => 'application/font-otf',
            'mp4' => 'video/mp4',
            'webm' => 'video/webm',
            'mp3' => 'audio/mpeg',
            'ogg' => 'audio/ogg',
            'wav' => 'audio/wav',
            'pdf' => 'application/pdf',
            'zip' => 'application/zip',
            'tar' => 'application/x-tar',
            'gz' => 'application/x-gzip',
            'bz2' => 'application/x-bzip2',
            '7z' => 'application/x-7z-compressed',
            'rar' => 'application/x-rar-compressed',
            'default' => 'application/octet-stream',
        };

        $headers = [];
        $headers['content-type'] = $contentType;

        return response()
            ->make($content, 200, $headers)
            ->setLastModified(DateTime::createFromFormat('U', (string) filemtime($distFile)));
    }
}
