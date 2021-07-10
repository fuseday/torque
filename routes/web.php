<?php


use Illuminate\Support\Facades\Route;
use Fuseday\Torque\Http\Controllers\ApiActionController;
use Fuseday\Torque\Http\Controllers\AssetController;

Route::get('/_torque/assets/{assetFolder}/{assetFile}', AssetController::class)
    ->where('assetFile', '.*') //todo Joõa ',*' ??? why ?
    ->name('torque.asset');

Route::get('/fonts/vendor/{assetFolder}/{assetFile}', AssetController::class)
    ->where('assetFile', '.*');

Route::post('/_torque/message/{entrypoint}', ApiActionController::class)->name('torque.message');

